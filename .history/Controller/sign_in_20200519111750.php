<?php
  session_start();
  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/sign_up_model.php" );
  dbconnection();

  $mail = $_POST["mail"];
  $password = $_POST["password"];

  //エラーを空にする
  $_SESSION["error"] = array();

  
?>