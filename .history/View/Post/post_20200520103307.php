<?php
  session_start();
  require_once( "../../Model/dbconnect.php" );
  require_once( "../../Model/post_model.php" );
  dbconnection();
  $post_array = create_post_list($pdo);

  $article_id = $_REQUEST["article_id"];

  //XSS対策
  function php_to_html($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
    };
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/post.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>投稿詳細欄</title>
</head>
<body>
  <div class="main-wrap">
    <div class="post-wrap">
      <p class="title">タイトル</p>
      <p class="content">内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容</p>
    </div>
    <div class="comment-wrap">
      <ul>
        <li>コメント</li>
        <li>コメント</li>
        <li>コメント</li>
        <li>コメント</li>
        <li>コメント</li>
      </ul>
    </div>
    <form action="">
      <input type="text">
      <button>コメントする</button>
    </form>
    <button class="home-button">ホームへ</button>
  </div>
</body>
</html>