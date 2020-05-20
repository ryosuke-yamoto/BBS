<?php
  session_start();
  require_once( "../../Model/dbconnect.php" );
  require_once( "../../Model/post_model.php" );
  dbconnection();
  $post_array = create_post_list($pdo);
  //urlからarticle_idを取得
  $article_id = $_REQUEST["article_id"];

  //XSS対策
  function php_to_html($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
    };
  //$post_arrayの中から$article_idと一致する配列を取得しこのページで表示する記事の配列（$this_post）を生成します
  foreach($post_array as $post) {
    if($post["article_id"] == $article_id) {
      $this_post = $post;
    };
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
      <p class="title"><?= php_to_html($this_post["title"]);?></p>
      <p class="content"><?= php_to_html($this_post["content"]);?></p>
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
    <form action="../../Controller/comment.controller.php" method="post">
      <input type="text" name="comment">
      <input type="hidden" name="article_id" value="<?php $article_id;?>">
      <button>コメントする</button>
    </form>
    <button class="home-button">ホームへ</button>
  </div>
</body>
</html>