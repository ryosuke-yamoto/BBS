<?php
  
  function post_article($title, $content, $pdo) {//新規投稿します
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

  function create_post_list($pdo) {//記事一覧の配列を生成します
    $post_array = array();
    try{
      //DBからarticleを取り出す
      $sql = "SELECT article_id, title, content, created, user_id FROM php_task.article WHERE deleted IS NULL order by created asc;";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $post_array = $stmt->fetchAll(PDO::FETCH_ASSOC);
      //DBのuserテーブルからuser_idとnameを取り出す
      $sql2 = "SELECT user_id, name FROM php_task.user";
      $stmt2 = $pdo->prepare($sql2);
      $stmt2->execute();
      $data = $stmt2->fetchAll(PDO::FETCH_ASSOC);
      //$post_arrayのuser_idをnameに変換する
      foreach ($post_array as &$row) {
        foreach ($data as $row2) {
          if($row["user_id"] == $row2["user_id"]) {
            $row += array("name"=>$row2["name"]);
          };
        };
      };
      return $post_array;
    }catch (PDOException $e){
      $_SESSION["error"]["post_failure"] = $e->getMessage();
    };
  };

  function delete_article($delete_id, $pdo) {//記事を削除します
    try{
      $sql = "update article set deleted = now() where article.article_id = :delete_id;";
      $stmt = $pdo -> prepare($sql);
      $stmt->bindValue(":delete_id", $delete_id, PDO::PARAM_STR);
      $stmt->execute();
    }catch (PDOException $e){
      $_SESSION["error"]["delete_article_failure"] = $e->getMessage();
      echo $_SESSION["error"]["delete_article_failure"];
      exit;
    };
  };

  function create_update_post($article_id, $pdo) {//update_post.phpに表示する「タイトル」と「内容」を取り出します
    try{
      //DBからarticleを取り出す
      $sql = "SELECT title, content FROM php_task.article WHERE article_id = :article_id;";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":article_id", $article_id, PDO::PARAM_STR);
      $stmt->execute();
      $update_article = $stmt->fetch(PDO::FETCH_ASSOC);
      
      return $update_article;
    }catch (PDOException $e){
      $_SESSION["error"]["create_update_post"] = $e->getMessage();
      echo $_SESSION["error"]["create_update_post"];
      exit;
    };
  };

  function update_article($update_id, $update_title, $update_content, $pdo) {
    try{
      //DBから$update_idを条件とし「タイトル」と「内容」を更新する
      $sql = "UPDATE article SET title = :title, content = :content, updated = now() WHERE article.article_id = :article_id;";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":article_id", $update_id, PDO::PARAM_STR);
      $stmt->bindValue(":title", $update_title, PDO::PARAM_STR);
      $stmt->bindValue(":content", $update_content, PDO::PARAM_STR);
      $stmt->execute();      
    
    }catch (PDOException $e){
      $_SESSION["error"]["update_article"] = $e->getMessage();
      echo $_SESSION["error"]["update_article"];
      exit;
    };
  };

?>