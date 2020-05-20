<?php
  session_start();

  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/sign_up_model.php" );
  dbconnection();

  //セッション変数削除
  $_SESSION = array();
  //セッションの破棄
  $sSessionName = session_name();
  if(isset($_COOKIE[$sSessionName])){
    setcookie($sSessionName, '', time() - 1800, '/');
  };

  $mail = $_POST["mail"];
  $password = $_POST["password"];
  $name = $_POST["name"];

  //エラーを再定義
  $_SESSION["error"] = array();

  //本登録バリデーとチェック
  user_input_validate($mail, $password, $name, $pdo);
  if(empty($_SESSION["error"])){
    //エラーがなければsign_up_user実施
    sign_up_user($mail, $password, $name, $pdo);
    //エラーがなければホーム画面へ
    if(empty($_SESSION["error"])) {
      header("Location: ../View/home.php");
      exit;
    }else {
      //エラーがあればもう一度
      header("Location: ../View/Signup/sign_up.php");
      exit;
    }
  }else {
    //エラーがあればもう一度
    header("Location: ../View/Signup/sign_up.php");
    exit;
  };
?>