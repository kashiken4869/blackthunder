<?php

$dsn = "mysql:host=db;dbname=sns;charset=utf8mb4;";
$user = 'posse_user';
$password = 'password';


try{

$db = new PDO($dsn, $user, $password);

$stmt = $db->prepare("INSERT INTO users (email, login_pass) VALUES (:email, :login_pass)");

$stmt->execute(array(':email' => $_POST['email'],':login_pass' => password_hash($_POST['pass'], PASSWORD_DEFAULT)));

}catch(Exception $e){
    echo "データベースの接続に失敗しました：";
    echo $e->getMessage();
    die();
}

if($_POST['email'] != null) {
    header("Location: signup_done.php"); 
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>会員登録</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="../style/login.css">
</head>

<body>
    <header>
    <h1>
        <p><span>MidNight</span>by blackthunder</p>
    </h1>
    <p class="agent_login">MidNightアカウント作成画面</p>
    </header>
        <div class="agent_login_info">

    <h2 class="agent_login_title">アカウント作成</h2>
    <form action="" method="post">
        <p>
            <label>メールアドレス：</label>
            <input type="text" name="email">
        </p>

        <p>
            <label>パスワード：</label>
            <input type="password" name="pass">
        </p>

        <input type="submit" name="submit" value="会員登録する">
    </form>
        </div>
</body>
</html>
