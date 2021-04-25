<?php
  session_start();

  require_once("database.php");
  require_once("function.php");
  require_once("UserLogic.php");

  //ログインしているか判定し、していなかったら新規登録画面へ返す
  $result = UserLogic::checkLogin();

  if (!$result) {
    $_SESSION["login_err"] = "ユーザーを登録してログインしてください！";
    header("Location: signup_form.php");
    return;
  }

  if (isset($_SESSION["err"])) {
    $errs = $_SESSION["err"];
  }

  $_SESSION["err"] = array(); 

  $login_user = $_SESSION["login_user"];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login_stylesheet.css">
    <title>商品削除画面</title>
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
        <form action="delete_result.php" method="POST">
    
          <p>商品名</p>
          <input type="text" name="goodsName">
          
          <div class="err">
            <?php if (isset($errs["goodsName"])): ?>
              <p><?php echo $errs["goodsName"]; ?></p>
            <?php endif ?>   
          </div>

          <div class="err">
            <?php if (isset($errs["goodsDate"])): ?>
              <p><?php echo $errs["goodsDate"]; ?></p>
            <?php endif ?>   
          </div>

          <?php //?function関数hが使えない ?>
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(setToken(), ENT_QUOTES, "UTF-8"); ?>">

          <input type="submit" value="削除">
      
        </form>
      </div>
      </div>
    </div>
  </div>
    
</body>
</html>