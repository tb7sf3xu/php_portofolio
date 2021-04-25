<?php
  session_start();

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
  if (!$username = filter_input(INPUT_POST, "username")) {
    $err["username"] = "ユーザー名を記入してください。"; 
  }

  if (!$email = filter_input(INPUT_POST, "email")) {
    $err["email"] = "メールアドレスを記入してください。"; 
  }

  $password = filter_input(INPUT_POST, "password");

  if (!preg_match("/\A[a-z\d]{8,100}+\z/i", $password)) {
    $err["password"] = "パスワードの値は英数字8文字以上100文字以下にしてください。";
  }

  $password_conf = filter_input(INPUT_POST, "password_conf");

  if ($password !== $password_conf) {
    $err["password_conf"] = "確認用パスワードと異なっています。";
  }

  if (count($err) > 0) {
    //エラーがあった場合は戻す
    $_SESSION = $err;
    header("Location: signup_form.php");
    return;
  }

  if (count($err) === 0) {
    //ユーザー登録をする処理
    $hasCreated = UserLogic::createUser($_POST);

    if (!$hasCreated) {
      $err["hasCreated"] = "登録に失敗しました。";
    }
  }  
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login_stylesheet.css">
    <title>ユーザー登録完了画面</title>
</head>

<body>
  <?php if(isset($err["hasCreated"])): ?>
    <p><?php echo $err["hasCreated"] ?></p>
  <?php else: ?>
    <p>ユーザー登録が完了しました。</p>     
  <?php endif ?>
  <a href="login_form.php">ログイン画面へ</a>
    
</body>
</html>