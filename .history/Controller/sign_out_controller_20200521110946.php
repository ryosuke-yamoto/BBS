<?php
  session_start();
  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/sign_out_model.php" );
  dbconnection();
  
  var_dump($_GET["logout"]);
  exit;

  
?>