<?php

  function register_user_temporery($token,$mail, $pdo) {
    global $e;
	  //メール入力判定
	  if ($mail == ""){
		$e["mail"] = "メールが入力されていません。";
	  }else if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)){
		$e["mail_check"] = "メールアドレスの形式が正しくありません。";
	  }else {
    //１回目のtryですでにメールアドレスがあったら登録できない
	  try {
      // require_once( "dbconnect.php" );
      // dbconnection();
      //   var_dump($pdo);
      //   exit;
      $sql = "INSERT INTO php_task.user_temporary(email, urltoken, created) VALUES(:email, :urltoken, now())";

      $stmt = $pdo -> prepare($sql);
      $stmt->bindValue(":email", $mail, PDO::PARAM_STR);
      $stmt->bindValue(":urltoken", $token, PDO::PARAM_STR);
      $stmt->execute();
    } catch (PDOException $e) {
      //エラー発生時
      echo $e->getMessage();
      exit;
    }; 
    };
  
    //メール送信
    mb_language("Japanese"); 
    mb_internal_encoding("UTF-8");
  
    $url = "http://localhost:8888/BBS_yamoto/Controller/signup_temporery.php?token=" . $token;
    
    $email = "xxxxxx@example.com";//送信元
    $subject = "テスト"; // 題名 
    $body = "24時間以内に下記のURLからご登録下さい。\n" . $url; // 本文
    $to = $mail; // 宛先
    $header = "From: $email\nReply-To: $email\n";
    
    mb_send_mail($to, $subject, $body, $header);
  };

  function mail_check($token, $pdo) {

    try {
      $sql = "SELECT * FROM php_task.user_temporary WHERE urltoken = :token and DATE_ADD(created, INTERVAL 1 DAY) > NOW();";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':token', $token, PDO::PARAM_INT);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      var_dump($data);
    } catch (PDOException $e) {
      //エラー発生時
      echo $e->getMessage();
      exit;
    }; 

    // if($e)

  };


  
?>