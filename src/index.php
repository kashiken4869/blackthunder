<?php

require($_SERVER['DOCUMENT_ROOT'] . "/db_connect.php");
session_start();

//ログインされていない場合は強制的にログインページにリダイレクト
if (!isset($_SESSION["user_id"]) || !isset($_SESSION['login'])) {
    header("Location: login/login.php");
    exit();
}


//すべての投稿取得
$stmt = $db->prepare("SELECT * FROM users JOIN posts ON users.id = posts.user_id");
$stmt->execute();
$posts = $stmt->fetchAll();

function check_favolite_duplicate($user_id, $post_id)
{
    $dsn = "mysql:host=db;dbname=sns;charset=utf8mb4;";
    $user = 'posse_user';
    $password = 'password';
    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //追加した！
    } catch (PDOException $e) {
        echo '接続失敗: ' . $e->getMessage();
        exit();
    }
    $sql = "SELECT *
            FROM benches
            WHERE user_id = :user_id AND post_id = :post_id";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
        ':user_id' => $user_id,
        ':post_id' => $post_id
    ));
    $favorite = $stmt->fetch();
    return $favorite;
}
?>



<body>
    <div class="main">
    <?php

require('./parts/_header.php');
?>
        <?php
        foreach ($posts as $post) :
            $post_id = $post['post_id'];
            //コメント数取得
            $stmt_reply = $db->prepare("SELECT count(*) FROM comments INNER JOIN posts on comments.post_id = posts.post_id INNER JOIN users on comments.user_id = users.id where posts.post_id = '$post_id'");
            $stmt_reply->execute();
            $replyCount = $stmt_reply->fetch();
            //ベンチ数取得
            $stmt_bench = $db->prepare("select count(*) from benches where post_id = '$post_id'");
            $stmt_bench->execute();
            $benchCount = $stmt_bench->fetch();

            //ベンチ押したユーザー取得
            $stmt_user = $db->prepare("SELECT * from benches INNER JOIN users on benches.user_id = users.id where post_id = '$post_id'");
            $stmt_user->execute();
            $benchUsers = $stmt_user->fetchAll();
        ?>
            <section class="post">
                <div class="benchModal">
                    <p>ベンチに行きたいユーザー</p>
                    <?php foreach ($benchUsers as $benchUser) : ?>
                        <div class="post-header">
                            <img src="./img/<?= $benchUser['image']; ?>" alt="" class="post-header_logo">
                            <p class="post-header_title"><?= $benchUser['name']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
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
                        <input type="hidden" name="id" value="<?= $post['post_id'] ?>">
                        <input type="image" src="./img/iconmonstr-speech-bubble-comment-thin-240.png" class="commentIcon">
                        <span><?= $replyCount['count(*)']; ?></span>
                    </form>
                    <form class="favorite_count" action="#" method="post">
                        <button name="favorite" class="favorite_btn">
                            <input type="hidden" value="<?= $post['post_id']; ?>" name="post_id" class="postId">
                            <i class="fa-solid fa-couch bench <?php if (check_favolite_duplicate($_SESSION['user_id'], $post['post_id'])) : ?>benchOn<?php endif; ?>" data-post="<?= $post['post_id']; ?>"></i>
                        </button>
                        <span class="count"><?= $benchCount['count(*)']; ?></span>
                    </form>
                    <!-- <button class="bench" data-post="<?= $post['id']; ?>"><i class="fa-solid fa-couch"></i><span class="count"><?= $benchCount['count(*)']; ?></span></button> -->
                    <!-- <button><i class="fa-solid fa-bookmark"></i></button> -->
                    <a href="//timeline.line.me/social-plugin/share?text=<?= $post['content'] ?>" target="_blank" rel="nofollow noopener noreferrer">
                        <button><i class="fa-solid fa-arrow-up-from-bracket"></i></button>
                    </a>
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
        <p class="fa-solid fa-plus">叫ぶ</p>
    </div>
    <div class="modal">
        <i class="fa-solid fa-circle-xmark close"></i>
        <div class="modal-text">
            <img src="./img/<?= $_SESSION['image']; ?>" alt="" class="post-header_logo">
            <textarea placeholder="ここに記入してください"></textarea>
        </div>
        <button class="modal-button">記録・投稿</button>
    </div>
    <div class="blackFilm"></div>
    <?php

    require('./parts/_footer.php');

    ?>
</body>

</html>