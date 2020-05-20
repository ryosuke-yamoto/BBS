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


  function create_comment_list($pdo, $article_id) {//コメント一覧の配列を生成します
    $comment_array = array();
    try{
      //DBからarticleを取り出す
      $sql = "SELECT comment_id, content, created, user_id, article_id FROM php_task.comment order by created asc;";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $comment_array = $stmt->fetchAll(PDO::FETCH_ASSOC);
      //DBのuserテーブルからuser_idとnameを取り出す
      $sql2 = "SELECT user_id, name FROM php_task.user";
      $stmt2 = $pdo->prepare($sql2);
      $stmt2->execute();
      $user_array = $stmt2->fetchAll(PDO::FETCH_ASSOC);
      //$comment_arrayのuser_idをnameに変換する
      foreach ($comment_array as &$row) {
        foreach ($user_array as $row2) {
          if($row["user_id"] == $row2["user_id"]) {
            $row["user_id"] = $row2["name"];
          };
        };
      };
      unset($row);
      //$comment_arrayの中から$article_idと一致する配列を取得しこのページで表示するコメントの配列（$this_comment）を生成します
      $this_comment = array();
      $filter_func = function ($row) use ($article_id) { return ($row["article_id"] == $article_id); };
      $this_comment = array_filter($comment_array, $filter_func);
      return $this_comment;
    }catch (PDOException $e){
      $_SESSION["error"]["create_comment_list"] = $e->getMessage();
    };
  };

?>