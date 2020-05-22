<?php
  session_start();
  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/sign_in_model.php" );
  dbconnection();
  $auto_signin = $_GET["auto_signin"];
    if(isset($_SESSION["user_id"])) {
      //user_id 認証
      header("Location: ../View/home.php");
      exit;
    }else if(isset($auto_signin)) {
      // var_dump($_COOKIE["auto_signin"]);
      // exit;
      $count = auto_sign_in($auto_signin, $pdo);
      // echo $count;
      // exit;
      if($count == 1) {
        header("Location: ../View/home.php?auto_signin=$auto_signin");
        exit;
      }else {
        // header("Location: ../View/Signin/sign_in.php");
        echo "ii";
        exit;
      };
    }else {
      // header("Location: ../View/Signin/sign_in.php");
      echo "oo";
        exit;
    };

  

?>