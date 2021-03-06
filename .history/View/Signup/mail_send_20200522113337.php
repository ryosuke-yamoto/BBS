<?php
echo $_COOKIE["auto_signin"]. "クッキお<br/>\n";//クッキーの確認

session_start();

//クロスサイトリクエストフォージェリ（CSRF）対策
$_SESSION["token"] = base64_encode(openssl_random_pseudo_bytes(16));
$token = $_SESSION["token"];
//エラーがあってもなくても毎回$errorに代入することでエラー表示は一回で済ませられる
$error = $_SESSION["error"];
$_SESSION["error"] = array();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/top.css">
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
    <?php if(!empty($error)): ?>
    <p style="color: red;"><?= $error;?></p>
    <?php endif; ?>
    <button><a href="../top.php">ホームへ</a></button>
  </div>
</body>
</html>