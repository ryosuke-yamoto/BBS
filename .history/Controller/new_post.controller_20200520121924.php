<?php
  session_start();

  echo $_SESSION["user_id"]."<br/>\n";//セッションIDの確認

  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/post_model.php" );
  dbconnection();
  
  $title = $_POST["title"];
  $content = $_POST["content"];

  //   //エラーメッセージの初期化
  $_SESSION["error"] = array();

  post_article($title, $content, $pdo);//記事を投稿する
  if(empty($_SESSION["error"])) {
    //エラーがなければ投稿一覧へ
    header("Location: ../View/Post/post_list.php");
  };
?>