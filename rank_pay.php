<?php

set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once( 'config.php' );

$message = "";

$url="";

$success = false;

$sql1 = "SELECT * FROM `rank` where `count` < '2' and `status` = '0'";
$q1 = mysqli_query($db,$sql1);
$c1 = mysqli_num_rows($q1);
if($c1>0){
    $k = $l= 0;
    while($r1 = mysqli_fetch_assoc($q1)){
        $id = $r1['id'];
        $uid = $r1['uid'];
        $pamount = $r1['pamount'];
        $pay2=mysqli_query($db,"INSERT INTO `rank_income`(`uid`, `amount`, `date`) VALUES ('$uid','$pamount',now())");
        $query = $db->query("UPDATE `rank` SET `count` = `count` + 1 WHERE `id` = '$id'");
    }
}

$q8d3 = mysqli_query($db,"INSERT INTO `check_cron`(`type`,`date`) VALUES ('Rank Club Pay',now())");

echo json_encode(array(

    "valid"=>$success,

    "message" => $message

));

?>