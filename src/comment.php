<?php
// require(dirname(__FILE__) . "/db_connect.php");
require($_SERVER['DOCUMENT_ROOT'] . '/db_connect.php');
session_start();

isset($_POST['id']) ? $id = $_POST['id']: $id = $_SESSION['id'];

//投稿取得
$stmt_post = $db->prepare("SELECT * FROM users JOIN posts ON users.id = posts.user_id where posts.post_id = '$id'");
$stmt_post->execute();
$posts = $stmt_post->fetchAll();

//コメント取得
$stmt = $db->prepare("SELECT * FROM comments INNER JOIN posts on comments.post_id = posts.post_id INNER JOIN users on comments.user_id = users.id where posts.post_id = '$id'");
$stmt->execute();
$replies = $stmt->fetchAll();

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
    <div class="main">
    <?php 
        foreach($posts as $post):
            $stmt_bench = $db->prepare("select count(*) from benches where post_id = '$id'");
            $stmt_bench->execute();
            $benchCount = $stmt_bench->fetch();
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
                <form class="favorite_count" action="#" method="post">
                        <button  name="favorite" class="favorite_btn">
                            <input type="hidden" value="<?= $post['post_id']; ?>" name="post_id" class="postId">
                            <i class="fa-solid fa-couch bench <?php if(check_favolite_duplicate($_SESSION['user_id'],$post['post_id'])): ?>benchOn<?php endif; ?>" data-post="<?= $post['post_id']; ?>"></i>
                            <span class="count"><?= $benchCount['count(*)'];?></span>
                        </button>
                </form>
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
        <img src="./img/<?= $_SESSION['image'] ;?>" alt="" class="post-header_logo">
            <input type="hidden" name="id" value="<?= $id ;?>">
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