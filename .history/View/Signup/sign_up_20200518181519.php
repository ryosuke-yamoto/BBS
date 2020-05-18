<?php
//エラーがあったら表示させる
// require_once( "../../Model/sign_up_model.php" );

session_start();
echo $_SESSION["token"];//セッション変数の呼び出し
 
echo session_id()."<br/>\n";//セッションIDの確認
 
echo session_name()."<br/>\n";//セッション名の確認
  exit;
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
      <p>パスワード</p>
      <input type="text" name="password">
      <p>名前</p>
      <input type="text" name="name">
      <button type="submit">新規登録</button>
    </form>
  </div>
</body>
</html>