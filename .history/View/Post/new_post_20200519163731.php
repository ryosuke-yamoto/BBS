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
  <link rel="stylesheet" href="../css/newpost.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>新規投稿</title>
</head>
<body>
  <div>
    <form action="../../Controller/new_post.controller.php" method="post">
      <p>タイトル</p>
      <input type="text">
      <p>内容</p>
      <textarea name="" id="" cols="30" rows="10"></textarea>
      <button type="submit">投稿する</button>
      <button>ホームへ</button>
    </form>
  </div>
</body>
</html>