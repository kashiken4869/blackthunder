<?php
session_start();
require(dirname(__FILE__) . "/db_connect.php");
$user_id = $_SESSION['user_id'];

isset($_POST['partner_id']) ? $partner_id = $_POST['partner_id'] : $partner_id = $_SESSION['partner_id'];

$stmt = $db->prepare("SELECT * FROM rooms where rooms.user_id = '$user_id' AND rooms.partner_id = '$partner_id' OR rooms.user_id = '$partner_id' AND rooms.partner_id = '$user_id'");
$stmt->execute();
$room = $stmt->fetch();

if(!isset($room['id'])){
    $stmt = $db->prepare("insert into rooms(user_id,partner_id) value('$user_id','$partner_id')");
    $stmt->execute();

    $room_id = $db-> lastInsertId();
}


$stmt = $db->prepare("SELECT * FROM rooms INNER JOIN messages on rooms.id = messages.room_id INNER JOIN users on rooms.user_id = users.id where rooms.user_id = '$user_id' AND rooms.partner_id = '$partner_id' OR rooms.user_id = '$partner_id' AND rooms.partner_id = '$user_id'");
$stmt->execute();
$messages = $stmt->fetchAll();

require('./parts/_header.php');
?>
<div class="message">
    <?php foreach ($messages as $message) : 
        if($user_id == $message['user_id']){
            if($user_id == $message['send_user_id']){
                $stmt = $db->prepare("SELECT * FROM rooms INNER JOIN messages on rooms.id = messages.room_id INNER JOIN users on rooms.user_id = users.id where send_user_id = '$partner_id' limit 1");
                $stmt->execute();
                $image = $stmt->fetch();
            }else{
                $stmt = $db->prepare("SELECT * FROM rooms INNER JOIN messages on rooms.id = messages.room_id INNER JOIN users on rooms.partner_id = users.id where send_user_id = '$user_id' limit 1");
                $stmt->execute();
                $image = $stmt->fetch();
            }            
        }else{
            if($user_id !== $message['send_user_id']){
                $stmt = $db->prepare("SELECT * FROM rooms INNER JOIN messages on rooms.id = messages.room_id INNER JOIN users on rooms.user_id = users.id where send_user_id = '$partner_id' limit 1");
                $stmt->execute();
                $image = $stmt->fetch();
            }else{
                $stmt = $db->prepare("SELECT * FROM rooms INNER JOIN messages on rooms.id = messages.room_id INNER JOIN users on rooms.partner_id = users.id where send_user_id = '$user_id' limit 1");
                $stmt->execute();
                $image = $stmt->fetch();
            }             
        }
        ?>
        <div class="message-body <?= $message['text'] ;?>">
            <img src="./img/<?= $image['image']; ?>" alt="" class="message-body_image">
            <p class="message-body_area"><?= $message['text']; ?></p>
        </div>
        <style>
            <?php if ($user_id == $message['send_user_id']) : ?>
                .<?= $message['text'] ;?>{
                flex-direction: row-reverse;
            }
            <?php endif; ?>
        </style>
    <?php endforeach; ?>
    <div class="message-send">
        <form action="store.php" method="post">
            <textarea name="message" id="" placeholder="ここに記入してください"></textarea>
            <?php if(!isset($room['id'])) : ?>
                <input type="hidden" name="room_id" value="<?= $room_id ?>">                
            <?php else : ?>
                <input type="hidden" name="room_id" value="<?= $room['id'] ?>">
            <?php endif; ?>
            <input type="hidden" name="send_id" value="<?= $user_id ?>">
            <input type="hidden" name="partner_id" value="<?= $partner_id ;?>">
            <input type="image" src="./img/icons8-メールを送信-48.png">
        </form>
    </div>
</div>
</body>

</html>