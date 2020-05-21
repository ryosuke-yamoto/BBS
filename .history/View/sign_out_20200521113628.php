<?php
  session_start();
  //ログインしてなければトップページに飛ばされる
  if(!isset($_SESSION["user_id"])) {
    header("Location: http://localhost:8888/BBS_yamoto/View/top.php");
  };

  echo session_id()."session_id<br/>\n";//セッションIDの確認
 
  echo session_name()."session_name<br/>\n";//セッション名の確認
  
  echo $_SESSION["user_id"]."<br/>\n";//セッションIDの確認

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./css/signout.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ログアウト</title>
</head>
<body>
  <div>
    <h1>本当にログアウトしますか？</h1>
    <form action="../Controller/sign_out_controller.php" method="get">
      <button type="submit" class="signout-button" name="logout" value="true">ログアウト</button>
    </form>
    <button><a class="home-button" href="./home.php">ホームへ</a></button>
  </div>
</body>
</html>