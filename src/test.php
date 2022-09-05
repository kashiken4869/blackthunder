<?php
date_default_timezone_set('Asia/Tokyo'); //日本のタイムゾーンに設定

require(dirname(__FILE__) . "/db_connect.php");
$stmt = $db->prepare("SELECT * FROM posts where post_id = 2");
$stmt->execute();
$posts = $stmt->fetch();


$from = strtotime($posts['created_at']);  // 2016年元旦 (0時0分0秒)
$to   = strtotime("now");         // 現在日時
echo time_diff($from, $to);
// 結果：32days 12:34:56

//***************************************
// 日時の差を計算
//***************************************
function time_diff($time_from, $time_to) 
{
    // 日時差を秒数で取得
    $dif = $time_to - $time_from;
    //分単位
    // 時間単位の差
    $dif_hour= floor( $dif / 3600 );
    // 日付単位の差
    $dif_days = floor((strtotime(date("Y-m-d", $dif))) / 86400);
    if($dif_days > 0){
        return "{$dif_days}日";
    }else{
        return "{$dif_hour}h";
    }
}
