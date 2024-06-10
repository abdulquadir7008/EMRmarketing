<?php
include("../config.php");
include('../include/other_function.php');
date_default_timezone_set('Europe/London');
if(isset($_POST["type"]) && $_POST["type"] == "ApproveRejTopup")
{
    $success = false;
    $msg = "";
    $url="";
    $tid = $_POST['id'];
    $status = $_POST['status'];
    if($status == 1){ $msg = "Request Approved";}
    else { $msg = "Request Rejected";}
    $query = $db->query("update up_trans_history1 set status = '$status',mdate=now() where id = '$tid'");
    if($query)
    {
        $success = true;
        if($status == 1)
        { 
            $rr1=mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `up_trans_history1` WHERE id='$tid'"));
            $amount = $rr1['amount'];
            $wal_type = $rr1['wal_type'];
            $uid = $rr1['uid'];
            if($wal_type == 2){
                $sql1=mysqli_query($db,"INSERT INTO `selfpool_wallet` set `uid`='$uid',`amount`='$amount',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }
            elseif($wal_type == 6){
                $sql1=mysqli_query($db,"INSERT INTO `booster1_wallet` set `uid`='$uid',`amount`='$amount',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }
            elseif($wal_type == 7){
                $sql1=mysqli_query($db,"INSERT INTO `gold_wallet` set `uid`='$uid',`amount`='$amount',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }
            elseif($wal_type == 8){
                $sql1=mysqli_query($db,"INSERT INTO `diamond_wallet` set `uid`='$uid',`amount`='$amount',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }
            if($sql1)
            {
                $success = true;
                $message = "Added Successfully";
            }
            else
            {
                $message = "Request Cannot Done";
            }
            
        } 
        else 
        { $msg = "Request Rejected";}
    }
    else
    {
        $msg = "Invalid Request";
    }
    echo json_encode(array(
        "valid"=>$success,
        "message" => $msg
    ));
    
}

if(isset($_POST["type"]) && $_POST["type"] == "GoldBoost")
{
    $success = false;
    $msg = "";
    $url="";
    $uid = $_POST['uid'];
    $mwp = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `gold_wallet` WHERE `uid`='$uid' and status='0' "));

    $add_wal = $mwp['main_wallet'];

    $mwp1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `gold_wallet` WHERE `uid`='$uid' and status='1' "));

    $sub_wal = $mwp1['main_wallet'];

    $tot_wal = ($add_wal-$sub_wal);
    if($tot_wal > 0){
        if (isMultipleOf500($tot_wal)) { 
            $today = date('Y-m-d');
            // Assuming $userId contains the user's ID
            $userId = $uid; // Replace with the actual user ID
            $userc04=mysqli_num_rows(mysqli_query($db,"SELECT `uid` FROM `pairing_2` WHERE `uid` LIKE '$uid%' AND DATE(`date`) = '$today'"));
            if($userc04 > 2){
                $msg = " Booster 2 is already done for the day!";
            }
            else {
                $sql1=mysqli_query($db,"INSERT INTO `gold_wallet` set `uid`='$uid',`amount`='500',`date`=now(),`status`='1'") or die(mysqli_error($db));
                $slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `child_counter_2` WHERE `uid` LIKE '$uid%'"));
                $cc = $slot_count+1;
                $uidd = $uid.".".$cc;
                $type=2;
                $cds = BoostIncome3($db,$uidd,$type);
                $ts = CheckGoldBoost($db);
                $success = true;
                $msg = " Booster 2 was Successful!";
            }
        }
        else {
            $msg = "Invalid Request";
        }
    }
    else {
        $msg = "Insufficient Balance!";
    }
    echo json_encode(array(
        "valid"=>$success,
        "message" => $msg
    ));
    
}

if(isset($_POST["type"]) && $_POST["type"] == "DiaBoost")
{
    $success = false;
    $msg = "";
    $url="";
    $uid = $_POST['uid'];
    $mwp = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `diamond_wallet` WHERE `uid`='$uid' and status='0' "));

    $add_wal = $mwp['main_wallet'];

    $mwp1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `diamond_wallet` WHERE `uid`='$uid' and status='1' "));

    $sub_wal = $mwp1['main_wallet'];

    $tot_wal = ($add_wal-$sub_wal);
    if($tot_wal > 0){
        if (isMultipleOf1000($tot_wal)) { 
            $today = date('Y-m-d');
            // Assuming $userId contains the user's ID
            $userId = $uid; // Replace with the actual user ID
            $userc04=mysqli_num_rows(mysqli_query($db,"SELECT `uid` FROM `pairing_3` WHERE `uid` LIKE '$uid%' AND DATE(`date`) = '$today'"));
            if($userc04 > 2){
                $msg = " Booster 3 is already done for the day!";
            }
            else {
                $sql1=mysqli_query($db,"INSERT INTO `diamond_wallet` set `uid`='$uid',`amount`='1000',`date`=now(),`status`='1'") or die(mysqli_error($db));

                $slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `child_counter_3` WHERE `uid` LIKE '$uid%'"));
                $cc = $slot_count+1;
                $uidd = $uid.".".$cc;
                $type=3;
                $cds = BoostIncome4($db,$uidd,$type);
                $ts = CheckDiaBoost($db);

                // $type=3;
                // $cds = BoostIncome($db,$uid,$type,10,3);
                // $ts = CheckDiaBoost($db);
                $success = true;
                $msg = " Booster 3 was Successful!";
            }
        }
        else {
            $msg = "Invalid Request";
        }
    }
    else {
        $msg = "Insufficient Balance!";
    }
    echo json_encode(array(
        "valid"=>$success,
        "message" => $msg
    ));
    
}


if(isset($_POST["type"]) && $_POST["type"] == "SelfBoost")
{
    $success = false;
    $msg = "";
    $url="";
    $uid = $_POST['uid'];
    $mwp = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `selfpool_wallet` WHERE `uid`='$uid' and status='0' "));

    $add_wal = $mwp['main_wallet'];

    $mwp1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `selfpool_wallet` WHERE `uid`='$uid' and status='1' "));

    $sub_wal = $mwp1['main_wallet'];

    $tot_wal = ($add_wal-$sub_wal);
    if($tot_wal > 0){
        if (isMultipleOf500($tot_wal)) { 
            $today = date('Y-m-d');
            // Assuming $userId contains the user's ID
            $userId = $uid; // Replace with the actual user ID
            $userc04=mysqli_num_rows(mysqli_query($db,"SELECT `uid` FROM `pairing_1` WHERE `uid` LIKE '$uid%' AND DATE(`date`) = '$today'"));
            if($userc04 > 1){
                $msg = "Self Pool is already done for the day!";
            }
            else {
                $sql1=mysqli_query($db,"INSERT INTO `selfpool_wallet` set `uid`='$uid',`amount`='500',`date`=now(),`status`='1'") or die(mysqli_error($db));
                $type=1;
                $slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `child_counter_1` WHERE `uid` LIKE '$uid%'"));
                $cc = $slot_count+1;
                $uidd = $uid.".".$cc;
                $cds = BoostIncome1($db,$uidd,$type);
                $ts = CheckSelfPool($db);

                $success = true;
                $msg = "Pool 2 Entry was Successful!";
            }
        }
        else {
            $msg = "Invalid Request";
        }
    }
    else {
        $msg = "Insufficient Balance!";
    }
    echo json_encode(array(
        "valid"=>$success,
        "message" => $msg
    ));
    
}

if(isset($_POST["type"]) && $_POST["type"] == "Boost1")
{
    $success = false;
    $msg = "";
    $url="";
    $uid = $_POST['uid'];
    $mwp = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `booster1_wallet` WHERE `uid`='$uid' and status='0' "));

    $add_wal = $mwp['main_wallet'];

    $mwp1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `booster1_wallet` WHERE `uid`='$uid' and status='1' "));

    $sub_wal = $mwp1['main_wallet'];

    $tot_wal = ($add_wal-$sub_wal);
    if($tot_wal > 0){
        if (isMultipleOf100($tot_wal)) { 
            $today = date('Y-m-d');
            // Assuming $userId contains the user's ID
            $userId = $uid; // Replace with the actual user ID
            $userc04=mysqli_num_rows(mysqli_query($db,"SELECT `uid` FROM `pairing_4` WHERE `uid` LIKE '$uid%' AND DATE(`date`) = '$today'"));
            if($userc04 > 9){
                $msg = " Booster 1 is already done for the day!";
            }
            else {
                $sql1=mysqli_query($db,"INSERT INTO `booster1_wallet` set `uid`='$uid',`amount`='100',`date`=now(),`status`='1'") or die(mysqli_error($db));
                $slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `child_counter_4` WHERE `uid` LIKE '$uid%'"));
                $cc = $slot_count+1;
                $uidd = $uid.".".$cc;
                $type=4;
                $cds = BoostIncome2($db,$uidd,$type);
                $ts = CheckBoost1($db,'child_counter_4','pairing_4',4);
                $success = true;
                $msg = "Booster 1 was Successful!";
            }
        }
        else {
            $msg = "Invalid Request";
        }
    }
    else {
        $msg = "Insufficient Balance!";
    }
    echo json_encode(array(
        "valid"=>$success,
        "message" => $msg
    ));
    
}



if(isset($_POST["country_id"]) && !empty($_POST["country_id"])){
    $countryId = $_POST["country_id"];
    $id = 1;
    $userc04=mysqli_num_rows(mysqli_query($db,"SELECT t1.*,t1.id as idd
    FROM `child_counter_1` t1 where t1.uid LIKE '$countryId%'"));
    if($userc04 > 0){
        $sql=mysqli_query($db,"SELECT t1.*,t1.id as idd
        FROM `child_counter_1` t1 where t1.uid LIKE '$countryId%' ");
        while($row = mysqli_fetch_assoc($sql))
        { 
            $decimalNumber = $row['uid'];
            $integerPart = floor($decimalNumber);
            $sqvvl=mysqli_query($db,"select t1.* from membership t1 where t1.member_id='$integerPart'");
            $cffrt = mysqli_fetch_assoc($sqvvl);
            echo '<option value="' . $row['uid'] . '"';
            echo '>' . $cffrt['fname'] . ' ' . $cffrt['lname'] . ' (' . $cffrt['userid'] . ') ' . $id++ . '</option>';
        }
    }
    else{
        echo '<option value=""> No Member Found </option>';
    }
}










?>