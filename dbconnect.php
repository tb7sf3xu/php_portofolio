<?php
  /**
   * userデータベースへの接続
   */
  function connectUser() {
    $dsn = "mysql:dbname=heroku_f7f93f1405d1996;host=us-cdbr-east-03.cleardb.com;port=3306;chrset=utf8mb4";
    $user = "bf5bf82d5b849d";
    $password = "cb50c158";
    
    try {
        $pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    } catch(PDOException $e) {
        echo "接続失敗です！".$e->getMessage();
        exit();

    }
    
  }

  /**
   * goodsデータベースへの接続
   */
  function connectgoods() {
    $dsn = "mysql:dbname=heroku_f7f93f1405d1996;host=us-cdbr-east-03.cleardb.com;port=3306;chrset=utf8mb4";
    $user = "bf5bf82d5b849d";
    $password = "cb50c158";
    
    try {
        $dbinfo = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        return $dbinfo;
    } catch(PDOException $e) {
        echo "接続失敗です！".$e->getMessage();
        exit();

    }
    
  }

?>  