<?php
  session_start();

  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/sign_up_model.php" );
  dbconnection();

  $mail = $_POST["mail"];
  $password = $_POST["password"];
  $name = $_POST["name"];

  $token = $_SESSION["token"];

  //エラーを空にする
  $_SESSION["error"] = array();

  //本登録バリデーとチェック
  user_input_validate($mail, $password, $name);
  if(empty($_SESSION["error"])){
    //エラーがなければsign_up_user実施
    sign_up_user($mail, $password, $name, $token, $pdo);
    //エラーがなければホーム画面へ
    if(empty($_SESSION["error"])) {
      //仮登録のデータを消す
      
      header("Location: ../View/home.php");
      exit;
    }else {
      //エラーがあればもう一度
      header("Location: ../View/Signup/sign_up.php");
      exit;
    };
  }else {
    //エラーがあればもう一度
    header("Location: ../View/Signup/sign_up.php");
    exit;
  };
?>