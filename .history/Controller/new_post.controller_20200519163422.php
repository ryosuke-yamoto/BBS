<?php

  session_start();

  require_once( "../Model/dbconnect.php" );
  
  dbconnection();
  
//   //エラーメッセージの初期化
$_SESSION["error"] = array();
 

?>