<?php
  session_start();

  require_once("database.php");
  require_once("UserLogic.php");
  require_once("dbconnect.php");
  //ログインしているか判定し、していなかったら新規登録画面へ返す
  $result = UserLogic::checkLogin();

  if (!$result) {
    $_SESSION["login_err"] = "ユーザーを登録してログインしてください！";
    header("Location: signup_form.php");
    return;
  }

  $login_user = $_SESSION["login_user"];

?>

<!DOCtYPE html>
<html>
<head>
  <meta charset ="UTF-8">
  <link rel="stylesheet" href="stylesheet.css">
  <title>売り上げ確認画面</title> 
</head>

<body>

  <header>
    <h1 class="name">在庫管理システム</h1>
  </header>

  <div class="order-wrapper">
    <h2>売り上げ確認</h2>

    <?php 
      //goodsデータベースへ接続
      $dbinfo = connectgoods();
      //goodsテーブルの全データを選択
      $sql = "SELECT * FROM goods";
    ?>

    <!-- 繰り返し処理でデータを一行ずつ取得 -->
    <?php foreach ($dbinfo->query($sql) as $record): ?>
    
      <?php
        //取得したデータの項目を変数に代入
        $id = $record["itemid"]; 
        $maker = $record["maker"];
        $name = $record["name"];
        $price = $record["price"];
        $count = $record["count"];
        $order = $record["anorder"];
        $sales = $record["sales"];
        $salesCount = $record["salescount"];
        //取得したデータをもとにgoodsインスタンスを作成
        $goods = new Goods($id, $maker, $name, $price, $count, $order, $sales, $salesCount);
      ?>

    <!-- フォームで送られてきた販売数を商品名をキーにして取得 -->
    <?php if (isset($_POST[$goods->getName()])): ?>
      <?php
        //販売数を変数$goodsSellに代入
        $goodsSell = $_POST[$goods->getName()];
        //合計の販売数を変数$toalSalesCountに代入
        $toalSalesCount = $goods->getSalesCount() + $goodsSell;
        //データベースの"salescount"の値を更新
        salesCountUpdate($toalSalesCount, $goods->getId()); 
      ?>

      <p><?php echo "販売数"."　　".$goodsSell."個"."<br/>"; ?></p>

      <?php
        //個別の売り上げを変数$priceに代入
        $price = $goods->getPrice() * $goodsSell;
        //全体の売り上げを変数$totalSalesに代入
        $totalSales = $goods->getSales() + $price;
        //データベースの"sales"の値を更新
        salesUpdate($totalSales, $goods->getId());
      ?>

      <p><?php echo "売上"."　　".$price."円"; ?></p>
      
      <?php
        //販売後の在庫数を変数$amountに代入
        $amount = $goods->getCount() - $goodsSell;
        //データベースの"count"の値を更新
        countUpdate($amount, $goods->getId());
        //在庫数が50より小さくなったらデータベースの"anorder"の値を更新
        if ($amount < 50) {
         anorderUpdate("発注してください", $goods->getId());
        } 
      ?>

      <a href="index.php">完了</a>
    <?php endif ?>
    <?php endforeach ?>    
      
  </div>

</body>

</html>