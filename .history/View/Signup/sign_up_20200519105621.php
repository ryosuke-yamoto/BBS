<?php
//エラーがあったら表示させる
// require_once( "../../Model/sign_up_model.php" );
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
  <title>新規登録画面</title>
</head>
<body>
  <div>
    <h1>新規登録</h1>
    <form action="../../Controller/sign_up.php" method="post">
      <p>Eメール</p>
      <input type="text" name="mail">
      <p style="color: red;"><?php echo $_SESSION["error"]["mail_check"]; ?></p>
      <p>パスワード</p>
      <input type="text" name="password">
      <p style="color: red;"><?php echo $_SESSION["error"]["password_check"]; ?></p>
      <p>名前</p>
      <input type="text" name="name">
      <p style="color: red;"><?php echo $_SESSION["error"]["name_check"]; ?></p>
      <button type="submit">新規登録</button>
    </form>
  </div>
</body>
</html>