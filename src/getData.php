<script src=" https://code.jquery.com/jquery-3.4.1.min.js "></script>
<script src="../js/script.js"></script>
<?php
// session_start();
// session_regenerate_id(true);
// require_once('config.php');

function check_favolite_duplicate($user_id, $post_id)
{
  $dsn = 'mysql:host=db;dbname=sns;charset=utf8;';
  $user = "root";
  $password = 'password';
  $dbh = new PDO($dsn, $user, $password);
  $sql = "SELECT *
            FROM benches
            WHERE user_id = :user_id AND post_id = :post_id";
  $stmt = $dbh->prepare($sql);
  $stmt->execute(array(
    ':user_id' => 1,
    ':post_id' => 2
  ));
  $favorite = $stmt->fetch();
  return $favorite;
}

if (isset($_POST)) {

  //   $current_user = get_user($_SESSION['user_id']);
  $post_id = $_POST['post_id'];

  $profile_user_id = $_POST['page_id'] ?: $current_user['user_id'];

  //既に登録されているか確認
  if (check_favolite_duplicate(1, 2)) {
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
    $dsn = 'mysql:host=mysql;dbname=sns;charset=utf8;';
    $user = "root";
    $password = 'password';
    $dbh = new PDO($dsn, $user, $password);
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(':user_id' => 1, ':post_id' => 2));
  } catch (\Exception $e) {
    error_log('エラー発生:' . $e->getMessage());
    echo json_encode("error");
  }
}
