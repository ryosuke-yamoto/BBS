<?php
  session_start();
  
  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/sign_up_model.php" );
  dbconnection();

  $token = $_GET['token'];

  if ($token == "") {
    $_SESSION["error"]["mail_send_error"] = "もう一度登録をやり直してください";//トップページへ
  }else {
    mail_check($token, $pdo);
    //エラーがなければ新規登録画面へ
    if (empty($_SESSION["error"])) {
        header("Location: ../View/Signup/sign_up.php");
    }

  }
?>