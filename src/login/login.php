<?php 
require($_SERVER['DOCUMENT_ROOT'] . "/db_connect.php");
session_start();

// ログイン済みかを確認
if (!empty($_POST)) {
    $login = $db->prepare('SELECT * FROM users WHERE email=? AND password=?');
    $login->execute(array(
      $_POST['mail'],
      $_POST['password']
    ));
    $user = $login->fetch();
  
    if ($user) {
      $_SESSION = array();
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['name'] = $user['name'];
      $_SESSION['image'] = $user['image'];
      $_SESSION['time'] = time();
      header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.php');
      exit();
    } else {
      $error = 'fail';
    }
  }
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理者ログイン</title>
  <link rel="stylesheet" href="../admin/reset.css">
  <link rel="stylesheet" href="login.css">
</head>

<body>

  <header>
    <div class="header_top">
      <h1>管理者画面 ログインページ</h1>
    </div>
  </header>

  <section class="login">
    <form action="../login/login.php" method="POST" class="login-container">
      <p><input type="mail" name="mail" placeholder="mail" required></p>
      <p><input type="password" name="password" placeholder="Password" required></p>
      <?php if ($user == []) : ?>
        <span>ログインに失敗しました。正しくご記入ください。</span>
      <?php endif; ?>
      <p><input type="submit" value="Log in"></p>
      <p><a href="../admin_top/index.html">パスワードをお忘れの方はこちら</a></p>
    </form>
  </section>
</body>

</html>