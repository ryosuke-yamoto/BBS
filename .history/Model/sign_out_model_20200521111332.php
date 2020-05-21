<?php
  
  function sign_out() {//ログアウト
    $_SESSION = array();
    if(isset($_COOKIE[$sSessionName])){
      setcookie($sSessionName, '', time() - 1800, '/');
    };
    session_destroy();
  };

?>