<?php

// set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', '1');
// ini_set('memory_limit', '2560M');
ini_set("max_execution_time", "-1");
ini_set("memory_limit", "-1");
ignore_user_abort(true);
set_time_limit(0);


include_once( 'config.php' );
include('include/other_function.php');

$message = "";

$url="";

$success = false;
$binary_inc = $sponsor_income = $pool2 = $pool2_level = $boost1_income = $boost1_level_income = $boost2_income = $boost3_income = 0;
$sql1 = "SELECT t4.uid FROM robotic_wallet t4 where t4.uid != '85' GROUP BY t4.uid";
$q1 = mysqli_query($db,$sql1);
$c1 = mysqli_num_rows($q1);

if($c1>0){
    $k = $l= 0;
    while($r1 = mysqli_fetch_assoc($q1)){
        $customeid = $r1['uid'];
        $uid = $r1['uid'];
        $robotic_wallet ='0';
        $csrep = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `robotic_wallet` WHERE `uid`='$customeid' and status='0' "));
        $add_rep = $csrep['main_wallet'];
        $mwprob = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `robotic_wallet` WHERE `uid`='$customeid' and status='1' "));
        $sub_rob = $mwprob['main_wallet'];
        $robotic_wallet = ($add_rep-$sub_rob);
        if($robotic_wallet >= 10){
            $type=10;
            $slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `child_counter_10` WHERE `uid` LIKE '$uid%'"));
            $cc = $slot_count+1;
            $uidd = $uid.".".$cc;
            $cds = BoostIncome10($db,$uidd,$type);
            // $ts = CheckRoboPool($db);
            // UpgradeBo($db);
            $q83 = mysqli_query($db,"INSERT INTO `pool_activation`(`uid`,`pool`,`date`) VALUES ($uid,'5',now())");
            $sxql1=mysqli_query($db,"INSERT INTO `robotic_wallet` set `uid`='$customeid',`amount`='10',`date`=now(),`status`='1'") or die(mysqli_error($db));
            $success = true;
            $message = "Success";
        }
    }
}
$q8d3 = mysqli_query($db,"INSERT INTO `check_cron`(`type`,`date`) VALUES ('Check Robotic',now())");
echo json_encode(array(

    "valid"=>$success,

    "message" => $message

));

?>