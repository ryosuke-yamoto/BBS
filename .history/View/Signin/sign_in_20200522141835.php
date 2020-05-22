<?php
  session_start();
  //エラーがあってもなくても毎回$errorに代入することでエラー表示は一回で済ませられる
  $error = $_SESSION["error"];
  $_SESSION["error"] = array();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/sign.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ログイン画面</title>
</head>
<body>
  <div>
    <h1>ログイン</h1>
    <form action="../../Controller/sign_in.php" method="post" >
      <p>Eメール</p>
      <input type="text" name="mail">
      <p>パスワード</p>
      <input type="text" name="password">
      <button type="submit">ログイン</button>
    </form>
    <?php if(!empty($error)): ?>
    <p style="color: red;"><?= $error["mail_check"];?></p>
    <p style="color: red;"><?= $error["password_check"];?></p>
    <?php endif; ?>
  </div>
</body>
</html>