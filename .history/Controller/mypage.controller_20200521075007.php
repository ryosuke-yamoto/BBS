<?php
  session_start();

  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/mypage_model.php" );
  dbconnection();

  $mail = $_POST["mail"];
  
?>