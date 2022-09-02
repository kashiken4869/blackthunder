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
//すべての投稿取得
$stmt = $pdo->prepare("SELECT * FROM users JOIN posts ON users.id = posts.user_id WHERE users.id = 1");
$stmt->execute();
$posts = $stmt->fetchAll();


$introduction = "2.0期生のかれんです。";

if (isset($_POST['iconImg'])) {
    $icon_karen_img = $_POST['iconImg'];
}

?>

<?php

require('./parts/_header.php');
?>

<div class="main">
    <button class="edit-wrapper">
        <p class="edit-button">プロフィールを変更する</p>
    </button>
    <div id="profile">
        <i class="fa-solid fa-circle-xmark closed"></i>
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
    <section class="post">
        <div class="post-header">
            <img src=<?= $icon_karen_img ?> alt="" class="post-header_logo">
            <p class="post-header_title">karen@Hyogo<span>40m</span></p>
        </div>
        <div class="post-body">
            <p>水族館のあるお店で夜ご飯を食べたよ！とてもきれいでおいしかったです。</p>
            <a href="#">#Good&New</a>
        </div>
        <div class="post-items">
            <i class="fa-solid fa-comment"></i>
            <i class="fa-solid fa-couch"></i>
            <i class="fa-solid fa-bookmark"></i>
            <i class="fa-solid fa-arrow-up-from-bracket"></i>
        </div>
    </section>
    <section class="post">
        <div class="post-header">
            <img src=<?= $icon_karen_img ?> alt="" class="post-header_logo">
            <p class="post-header_title">karen@Hyogo<span>1h</span></p>
        </div>
        <div class="post-body">
            <p>神宮の花火が自分が見てきたのと違っていろんな種類の花火が見れず、スポンサーお膳立て花火ばっかだった。なんか違う</p>
            <a href="#">#想いの丈</a>
        </div>
        <div class="post-items">
            <i class="fa-solid fa-comment"></i>
            <i class="fa-solid fa-couch"></i>
            <i class="fa-solid fa-bookmark"></i>
            <i class="fa-solid fa-arrow-up-from-bracket"></i>
        </div>
    </section>
    <section class="post">
        <div class="post-header">
            <img src=<?= $icon_karen_img ?> alt="" class="post-header_logo">
            <p class="post-header_title">karen@Hyogo<span>2h</span></p>
        </div>
        <div class="post-body">
            <p>今日はVRの研究室で電波を発する銃を作りました。電気パッドで電気が流れてくるのがとても気持ちいいです。</p>
            <a href="#">#Good&New</a>
        </div>
        <div class="post-items">
            <i class="fa-solid fa-comment"></i>
            <i class="fa-solid fa-couch"></i>
            <i class="fa-solid fa-bookmark"></i>
            <i class="fa-solid fa-arrow-up-from-bracket"></i>
        </div>
    </section>
    <section class="post">
        <div class="post-header">
            <img src=<?= $icon_karen_img ?> alt="" class="post-header_logo">
            <p class="post-header_title">karen@Hyogo<span>4h</span></p>
        </div>
        <div class="post-body">
            <p>やっぱり作るものが決まるとやる気が出ますなぁ。ということで見た目だけSNS作ってみました。PHPとGitHubの復習も頑張りたいと思います。</p>
            <a href="#">#Good&New</a>
        </div>
        <div class="post-items">
            <i class="fa-solid fa-comment"></i>
            <i class="fa-solid fa-couch"></i>
            <i class="fa-solid fa-bookmark"></i>
            <i class="fa-solid fa-arrow-up-from-bracket"></i>
        </div>
    </section>
</div>
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