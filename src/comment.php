<?php
$dsn = 'mysql:host=db;dbname=sns;charset=utf8;';
$user = "root";
$password = 'password';

try {
    $pdo = new PDO($dsn, $user, $password);
    $msg = 'MySQLに接続成功！';
} catch (PDOException $e) {
    $msg  = 'MySQLへの接続失敗...<br>' . $e->getMessage();
}

$id = $_POST['id'];

//投稿取得
$stmt_post = $pdo->prepare("SELECT * FROM users JOIN posts ON users.id = posts.user_id where posts.id = $id");
$stmt_post->execute();
$posts = $stmt_post->fetchAll();

//コメント取得
$stmt = $pdo->prepare("SELECT * FROM comments INNER JOIN posts on comments.post_id = posts.id INNER JOIN users on comments.user_id = users.id where posts.id = $id");
$stmt->execute();
$replies = $stmt->fetchAll();

?>
<?php

require('./parts/_header.php');

?>


<div class="main">
    <?php
    foreach ($posts as $post) :
    ?>
        <section class="post">
            <div class="post-header">
                <img src="./img/<?= $post['image']; ?>" alt="" class="post-header_logo">
                <p class="post-header_title"><?= $post['name']; ?><span>40m</span></p>
            </div>
            <div class="post-body">
                <p><?= $post['content']; ?></p>
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
    foreach ($replies as $reply) :
    ?>
        <section class="comment">
            <div class="comment-header">
                <img src="./img/<?= $reply['image']; ?>" alt="" class="comment-header_logo">
                <p class="comment-header_title"><?= $reply['name']; ?><span>30m</span></p>
            </div>
            <div class="comment-body">
                <p><?= $reply['comment']; ?></p>
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
            <input type="hidden" name="id" value="<?= $id; ?>">
            <textarea placeholder="ここに記入してください" name="comment"></textarea>
        </div>
        <button class="modal-button">記録・投稿</button>
    </form>
</div>
<div class="blackFilm"></div>
<?php

require('./parts/_footer.php');

?>
</body>

</html>