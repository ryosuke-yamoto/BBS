<?php
  session_start();
  //ログインしてなければトップページに飛ばされる
  if(!isset($_SESSION["user_id"])) {
    header("Location: http://localhost:8888/BBS_yamoto/View/top.php");
  };
  
  //エラーがあってもなくても毎回$errorに代入することでエラー表示は一回で済ませられる
  $error = $_SESSION["error"];
  $_SESSION["error"] = array();

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
      <input type="text" name="title">
      <p>内容</p>
      <textarea name="content" id="" cols="60" rows="20"></textarea>
      <button type="submit">投稿する</button>
      <button>ホームへ</button>
    </form>
    <?php if(!empty($error)): ?>
    <p style="color: red;"><?= echo $error;?></p>
    <?php endif; ?>
  </div>
</body>
</html>