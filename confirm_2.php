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
  <title>発注確認画面</title>
</head>

<body>

  <header>
    <h1 class="name">在庫管理システム</h1>
  </header>

  <div class="order-wrapper">
    <h2>発注確認</h2>

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
      
    <!-- フォームで送られてきた発注数をメーカー名をキーにして取得 -->
    <?php if (isset($_POST[$goods->getMaker()])): ?>
      <?php
        //発注数を変数$goodsOrderに代入
        $goodsOrder = $_POST[$goods->getMaker()];
        //合計の発注数を変数$totalCountに代入
        $totalCount = $goods->getCount() + $goodsOrder;
        //データベースの"count"の値を更新
        countUpdate($totalCount, $goods->getId());
        //在庫数が50以上になったらデータベースの"anorder"の値を更新
        if ($totalCount >= 50) {
          anorderUpdate("発注なし", $goods->getId());
        }
      ?>

      <p><?php echo "発注数"."　　".$goodsOrder."個"; ?></p>
      
      <a href="index.php">完了</a>
    <?php endif ?>
    <?php endforeach ?>
  </div>

</body>

</html>