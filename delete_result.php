<?php
  session_start();

  require_once("database.php");
  require_once("UserLogic.php");
  //エラーメッセージ
  $err = [];
  
  $token = filter_input(INPUT_POST, "csrf_token");
  
  //トークンがない、もしくは一致しない場合、処理を中止
  if (!isset($_SESSION["csrf_token"]) || $token !== $_SESSION["csrf_token"]) {
    exit ("不正なリクエストです。");

  }

  unset($_SESSION["csrf_token"]);

  //バリデーション
  if (!$goodsName = filter_input(INPUT_POST, "goodsName")) {
    $err["goodsName"] = "商品名を記入してください。"; 
  }
  //同じ商品名が登録されているか判定
  if ($goodsName = filter_input(INPUT_POST, "goodsName")) {
    $goods = findByName($goodsName);

    if (!$goods) {
      $err["goodsDate"] = "登録されている商品名を記入してください。";
    }

  }

  if (count($err) > 0) {
    //エラーがあった場合は戻す
    $_SESSION["err"] = $err;
    header("Location: delete_index.php");
    return;
  }

  if (count($err) === 0) {
    //商品削除をする処理
    $name = $_POST["goodsName"];
    
    delete($name);
    
  }  
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login_stylesheet.css">
    <title>商品削除完了画面</title>
</head>

<body>

  <header>
    <h1 class="name">在庫管理システム</h1>
    <ul>
      <li>
        <a href="index.php">在庫管理システムへ</a>
      </li>
      <li>
        <a href="insert_index.php">商品登録画面へ</a>
      </li>
      <li>  
        <form action="logout.php" method="POST">
          <input type="submit" name="logout" value="ログアウト">
        </form>
      </li>  
    </ul>
  </header>

  <div class="main users-new">
    <div class="container">
      <h2 class="form-heading">商品削除</h2>

      <div class="form users-form">
      <div class="form-body">
        <h2>商品削除完了</h2>       
        <p>商品削除が完了しました！</p>     
        <a href="index.php">在庫管理システムへ</a>
      </div>
      </div>
    </div>
  </div>

</body>
</html>