<?php
session_start();
$output = '';
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
//セッション変数のクリア
$_SESSION = array();
//セッションクッキーも削除
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}
//セッションクリア
@session_destroy();

echo $output;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ログアウトページ</title>
    <link rel="stylesheet" href="agent_logout.css">
    <link rel="stylesheet" href="../style/login.css">
</head>

<body>
    <header>
        <h1>
            <p><span>MidNight</span>by blackthunder</p>
        </h1>
        <p class="agent_login">ログアウト画面</p>
    </header>
    <div class="message">
        <p>ログアウトしました</p>
        <a href="login.php">ログインページへ</a>
    </div>
</body>

</html>