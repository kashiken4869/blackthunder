<?php

$icon_karen_img = './img/karenicon.jpeg';

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
    </header>
    <div class="wrapper">
        <div class="side">
            <div class="icon-wrapper">
                <i id="home" class="fa-solid fa-house icon-items"></i>
                <i id="bench" class="fa-solid fa-couch icon-items"></i>
                <i id="user" class="fa-solid fa-user icon-items"></i>
                <img src=<?= $icon_karen_img ?> alt="" class="post-header_logo icon-items">
            </div>
        </div>