<?php
  /**
   * userデータベースへの接続
   */
  function connectUser() {
    $dsn = "mysql:dbname=heroku_0cf28b832cea3cb;host=us-cdbr-east-03.cleardb.com;port=3306;chrset=utf8";
    $user = "b06f4f16610003";
    $password = "10144b02";
    
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
    $dsn = "mysql:dbname=heroku_0cf28b832cea3cb;host=us-cdbr-east-03.cleardb.com;port=3306;chrset=utf8";
    $user = "b06f4f16610003";
    $password = "10144b02";
    
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