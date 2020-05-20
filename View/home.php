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
  <link rel="stylesheet" href="./css/home.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ホームページ</title>
</head>
<body>
  <div class="aggregate-wrap">
    <p>今月の登録者数は　　人です</p>
    <p>今月の投稿数は　　件です</p>
  </div>
  <div class="main-wrap">
    <ul>
      <li><a href="./Post/new_post.php">新規投稿</a></li>
      <li><a href="">投稿一覧</a></li>
      <li><a href="">マイページ</a></li>
      <li><a href="">ログアウト</a></li>
    </ul>
  </div>
</body>
</html>