<?php
  function user_input_validate($mail, $password) {//ログインフォームチェック
    //メールチェック
    if ($mail == ""){
      $_SESSION["error"] = "メールが入力されていません。";
	  }else if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)){
      $_SESSION["error"] = "メールアドレスの形式が正しくありません。";
    };
    //パスワードチェック
    if($password == "") {
      $_SESSION["error"] = "パスワードが入力されていません。";
    }else if(!preg_match("/\A[a-z\d]{8,16}+\z/i", $password)) {
      $_SESSION["error"] = "パスワードは半角英数記号のみを使用して、8文字以上16文字で入力してください。";
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

  function set_auto_signin($pdo, $user_id, $auto_signin_key) {
    //DBにauto_signin_keyを入れる
    try{
      //DBから$user_idを条件とし「auto_signin_key」を更新する
      $sql = "UPDATE user SET auto_signin_key = :auto_signin_key, updated = now() WHERE user.user_id = :user_id;";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":auto_signin_key", $auto_signin_key, PDO::PARAM_STR);
      $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
      $stmt->execute();      
    
    }catch (PDOException $e){
      $_SESSION["error"] = $e->getMessage();
      echo $_SESSION["error"]["update_article"];
      exit;
    };

  };

?>