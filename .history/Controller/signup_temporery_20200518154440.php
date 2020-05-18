<?php

  session_start();

  $mail = $_POST["mail"];
  $token = $_POST["token"];

   echo $mail;

//   require_once( "../Model/dbconnect.php" );
  require_once( "../Model/sign_up_model.php" );
//   dbconnection();
//   var_dump($pdo);
  

//   //エラーメッセージの初期化
// $e = array();
 
if(empty($_POST["mail"])) {
	header("Location: ../View/Signup/mail_send.php");
	exit();
}else{//モデルでバリデーションand新規登録
    // re();
    register_user_temporery($mail, $token);
};
?>