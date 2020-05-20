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

  var_dump($_SESSION);
  exit;
  
  

  $mail = $_POST["mail"];
  $password = $_POST["password"];
  $name = $_POST["name"];

  //本登録バリデーとチェック
//   user_input_validate()
  if(empty($e)) {
    sign_up_user($mail, $password, $name, $pdo);
    if(empty($e)){
      //エラーがなければホーム画面へ
      header("Location: ../View/home.php");
      exit;
    
    }else {
      //エラーがあればもう一度
      
    };
  }else {
    header("Location: ../View/Signup/sign_up.php");
    exit;
  };


?>