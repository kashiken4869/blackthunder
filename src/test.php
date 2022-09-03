<?php
    require('./parts/_header.php');
function check_favolite_duplicate($user_id,$post_id){
    $dsn = 'mysql:host=db;dbname=sns;charset=utf8mb4;';
    $user = 'posse_user';
    $password = 'password';
    try {
      $db = new PDO($dsn, $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);//追加した！
    } catch (PDOException $e) {
      echo '接続失敗: ' . $e->getMessage();
      exit();
    }
    $sql = "SELECT *
            FROM benches
            WHERE user_id = :user_id AND post_id = :post_id";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':user_id' => $user_id ,
                         ':post_id' => $post_id));
    $favorite = $stmt->fetch();
    return $favorite;
}
?>
</div>
<form class="favorite_count" action="#" method="post">
        <button name="favorite" class="favorite_btn">
            <i class="fa-solid fa-couch bench <?php if(check_favolite_duplicate(1,2)): ?>benchOn<?php endif; ?>"></i>
        </button>
</form>
<script src=" https://code.jquery.com/jquery-3.4.1.min.js "></script>
<script src="./js/test.js"></script>
</body>
</html>