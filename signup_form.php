<?php
  session_start();

  require_once("function.php");
  require_once("UserLogic.php");

  $result = UserLogic::checkLogin();

  if($result) {
    header("Location: mypage.php");
    return;
  }

  $login_err = isset($_SESSION["login_err"]) ? $_SESSION["login_err"] : null;
  unset($_SESSION["login_err"]);

  $err = $_SESSION;

  //セッションを消す
  $_SESSION = array();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login_stylesheet.css">
    <title>ユーザー登録画面</title>
</head>

<body>

  <header>
    <h1 class="name">在庫管理システム</h1>
    <a class="login" href="login_form.php">ログインする</a>
  </header>

  <div class="main users-new">
    <div class="container">
      <h2 class="form-heading">ユーザー登録フォーム</h2>
  
      <?php if (isset($login_err)): ?>
        <p class="login-err"><?php echo $login_err; ?></p>
      <?php endif ?>

      <div class="form users-form">
      <div class="form-body">         
        <form action="register.php" method="POST">
    　
          <p>ユーザー名</p>
          <input type="text" name="username">
          
          <div class="err">
            <?php if (isset($err["username"])): ?>
              <p><?php echo $err["username"]; ?></p>
            <?php endif ?>   
          </div>

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

          <p>パスワード確認</p>
          <input type="password" name="password_conf">
          
          <div class="err">
            <?php if (isset($err["password_conf"])): ?>
              <p><?php echo $err["password_conf"]; ?></p>
            <?php endif ?>   
          </div>

          <?php //?function関数hが使えない ?>
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(setToken(), ENT_QUOTES, "UTF-8"); ?>">

          <input type="submit" value="新規登録">
      
        </form>
      </div>
      </div>
    </div>    
  </div>
     
</body>
</html>