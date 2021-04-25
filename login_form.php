<?php
session_start();

require_once("UserLogic.php");

$result = UserLogic::checkLogin();

if($result) {
  header("Location: mypage.php");
  return;
}

$err = $_SESSION;

//セッションを消す
$_SESSION = array();
session_destroy();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login_stylesheet.css">
    <title>ログイン画面</title>
</head>

<body>

  <header>
    <h1 class="name">在庫管理システム</h1>
    <a class="login" href="signup_form.php">新規登録はこちら</a>
  </header>
  
  <div class="main users-new">
    <div class="container">
      <h2 class="form-heading">ログインフォーム</h2>
        <div class="err">
          <?php if (isset($err["msg"])): ?>
            <p><?php echo $err["msg"]; ?></p>
          <?php endif ?>
        </div>
      <div class="form users-form">
      <div class="form-body">     
        <form action="mypage.php" method="POST">
      
          <p>メールアドレス</p>
          <input type="text" name="email">

          <div class="err">
            <?php if (isset($err["email"])): ?>
              <p><?php echo $err["email"]; ?></p>
            <?php endif ?>   
          </div>

          <p>パスワード</p>
          <input type="password" name="password">

          <div class="err">
            <?php if (isset($err["password"])): ?>
              <p><?php echo $err["password"]; ?></p>
            <?php endif ?>   
          </div>

          <input type="submit" value="ログイン">

        </form>
      </div>
      </div>
    </div>    
  </div>
  

</body>
</html>