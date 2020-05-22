<?php

  function sign_out() {//ログアウト
    $_SESSION = array();
    //クライアントのセッションクッキーを削除
    //クッキー破壊
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