<?php
function register_user_temporery($mail, $token) {
    
// 	//メール入力判定
// 	// if ($mail == ""){
// 	// 	$e["mail"] = "メールが入力されていません。";
// 	// }else if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)){
// 	// 	$e["mail_check"] = "メールアドレスの形式が正しくありません。";
// 	// }else {
	try {
      require_once( "dbconnect.php" );
      dbconnection();
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
  
?>