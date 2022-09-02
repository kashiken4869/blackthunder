<?php
function check_favolite_duplicate($user_id,$post_id){
    $dsn = 'mysql:host=mysql;dbname=good_sns;charset=utf8;';
    $user = "root";
    $password = 'password';
    $dbh=new PDO($dsn,$user,$password);
    $sql = "SELECT *
            FROM benches
            WHERE user_id = :user_id AND post_id = :post_id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(':user_id' => $user_id ,
                         ':post_id' => $post_id));
    $favorite = $stmt->fetch();
    return $favorite;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form class="favorite_count" action="#" method="post">
        <input type="hidden" name="post_id">
        <button type="button" name="favorite" class="favorite_btn">
        <?php if (!check_favolite_duplicate(1,2)): ?>
          いいね
        <?php else: ?>
          いいね解除
        <?php endif; ?>
        </button>
</form>
<script src=" https://code.jquery.com/jquery-3.4.1.min.js "></script>
<script src="./js/test.js"></script>
</body>
</html>