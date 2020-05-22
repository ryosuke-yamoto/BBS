<?php
  session_start();
  $auto_signin = $_COOKIE["auto_signin"];
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
    <form action="../Controller/auto_signin.php" method="get">
      <button name="auto_signin"  type=submit value="<?= $auto_signin ?>">ログイン</button>
    </form>
    <button class="signup-button"><a href="./Signup/mail_send.php">新規登録</a></button>
  </div>
</body>
</html>