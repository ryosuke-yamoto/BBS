<?php
  session_start();

  var_dump($_SESSION["error"]);
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
    <form action="../../Controller/sign_in.php"method="post" >
      <p>Eメール</p>
      <input type="text" name="mail">
      <p>パスワード</p>
      <input type="text" name="password">
      <button type="submit">ログイン</button>
    </form>
  </div>
</body>
</html>