<?php
  session_start();
  //ログインしてなければトップページに飛ばされる
  if(!isset($_SESSION["user_id"])) {
    header("Location: http://localhost:8888/BBS_yamoto/View/top.php");
  };
  require_once( "../../Model/dbconnect.php" );
  require_once( "../../Model/post_model.php" );
  require_once( "../../Model/comment_model.php" );
  dbconnection();
  //urlからarticle_idを取得
  $article_id = $_REQUEST["article_id"];
  //XSS対策
  function php_to_html($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
    };
  //$post_arrayの中から$article_idと一致する配列を取得しこのページで表示する記事の配列（$this_post）を生成します
  $post_array = create_post_list($pdo);
  foreach($post_array as $post) {
    if($post["article_id"] === $article_id) {
      $this_post = $post;
    };
  };
  //コメント生成
  $this_comment = create_comment_list($pdo, $article_id);
  //エラーがあってもなくても毎回$errorに代入することでエラー表示は一回で済ませられる
  $error = $_SESSION["error"];
  $_SESSION["error"] = array();
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
            <p class="user-name"><?= php_to_html($comment["name"]);?></p>
            <p class="created"><?= php_to_html($comment["created"]);?></p>
            <?php if($_SESSION["user_id"] == $comment["user_id"]): ?>
            <form class="delete" action="../../Controller/comment.controller.php" method="post">
              <input type="hidden" name="article_id" value="<?php print($article_id);?>">
              <button type="submit" name="comment_id" value="<?= php_to_html($comment["comment_id"]);?>">削除</button>
            </form>
            <?php endif; ?>
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
    <?php if(!empty($error)): ?>
    <p style="color: red;"><?= $error;?></p>
    <?php endif; ?>
    <button class="home-button"><a href="./post_list.php?page=1">記事一覧へ</a></button>
  </div>
</body>
</html>