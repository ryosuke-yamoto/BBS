<?php
// var_dump($_COOKIE["auto_signin"]);
// exit;
  session_start();
  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/sign_in_model.php" );
  dbconnection();
  if(empty($_POST["mail"])){//トップページから来た場合
    if(isset($_SESSION["user_id"])) {
      header("Location: ../View/home.php");
      exit;
    }else if(isset($_COOKIE["auto_signin"])) {
      // var_dump($_COOKIE["auto_signin"]);
      // exit;
      $count = auto_sign_in($_COOKIE["auto_signin"], $pdo);
      echo $count;
      exit;
      if($count == 1) {
        header("Location: ../View/home.php");
        exit;
      }else {
        header("Location: ../View/Signin/sign_in.php");
        exit;
      };
    };
  };
  
  
  

  $mail = $_POST["mail"];
  $password = $_POST["password"];


  //入力フォームチェック
  user_input_validate($mail, $password);
  if(empty($_SESSION["error"])) {
    //エラーがなければsign_in_user実施
    sign_in_user($mail, $password, $pdo);
    if(empty($_SESSION["error"])) {
      //エラーがなければホーム画面へ
      set_auto_signin($pdo, $_SESSION["user_id"]);
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