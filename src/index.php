<?php
require($_SERVER['DOCUMENT_ROOT'] . "/db_connect.php");
session_start();

$dsn = 'mysql:host=db;dbname=sns;charset=utf8;';
$user = "root";
$password = 'password';

try {
    $pdo = new PDO($dsn, $user, $password);
    $msg = 'MySQLに接続成功！';
} catch (PDOException $e) {
    $msg  = 'MySQLへの接続失敗...<br>' . $e->getMessage();
}
echo $msg;
//すべての投稿取得
$stmt = $pdo->prepare("SELECT * FROM users JOIN posts ON users.id = posts.user_id");
$stmt->execute();
$posts = $stmt->fetchAll();

?>

<?php

require('./parts/_header.php');
?>

<body>
    <div class="main">
        <?php
        foreach ($posts as $post) :
            $id = $post['id'];
            $stmt_reply = $pdo->prepare("SELECT count(*) FROM comments INNER JOIN posts on comments.post_id = posts.id INNER JOIN users on comments.user_id = users.id where posts.id = $id");
            $stmt_reply->execute();
            $replyCount = $stmt_reply->fetch();

            //ベンチ数取得
            $stmt_bench = $pdo->prepare("select count(*) from benches where post_id = '$id'");
            $stmt_bench->execute();
            $benchCount = $stmt_bench->fetch();
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
                    <form action="comment.php" method="post">
                        <input type="hidden" value="<?= $post['id']; ?>" name="id">
                        <input type="image" src="./img/iconmonstr-speech-bubble-comment-thin-240.png" class="commentIcon">
                        <span><?= $replyCount['count(*)']; ?></span>
                    </form>
                    <button class="bench" data-post="<?= $post['id']; ?>"><i class="fa-solid fa-couch"></i><span class="count"><?= $benchCount['count(*)']; ?></span></button>
                    <button><i class="fa-solid fa-bookmark"></i></button>
                    <button><i class="fa-solid fa-arrow-up-from-bracket"></i></button>
                </div>
            </section>
        <?php
        endforeach;
        ?>
        <!-- 要素としては残しておきつつ隠す -->
        <button class="edit-wrapper" style="display: none;">
            <p class="edit-button">プロフィールを変更する</p>
        </button>
        <div id="profile" style="display: none;">
            <!-- <i class="fa-solid fa-circle-xmark close"></i> -->
            <form action="#" method="post" class="modal-form">
                <div class="post-header_logo_wrapper">
                    <label class="post-header_logo img_wrap">
                        <img src=<?= $icon_karen_img ?> alt="" id="postHeaderLogo" class="post-header_logo" title="画像を選択">
                        <input type="file" name="iconImg" id="filesend" accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png">
                    </label>
                    <div class="modal-text">
                        <textarea name="introText" placeholder="自己紹介をしよう"><?= $introduction ?></textarea>
                    </div>
                </div>
                <button class="modal-button">保存する</button>
            </form>
        </div>
    </div>
    <!-- 要素としては残しておきつつ隠す -->
    <div class="create">
        <i class="fa-solid fa-plus"></i>
    </div>
    <div class="modal">
        <i class="fa-solid fa-circle-xmark close"></i>
        <form action="./index.php" method="post" class="modal-form">
            <div class="post-header_logo_wrapper">
                <img src=<?= $icon_karen_img ?> alt="" class="post-header_logo">
                <div class="modal-text">
                    <textarea name="postText" placeholder="ここに記入してください"></textarea>
                    <div class="hashTag_wrapper">
                        <select name="hashTag" class="hashTag">
                            <option>#good&new</option>
                            <option>#思いの丈</option>
                        </select>
                    </div>
                </div>
            </div>
            <button class="modal-button">投稿</button>
        </form>
    </div>
    <div class="blackFilm"></div>
    <?php

    require('./parts/_footer.php');

    ?>
</body>

</html>