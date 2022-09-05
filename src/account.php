<?php
session_start();
require(dirname(__FILE__) . "/db_connect.php");
$user_id = $_SESSION['user_id'];
$search_id = $_POST['search_id'];


$stmt = $db->prepare("SELECT * FROM users JOIN posts ON users.id = posts.user_id where id = '$search_id'");
$stmt->execute();
$posts = $stmt->fetchAll();

$stmt = $db->prepare("SELECT * FROM users where id = '$search_id'");
$stmt->execute();
$profile = $stmt->fetch();

if (isset($_POST['iconImg'])) {
    $icon_karen_img = $_POST['iconImg'];
}

function check_favolite_duplicate($user_id,$post_id){
    $dsn = 'mysql:host=db;dbname=sns;charset=utf8mb4;';
    $user = 'posse_user';
    $password = 'password';
    try {
      $db = new PDO($dsn, $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);//追加した！
    } catch (PDOException $e) {
      echo '接続失敗: ' . $e->getMessage();
      exit();
    }
    $sql = "SELECT *
            FROM benches
            WHERE user_id = :user_id AND post_id = :post_id";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':user_id' => $user_id ,
                            ':post_id' => $post_id));
    $favorite = $stmt->fetch();
    return $favorite;
}

require('./parts/_header.php');

?>
<div class="main">
    <button class="edit-wrapper">
        <?php if($search_id == $user_id) : ?>
            <p class="edit-button">プロフィールを変更する</p>
        <?php else : ?>
            <p class="edit-button">プロフィールを見る</p>            
        <?php endif; ?>
    </button>
    <div id="profile">
        <i class="fa-solid fa-circle-xmark closed"></i>
        <form action="update.php" method="post" class="modal-form" enctype="multipart/form-data">
            <div class="post-header_logo_wrapper">
                <label class="post-header_logo img_wrap">
                    <img src=./img/<?= $profile['image'] ;?> alt="" id="preview" class="post-header_logo" title="画像を選択">
                    <input type="file" name="iconImg" id="filesend" accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png" <?php if($search_id !== $user_id): ?>disabled<?php endif; ?>>
                </label>
                <div class="modal-text">
                    <textarea name="introduce" placeholder="自己紹介をしよう" <?php if($search_id !== $user_id): ?>disabled<?php endif; ?>><?= $profile['introduce'] ;?></textarea>
                </div>
            </div>
            <input type="submit" class="modal-button" value="保存する" <?php if($search_id !== $user_id): ?>disabled<?php endif; ?>>
        </form>
    </div>
    <?php
        foreach ($posts as $post) :
            $post_id = $post['post_id'];
            $stmt_reply = $db->prepare("SELECT count(*) FROM comments INNER JOIN posts on comments.post_id = posts.post_id INNER JOIN users on comments.user_id = users.id where posts.post_id = '$post_id'");
            $stmt_reply->execute();
            $replyCount = $stmt_reply->fetch();
            //ベンチ数取得
            $stmt_bench = $db->prepare("select count(*) from benches where post_id = '$post_id'");
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
                        <input type="hidden" name="id" value="<?= $post['post_id'] ?>">
                        <input type="image" src="./img/iconmonstr-speech-bubble-comment-thin-240.png" class="commentIcon">
                        <span><?= $replyCount['count(*)']; ?></span>
                    </form>
                    <form class="favorite_count" action="#" method="post">
                        <button  name="favorite" class="favorite_btn">
                            <input type="hidden" value="<?= $post['post_id']; ?>" name="post_id" class="postId">
                            <i class="fa-solid fa-couch bench <?php if(check_favolite_duplicate($search_id,$post['post_id'])): ?>benchOn<?php endif; ?>" data-post="<?= $post['post_id']; ?>"></i>
                            <span class="count"><?= $benchCount['count(*)'];?></span>
                        </button>
                    </form>
                    <!-- <button class="bench" data-post="<?= $post['id']; ?>"><i class="fa-solid fa-couch"></i><span class="count"><?= $benchCount['count(*)'];?></span></button> -->
                    <button><i class="fa-solid fa-bookmark"></i></button>
                    <button><i class="fa-solid fa-arrow-up-from-bracket"></i></button>
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
    <form action="./index.php" method="post" class="modal-form">
        <div class="post-header_logo_wrapper">
            <img src=./img/<?= $profile['image'] ?> alt="" class="post-header_logo">
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
<script src="./js/test.js"></script>
<?php

require('./parts/_footer.php');

?>