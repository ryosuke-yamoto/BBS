<?php
  session_start();
  require_once( "../../Model/dbconnect.php" );
  require_once( "../../Model/post_model.php" );
  dbconnection();
  $post_array = create_post_list($pdo);
  
  //XSS対策
  function php_to_html($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
  };

  //１ページに５件ずつ記事を表示させたい
  $page = $_REQUEST["page"];
  $start = ($page - 1) * 5;
  $post_list = array_slice($post_array, $start, 5);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/postlist.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>投稿一覧</title>
</head>
<body>
  <div class="post-list-wrap">
    <h1>投稿一覧</h1>
    <ul>
      <?php foreach ($post_list as $post) : ?>
        <li>
          <a><?= php_to_html($post["title"]);?></a>
          <div class="name-data-wrap">
            <p class="user-name"><?= php_to_html($post["user_id"]);?></p><p><?= php_to_html($post["created"]);?></p>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
    <div>
      <button>前のページへ</button>
      <button>次のページへ</button>
    </div>
    <button class="newpost-button">新規投稿</button>
    <button>ホームへ</button>
  </div>
</body>
</html>