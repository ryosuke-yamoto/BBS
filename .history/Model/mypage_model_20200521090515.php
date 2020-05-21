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
      $_SESSION["error"]["create_mypage"] = $e->getMessage();
      echo $_SESSION["error"]["create_mypage"];
      exit;
    };
  };

  function update_my_name($user_id, $name, $pdo) {
    try{
      //DBから$user_idを条件とし「name」を更新する
      $sql = "UPDATE user SET name = :name, updated = now() WHERE user.user_id = :user_id;";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
      $stmt->bindValue(":name", $name, PDO::PARAM_STR);
      $stmt->execute();      
    
    }catch (PDOException $e){
      $_SESSION["error"]["update_my_name"] = $e->getMessage();
    };
  };

?>