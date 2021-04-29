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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="responsive.css">
    <title>在庫管理システム</title>
</head>

<body>

  <header>
    <h1 class="name">在庫管理システム</h1>
    <ul>
      <li>
        <a href="insert_index.php">商品登録画面へ</a>
      </li>
      <li>
        <a href="delete_index.php">商品削除画面へ</a>
      </li>
      <li>  
        <form action="logout.php" method="POST">
          <input type="submit" name="logout" value="ログアウト">
        </form>
      </li>  
    </ul>
  </header>

  <div class="goods-wrapper container">
    <h1 class="logo">商品管理</h1>
      <div class="goods-items">

      <?php
        //goodsデータベースへ接続
        $dbinfo = connectgoods();
        $dbinfo->set_character('utf8');
        
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

        <div class="goods-item">
          <div class="goods-item-only">
            <!-- インスタンスのプロパティを用い商品の情報を表示 -->
            <h3 class="goods-item-name"><?php echo "・".$goods->getName(); ?></h3>
            <div class="goods-item-about">
              <h3 class="goods-item-maker"><?php echo "メーカー"."　　".$goods->getMaker(); ?></h3>
              <h3 class="goods-item-price"><?php echo "価格"."　　".$goods->getPrice()."円"; ?></h3>
              <h3 class="goods-item-count"><?php echo "在庫数"."　　".$goods->getCount()."個"; ?></h3>
              <h3 class="goods-item-salesCount"><?php echo "総売上数"."　　".$goods->getSalesCount()."個"; ?></h3>
              <h3 class="goods-item-sales"><?php echo "総売上"."　　".$goods->getSales()."円"; ?></h3>
              <h3 class="goods-item-order"><?php echo $goods->getOrder(); ?></h3>
            
              <div class="sent-form">
                <!-- フォームで販売数を送信 -->
                <form method="post" action="confirm.php">
                  <div class="goods-count">
                    <!-- データベースの"count"(在庫数)の値が0より大きい時に表示 -->
                    <?php if ($goods->getCount() > 0): ?>
                      <select name="<?php echo $goods->getName(); ?>">
                        <!-- selectタグでデータベースの"count"(在庫数)の値を上限に選択させる -->
                        <?php for ($i=1; $i<=$goods->getCount(); $i++): ?>
                          <option value=<?php echo $i; ?>><?php echo $i; ?></option>       
                        <?php endfor ?>  
                      </select>
                      <span>個</span>
                      <input type="submit" value="販売">
                    <?php endif ?>
                  </div>
                </form>
                <!-- フォームで発注数を送信 --> 
                <form method="post" action="confirm_2.php">
                  <div class="goods-order">
                    <!-- データベースの"count"(在庫数)の値が50より小さい時に表示 -->
                    <?php if ($goods->getCount() < 50): ?>
                      <select name="<?php echo $goods->getMaker(); ?>">
                        <!-- selectタグで発注後の在庫数が100以下になる値を発注数として選択させる -->
                        <?php for ($i=1; $i<=100 - $goods->getCount(); $i++): ?>
                          <option value=<?php echo $i; ?>><?php echo $i; ?></option>       
                        <?php endfor ?>  
                      </select>
                      <span>個</span>
                      <input type="submit" value="発注">
                    <?php endif ?>
                  </div>
                </form>
              </div>
              <!-- float解除のための空タグ -->
              <div class="clear"></div>
            </div>
          </div>
        </div>  
      <?php endforeach ?>
      </div>
  </div>

</body>
</html>