<?php
  session_start();

  echo $_SESSION["user_id"]."<br/>\n";//セッションIDの確認

  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/comment_model.php" );
  dbconnection();

  $user_id = $_SESSION["user_id"];
  $comment = $_POST["comment"];
  $article_id = $_POST["article_id"];

  post_comment($comment, $user_id, $pdo);
  
?>