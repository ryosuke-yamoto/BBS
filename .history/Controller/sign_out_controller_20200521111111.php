<?php
  session_start();
  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/sign_out_model.php" );
  dbconnection();
  
  if(isset($_GET["logout"])) {

  };
  
?>