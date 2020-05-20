<?php
  
  function post_article($title, $content, $pdo) {
    try{
      
      //$article_idをランダムな文字列で生成
      $article_id = base64_encode(openssl_random_pseudo_bytes(16));

      //user_idはセッション変数から取得
      $user_id = $_SESSION["user_id"];

      $sql = "INSERT INTO php_task.article(article_id, title, content, created, user_id ) VALUES(:article_id, :title, :content, now(), :user_id)";
      $stmt = $pdo -> prepare($sql);
      $stmt->bindValue(":article_id", $article_id, PDO::PARAM_STR);
      $stmt->bindValue(":title", $title, PDO::PARAM_STR);
      $stmt->bindValue(":content", $content, PDO::PARAM_STR);
      $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
      $stmt->execute();
    }catch (PDOException $e){
      $_SESSION["error"]["post_failure"] = $e->getMessage();
      echo $_SESSION["error"]["post_failure"];
    };
  };

  function create_post_list($pdo) {
    global $post_array;
    $post_array = array();
    try{
      $sql = "SELECT article_id, title, content, created, user_id FROM php_task.article";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $post_array = $stmt->fetchAll(PDO::FETCH_ASSOC);
      var_dump($post_array);
      echo "<br />";
      $sql2 = "SELECT user_id, name FROM php_task.user";
      $stmt2 = $pdo->prepare($sql2);
      $stmt2->execute();
      $data = $stmt2->fetchAll(PDO::FETCH_ASSOC);
      var_dump($data);
      echo "<br />";

      foreach ($post_array as $row) {
        foreach ($data as $row2) {
          if($row["user_id"] == $row2["user_id"]) {
            echo $row["user_id"], $row2["name"];
            $row["user_id"] = $row2["name"];
          };
        };
      };
      var_dump($post_array);

      exit;
    }catch (PDOException $e){
      $_SESSION["error"]["post_failure"] = $e->getMessage();
      echo $_SESSION["error"]["post_failure"];
    };
  };

?>