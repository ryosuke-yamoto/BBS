<?php
  session_start();
  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/sign_up_model.php" );
  dbconnection();

  $token = $_GET['token'];

  if ($token == "") {
    $_SESSION["error"] = "認証に失敗しました。もう一度登録をやり直してください";//トップページへ
    //セッション変数削除
    $_SESSION = array();
    //セッションの破棄
    $sSessionName = session_name();
    if(isset($_COOKIE[$sSessionName])){
      setcookie($sSessionName, '', time() - 1800, '/');
    };
    session_destroy();
    header("Location: ../View/Signup/mail_send.php");
    exit;
  }else {
    mail_check($token, $pdo);
    //エラーがなければ新規登録画面へ
    if (empty($_SESSION["error"])) {
        header("Location: ../View/Signup/sign_up.php");
        exit;
    }else {
      //セッション変数削除
      $_SESSION = array();
      //セッションの破棄
      $sSessionName = session_name();
      if(isset($_COOKIE[$sSessionName])){
        setcookie($sSessionName, '', time() - 1800, '/');
      };
      session_destroy();
      header("Location: ../View/Signup/sign_up.php");
      exit;
    };
  };
?>