<?php
session_start();
date_default_timezone_set('Asia/Tokyo'); //日本のタイムゾーンに設定
require(dirname(__FILE__) . "/db_connect.php");
$user_id = $_SESSION['user_id'];
$date = date("Y-m-d H:i:s");
$comment = $_POST['comment'];
if(isset($_POST['comment'])){
    $id = $_POST['post_id'];
    $_SESSION['id'] = $id;
    //コメントinsert
    $stmt = $db->prepare("insert into comments(post_id,user_id,comment,created_at) value('$id','$user_id','$comment','$date')");
    $stmt->execute();
    header('Location: comment.php');
    exit();
}elseif(isset($_POST['delete'])){
    $delete = $_POST['delete'];
    $stmt = $db->prepare("delete from posts where post_id = '$delete'");
    $stmt->execute();
    header('Location: index.php');
    exit();
}elseif(isset($_POST['message'])){
    $message = $_POST['message'];
    $room_id = $_POST['room_id'];
    $send_id = $_POST['send_id'];
    $_SESSION['partner_id'] = $_POST['partner_id'];
    $stmt = $db->prepare("insert into messages(room_id,send_user_id,text,created_at) value('$room_id','$send_id','$message','$date')");
    $stmt->execute();
    header('Location: message.php');
    exit();
}else{
    $text = $_POST['text'];
    $tag = $_POST['tag_create'];
    $stmt = $db->prepare("insert into posts(user_id,tag_id,content,created_at) value('$user_id','$tag','$text','$date')");
    $stmt->execute();
    header('Location: index.php');
    exit();
}




