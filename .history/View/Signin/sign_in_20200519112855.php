<?php
  session_start();
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
      <p style="color: red;"><?php echo $_SESSION["error"]["mail_check"]; ?></p>
      <p>パスワード</p>
      <input type="text" name="password">
      <p style="color: red;"><?php echo $_SESSION["error"]["password_check"]; ?></p>
      <button type="submit">ログイン</button>
    </form>
  </div>
</body>
</html>