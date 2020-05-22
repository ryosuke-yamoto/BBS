<?php
  session_start();
  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/mypage_model.php" );
  dbconnection();

  $user_id = $_POST["user_id"];
  $name = $_POST["name_change"];
  $mail = $_POST["mail_change"];

  if(isset($name)) {//名前を変更する時の処理
    update_my_name($user_id, $name, $pdo);
    header("Location: ../View/mypage.php");
  };

  if(isset($mail)) {//メールアドレスを変更する時の処理
    update_my_mail($user_id, $mail, $pdo);
    header("Location: ../View/mypage.php");
  };
  
?>