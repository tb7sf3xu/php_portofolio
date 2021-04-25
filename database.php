<?php

  require_once("goods.php");
  require_once("dbconnect.php");
  
  /**
   * データベースの"salescount"の更新
   * @param int $salesCount
   * @param int $itemid
   * @return void
   */
  function salesCountUpdate($salesCount,$itemid) {
    $dbinfo = connectgoods();

    $sql = "UPDATE goods SET salescount=:salescount WHERE itemid=:itemid";
    $stmt = $dbinfo->prepare($sql);
    $stmt->bindParam(":salescount", $salesCount,PDO::PARAM_INT);
    $stmt->bindParam(":itemid", $itemid,PDO::PARAM_INT);
    $stmt->execute();
       
    $dbinfo = null;
  }
    
  /**
   * データベースの"sales"の更新
   * @param int $sales
   * @param int $itemid
   * @return void
   */
  function salesUpdate($sales,$itemid) {
    $dbinfo = connectgoods();

    $sql = "UPDATE goods SET sales=:sales WHERE itemid=:itemid";
    $stmt = $dbinfo->prepare($sql);
    $stmt->bindParam(":sales", $sales, PDO::PARAM_INT);
    $stmt->bindParam(":itemid", $itemid, PDO::PARAM_INT);
    $stmt->execute();
       
    $dbinfo = null;
  }

  /**
   * データベースの"count"の更新
   * @param int $count
   * @param int $itemid
   * @return void
   */
  function countUpdate($count,$itemid) {
    $dbinfo = connectgoods();

    $sql = "UPDATE goods SET count=:count WHERE itemid=:itemid";
    $stmt = $dbinfo->prepare($sql);
    $stmt->bindParam(":count", $count, PDO::PARAM_INT);
    $stmt->bindParam(":itemid", $itemid, PDO::PARAM_INT);
    $stmt->execute();
       
    $dbinfo = null;
  }

  /**
   * データベースの"anorder"の更新
   * @param string $anorder
   * @param int $itemid
   * @return void
   */
  function anorderUpdate($anorder,$itemid) {
    $dbinfo = connectgoods();

    $sql = "UPDATE goods SET anorder=:anorder WHERE itemid=:itemid";
    $stmt = $dbinfo->prepare($sql);
    $stmt->bindParam(":anorder", $anorder, PDO::PARAM_STR);
    $stmt->bindParam(":itemid", $itemid, PDO::PARAM_INT);
    $stmt->execute();
       
    $dbinfo = null;
  }

  /**
   * データベースにデータを追加
   * @param string $name
   * @param string $maker
   * @param int $price
   * @return void
   */
  function insert($name, $maker, $price) {
    $dbinfo = connectgoods();

    $sql = "INSERT INTO goods(name, maker, price) VALUES (:name, :maker, :price)";
    $stmt = $dbinfo->prepare($sql);
    $stmt->bindParam(":name", $name, PDO::PARAM_STR); 
    $stmt->bindParam(":maker", $maker, PDO::PARAM_STR);
    $stmt->bindParam(":price", $price, PDO::PARAM_INT);
    $stmt->execute();

    $dbinfo = null;
  }

  /**
   * データベースから同じ商品名のデータを取得
   * @param string $name
   * @return array|bool $goods|false
   */
  function findByName($name) {
    $dbinfo = connectgoods();
    
    $sql = "SELECT * FROM goods WHERE name = ?";

        //nameを配列に入れる
        $arr = [];
        $arr[] = $name;
        
          try{
              $stmt = $dbinfo->prepare($sql);
              $stmt->execute($arr);
              //SQLの結果を返す
              $goods = $stmt->fetch();
              return $goods;
          } catch (\Exception $e) {
              return false;
          }
  }

  /**
   * データベースからデータを削除
   * @param string
   * @return void
   */
  function delete($name) {
    $dbinfo = connectgoods();

    $sql = "DELETE FROM goods WHERE name=:name";
    $stmt = $dbinfo->prepare($sql);
    $stmt->bindParam(":name", $name, PDO::PARAM_STR); 
    
    $stmt->execute();

    $dbinfo = null;
  }

    
?>