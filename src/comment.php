<?php
    require(dirname(__FILE__) . "/db_connect.php");

$id = $_POST['id'];

//投稿取得
$stmt_post = $db->prepare("SELECT * FROM users JOIN posts ON users.id = posts.user_id where posts.id = $id");
$stmt_post->execute();
$posts = $stmt_post->fetchAll();

//コメント取得
$stmt = $db->prepare("SELECT * FROM comments INNER JOIN posts on comments.post_id = posts.id INNER JOIN users on comments.user_id = users.id where posts.id = $id");
$stmt->execute();
$replies = $stmt->fetchAll();

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
    <div class="main">
    <?php 
        foreach($posts as $post):
            ?>
            <section class="post">
            <div class="post-header">
                <img src="./img/<?= $post['image'];?>" alt="" class="post-header_logo">
                <p class="post-header_title"><?= $post['name'] ;?><span>40m</span></p>
            </div>
            <div class="post-body">
                <p><?= $post['content'] ;?></p>
                <a href="#">#Good&New</a>
            </div>
            <div class="post-items">
                <i class="fa-solid fa-comment"></i>
                <i class="fa-solid fa-couch"></i>
                <i class="fa-solid fa-bookmark"></i>
                <i class="fa-solid fa-arrow-up-from-bracket"></i>
            </div>
        </section>
        <?php
        endforeach;
        ?>
            <?php 
        foreach($replies as $reply):
            ?>
        <section class="comment">
            <div class="comment-header">
                <img src="./img/<?= $reply['image'] ;?>" alt="" class="comment-header_logo">
                <p class="comment-header_title"><?= $reply['name'] ;?><span>30m</span></p>
            </div>
            <div class="comment-body">
                <p><?= $reply['comment'] ;?></p>
            </div>
        </section>
        <?php
        endforeach;
        ?>
    </div>
    <div class="create">
        <i class="fa-solid fa-plus"></i>
    </div>
    <div class="modal">
        <i class="fa-solid fa-circle-xmark close"></i>
        <form action="store.php" method="POST">
        <div class="modal-text" action="store.php" method="get">
            <img src="./img/karenicon.jpeg" alt="" class="post-header_logo">
            <input type="hidden" name="id" value="<?= $id ;?>">
            <textarea placeholder="ここに記入してください" name="comment"></textarea>
        </div>
        <button class="modal-button">記録・投稿</button>
        </form>
    </div>
    <div class="blackFilm"></div>
    <script src="./js/script.js"></script>
</body>
</html>