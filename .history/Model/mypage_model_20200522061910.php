<?php
  
  function create_mypage($user_id, $pdo) {//mypage.phpに表示する情報を取り出します
    try{
      //DBから「name」と「mail」を取り出す
      $sql = "SELECT name, mail, iv FROM php_task.user WHERE user_id = :user_id;";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
      $stmt->execute();
      $mypage_user = $stmt->fetch(PDO::FETCH_ASSOC);
      //メールアドレス復号
      $encrypted_mail = openssl_decrypt($mypage_user["mail"], 'aes-256-cbc', "password1234", 0, hex2bin($mypage_user['iv']));
      $mypage_user["mail"] = $encrypted_mail;
      return $mypage_user;
    }catch (PDOException $e){
      $_SESSION["error"] = $e->getMessage();
    };
  };

  function update_my_name($user_id, $name, $pdo) {
    //名前の空欄チェック
    if ($name == ""){
      return $_SESSION["error"] = "名前が入力されていません。";
    };
    
    try{
      //DBから$user_idを条件とし「name」を更新する
      $sql = "UPDATE user SET name = :name, updated = now() WHERE user.user_id = :user_id;";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
      $stmt->bindValue(":name", $name, PDO::PARAM_STR);
      $stmt->execute();      
    
    }catch (PDOException $e){
      $_SESSION["error"] = $e->getMessage();
      $_SESSION["error"] = "変更に失敗しました。";
    };
  };

  function update_my_mail($user_id, $mail, $pdo) {
    //メールアドレスの入力フォームチェック
    if ($mail == ""){
      return $_SESSION["error"] = "メールが入力されていません。";
	  }else if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)){
      return $_SESSION["error"] = "メールアドレスの形式が正しくありません。";
    };
    try{
      //$mailを暗号化する
      //DBから「iv」を取り出す
      $sql = "SELECT iv FROM php_task.user WHERE user_id = :user_id;";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
      $stmt->execute();
      $update_mail_iv = $stmt->fetch(PDO::FETCH_ASSOC);
      
      //メールアドレス暗号化
      $encrypted_mail = openssl_encrypt($mail, 'aes-256-cbc', "password1234", 0, hex2bin($update_mail_iv["iv"]));

      // var_dump($encrypted_mail);
      // exit;

      //DBから$user_idを条件とし「name」を更新する
      $sql2 = "UPDATE user SET mail = :mail, updated = now() WHERE user.user_id = :user_id;";
      $stmt2 = $pdo->prepare($sql2);
      $stmt2->bindValue(":user_id", $user_id, PDO::PARAM_STR);
      $stmt2->bindValue(":mail", $encrypted_mail, PDO::PARAM_STR);
      $stmt2->execute();      
    }catch (PDOException $e){
      $_SESSION["error"] = $e->getMessage();
      $_SESSION["error"] = "変更に失敗しました。";
    };
  };

?>