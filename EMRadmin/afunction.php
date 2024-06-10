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
            elseif($wal_type == 9){
                $sql1=mysqli_query($db,"INSERT INTO `robotic_wallet` set `uid`='$uid',`amount`='$amount',`date`=now(),`status`='0'") or die(mysqli_error($db));
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

if(isset($_POST["type"]) && $_POST["type"] == "ApproveRejTopup1")
{
    $success = false;
    $msg = "";
    $url="";
    $tid = $_POST['id'];
    $status = $_POST['status'];
    if($status == 1){ $msg = "Request Approved";}
    else { $msg = "Request Rejected";}
    $query = $db->query("update up_trans_history11 set status = '$status',mdate=now() where id = '$tid'");
    if($query)
    {
        $success = true;
        if($status == 1)
        { 
            $rr1=mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `up_trans_history11` WHERE id='$tid'"));
            $uid = $rr1['uid'];
            $query = $db->query("update `membership` set `kyc_status` = '$status' where `member_id` = '$uid'");
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


if(isset($_POST["type"]) && $_POST["type"] == "DeleteKYC")
{
    $success = false;
    $msg = "";
    $url="";
    $tid = $_POST['id'];
    $status = $_POST['status'];
    if($status == 1){ $msg = "Deleted Successful";}
    else { $msg = "Deleted Invalid";}
    $query = $db->query("update up_trans_history11 set status = '$status',mdate=now() where id = '$tid'");
    if($query)
    {
        $success = true;
        if($status == 1)
        { 
            $rr1=mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `up_trans_history11` WHERE id='$tid'"));
            $uid = $rr1['uid'];
            $slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `up_trans_history11` WHERE `uid` LIKE '$uid%'"));
            $cc = $slot_count+1;
            $uidd = $uid.".".$cc;
            $query = $db->query("update `membership` set `kyc_status` = '0' where `member_id` = '$uid'");
            $quexry = $db->query("update `up_trans_history11` set `uid` = '$uidd' where `id` = '$tid'");
        } 
        else 
        { $msg = "Deleted Invalid";}
    }
    else
    {
        $msg = "Invalid Deleted";
    }
    echo json_encode(array(
        "valid"=>$success,
        "message" => $msg
    ));
    
}

if(isset($_POST["type"]) && $_POST["type"] == "ApproveProduct")
{
    $success = false;
    $msg = "";
    $url="";
    $tid = $_POST['id'];
    $status = $_POST['status'];
    if($status == 1){ $msg = "Delivered Successfully";}
    $query = $db->query("update `membership` set `product_status` = '$status',`deliver_date`=now() where `member_id` = '$tid'");
    if($query)
    {
        $success = true;
        $msg = "Delivered Successfully";
    }
    else
    {
        $msg = "Invalid Deleted";
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

if(isset($_POST["country_id0"]) && !empty($_POST["country_id0"])){
    $countryId = $_POST["country_id0"];
    $id = 1;
    $userc04=mysqli_num_rows(mysqli_query($db,"SELECT t1.*,t1.id as idd
    FROM `child_counter_10` t1 where t1.uid LIKE '$countryId%'"));
    if($userc04 > 0){
        $sql=mysqli_query($db,"SELECT t1.*,t1.id as idd
        FROM `child_counter_10` t1 where t1.uid LIKE '$countryId%' ");
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

if(isset($_POST["type"]) && $_POST["type"] == "WithdrawR")
{
    $success = false;
    $msg = "";
    $url="";
    $g_perc=10;
    $tb_perc=10;
    $admin_perc=5;
    $tot = $totalAmount = $remainingBalance = 0;
    $uid = $_POST['uid']; 
    $mwp = mysqli_fetch_assoc(mysqli_query($db,"SELECT kyc_status FROM `membership` WHERE `member_id`='$uid' "));
    $kyc_status = $mwp['kyc_status'];
    if($kyc_status != 0){
        $userc04=mysqli_num_rows(mysqli_query($db,"select uid from up_trans_history111 where uid='$uid' and status = 0"));
        if($userc04 > 0){
            $msg = "Withdraw Already Requested!";
        }
        else {
            $qx10 = mysqli_query($db,"SELECT t1.*,t2.* FROM `pairing` t1 join `membership` t2 on t1.uid = t2.member_id WHERE t1.sponsor_id = '$uid' AND (t2.binary_status = '1' OR t2.binary_status = '2')");
            $c1 = mysqli_num_rows($qx10);
            if($c1 > 1){
                $q10=mysqli_query($db,"SELECT * FROM `main_wallet` WHERE uid='$uid' and status='0'");
                if(mysqli_num_rows($q10) > 0)
                {
                    $add_wal = 0;
                    $sub_wal = 0;
                    $tot_wal = 0;
                    $mwp = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS withdraw_wallet FROM `main_wallet` WHERE `uid`='$uid' and status='0' "));
                    $add_wal = $mwp['withdraw_wallet'];
                    $mwp1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS withdraw_wallet FROM `main_wallet` WHERE `uid`='$uid' and status='1' "));
                    $sub_wal = $mwp1['withdraw_wallet'];
                    $totalAmount = $tot_wal = $add_wal-$sub_wal;
                    if($tot_wal > 0){
                        // Check if the total amount is greater than or equal to 300
                        if ($totalAmount >= 300) {
                            // Calculate the number of times 300 can be deducted from the total amount
                            $deductions = floor($totalAmount / 300);

                            // Calculate the remaining balance after deducting multiples of 300
                            $remainingBalance = $totalAmount - ($deductions * 300);
                            $tot = $totalAmount - $remainingBalance;
                            // Output the remaining balance
                            // echo "Remaining Balance is : $remainingBalance";
                            $success = true;
                            $sql10=mysqli_query($db,"INSERT INTO `up_trans_history111` set `uid`='$uid',`amount`='$tot',`date`=now(),`status`='0'") or die(mysqli_error($db));
                            $msg = "Requested Successfully";
                        } else {
                            // If the total amount is less than 300, there are no deductions
                            $msg = "Minimum 300 is required to Withdraw!";
                        }
                        
                    }
                    else {
                        $msg = "Insufficient Amount!";
                    }
                }
                else
                {
                    $msg = "Insufficient Amount!";
                }
            }
            else {
                $msg = "Minimum two paid directs are need to Withdraw Amount!";
            }
        }
    }
    else {
        $msg = "Please Verify your KYC!";
    }
    echo json_encode(array(
        "url"=>$url,
        "valid"=>$success,
        "message" => $msg
    ));
    
}



if(isset($_POST["type"]) && $_POST["type"] == "ApproveRejTopup11")
{
    $success = false;
    $msg = "";
    $url="";
    $tid = $_POST['id'];
    $status = $_POST['status'];
    if($status == 1){ $msg = "Withdraw Request Approved";}
    elseif($status == 2){ $msg = "Withdraw Request Rejected";}
    else { $msg = "Withdraw Request Delayed";}
    // echo "update up_trans_history111 set status = '$status',mdate=now() where id = '$tid'";die;
    $query = $db->query("update up_trans_history111 set status = '$status',mdate=now() where id = '$tid'");
    if($query)
    {
        $success = true;
        if($status == 1)
        { 
            $rr1=mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `up_trans_history111` WHERE id='$tid'"));
            $amount = $rr1['amount'];
            $uid = $rr1['uid'];
            $sql1=mysqli_query($db,"INSERT INTO `main_wallet` set `uid`='$uid',`amount`='$amount',`date`=now(),`status`='1'") or die(mysqli_error($db));
            if($sql1)
            {
                $success = true;
                $message = "Withdraw Request Cleared";
            }
            else
            {
                $message = "Withdraw Request Cannot Done";
            }
            
        } 
        else 
        { $msg = "Withdraw Request Rejected";}
    }
    else
    {
        $msg = "Invalid Withdraw Request";
    }
    echo json_encode(array(
        "valid"=>$success,
        "message" => $msg
    ));
    
}



if(isset($_POST["type"]) && $_POST["type"] == "ApplyReward")
{
    $success = false;
    $msg = "";
    $url="";
    $tid = $_POST['id'];
    $status = $_POST['status'];
    $uid = $_POST['uid']; 
    $pay = $_POST['pay']; 
    $mwp = mysqli_fetch_assoc(mysqli_query($db,"SELECT `kyc_status` FROM `membership` WHERE `member_id`='$uid' "));
    $kyc_status = $mwp['kyc_status'];
    if($kyc_status != 0){
        $userc04=mysqli_num_rows(mysqli_query($db,"select `uid` from `reward_request` where uid='$uid' and `status` = 0"));
        if($userc04 > 0){
            $msg = "Already Requested!";
        }
        else {
            $success = true;
            $sql10=mysqli_query($db,"INSERT INTO `reward_request` set `uid`='$uid',`pay_id`='$pay',`reward_type`='$status',`reward_id`='$tid',`date`=now(),`status`='0'") or die(mysqli_error($db));
            $msg = "Requested Successfully";
        }
    }
    echo json_encode(array(
        "valid"=>$success,
        "message" => $msg
    ));
    
}


if(isset($_POST["type"]) && $_POST["type"] == "ApproveReward")
{
    $success = false;
    $msg = "";
    $url="";
    $tid = $_POST['id'];
    $status = $_POST['status'];
    if($status == 1){ $msg = "Request Approved";}
    else { $msg = "Request Rejected";}
    $query = $db->query("update `reward_request` set `status` = '$status',mdate=now() where id = '$tid'");
    if($query)
    {
        $success = true;
        if($status == 1)
        { 
            $rr1=mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `reward_request` WHERE id='$tid'"));
            $pay_id = $rr1['pay_id'];
            $qduery = $db->query("update reward_pay set status = '$status' where id = '$pay_id'");
            $msg = "Request Approved";
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

?>