<?php
  $auto_signin_key = bin2hex(random_bytes(16));
  $cookieExpire = time() + 3600 * 24 * 7; // 7日間
  if(empty($_COOKIE["auto_signin"])) {
    setcookie("auto_signin", $auto_signin_key, $cookieExpire);
  }else {
    //ログインするたびに再生成
    $_COOKIE["auto_signin"] = $auto_signin_key;
  };
  
  session_start();
  //ログインしてなければトップページに飛ばされる
  if(!isset($_SESSION["user_id"])) {
    header("Location: http://localhost:8888/BBS_yamoto/View/top.php");
  };
  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/sign_in_model.php" );
  dbconnection();
  set_auto_signin($pdo, $_SESSION["user_id"]);
  header("Location: ../View/home.php");
?>