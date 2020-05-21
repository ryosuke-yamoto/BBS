<?php
  
  function create_mypage($user_id, $pdo) {//mypage.phpに表示する情報を取り出します
    try{
      //DBから「name」と「mail」を取り出す
      $sql = "SELECT name, mail FROM php_task.user WHERE user_id = :user_id;";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
      $stmt->execute();
      $mypage_user = $stmt->fetch(PDO::FETCH_ASSOC);
      
      return $mypage_user;
    }catch (PDOException $e){
      $_SESSION["error"]["create_mypage"] = $e->getMessage();
      echo $_SESSION["error"]["create_mypage"];
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