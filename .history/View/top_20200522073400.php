<?php
  session_start();

  $_SESSION["auto_signin"] = $_COOKIE["auto_signin"];

  echo session_id()."session_id<br/>\n";//セッションIDの確認
 
  echo session_name()."session_name<br/>\n";//セッション名の確認
  
  echo $_SESSION["user_id"]."<br/>\n";//セッションIDの確認

  echo $_SESSION["auto_signin"]."<br/>\n";//セッションIDの確認

  echo $_COOKIE["auto_signin"]. "クッキお<br/>\n";//クッキーの確認
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./css/top.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>トップページ</title>
</head>
<body>
  <div>
    <h1>THE掲示板</h1>
    <a href="../Controller/sign_in.php">ログイン</a>
    <a href="./Signup/mail_send.php">新規登録</a>
  </div>
</body>
</html>