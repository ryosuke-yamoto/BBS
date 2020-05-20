<?php
  session_start();

  echo $_SESSION["user_id"]."<br/>\n";//セッションIDの確認

  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/comment_model.php" );
  dbconnection();

  $user_id = $_SESSION["user_id"];
  $content = $_POST["comment"];
  $article_id = $_POST["article_id"];

  post_comment($content, $user_id, $article_id, $pdo);
  if(empty($_SESSION["error"])) {
    //エラーがなければ記事内容へ
    header("Location: ../View/Post/post.php?article_id=$article_id");
  }else {
    echo $_SESSION["error"]["post_comment_failure"] = "正しく投稿できませんでした。";
  };
  
?>