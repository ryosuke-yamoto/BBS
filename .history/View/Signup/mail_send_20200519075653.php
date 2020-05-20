<?php

session_start();

//クロスサイトリクエストフォージェリ（CSRF）対策
$_SESSION["token"] = base64_encode(openssl_random_pseudo_bytes(16));
$token = $_SESSION["token"];

require_once( "../../Model/sign_up_model.php" );

var_dump($e);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>メール送信</title>
</head>
<body>
  <div>
    <h1>メールアドレスを記入してください</h1>
    <form action="../../Controller/mail_send.php" method="POST">
      <input type="text" name="mail">
      <input type="hidden" name="token" value="<?=$token?>">
      <button type="submit" >送信</button>
    </form>
  </div>
</body>
</html>