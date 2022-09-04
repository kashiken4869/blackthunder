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

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style/reset.css">
    <link rel="stylesheet" type="text/css" href="./style/style.css">
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
            <img id="user" class="fa-solid fa-user icon-items post-header_logo icon-items" src=./img/<?= $image['image'] ?> alt="">
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
            </div>
        </div>
    </div> -->