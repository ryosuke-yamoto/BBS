<?php
  session_start();
  //ログインしてなければトップページに飛ばされる
  if(!isset($_SESSION["user_id"])) {
    header("Location: http://localhost:8888/BBS_yamoto/View/top.php");
  };
  require_once( "../Model/dbconnect.php" );
  require_once( "../Model/mypage_model.php" );
  dbconnection();
  
  echo $_SESSION["auto_signin"]. "sessiお<br/>\n";//クッキーの確認
  echo $_COOKIE["auto_signin"]. "クッキお<br/>\n";//クッキーの確認

  $user_id = $_SESSION["user_id"];
  //このページで表示される情報を作ります
  $mypage_user = create_mypage($user_id, $pdo);

  //XSS対策
  function php_to_html($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
  };

  //エラーがあってもなくても毎回$errorに代入することでエラー表示は一回で済ませられる
  $error = $_SESSION["error"];
  $_SESSION["error"] = array();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./css/mypage.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>マイページ</title>
</head>
<body>
  <div class="main-wrap">
    <h1>マイページ</h1>
    <div class="name-wrap">
      <p>あなたの名前</p>
      <div>
        <p class="user-name"><?= php_to_html($mypage_user["name"]) ?></p>
        <button id="name-change">変更</button>
      </div>
    </div>
    <div class="email-wrap">
      <p>あなたのメールアドレス</p>
      <div>
        <p class="user-email"><?= php_to_html($mypage_user["mail"]) ?></p>
        <button id="mail-change">変更</button>
      </div>
    </div>
    <button><a href="./home.php">ホームへ</a></button>
    <?php if(!empty($error)): ?>
    <p style="color: red;"><?= php_to_html($error) ?></p>
    <?php endif; ?>
  </div>
  <div id="modal" class="modal-close">
    <div id="modal-bg"></div>
    <div id="modal-name">
      <div id="modal-name-wrap">
        <h5 id="modal-title"></h5>
        <form action="../Controller/mypage.controller.php" method="post">
          <input id="change-input" type="text">
          <input type="hidden" name="user_id" value="<?= php_to_html($user_id); ?>">
          <button id="change-button">変更</button>
        </form>
      </div>
      <button class="back-button">戻る</button>
    </div>
  </div>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="./js/mypage.js"></script>
</body>
</html>