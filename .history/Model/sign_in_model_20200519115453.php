<?php
  session_start();

  $_SESSION["error"] = array();

  function user_input_validate($mail, $password) {//新規登録フォームチェック
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

  function sign_in_user($mail, $password, $name, $pdo) {
    try{
      

      $sql = "SELECT user_id, mail, iv, password FROM php_task.user";
      $stmt = $pdo->prepare($sql);
    //   $stmt->bindValue(':id', $input_id, PDO::PARAM_INT);
      $stmt->execute();
      foreach ($stmt as $row) {
      //復号
      $decrypted = openssl_decrypt($row["mail"], 'aes-256-cbc', "password1234", 0, hex2bin($row["iv"]));
      if($decrypted == $mail && empty($row["deleted"])) {
        if($password == $row["password"]) {
          //ログイン成功
          return 1;
        }else {
          $_SESSION["error"]["login_failure"] = "ログインに失敗しました。";
          $_SESSION["error"]["password_check"] = "入力したパスワードに誤りがあります。";
        };
        $_SESSION["error"]["login_failure"] = "ログインに失敗しました。入力したメールアドレスかパスワードに誤りがあります。";
        
      };
      
      
    }catch (PDOException $e){
      print('Error:'.$e->getMessage());
      die();
    }
  }



?>