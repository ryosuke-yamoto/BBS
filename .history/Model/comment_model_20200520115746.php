<?php
  
  function post_comment($content, $user_id,$article_id, $pdo) {
    try{
      //$comment_idをランダムな文字列で生成
      $comment_id = base64_encode(openssl_random_pseudo_bytes(16));

      $sql = "INSERT INTO php_task.comment(comment_id, content, created, user_id, article_id) VALUES(:comment_id, :content, date_format(now(), '%Y年%m月%d日 %H時%i分%s秒'), :user_id, :article_id)";
      $stmt = $pdo -> prepare($sql);
      $stmt->bindValue(":comment_id", $comment_id, PDO::PARAM_STR);
      $stmt->bindValue(":content", $content, PDO::PARAM_STR);
      $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
      $stmt->bindValue(":article_id", $article_id, PDO::PARAM_STR);
      $stmt->execute();
    }catch (PDOException $e){
      $_SESSION["error"]["post_comment_failure"] = $e->getMessage();
    };
  };


  // function create_post_list($pdo) {//記事一覧の配列を生成します
  //   $post_array = array();
  //   try{
  //     //DBからarticleを取り出す
  //     $sql = "SELECT article_id, title, content, created, user_id FROM php_task.article order by created asc;";
  //     $stmt = $pdo->prepare($sql);
  //     $stmt->execute();
  //     $post_array = $stmt->fetchAll(PDO::FETCH_ASSOC);
  //     //DBのuserテーブルからuser_idとnameを取り出す
  //     $sql2 = "SELECT user_id, name FROM php_task.user";
  //     $stmt2 = $pdo->prepare($sql2);
  //     $stmt2->execute();
  //     $data = $stmt2->fetchAll(PDO::FETCH_ASSOC);
  //     //$post_arrayのuser_idをnameに変換する
  //     foreach ($post_array as &$row) {
  //       foreach ($data as $row2) {
  //         if($row["user_id"] == $row2["user_id"]) {
  //           $row["user_id"] = $row2["name"];
  //         };
  //       };
  //     };
  //     return $post_array;
  //   }catch (PDOException $e){
  //     $_SESSION["error"]["post_failure"] = $e->getMessage();
  //   };
  // };

?>