<?php
  session_start();
  


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/newpost.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>投稿編集</title>
</head>
<body>
  <div>
    <form action="../../Controller/new_post.controller.php" method="post">
      <p>タイトル</p>
      <input type="text" name="update-title">
      <p>内容</p>
      <textarea name="update-content" id="" cols="30" rows="10"></textarea>
      <button type="submit">更新する</button>
      <button>記事一覧へ</button>
    </form>
  </div>
</body>
</html>