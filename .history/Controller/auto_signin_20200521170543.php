<?php
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