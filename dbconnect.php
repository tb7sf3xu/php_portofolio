<?php
  /**
   * userデータベースへの接続
   */
  function connectUser() {
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $db_name = substr($Url["path"], 1);
    $db_host = $url["host"];
    $user = $url["user"];
    $password = $url["pass"]; 

    $dsn = "mysql:dbname=".$db_name.";host=".$db_host.";charset=utf8mb4";
    
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
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $db_name = substr($Url["path"], 1);
    $db_host = $url["host"];
    $user = $url["user"];
    $password = $url["pass"]; 

    $dsn = "mysql:dbname=".$db_name.";host=".$db_host.";charset=utf8";
    
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