<?php
  
  function sign_out() {//ログアウト
    $_SESSION = array();
    //クライアントのセッションクッキーを削除
    //セッション名取得
    //クッキー破壊
    var_dump($_COOKIE["PHPSESSID"]);
    var_dump($_COOKIE["auto_signin"]["auto_signin"]);
    exit;
    if(isset($_COOKIE["PHPSESSID"])){
      setcookie("PHPSESSID", '', time() - 1800, '/');
    };
    if(isset($_COOKIE["auto_signin"])){
      setcookie("auto_signin", '', time() - 1800, '/');
    };
    //セッションに関係するデータを破棄
    session_destroy();
  };

?>