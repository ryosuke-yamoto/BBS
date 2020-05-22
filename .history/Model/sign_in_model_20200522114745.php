<?php
  function user_input_validate($mail, $password) {//ログインフォームチェック
    //メールチェック
    if ($mail == ""){
      $_SESSION["error"]["mail_check"] = "メールが入力されていません。";
	  }else if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)){
      $_SESSION["error"]["mail_check"] = "メールアドレスの形式が正しくありません。";
    };
    //パスワードチェック
    if($password == "") {
      $_SESSION["error"]["password_check"] = "パスワードが入力されていません。";
    }else if(!preg_match("/\A[a-z\d]{8,16}+\z/i", $password)) {
      $_SESSION["error"]["password_check"] = "パスワードは半角英数記号のみを使用して、8文字以上16文字で入力してください。";
    };
  };

  function sign_in_user($mail, $password, $pdo) {//ログインしてセッション変数作成
    try{

      $sql = "SELECT user_id, mail, iv, password FROM php_task.user";
      $stmt = $pdo->prepare($sql);
    //   $stmt->bindValue(':id', $input_id, PDO::PARAM_INT);
      $stmt->execute();

      foreach ($stmt as $row) {
      //復号
      $decrypted = openssl_decrypt($row["mail"], 'aes-256-cbc', "password1234", 0, hex2bin($row["iv"]));
      if($decrypted === $mail && empty($row["deleted"])) {
        if(password_verify($password, $row["password"]) == true) {
          //ログイン成功
          //セッションハイジャック対策
          session_regenerate_id(true);
          //セッション変数にuser_idを入れる
		      $_SESSION["user_id"] = $row["user_id"];
          return 1;
        }else {
          $_SESSION["error"] = "ログインに失敗しました。入力したパスワードに誤りがあります。";
        };
      }else {
        $_SESSION["error"] = "ログインに失敗しました。入力したメールアドレスかパスワードに誤りがあります。";
      };
    };
      
    }catch (PDOException $e){
      $_SESSION["error"] = $e->getMessage();
    };
  };

  function set_auto_signin($pdo, $user_id) {
    //クッキーとDBに保存するキーはランダムな文字列
    $auto_signin_key = bin2hex(random_bytes(16));
    
    $_SESSION["auto_signin"] = $auto_signin_key;

    //DBにauto_signin_keyを入れる
    try{
      //DBから$user_idを条件とし「auto_signin_key」を更新する
      $sql = "UPDATE user SET auto_signin_key = :auto_signin_key, updated = now() WHERE user.user_id = :user_id;";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":auto_signin_key", $auto_signin_key, PDO::PARAM_STR);
      $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
      $stmt->execute();
      return $auto_signin_key;
    
    }catch (PDOException $e){
      $_SESSION["error"] = $e->getMessage();
      echo $_SESSION["error"];
      exit;
    };

  };
  
  function auto_sign_in($auto_signin_key,$pdo) {
    // var_dump($auto_signin_key);
    //   exit;
    try{
      $sql = "SELECT user_id, auto_signin_key FROM user;";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();  
      $auto_signin_key_array = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $count = 0;
      foreach($auto_signin_key_array as $row) {
        if ($row["auto_signin_key"] == $auto_signin_key) {
          $count = 1;
          $_SESSION["user_id"] = $row["user_id"];
        };
      };
      // var_dump($count);
      // exit;
      return $count;
    
    }catch (PDOException $e){
      $_SESSION["error"] = $e->getMessage();
      echo $_SESSION["error"];
      exit;
    };
    
  };

  function create_user_id($auto_signin, $pdo) {//auto_signinをキーにuser_idを生成します
    try{
      $sql = "SELECT user_id FROM user WHERE auto_signin_key = :auto_signin_key ;";

      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":auto_signin_key", $auto_signin, PDO::PARAM_STR);
      $stmt->execute();  
      $user_id_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $_SESSION["user_id"] = $user_id_data["user_id"];
    }catch (PDOException $e){
      $_SESSION["error"] = $e->getMessage();
      $_SESSION["error"] = ["自動ログイン失敗"];
      header("Location: http://localhost:8888/BBS_yamoto/View/top.php");
    };
  };
?>