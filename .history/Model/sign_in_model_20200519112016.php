<?php
  session_start();

  $_SESSION["error"] = array();

  function user_input_validate($mail, $password) {//新規登録フォームチェック
    //メールチェック
    if ($mail == ""){
      $_SESSION["error"]["mail_check"] = "メールが入力されていません。";
	  }else if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)){
      $_SESSION["error"]["mail_check"] = "メールアドレスの形式が正しくありません。";
    };
    //パスワードチェック
    if($password == "") {
      $_SESSION["error"]["password_check"] = "パスワードが入力されていません。";
    }else if(!preg_match("/\A[a-z\d]{8,16}+\z/i", $password)) {
      $_SESSION["error"]["password_check"] = "パスワードは半角英数記号のみを使用して、8文字以上16文字で入力してください。";
    };
  };

  function sign_in_user($mail, $password, $name, $pdo) {
    try{
    
      
      
    }catch (PDOException $e){
      print('Error:'.$e->getMessage());
      die();
    }
  }



?>