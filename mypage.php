<?php
  session_start();

  require_once("UserLogic.php");
  require_once("function.php");

  //エラーメッセージ
  $err = [];

  //バリデーション
  
  if (!$email = filter_input(INPUT_POST, "email")) {
    $err["email"] = "メールアドレスを記入してください。"; 
  }

  if (!$password = filter_input(INPUT_POST, "password")) {
    $err["password"] = "パスワードを記入してください。";  
  }

  
  if (count($err) > 0) {
    //エラーがあった場合は戻す
    $_SESSION = $err;
    header("Location: login_form.php");
    return;
  } 
  
  //ログイン成功時の処理
  $result = UserLogic::login($email, $password);
  //ログイン失敗時の処理
  if (!$result) {
    header("Location: login_form.php");
    return;
  }

  //ログインしているか判定し、していなかったら新規登録画面へ返す
  $result = UserLogic::checkLogin();

  if (!$result) {
    $_SESSION["login_err"] = "ユーザーを登録してログインしてください！";
    header("Location: signup_form.php");
    return;
  }

  $login_user = $_SESSION["login_user"];


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login_stylesheet.css">
    <title>マイページ</title>
</head>

<body>

  <header>
    <h1 class="name">在庫管理システム</h1>
    <form action="logout.php" method="POST">
      <input type="submit" name="logout" value="ログアウト">
    </form>
  </header>

  <div class="main users-new">
    <div class="container">
      <h2 class="form-heading">マイページ</h2>
      <div class="form users-form">
      <div class="form-body">     
        <?php //?function関数hが使えない ?>
        <p>ログインユーザー：<?php echo htmlspecialchars($login_user["name"], ENT_QUOTES, "UTF-8") ?></p>
        <p>メールアドレス：<?php echo htmlspecialchars($login_user["email"], ENT_QUOTES, "UTF-8") ?></p>
        
        <p><a href="index.php">在庫管理システムへ</a></p>
            
        <p><a href="insert_index.php">商品登録画面へ</a></p>

        <p><a href="delete_index.php">商品削除画面へ</a></p>
           
     </div>
     </div>
    </div>
  </div>
  
    
</body>
</html>