<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/db_connect.php');

try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //追加した！
} catch (PDOException $e) {
    echo '接続失敗: ' . $e->getMessage();
    exit();
}
$user_id = $_SESSION['user_id'];

$stmt = $db->prepare("SELECT * FROM users where id = '$user_id'");
$stmt->execute();
$image = $stmt->fetch();

$stmt = $db->prepare("SELECT * FROM tags");
$stmt->execute();
$tags = $stmt->fetchAll();

echo $user_id;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style/reset.css">
    <link rel="stylesheet" type="text/css" href="./style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/92d415f0a8.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <header>
        <img src="./img/POSSElogo.jpeg" alt="" class="header_logo">
        <h2>Good&New/想いの丈SNS</h2>
        <div class="icon-wrapper">
            <i id="home" class="fa-solid fa-house icon-items"></i>
            <i id="bench" class="fa-solid fa-couch icon-items"></i>
            <?php if ($image['image'] != null): ?>
            <img id="user" class="fa-solid fa-user icon-items post-header_logo" src=./img/<?= $image['image'] ?> alt="">
            <?php else: ?>
            <img id="user" class="fa-solid fa-user icon-items post-header_logo" src="./img/ストイック.jpeg" alt="">
            <?php endif ?>
        </div>
        <a href="../login/logout.php">ログアウト</a>
        <i class="fa-solid fa-sun sun"></i>
        <i class="fa-solid fa-moon moon"></i>
    </header>
    <!-- <div class="wrapper">
        <div class="side">
            <div class="icon-wrapper">
                <i id="home" class="fa-solid fa-house icon-items"></i>
                <i id="bench" class="fa-solid fa-couch icon-items"></i>
                <i id="user" class="fa-solid fa-user icon-items"></i>
                <img id="user" class="fa-solid fa-user icon-items post-header_logo icon-items" src=./img/<?= $image['image'] ?> alt="">
                <div class="open-btn1"></div>
                <div id="search-wrap">
                    <form role="search" method="post" id="searchform" action="" action="index.php">
                        <input type="text" value="" name="search" id="search-text" placeholder="search">
                        <input type="submit" id="searchsubmit" value="">
                    </form>
                </div>
                <form action="index.php" method="post">
                    <select name="tag" id="tag" onchange="submit(this.form)">
                    </select>
                </form>
                <a href="index.php"><i id="home" class="fa-solid fa-house icon-items"></i></a>
                <a href="bench.php"><i id="bench" class="fa-solid fa-couch icon-items"></i></a>
                <!-- <i id="user" class="fa-solid fa-user icon-items"></i> -->
                <a href="dm.php"><i class="fa-solid fa-envelope icon-items"></i></a>
                <form action="account.php" method="post">
                    <input type="hidden" name="search_id" value="<?= $user_id ;?>">
                    <input type="image" src=./img/<?= $image['image'] ?> alt="" class="post-header_logo icon-items">
                </form>
            </div>
        </div>
    </div> -->
