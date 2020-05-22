<?php

  session_start();

  $mail = $_POST["mail"];
  $token = $_POST["token"];

  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/sign_up_model.php" );
  dbconnection();
  
  //メールチェック
  if ($mail == ""){
    $_SESSION["error"] = "メールが入力されていません。";
    header("Location: ../View/Signup/mail_send.php");
    exit;
  }else if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)){
    $_SESSION["error"] = "メールアドレスの形式が正しくありません。";
    header("Location: ../View/Signup/mail_send.php");
    exit;
  }else{//モデルでバリデーションand新規登録
    register_user_temporery($mail, $token, $pdo);
    if (count($_SESSION["error"]) === 0) {//メール送信成功したら「送信成功ページ」へ
      header("Location: ../View/Signup/mail_send_success.php");
    }else {//失敗したら元のページでエラーを表示させる
      header("Location: ../View/Signup/mail_send.php");
    };
  };
?>