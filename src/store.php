<?php
session_start();
require(dirname(__FILE__) . "/db_connect.php");
$user_id = $_SESSION['user_id'];
$date = date("Y-m-d");
$comment = $_POST['comment'];
$id = $_POST['post_id'];

$_SESSION['id'] = $id;
//コメントinsert
$stmt = $db->prepare("insert into comments(post_id,user_id,comment,created_at) value('$id','$user_id','$comment','$date')");
$stmt->execute();


header('Location: comment.php');
exit();
