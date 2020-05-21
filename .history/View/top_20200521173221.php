<?php
  session_start();

  echo session_id()."session_id<br/>\n";//セッションIDの確認
 
  echo session_name()."session_name<br/>\n";//セッション名の確認
  
  echo $_SESSION["user_id"]."<br/>\n";//セッションIDの確認

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
    <form action="./Controller/sign_in.php" method="get">
      <button name="signin" value="1" >ログイン</button>
    </form>
    <form action="./Controller/sign_up.php" method="get">
      <button name="signup" value="1" >新規登録</button>
    </form>
  </div>
</body>
</html>