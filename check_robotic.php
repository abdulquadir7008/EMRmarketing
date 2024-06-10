<?php

set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once( 'config.php' );
include('include/other_function.php');

$message = "";

$url="";

$success = false;
$binary_inc = $sponsor_income = $pool2 = $pool2_level = $boost1_income = $boost1_level_income = $boost2_income = $boost3_income = 0;
$sql1 = "SELECT t4.uid FROM robotic_income t4 where t4.uid != '85' GROUP BY t4.uid";
$q1 = mysqli_query($db,$sql1);
$c1 = mysqli_num_rows($q1);

if($c1>0){
    $k = $l= 0;
    while($r1 = mysqli_fetch_assoc($q1)){
        $customeid = $r1['uid'];
        $uid = $r1['uid'];
        $robotic_income ='0';
        $csrep = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `robotic_income` WHERE `uid`='$customeid' and status='0' "));
        $add_rep = $csrep['main_wallet'];
        $csrdrob = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `robotic_income` WHERE `uid`='$customeid' and status='1' "));
        $sub_robb = $csrdrob['main_wallet'];
        $robotic_income = ($add_rep-$sub_robb);
        // $robotic_income = ($add_rep);
        if($robotic_income >= 500){
            $checkd = $db->query("select `binary_status` from `membership` WHERE member_id='$customeid' and `binary_status` = 0");
            $cdf = $checkd->num_rows;
            if($cdf>0)
            {
                AddTopCount($db,$customeid,"200");
                $uq = mysqli_query($db,"UPDATE `membership` SET `binary_status`=1 where `member_id` = '$customeid'");
                $ucq = mysqli_query($db,"UPDATE `child_counter` SET `totalcount`= 1 where `uid` = '$customeid'");
                $sxql1=mysqli_query($db,"INSERT INTO `robotic_income` set `uid`='$customeid',`amount`='500',`date`=now(),`status`='1'") or die(mysqli_error($db));
            }
            else{
                $checc = $db->query("select `uid` from `child_counter` WHERE uid='$uid' and  `totalcount` = 1");
                $cvde = $checc->num_rows;
                if($cvde>0)
                {
                    $type=1;
                    $slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `child_counter_1` WHERE `uid` LIKE '$uid%'"));
                    $cc = $slot_count+1;
                    $uidd = $uid.".".$cc;
                    $cds = BoostIncome1($db,$uidd,$type);
                    $ts = CheckSelfPool($db);
                    $q83 = mysqli_query($db,"INSERT INTO `pool_activation`(`uid`,`pool`,`date`) VALUES ($uid,'1',now())");
                    $sxql1=mysqli_query($db,"INSERT INTO `robotic_income` set `uid`='$customeid',`amount`='500',`date`=now(),`status`='1'") or die(mysqli_error($db));
                    $ucq = mysqli_query($db,"UPDATE `child_counter` SET `totalcount`= 2 where `uid` = '$customeid'");
                }
            }
        }
        elseif($robotic_income >= 100){
            $checc1 = $db->query("select `uid` from `child_counter` WHERE uid='$uid' and  `totalcount` = 2");
            $cvde0 = $checc1->num_rows;
            if($cvde0>0)
            {
                $slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `child_counter_4` WHERE `uid` LIKE '$uid%'"));
                $cc = $slot_count+1;
                $uidd = $uid.".".$cc;
                $type=4;
                $cds = BoostIncome2($db,$uidd,$type);
                $ts = CheckBoost1($db,'child_counter_4','pairing_4',4);
                $q83 = mysqli_query($db,"INSERT INTO `pool_activation`(`uid`,`pool`,`date`) VALUES ($uid,'2',now())");
                $sxql1=mysqli_query($db,"INSERT INTO `robotic_income` set `uid`='$customeid',`amount`='100',`date`=now(),`status`='1'") or die(mysqli_error($db));
                $ucq = mysqli_query($db,"UPDATE `child_counter` SET `totalcount`= 0 where `uid` = '$customeid'");
            }
        }
    }
}
$q8d3 = mysqli_query($db,"INSERT INTO `check_cron`(`type`,`date`) VALUES ('Robotic Eligibility',now())");

echo json_encode(array(

    "valid"=>$success,

    "message" => $message

));

?>