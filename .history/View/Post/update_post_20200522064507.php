<?php
  session_start();
  //ログインしてなければトップページに飛ばされる
  if(!isset($_SESSION["user_id"])) {
    header("Location: http://localhost:8888/BBS_yamoto/View/top.php");
  };
  require_once( "../../Model/dbconnect.php" );
  require_once( "../../Model/post_model.php" );
  dbconnection();
  $article_id = $_GET["article_id"];
  //XSS対策
  function php_to_html($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
  };
  $update_article = create_update_post($article_id, $pdo);

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
      <input type="text" name="update-title" value="<?= php_to_html($update_article["title"]); ?>" >
      <p>内容</p>
      <textarea name="update-content" id="" cols="50" rows="20"><?= php_to_html($update_article["content"]) ?></textarea>
      <input type="hidden" name="update-article_id" value="<?= php_to_html($article_id) ?>">
      <button type="submit">更新する</button>
      <button><a href="./post_list.php">記事一覧へ</a></button>
    </form>
    <?php if(!empty($error)): ?>
    <p style="color: red;"><?= $error;?></p>
    <?php endif; ?>
  </div>
</body>
</html>