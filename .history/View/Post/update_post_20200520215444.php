<?php
  session_start();
  require_once( "../../Model/dbconnect.php" );
  require_once( "../../Model/post_model.php" );
  dbconnection();
  $article_id = $_GET["article_id"];
  //XSS対策
  function php_to_html($s) {
    return htmlspecialchars($s, ENT_QUOTESENT_QUOTES|ENT_HTML5);
  };
  $update_article = create_update_post($article_id, $pdo);

  var_dump($update_article["title"]);
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
      <p><?php php_to_html($update_article["title"]) ?></p>
      <input type="text" name="update-title" value="<?php php_to_html($update_article["title"]) ?>" >
      <p>内容</p>
      <textarea name="update-content" id="" cols="50" rows="20" value="<?php print($update_article["content"]) ?>"></textarea>
      <button type="submit">更新する</button>
      <button>記事一覧へ</button>
    </form>
  </div>
</body>
</html>