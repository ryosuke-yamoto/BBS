<?php
  
  function sign_out() {//ログアウト
    $_SESSION = array();
    //クライアントのセッションクッキーを削除
    $sSessionName = session_name();
    if(isset($_COOKIE[$sSessionName])){
      setcookie($sSessionName, '', time() - 1800, '/');
    };
    session_destroy();
  };

?>