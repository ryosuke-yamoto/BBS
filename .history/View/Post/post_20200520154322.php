<?php
  session_start();
  require_once( "../../Model/dbconnect.php" );
  require_once( "../../Model/post_model.php" );
  require_once( "../../Model/comment_model.php" );
  dbconnection();
  $post_array = create_post_list($pdo);
  //urlからarticle_idを取得
  $article_id = $_REQUEST["article_id"];
  echo $article_id;
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

  //コメント生成
  $this_comment = create_comment_list($pdo, $article_id);
  if(!empty($_SESSION["error"])) {
    echo $_SESSION["error"]["create_comment_list"] = "正しく投稿できませんでした。";
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
      <p class="title-text">タイトル</p>
      <p class="title"><?= php_to_html($this_post["title"]);?></p>
      <p class="content-text">記事内容</p>
      <p class="content"><?= php_to_html($this_post["content"]);?></p>
    </div>
    <div class="comment-wrap">
      <p>コメント欄</p>
      <ul class="comment-ul">
      <?php foreach ($this_comment as $comment) : ?>
        <li class="comment-li">
          <p><?= php_to_html($comment["content"]);?></p>
          <div class="name-data-wrap">
            <p class="user-name"><?= php_to_html($comment["user_id"]);?></p>
            <p class="created"><?= php_to_html($comment["created"]);?></p>
            <form class="delete" action="../../Controller/comment.controller.php" method="get">
              <input type="hidden" name="article_id" value="<?php print($article_id);?>">
              <button type="submit" name="comment_id" value="<?= print($comment["comment_id"]);?>">削除</button>
            </form>
          </div>
        </li>
      <?php endforeach; ?>
      </ul>
    </div>
    <form action="../../Controller/comment.controller.php" method="post">
      <input type="text" name="comment">
      <input type="hidden" name="article_id" value="<?php print($article_id);?>">
      <button type="submit">コメントする</button>
    </form>
    <button class="home-button">ホームへ</button>
  </div>
</body>
</html>