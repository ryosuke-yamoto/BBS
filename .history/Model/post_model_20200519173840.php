<?php

  function post_article() {
    try{
      
      //$article_idをランダムな文字列で生成
      $article_id = base64_encode(openssl_random_pseudo_bytes(16));

      $sql = "INSERT INTO php_task.article(article_id, title, content, created, user_id ) VALUES(:article_id, :title, :iv, :content, now(), :user_id)";

      $stmt = $pdo -> prepare($sql);
      $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
      $stmt->bindValue(":mail", $encrypted, PDO::PARAM_STR);
      $stmt->bindValue(":iv", bin2hex($iv), PDO::PARAM_STR);
      $stmt->bindValue(":password", $password, PDO::PARAM_STR);
      $stmt->bindValue(":name", $name, PDO::PARAM_STR);
      $stmt->execute();
      
    }catch (PDOException $e){
      $_SESSION["error"]["login_failure"] = $e->getMessage();
    };
  };

?>