<?php

  function get_register_monthly_number($pdo) {
    try{
      //DBから今月の「article」を取り出す
      $sql = "SELECT count(*) FROM article WHERE DATE_FORMAT(created, '%Y%m') = DATE_FORMAT(NOW(), '%Y%m');";
      $stmt = $pdo->query($sql);
      $post_count = $stmt->fetch();
      //メールアドレス復号
      return $post_count;
    }catch (PDOException $e){
      $_SESSION["error"] = $e->getMessage();
    };
  };

  function get_post_monthly_number() {

};

?>