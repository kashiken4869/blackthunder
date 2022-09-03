<?php
    require(dirname(__FILE__) . "/db_connect.php");

$date = date("Y-m-d");
$comment = $_POST['comment'];
$id = $_POST['id'];

//コメントinsert
$stmt = $db->prepare("insert into comments(post_id,user_id,comment,created_at) value('$id',2,'$comment','$date')");
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="comment.php" method="POST">
        <input type="hidden" value="<?= $id ;?>" name="id">
        <input type="submit" value="コメントを見る">
    </form>
</body>
</html>
