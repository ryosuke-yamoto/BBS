<?php
  session_start();

  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/mypage_model.php" );
  dbconnection();

  //   //エラーメッセージの初期化
  $_SESSION["error"] = array();

  $user_id = $_POST["user_id"];
  $name = $_POST["name_change"];
  $mail = $_POST["mail_change"];

  if(isset($name)) {//名前を変更する時の処理
    update_my_name($name, $pdo);
    if(empty($_SESSION["error"])) {//成功時
      header("Location: ../View/mypage.php");
    }else {//失敗時
      header("Location: ../View/mypage.php");
    };
    

  };

  if(isset($mail)) {//メールアドレスを変更する時の処理
    update_my_mail($mail, $pdo);
    

  };
  
?>