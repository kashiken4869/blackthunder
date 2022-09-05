<?php
session_start();
require(dirname(__FILE__) . "/db_connect.php");

$search_name = $_POST['search_name'];
$stmt = $db->prepare("SELECT * FROM users JOIN posts ON users.id = posts.user_id where name LIKE ? limit 1");
$stmt->execute(['%'.$search_name.'%']);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $memberList = array(
        'id' => $row['id'],
        'name' => $row['name'],
        'image' => $row['image'],
    );
}
header("Content-type: application/json; charset=UTF-8");
echo json_encode($memberList);
