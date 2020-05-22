<?php

  session_start();
  echo $_COOKIE["auto_signin"]. "クッキお<br/>\n";//クッキーの確認
  //ログインしてなければトップページに飛ばされる
  if(!isset($_SESSION["user_id"])) {
    header("Location: http://localhost:8888/BBS_yamoto/View/top.php");
  };
  // setcookie("auto_signin" , "" , time()-100 );
  $cookieExpire = time() + 3600 * 24 * 7; // 7日間
  $auto_signin = $_GET["auto_signin"];
  var_dump($auto_signin);
  if(!empty($auto_signin)) {
    if(!isset($_COOKIE["auto_signin"])) {
      setcookie("auto_signin", $auto_signin, $cookieExpire, '/');
      $_SESSION["auto_signin"] = array();
    }else {
      $_COOKIE["auto_signin"] = $auto_signin;
    };
  };

  echo $_SESSION["auto_signin"]. "sessiお<br/>\n";//クッキーの確認
  echo $_COOKIE["auto_signin"]. "クッキお<br/>\n";//クッキーの確認
  echo session_id()."session_id<br/>\n";//セッションIDの確認
  echo session_name()."session_name<br/>\n";//セッション名の確認
  
  echo $_SESSION["user_id"]."<br/>\n";//セッションIDの確認
  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/statics_model.php" );
  require_once( "../Model/sign_in_model.php" );
  dbconnection();
  create_user_id($auto_signin, $pdo);
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
    <p>今月の会員登録者数は<?= $register_count ?>人です</p>
    <p>今月の累計投稿数は<?= $post_count ?>件です</p>
  </div>
  <div class="main-wrap">
    <ul>
      <li><a href="./Post/new_post.php">新規投稿</a></li>
      <li><a href="./Post/post_list.php?page=1">投稿一覧</a></li>
      <li><a href="./mypage.php">マイページ</a></li>
      <li><a href="./sign_out.php">ログアウト</a></li>
    </ul>
  </div>
</body>
</html>