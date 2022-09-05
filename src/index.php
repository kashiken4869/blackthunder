<?php

require($_SERVER['DOCUMENT_ROOT'] . "/db_connect.php");
session_start();

//ログインされていない場合は強制的にログインページにリダイレクト
if (!isset($_SESSION["user_id"]) || !isset($_SESSION['login'])) {
    header("Location: login/login.php");
    exit();
}

function time_diff($time_from, $time_to)
{
    // 日時差を秒数で取得
    $dif = $time_to - $time_from;
    //分単位
    $dif_min = floor($dif / 60);
    // 時間単位の差
    $dif_hour = floor($dif / 3600);
    // 日付単位の差
    $dif_days = round((strtotime(date("Y-m-d", $dif))) / 86400);
    if ($dif_days > 0) {
        return "{$dif_days}日";
    } elseif ($dif_hour > 0) {
        return "{$dif_hour}h";
    } else {
        return "{$dif_min}m";
    }
}

$tag = $_POST['tag'];
if ($tag == '選択してください' || $tag == 'すべて' || $tag == '') {
    $stmt = $db->prepare("SELECT * FROM users JOIN posts ON users.id = posts.user_id order by posts.created_at desc");
    $stmt->execute();
    $posts = $stmt->fetchAll();
} else {
    $stmt = $db->prepare("SELECT * FROM users JOIN posts ON users.id = posts.user_id where posts.tag_id = '$tag' order by posts.created_at desc");
    $stmt->execute();
    $posts = $stmt->fetchAll();
}
//すべての投稿取得

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

            //時間取得
            date_default_timezone_set('Asia/Tokyo'); //日本のタイムゾーンに設定
            $stmt = $db->prepare("SELECT * FROM posts where post_id = '$post_id'");
            $stmt->execute();
            $posts = $stmt->fetch();
            $from = strtotime($posts['created_at']);  // 2016年元旦 (0時0分0秒)
            $to   = strtotime("now");         // 現在日時
            // 結果：32days 12:34:56
            //***************************************
            // 日時の差を計算
            //**************************************

            //タグ表示
            $stmt = $db->prepare("SELECT * FROM posts INNER JOIN tags on posts.tag_id = tags.id where post_id = '$post_id'");
            $stmt->execute();
            $tag = $stmt->fetch();
        ?>
            <section class="post">
                <form action="store.php" method="post">
                    <input type="hidden" name="delete" value="<?= $post_id; ?>">
                    <input type="image" src="./img/iconmonstr-trash-can-9-240.png" class="trash">
                </form>
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
                    <p class="post-header_title"><?= $post['name']; ?><span><?= time_diff($from, $to); ?></span></p>
                </div>
                <div class="post-body">
                    <p><?= $post['content']; ?></p>
                    <form action="index.php" method="post">
                        <input type="hidden" name="tag" value="<?= $tag['id']; ?>">
                        <input type="submit" value="#<?= $tag['tag_name']; ?>" class="hashTag">
                    </form>
                    <!-- <a href="index.php">#<?= $tag['tag_name']; ?></a> -->
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
        <div class="dm"></div>
    </div>
    <!-- 要素としては残しておきつつ隠す -->
    <div class="create">
        <i class="fa-solid fa-plus">叫ぶ</i>
    </div>
    <div class="modal">
        <i class="fa-solid fa-circle-xmark close"></i>
        <form action="store.php" method="post">
            <div class="modal-text">
                <img src="./img/<?= $_SESSION['image']; ?>" alt="" class="post-header_logo">
                <textarea placeholder="ここに記入してください" name="text"></textarea>
            </div>
            <select name="tag_create" id="">
                <option value="選択肢してください" selected>選択してください</option>
                <?php foreach ($tags as $tag) : ?>
                    <option value="<?= $tag['id'] ?>"><?= $tag['tag_name'] ?></option>
                <?php endforeach; ?>
            </select>
            <button class="modal-button">記録・投稿</button>
        </form>
    </div>
    <div class="blackFilm"></div>
    <?php
    require('./parts/_footer.php');
    ?>
    <script>
        let selection;
        if ('<?= $_POST["tag"]; ?>' == 'すべて') {
            selection += `<option value="すべて" selected>すべて</option>`
        } else {
            selection += `<option value="すべて">すべて</option>`
        }
        <?php foreach ($tags as $tag) : ?>
            if ('<?= $_POST["tag"]; ?>' == '<?= $tag['id']; ?>') {
                selection += `<option value="<?= $tag['id'] ?>" selected><?= $tag['tag_name'] ?></option>`
            } else {
                selection += `<option value="<?= $tag['id'] ?>"><?= $tag['tag_name'] ?></option>`
            }
        <?php endforeach; ?>
        document.getElementById('tag').insertAdjacentHTML("beforeend", selection);


        $(function() {
            $(document).on('input', '#searchform', function(e) {
                e.preventDefault();
                let name = $('#search-text').val();
                $.ajax({
                    type: 'POST',
                    url: 'searchData.php',
                    dataType: 'json',
                    data: {
                        search_name: name
                    }
                }).done(function(data) {
                    // $(e.target).toggleClass("benchOn");
                    $('.post').hide();
                    if(data !== null){
                        $('.dm-list').remove();
                        $(".dm").append(`<div class="dm-list">
                            <img src="./img/${data.image}">
                            <form action="account.php" method="post">
                                <input type="hidden" name="search_id" value="${data.id}">
                                <input type="submit" value="${data.name}">
                            </form>
                        </div>`);
                        // $('.dm').append(`<img src="./img/${data.image}" class="image">`);
                    }
                    console.log(data.name)
                }).fail(function() {
                    console.log("aaaa")
                });
            });
        })
    </script>
</body>

</html>