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
  if($page == "") {
    $page = 1;
  };
  $start = ($page - 1) * 5;
  $post_list = array_slice($post_array, $start, 5);

  $count = count($post_array);
  $maxpage = ceil($count / 5);
  $page = min($page, $maxpage);
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
    <button class="newpost-button">新規投稿</button>
    <button>ホームへ</button>
    <h1>投稿一覧</h1>
    <ul class="post-ul">
      <?php foreach ($post_list as $post) : ?>
        <li class="post-li">
          <a><?= php_to_html($post["title"]);?></a>
          <div class="name-data-wrap">
            <p class="user-name"><?= php_to_html($post["user_id"]);?></p><p><?= php_to_html($post["created"]);?></p>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
    <ul class="paging">
      <?php if($page > 1): ?>
      <li class="previous-page"><a href="post_list.php?page=<?php print($page - 1)?>">前のページへ</a></li>
      <?php else: ?>
      <li class="previous-page">前のページへ</a></li>
      <?php endif; ?>
      <?php if($page < $maxpage): ?>
      <li class="next-page"><a href="post_list.php?page=<?php print($page + 1)?>">次のページへ</a></li>
      <?php else: ?>
      <li class="next-page">次のページへ</a></li>
      <?php endif; ?>
    </ul>
  </div>
</body>
</html>