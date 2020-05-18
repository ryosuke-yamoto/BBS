<?php
  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/sign_up_model.php" );
  dbconnection();
  

  $mail = $_POST["mail"];
  $password = $_POST["password"];
  $name = $_POST["name"];

  //本登録バリデーとチェック
  if(empty($e)) {

  }else {
    header("Location: ../View/Signup/sign_up.php");
  }

  if ($token == "") {
    $e["mail_send_error"] = "もう一度登録をやり直してください";//トップページへ
  }else {
    mail_check($token, $pdo);
    //エラーがなければ新規登録画面へ
    if (empty($e)) {
        header("Location: ../View/Signup/sign_up.php");
    }

  }
?>