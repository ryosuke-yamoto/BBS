<?php
  session_start();

  echo $_SESSION["user_id"]."<br/>\n";//セッションIDの確認

  require_once( "../Model/dbconnect.php" );
  dbconnection();

  $title = $_POST["title"];
  $content = $_POST["content"];

  //   //エラーメッセージの初期化
  $_SESSION["error"] = array();

  post_article();//記事を投稿する
 

?>