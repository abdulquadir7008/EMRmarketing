<?php

set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once( 'config.php' );

$message = "";

$url="";

$success = false;
$main_amt = $code_wallet = $pool2 = $pool2_level = $boost1_income = $code = $main = $boost3_income = 0;
$sql1 = "SELECT t4.uid FROM code_users t4 where t4.status = '0'";
$q1 = mysqli_query($db,$sql1);
$c1 = mysqli_num_rows($q1);
if($c1>0){
    $code_wallet = 0;
    $mwfe = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `code_wallet` WHERE status='0' "));
    $add_fe = $mwfe['main_wallet'];
    $code_wallet = ($add_fe);

    if($code_wallet > 0){
        $main_amt = ($add_fe)/$c1;
        $quexry = $db->query("update `code_wallet` set `status` = '1' where `status`= 0");
        $sql14 = "SELECT t4.uid FROM code_users t4 where t4.status = '0'";
        $q1xe = mysqli_query($db,$sql14);
        $c1w = mysqli_num_rows($q1xe);
        if($c1w>0){
            $k = $l= 0;
            while($r1 = mysqli_fetch_assoc($q1xe)){
                $uid = $r1['uid'];
                $sql11=mysqli_query($db,"INSERT INTO `code_user_wallet` set `uid`='$uid',`amount`='$main_amt',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }
        }
        $qrxry = $db->query("update `code_users` set `status` = '1' where `status`= 0");
        $qrxcry = $db->query("update `code` set `status` = '1' where `status`= 0");
    }
}

echo json_encode(array(

    "valid"=>$success,

    "message" => $message

));

?>