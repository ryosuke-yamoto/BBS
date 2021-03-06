<?php
  session_start();

  echo $_SESSION["user_id"]."<br/>\n";//セッションIDの確認

  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/post_model.php" );
  dbconnection();
  
  $title = $_POST["title"];
  $content = $_POST["content"];
  //削除するときに使うID
  $delete_id = $_POST["delete"];
  //更新するときに使うID
  $update_id = $_POST["update"];

  //   //エラーメッセージの初期化
  $_SESSION["error"] = array();
  if(isset($title) && isset($content)) {
    post_article($title, $content, $pdo);//記事を投稿する
    if(empty($_SESSION["error"])) {
      //エラーがなければ投稿一覧へ
      header("Location: ../View/Post/post_list.php");
    };
  };
  
  //記事を削除するときの処理
  if(isset($delete_id)) {
    delete_article($delete_id, $pdo);
    header("Location: ../View/Post/post_list.php");
  };
  //記事を更新する時の処理
  if(isset($update_id)) {
    delete_article($delete_id, $pdo);
    header("Location: ../View/Post/post_list.php");
  };
?>