<?php
session_start();
// session_regenerate_id(true);
// require_once('config.php');
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

if (isset($_POST)) {

  //   $current_user = get_user($_SESSION['user_id']);
  $post_id = $_POST['post_id'];

  $profile_user_id = $_POST['page_id'] ?: $current_user['user_id'];

  //既に登録されているか確認
  if (check_favolite_duplicate($_SESSION['user_id'], $post_id)) {
    $action = '解除';
    $sql = "DELETE
            FROM benches
            WHERE user_id = :user_id AND post_id = :post_id";
  } else {
    $action = '登録';
    $sql = "INSERT INTO benches(user_id,post_id)
            VALUES(:user_id,:post_id)";
  }

  try {
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
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':user_id' => $_SESSION['user_id'], ':post_id' => $post_id));
  } catch (\Exception $e) {
    error_log('エラー発生:' . $e->getMessage());
    echo json_encode("error");
  }
}
