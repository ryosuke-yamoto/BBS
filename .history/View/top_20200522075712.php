<?php
  session_start();

  $auto_signin = $_COOKIE["auto_signin"];

  echo session_id()."session_id<br/>\n";//セッションIDの確認
 
  echo session_name()."session_name<br/>\n";//セッション名の確認
  
  echo $_SESSION["user_id"]."<br/>\n";//セッションIDの確認

  echo $_SESSION["auto_signin"]."se<br/>\n";//セッションIDの確認

  echo $_COOKIE["auto_signin"]["auto_signin"]. "クッキお<br/>\n";//クッキーの確認
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
    <form action="../Controller/sign_in.php" method="get">
      <button name="auto_signin"  type=submit value="<?= $auto_signin ?>">ログイン</button>

    </form>
    
    <a href="./Signup/mail_send.php">新規登録</a>
  </div>
</body>
</html>