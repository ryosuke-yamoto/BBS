<?php
  session_start();
  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/sign_in_model.php" );
  dbconnection();

  $mail = $_POST["mail"];
  $password = $_POST["password"];

  //エラーを空にする
  $_SESSION["error"] = array();

  //入力フォームチェック
  user_input_validate($mail, $password);
  if(empty($_SESSION["error"])) {
    //エラーがなければsign_in_user実施
    sign_in_user($mail, $password, $name, $pdo);
    if(empty($_SESSION["error"])) {
      //エラーがなければホーム画面へ
      header("Location: ../View/home.php");
      exit;
    }else {
      //エラーがあったらログイン画面に返す
      header("Location: ../View/Signin/sign_in.php");
      exit;
    };
  }else {
    //エラーがあったらログイン画面に返す
    header("Location: ../View/Signin/sign_in.php");
    exit;
  }
?>