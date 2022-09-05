<?php 
require($_SERVER['DOCUMENT_ROOT'] . "/db_connect.php");
session_start();

// // ログイン済みかを確認
// if (isset($_SESSION['login'])) {
//     header('Location: ../index.php'); // ログインしていればagent_students_all.phpへリダイレクトする
//     exit; // 処理終了
// }

            // echo password_hash("pass", PASSWORD_DEFAULT);
if (isset($_POST["submit"])) {
    try {
        $db = new PDO("$dsn", "$user", "$password");
        // $stmt = $db->prepare('SELECT id, corporate_name, login_email, login_pass FROM agents WHERE login_email = :login_email limit 1');
        $stmt = $db->prepare('SELECT id, name, email, login_pass FROM users WHERE email = :email limit 1');
        $email = $_POST['email'];
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($_POST['pass'], $result['login_pass'])) {
            session_regenerate_id(TRUE); //セッションidを再発行
            $_SESSION["user_id"] = $result["id"];
            $_SESSION['name'] = $result['name'];
            $_SESSION['img'] = $result['img'];
            $_SESSION["login"] = $_POST['email']; //セッションにログイン情報を登録
            header('Location: ../index.php');
        } else {
            $msg = 'メールアドレスもしくはパスワードが間違っています。';
        }
    } catch (PDOException $e) {
        echo "もう一回";
        $msg = $e->getMessage();
        exit;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="../style/login.css">
</head>

<body>
    <header>
    <h1>
        <p><span>MidNight</span>by blackthunder</p>
    </h1>
    <p class="agent_login">MidNightログイン画面</p>
    </header>
    <div class="agent_login_info">
        <h2 class="agent_login_title">ログイン</h2>
        <form action="" method="post">
        <?php if (isset($msg)) : ?>
            <h3 class="pass_wrong"><?php echo $msg; ?></h3>
        <?php endif; ?>
            <p class="agent_login_label">メールアドレス</p>
            <input type="text" name="email" value="" required>
            <p class="agent_login_label">パスワード</p>
            <input type="password" name="pass" value="" required>
            <input type="submit" name="submit" value="ログイン">
            <a class="new_person" href="signup.php">新規の方はこちら</a>
        </form>
    </div>
    <!-- <div class="inquiry">
        <p>お問い合わせは下記の連絡先にお願いいたします。
            <br>craft運営 boozer株式会社事務局
            <br>TEL:080-3434-2435
            <br>Email:craft@boozer.com
        </p>
    </div> -->
</body>

</html>  
