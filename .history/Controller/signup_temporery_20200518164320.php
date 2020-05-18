<?php
  session_start();
  
  require_once( "../Model/dbconnect.php" );
  dbconnection();

  $token = $_GET['token'];

  if ($token == "") {
    $e["mail_send_error"] = "もう一度登録をやり直してください";//トップページへ
  }else {
    mail_check($token, $pdo);
    //エラーがなければ新規登録画面へ

  }
?>