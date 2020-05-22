<?php

  function register_user_temporery($mail,$token,$pdo) {//メール入力判定並びに仮登録及びメール送信
	  
    //本登録に同じメールアドレスがあったら登録できない（削除されていなかったら）
    // try {
    //   $sql = "SELECT mail, iv, deleted FROM php_task.user";  
    //   $stmt = $pdo -> prepare($sql);
    //   $stmt->execute();
    //   foreach ($stmt as $row) {
    //     //復号
    //     $encrypted = openssl_decrypt($row["mail"], 'aes-256-cbc', "password1234", 0, hex2bin($row['iv']));
    //     if($encrypted == $mail && empty($row["deleted"])) {
    //       // $e['check_temporary'] = "このメールアドレスはすでに登録されてあります。";
    //       $_SESSION["error"] = "このメールアドレスはすでに登録されてあります。";
    //       return 1;
    //     };
    //   };
    // } catch (PDOException $e) {
    //   //エラー発生時
    //   $_SESSION["error"] = $e->getMessage();
    //   $_SESSION["error"] = "送信に失敗しました。";
    //   return 1;
    // }; 
    //仮登録
	  try {
      // $mailを暗号化
      $str = $mail;
      $password = "password1234";
      $method = "aes-256-cbc";
      $ivLength = openssl_cipher_iv_length($method);
      $iv = openssl_random_pseudo_bytes($ivLength);
      $options = 0;
      $encrypted = openssl_encrypt($str, $method, $password, $options, $iv);
      
      $sql = "INSERT INTO php_task.user_temporary(email, urltoken, iv, created) VALUES(:email, :urltoken, :iv, now())";
      $stmt = $pdo -> prepare($sql);
      $stmt->bindValue(":email", $encrypted, PDO::PARAM_STR);
      $stmt->bindValue(":urltoken", $token, PDO::PARAM_STR);
      //バイナリ文字列ではmysqlに保存できないので１６進表現に変換する
      //ivをDBに入れるのは復号する時に使うため
      $stmt->bindValue(":iv", bin2hex($iv), PDO::PARAM_STR);
      $stmt->execute();
    } catch (PDOException $e) {
      //エラー発生時
      $_SESSION["error"] = $e->getMessage();
      $_SESSION["error"] = "送信に失敗しました。";
      return 1;
    }; 
  
    //メール送信
    mb_language("Japanese"); 
    mb_internal_encoding("UTF-8");
  
    $url = "http://localhost:8888/BBS_yamoto/Controller/signup_temporery.php?token=" . $token;
    
    $email = "xxxxxx@example.com";//送信元
    $subject = "仮登録メール"; // 題名 
    $body = "24時間以内に下記のURLからご登録下さい。\n" . $url; // 本文
    $to = $mail; // 宛先
    $header = "From: $email\nReply-To: $email\n";
    //メール送信
    mb_send_mail($to, $subject, $body, $header);
  };

  function mail_check($token, $pdo) {//メールのurlを踏んで来た人が正当か判定する（同じtokenか？）（tokenが生成されて24時間以内か）
    try {
      $sql = "SELECT * FROM php_task.user_temporary WHERE urltoken = :token and DATE_ADD(created, INTERVAL 1 DAY) > NOW();";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':token', $token, PDO::PARAM_INT);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      //エラー発生時
      $_SESSION["error"] = $e->getMessage();
      $_SESSION["error"] = "認証に失敗しました。もう一度登録をやり直してください";
    };
  };

  function user_input_validate($mail, $password, $name) {//新規登録フォームチェック
    //パスワードチェック
    if($password == "") {
      $_SESSION["error"]["password_check"] = "パスワードが入力されていません。";
    }else if(!preg_match("/\A[a-z\d]{8,16}+\z/i", $password)) {
      $_SESSION["error"]["password_check"] = "パスワードは半角英数記号のみを使用して、8文字以上16文字で入力してください。";
    };
    //名前チェック
    if($name == "") {
      $_SESSION["error"]["name_check"] = "名前が入力されていません。";
    };
  };

  function sign_up_user($mail, $password, $name, $token, $pdo) {//新規登録及び仮登録のデータを論理削除
    try {
      //仮登録からメールアドレス取り出す
      $mail_sql = "SELECT email, iv FROM php_task.user_temporary WHERE urltoken = :urltoken";
      $mail_stmt = $pdo -> prepare($mail_sql);
      $mail_stmt->bindValue(":urltoken", $token, PDO::PARAM_STR);
      $mail_stmt->execute();
      $mail = $mail_stmt->fetch(PDO::FETCH_ASSOC);
      var_dump($mail);
      exit;
      //user_idとauto_signin_keyにはランダムな文字を返す
      $user_id = bin2hex(random_bytes(16));
      $auto_signin_key = bin2hex(random_bytes(16));
      //パスワードハッシュ化
      $password = password_hash($password, PASSWORD_BCRYPT);
      // $mailを暗号化
      $str = $mail["email"];
      $mail_password = "password1234";
      $method = 'aes-256-cbc';
      $ivLength = openssl_cipher_iv_length($method);
      $iv = openssl_random_pseudo_bytes($ivLength);
      $options = 0;
      $encrypted = openssl_encrypt($str, $method, $mail_password, $options, $iv);

      $sql = "INSERT INTO php_task.user(user_id, mail, iv, password, name, created, auto_signin_key) VALUES(:user_id, :mail, :iv, :password, :name, now(), :auto_signin_key)";

      $stmt = $pdo -> prepare($sql);
      $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
      $stmt->bindValue(":mail", $encrypted, PDO::PARAM_STR);
      $stmt->bindValue(":iv", bin2hex($iv), PDO::PARAM_STR);
      $stmt->bindValue(":password", $password, PDO::PARAM_STR);
      $stmt->bindValue(":name", $name, PDO::PARAM_STR);
      $stmt->bindValue(":auto_signin_key", $auto_signin_key, PDO::PARAM_STR);
      $stmt->execute();
      //登録できたら仮登録を削除します
      $sql2 = "UPDATE php_task.user_temporary SET deleted = now() WHERE urltoken = :token;";
      $stmt2 = $pdo -> prepare($sql2);
      $stmt2->bindValue(":token", $token, PDO::PARAM_STR);
      $stmt2->execute();
      //新規登録できたらセッション削除
      //セッション変数削除
      $_SESSION = array();
      //セッションの破棄
      $sSessionName = session_name();
      if(isset($_COOKIE[$sSessionName])){
        setcookie($sSessionName, '', time() - 1800, '/');
      };
      //セッションハイジャック対策
			session_regenerate_id(true);
      //新しくセッション作成「user_id」と「auto_signin」を使う
      session_start();
      $_SESSION["user_id"] = $user_id;
      return $auto_signin_key;
    } catch (PDOException $e) {
      //エラー発生時
      $_SESSION["error"] = $e->getMessage();
      $_SESSION["error"] = "登録に失敗しました。もう一度やり直してください。";
    }; 

  };

?>