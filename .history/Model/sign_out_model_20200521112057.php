<?php
  
  function sign_out() {//ログアウト
    $_SESSION = array();
    //クライアントのセッションクッキーを削除
    //セッション名取得
    $sSessionName = session_name();
    var_dump($sSessionName);
    //クッキー破壊
    if(isset($_COOKIE[$sSessionName])){
      setcookie($sSessionName, '', time() - 1800, '/');
    };
    //セッションに関係するデータを破棄
    session_destroy();
  };

?>