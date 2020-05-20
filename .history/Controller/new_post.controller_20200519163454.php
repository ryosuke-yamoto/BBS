<?php

  

  session_start();

  echo $_SESSION["user_id"]."<br/>\n";//セッションIDの確認

  require_once( "../Model/dbconnect.php" );
  
  dbconnection();
  
//   //エラーメッセージの初期化
$_SESSION["error"] = array();
 

?>