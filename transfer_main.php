<?php

set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once( 'config.php' );

$message = "";

$url="";

$success = false;
$binary_inc = $daily_wallet = $pool2 = $pool2_level = $boost1_income = $code = $main = $boost3_income = 0;
$sql1 = "SELECT t4.member_id FROM membership t4 where t4.member_id != '85'";
$q1 = mysqli_query($db,$sql1);
$c1 = mysqli_num_rows($q1);
if($c1>0){
    $k = $l= 0;
    while($r1 = mysqli_fetch_assoc($q1)){
        $customeid = $r1['member_id'];
        $daily_wallet = 0;
        $mwfe = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `daily_wallet` WHERE `uid`='$customeid' and status='0' "));
        $add_fe = $mwfe['main_wallet'];
        // $mgr = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `daily_wallet` WHERE `uid`='$customeid' and status='1' "));
        // $sub_wgr = $mgr['main_wallet'];
        $daily_wallet = ($add_fe);

        if($daily_wallet > 0){
            $code = $daily_wallet*1/100;
            $main = $daily_wallet-$code;
            $quexry = $db->query("update `daily_wallet` set `status` = '1' where `uid` = '$customeid' and `status`= 0");
            $sql11=mysqli_query($db,"INSERT INTO `main_wallet` set `uid`='$customeid',`amount`='$main',`date`=now(),`status`='0'") or die(mysqli_error($db));
            $sql11=mysqli_query($db,"INSERT INTO `code_wallet` set `uid`='85',`amount`='$code',`date`=now(),`status`='0'") or die(mysqli_error($db));
        }
    }
}

$q8d3 = mysqli_query($db,"INSERT INTO `check_cron`(`type`,`date`) VALUES ('Transfer Main',now())");

echo json_encode(array(

    "valid"=>$success,

    "message" => $message

));

?>