<?php

  function register_user_temporery($mail,$token,$pdo) {
    global $e;
	  //メール入力判定
	  if ($mail == ""){
		$e["mail"] = "メールが入力されていません。";
	  }else if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)){
		$e["mail_check"] = "メールアドレスの形式が正しくありません。";
	  }else {
      //本登録に同じメールアドレスがあったら登録できない（削除されていなかったら）
      try {
        $sql = "SELECT mail, iv, deleted FROM php_task.user";  
        $stmt = $pdo -> prepare($sql);
        // $stmt->bindValue(":email", $mail, PDO::PARAM_STR);
        $stmt->execute();
        // $count = 0;//登録するアドレスが登録してあるか数える
        foreach ($stmt as $row) {
          //復号
          $encrypted = openssl_decrypt($row["mail"], 'aes-256-cbc', "password1234", 0, hex2bin($row['iv']));
          if($encrypted == $mail && empty($row["deleted"])) {
            // $e['check_temporary'] = "このメールアドレスはすでに登録されてあります。";
            $_SESSION["error"]['check_temporary'] = "このメールアドレスはすでに登録されてあります。";
            header("Location: ../View/Signup/mail_send.php");
            exit;
          };
        };
      } catch (PDOException $e) {
        //エラー発生時
        echo $e->getMessage();
        exit;
      };     
    
	  try {
      // require_once( "dbconnect.php" );
      // dbconnection();
      //   var_dump($pdo);
      //   exit;
      
      // $mailを暗号化
      $str = $mail;
      $password = "password1234";
      $method = "aes-256-cbc";
      $ivLength = openssl_cipher_iv_length($method);
      $iv = openssl_random_pseudo_bytes($ivLength);
      $options = 0;
      $encrypted = openssl_encrypt($str, $method, $password, $options, $iv);
      //バイナリ文字列ではmysqlに保存できないので１６進表現に変換する
      

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
      echo $e->getMessage();
      exit;
    }; 
    };
  
    //メール送信
    mb_language("Japanese"); 
    mb_internal_encoding("UTF-8");
  
    $url = "http://localhost:8888/BBS_yamoto/Controller/signup_temporery.php?token=" . $token;
    
    $email = "xxxxxx@example.com";//送信元
    $subject = "テスト"; // 題名 
    $body = "24時間以内に下記のURLからご登録下さい。\n" . $url; // 本文
    $to = $mail; // 宛先
    $header = "From: $email\nReply-To: $email\n";
    
    mb_send_mail($to, $subject, $body, $header);
  };

  function mail_check($token, $pdo) {
    global $e;
    try {
      $sql = "SELECT * FROM php_task.user_temporary WHERE urltoken = :token and DATE_ADD(created, INTERVAL 1 DAY) > NOW();";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':token', $token, PDO::PARAM_INT);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      var_dump($data);
    } catch (PDOException $e) {
      //エラー発生時
      echo $e->getMessage();
      exit;
    };
  };

  function user_input_validate() {
    global $e;
  };

  function sign_up_user($mail, $password, $name, $pdo) {
    global $e;
    try {

      //user_idにはランダムな16文字を返す
      $user_id = bin2hex(random_bytes(16));
      
      //パスワードハッシュ化
      $password = password_hash($password, PASSWORD_BCRYPT);

      // $mailを暗号化
      $str = $mail;
      $mail_password = "password1234";
      $method = 'aes-256-cbc';
      $ivLength = openssl_cipher_iv_length($method);
      $iv = openssl_random_pseudo_bytes($ivLength);
      $options = 0;
      $encrypted = openssl_encrypt($str, $method, $mail_password, $options, $iv);

      $sql = "INSERT INTO php_task.user(user_id, mail, iv, password, name, created) VALUES(:user_id, :mail, :iv, :password, :name, now())";

      $stmt = $pdo -> prepare($sql);
      $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
      $stmt->bindValue(":mail", $encrypted, PDO::PARAM_STR);
      $stmt->bindValue(":iv", bin2hex($iv), PDO::PARAM_STR);
      $stmt->bindValue(":password", $password, PDO::PARAM_STR);
      $stmt->bindValue(":name", $name, PDO::PARAM_STR);
      $stmt->execute();
    } catch (PDOException $e) {
      //エラー発生時
      echo $e->getMessage();
      exit;
    }; 

  }

?>