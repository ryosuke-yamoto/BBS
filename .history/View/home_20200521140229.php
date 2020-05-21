<?php
  session_start();
  //ログインしてなければトップページに飛ばされる
  if(!isset($_SESSION["user_id"])) {
    header("Location: http://localhost:8888/BBS_yamoto/View/top.php");
  };

  echo session_id()."session_id<br/>\n";//セッションIDの確認
 
  echo session_name()."session_name<br/>\n";//セッション名の確認
  
  echo $_SESSION["user_id"]."<br/>\n";//セッションIDの確認
  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/statics_model.php" );
  dbconnection();
  //今月の登録者数を取得
  $register_count = get_register_monthly_number($pdo);
  //今月の投稿数を取得
  $post_count = get_post_monthly_number($pdo);


?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./css/home.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ホームページ</title>
</head>
<body>
  <div class="aggregate-wrap">
    <p>今月の登録者数は人です</p>
    <p>今月の投稿数は<?= $post_count ?>件です</p>
  </div>
  <div class="main-wrap">
    <ul>
      <li><a href="./Post/new_post.php">新規投稿</a></li>
      <li><a href="./Post/post_list.php">投稿一覧</a></li>
      <li><a href="./mypage.php">マイページ</a></li>
      <li><a href="./sign_out.php">ログアウト</a></li>
    </ul>
  </div>
</body>
</html>