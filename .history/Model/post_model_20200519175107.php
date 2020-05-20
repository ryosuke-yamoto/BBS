<?php
  session_start();
  
  function post_article($title, $content, $pdo) {
    try{
      
      //$article_idをランダムな文字列で生成
      $article_id = base64_encode(openssl_random_pseudo_bytes(16));

      //user_idはセッション変数から取得
      $user_id = $_SESSION["user_id"];

      $sql = "INSERT INTO php_task.article(article_id, title, content, created, user_id ) VALUES(:article_id, :title, :content, now(), :user_id)";
      $stmt = $pdo -> prepare($sql);
      $stmt->bindValue(":article_id", article_id, PDO::PARAM_STR);
      $stmt->bindValue(":title", $title, PDO::PARAM_STR);
      $stmt->bindValue(":content", $content, PDO::PARAM_STR);
      $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
      $stmt->execute();
    }catch (PDOException $e){
      $_SESSION["error"]["post_failure"] = $e->getMessage();
    };
  };

?>