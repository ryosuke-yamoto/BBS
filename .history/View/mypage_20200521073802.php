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
        <p class="user-name">username</p>
        <button id="name-change">変更</button>
      </div>
    </div>
    <div class="email-wrap">
      <p>あなたのメールアドレス</p>
      <div>
        <p class="user-email">example@gmail.com</p>
        <button id="mail-change">変更</button>
      </div>
    </div>
    <button><a href="./home.php">ホームへ</a></button>
  </div>
  <div id="modal" class="modal-close">
    <div id="modal-bg"></div>
    <div id="modal-name">
      <div id="modal-name-wrap">
        <h5 id="modal-title"></h5>
        <form action="">
          <input type="text">
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