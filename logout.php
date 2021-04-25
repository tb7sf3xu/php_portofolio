<?php
  session_start();
  
  require_once("UserLogic.php");
  
  if (!$logout = filter_input(INPUT_POST, "logout")) {
    exit("不正なリクエストです。");
  }


  //ログインしているか判定し、セッションが切れていたらログインしてくださいとメッセージを出す。
  $result = UserLogic::checkLogin();

  if (!$result) {
    exit("セッションが切れましたので、ログインし直してください。");
  }

  //ログアウトする
  UserLogic::logout();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login_stylesheet.css">
    <title>ログアウト</title>
</head>

<body>

  <header>
    <h1 class="name">在庫管理システム</h1>
    <a class="login" href="login_form.php">ログインする</a>
  </header>

  <div class="main users-new">
    <div class="container">
      <h2 class="form-heading">ログアウト</h2>
  
      <div class="form users-form">
      <div class="form-body">       
        <h2>ログアウト完了</h2>
        <p>ログアウトしました！</p>
        <a href="login_form.php">ログイン画面へ</a>
      </div>
      </div>
    </div>
  </div>
    
</body>
</html>