<?php
  session_start();
  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/sign_up_model.php" );
  dbconnection();
  //フォームに入力した値
  $mail = $_POST["mail"];
  $password = $_POST["password"];
  $name = $_POST["name"];
  //メールのurlを踏んで来た人のtokenを入れる
  $token = $_POST["token"];

  //本登録バリデーとチェック
  user_input_validate($mail, $password, $name);
  if(empty($_SESSION["error"])){
    //エラーがなければsign_up_user実施
    $auto_signin_key = sign_up_user($mail, $password, $name, $token, $pdo);
    //エラーがなければホーム画面へ
    if(empty($_SESSION["error"])) {
      header("Location: ../View/home.php?auto_signin=$auto_signin_key");
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