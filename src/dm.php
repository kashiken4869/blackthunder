<?php 
    session_start();
    require(dirname(__FILE__) . "/db_connect.php");

    $id = $_SESSION['user_id'];
    $stmt = $db->prepare("SELECT * FROM users where not id = '$id'");
    $stmt->execute();
    $users = $stmt->fetchAll();
    require('./parts/_header.php');
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
    <div class="dm">
    <?php foreach ( $users as $user ): ?>
        <div class="dm-list">
        <img src="./img/<?= $user['image'] ;?>">
        <form action="message.php" method="post">
            <input type="hidden" name="partner_id" value="<?= $user['id'] ;?>">
        <input type="submit" value="<?= $user['name'] ;?>">
        </form>
        </div>
    <?php endforeach; ?>
    </div>
</body>
</html>