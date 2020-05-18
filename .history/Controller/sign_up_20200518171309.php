<?php
  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/sign_up_model.php" );
  dbconnection();
  

  $mail = $_POST["mail"];
  $password = $_POST["password"];
  $name = $_POST["name"];

  //本登録バリデーとチェック
  if(empty($e)) {
    sign_up_user($mail, $password, $name, $pdo)
  }else {
    header("Location: ../View/Signup/sign_up.php");
  }

  }
?>