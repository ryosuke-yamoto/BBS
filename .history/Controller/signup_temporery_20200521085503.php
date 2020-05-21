<?php
  session_start();
  
  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/sign_up_model.php" );
  dbconnection();

  //エラーを空にする
  $_SESSION["error"] = array();

  $token = $_GET['token'];

  if ($token == "") {
    $_SESSION["error"]["mail_send_error"] = "もう一度登録をやり直してください";//トップページへ
    //セッション変数削除
    $_SESSION = array();
    //セッションの破棄
    $sSessionName = session_name();
    if(isset($_COOKIE[$sSessionName])){
      setcookie($sSessionName, '', time() - 1800, '/');
    };
    header("Location: ../View/Signup/mail_send_failure.php");
  }else {
    mail_check($token, $pdo);
    //エラーがなければ新規登録画面へ
    if (empty($_SESSION["error"])) {
        header("Location: ../View/Signup/sign_up.php");
    }else {
      //セッション変数削除
      $_SESSION = array();
      //セッションの破棄
      $sSessionName = session_name();
      if(isset($_COOKIE[$sSessionName])){
        setcookie($sSessionName, '', time() - 1800, '/');
      };
      header("Location: ../View/Signup/mail_send_failure.php");
    };

  }
?>