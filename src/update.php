<?php
session_start();
require(dirname(__FILE__) . "/db_connect.php");
$user_id = $_SESSION['user_id'];
$introduce = $_POST['introduce'];
if (!empty($_FILES)) {

  // ファイル名を取得
  $filename = $_FILES['iconImg']['name'];

  //move_uploaded_file（第1引数：ファイル名,第2引数：格納後のディレクトリ/ファイル名）
  // 第2引数に使う部分
  $uploaded_path = './img/' . $filename;
  //echo $uploaded_path.'<br>';

  $result = move_uploaded_file($_FILES['iconImg']['tmp_name'], $uploaded_path);

  if ($result) {
    $MSG = 'アップロード成功！ファイル名：' . $filename;
    $img_path = $uploaded_path;
  } else {
    $MSG = 'アップロード失敗！エラーコード：' . $_FILES['iconImg']['error'];
  }
} else {
  $MSG = '画像を選択してください';
}
  //前の画像さ削除

  // コメントinsert

$stmt_before = $db->prepare("select * from users where id = '$user_id'");
$stmt_before->execute();
$beforeImage = $stmt_before->fetch();

if($beforeImage['image'] !== $filename ){
  unlink('./img/'.$beforeImage['image']);
  $stmt = $db->prepare("UPDATE users SET image = '$filename' WHERE id = '$user_id'");
  $stmt->execute();
  if($beforeImage['introduce'] !== $introduce){
    $stmt = $db->prepare("UPDATE users SET introduce = '$introduce' WHERE id = '$user_id'");
    $stmt->execute();
  }
}elseif($beforeImage['introduce'] !== $introduce){
  $stmt = $db->prepare("UPDATE users SET introduce = '$introduce' WHERE id = '$user_id'");
  $stmt->execute();
}


header('Location: account.php');
exit();
