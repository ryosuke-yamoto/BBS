<?php
  session_start();

  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/post_model.php" );
  dbconnection();

  ////エラーメッセージの初期化
  $_SESSION["error"] = array();
  //投稿するときに使うセッション変数
  $title = $_POST["title"];
  $content = $_POST["content"];
  //削除するときに使うセッション変数
  $delete_id = $_POST["delete"];
  //更新するときに使うセッション変数
  $update_id = $_POST["update-article_id"];
  $update_title = $_POST["update-title"];
  $update_content = $_POST["update-content"];

  if(isset($title) && isset($content)) {
    post_article($title, $content, $pdo);//記事を投稿する
    if(empty($_SESSION["error"])) {
      //エラーがなければ投稿一覧へ
      header("Location: ../View/Post/post_list.php");
      exit;
    }else {
      //エラーがあれば元のページへ
      header("Location: ../View/Post/new_post.php");
      exit;
    };
  };
  
  //記事を削除するときの処理
  if(isset($delete_id)) {
    delete_article($delete_id, $pdo);
    header("Location: ../View/Post/post_list.php");
    exit;
  };
  //記事を更新する時の処理
  if(isset($update_id) && isset($update_title) && isset($update_content)) {
    update_article($update_id, $update_title, $update_content, $pdo);
    if(empty($_SESSION["error"])) {
      //エラーがなければ投稿一覧へ
      header("Location: ../View/Post/post_list.php");
      exit;
    }else {
      //エラーがあれば元のページへ
      header("Location: ../View/Post/update_post.php?article_id=$update_id");
      exit;
    };
  };
  header("Location: ../View/Post/post_list.php");
  exit;
?>