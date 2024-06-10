<?php

set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once( 'config.php' );

$message = "";

$url="";

$success = false;
$binary_inc = $sponsor_income = $pool2 = $pool2_level = $boost1_income = $boost1_level_income = $boost2_income = $boost3_income = 0;
$sql1 = "SELECT t4.member_id FROM membership t4 where t4.member_id != '85' AND (t4.binary_status = '1' OR t4.binary_status = '2')";
$q1 = mysqli_query($db,$sql1);
$c1 = mysqli_num_rows($q1);

if($c1>0){
    $k = $l= 0;
    while($r1 = mysqli_fetch_assoc($q1)){
        $customeid = $r1['member_id'];
        $checc1 = $db->query("select `uid` from `child_counter` WHERE uid='$customeid' and  `totalcount` = 0");
        $cvde0 = $checc1->num_rows;
        if($cvde0>0)
        {
            $binary_inc ='0';
            $mwfe = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `binary_income` WHERE `uid`='$customeid' and status='0' "));
            $add_fe = $mwfe['main_wallet'];
            // $mgr = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `binary_income` WHERE `uid`='$customeid' and status='1' "));
            // $sub_wgr = $mgr['main_wallet'];
            $binary_inc = ($add_fe);

            if($binary_inc > 0){
                $quexry = $db->query("update `binary_income` set `status` = '1' where `uid` = '$customeid' and `status`= 0");
                $sql11=mysqli_query($db,"INSERT INTO `daily_wallet` set `uid`='$customeid',`amount`='$binary_inc',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }



            $sponsor_income ='0';
            $spe = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `sponsor_income` WHERE `uid`='$customeid' and status='0' "));
            $add_sp = $spe['main_wallet'];
            // $sprf = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `sponsor_income` WHERE `uid`='$customeid' and status='1' "));
            // $sub_sp = $sprf['main_wallet'];
            $sponsor_income = ($add_sp);
            if($sponsor_income > 0){
                $quercy = $db->query("update `sponsor_income` set `status` = '1' where `uid` = '$customeid' and `status`= 0");
                $s5ql1=mysqli_query($db,"INSERT INTO `daily_wallet` set `uid`='$customeid',`amount`='$sponsor_income',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }

            $pool2 ='0';
            $sodf = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `selfpool_income` WHERE `uid`='$customeid' and status='0' "));
            $add_sl = $sodf['main_wallet'];
            // $mspf = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `selfpool_income` WHERE `uid`='$customeid' and status='1' "));
            // $sub_wsp = $mspf['main_wallet'];
            $pool2 = ($add_sl);
            if($pool2 > 0){
                $quervy = $db->query("update `selfpool_income` set `status` = '1' where `uid` = '$customeid' and `status`= 0");
                $sql41=mysqli_query($db,"INSERT INTO `daily_wallet` set `uid`='$customeid',`amount`='$pool2',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }

            $pool2_level ='0';
            $tegc = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `autopool_income` WHERE `uid`='$customeid' and status='0' "));
            $add_pdd = $tegc['main_wallet'];
            // $tegc1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `autopool_income` WHERE `uid`='$customeid' and status='1' "));
            // $sub_wvx = $tegc1['main_wallet'];
            $pool2_level = ($add_pdd);
            if($pool2_level > 0){
                $quxery = $db->query("update `autopool_income` set `status` = '1' where `uid` = '$customeid' and `status`= 0");
                $s4ql1=mysqli_query($db,"INSERT INTO `daily_wallet` set `uid`='$customeid',`amount`='$pool2_level',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }

            $boost1_income ='0';
            $mdwp = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `boost1_income` WHERE `uid`='$customeid' and status='0' "));
            $add_wal = $mdwp['main_wallet'];
            // $mwpc1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `boost1_income` WHERE `uid`='$customeid' and status='1' "));
            // $sub_wab1 = $mwpc1['main_wallet'];
            $boost1_income = ($add_wal);
            if($boost1_income > 0){
                $qudery = $db->query("update `boost1_income` set `status` = '1' where `uid` = '$customeid' and `status`= 0");
                $sq7l1=mysqli_query($db,"INSERT INTO `daily_wallet` set `uid`='$customeid',`amount`='$boost1_income',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }

            $boost1_level_income ='0';
            $mwp01 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `boost1_level_income` WHERE `uid`='$customeid' and status='0' "));
            $add_wal01 = $mwp01['main_wallet'];
            // $mwp101 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `boost1_level_income` WHERE `uid`='$customeid' and status='1' "));
            // $sub_wal01 = $mwp101['main_wallet'];
            $boost1_level_income = ($add_wal01);
            if($boost1_level_income > 0){
                $equery = $db->query("update `boost1_level_income` set `status` = '1' where `uid` = '$customeid' and `status`= 0");
                $sqls1=mysqli_query($db,"INSERT INTO `daily_wallet` set `uid`='$customeid',`amount`='$boost1_level_income',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }

            $boost2_income ='0';
            $mwfp = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `goldboost_income` WHERE `uid`='$customeid' and status='0' "));
            $add_wxal = $mwfp['main_wallet'];
            // $mwptts = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `goldboost_income` WHERE `uid`='$customeid' and status='1' "));
            // $sub_wadl = $mwptts['main_wallet'];
            $boost2_income = ($add_wxal);
            if($boost2_income > 0){
                $quuery = $db->query("update `goldboost_income` set `status` = '1' where `uid` = '$customeid' and `status`= 0");
                $sqvl1=mysqli_query($db,"INSERT INTO `daily_wallet` set `uid`='$customeid',`amount`='$boost2_income',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }

            $boost3_income ='0';
            $ccsr = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `diaboost_income` WHERE `uid`='$customeid' and status='0' "));
            $add_ce = $ccsr['main_wallet'];
            // $csrse = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `diaboost_income` WHERE `uid`='$customeid' and status='1' "));
            // $sub_vefc = $csrse['main_wallet'];
            $boost3_income = ($add_ce);
            if($boost3_income > 0){
                $quwery = $db->query("update `diaboost_income` set `status` = '1' where `uid` = '$customeid' and `status`= 0");
                $sxql1=mysqli_query($db,"INSERT INTO `daily_wallet` set `uid`='$customeid',`amount`='$boost3_income',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }

            $code_income ='0';
            $csvr = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `code_user_wallet` WHERE `uid`='$customeid' and status='0' "));
            $add_cec = $csvr['main_wallet'];
            // $codeu = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `code_user_wallet` WHERE `uid`='$customeid' and status='1' "));
            // $sub_coded = $codeu['main_wallet'];
            $code_income = ($add_cec);
            if($code_income > 0){
                $qufwery = $db->query("update `code_user_wallet` set `status` = '1' where `uid` = '$customeid' and `status`= 0");
                $sxql1=mysqli_query($db,"INSERT INTO `daily_wallet` set `uid`='$customeid',`amount`='$code_income',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }

            $rep_income ='0';
            $csrep = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `repurchase_income` WHERE `uid`='$customeid' and status='0' "));
            $add_rep = $csrep['main_wallet'];
            // $csrep1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `diaboost_income` WHERE `uid`='$customeid' and status='1' "));
            // $sub_rep1 = $csrep1['main_wallet'];
            $rep_income = ($add_rep);
            if($rep_income > 0){
                $qufwery = $db->query("update `repurchase_income` set `status` = '1' where `uid` = '$customeid' and `status`= 0");
                $sxql1=mysqli_query($db,"INSERT INTO `daily_wallet` set `uid`='$customeid',`amount`='$rep_income',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }

            $robo_income ='0';
            $csrd = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `robotic_income` WHERE `uid`='$customeid' and status='0' "));
            $add_rob = $csrd['main_wallet'];
            $csrdrob = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `robotic_income` WHERE `uid`='$customeid' and status='1' "));
            $sub_robb = $csrdrob['main_wallet'];
            $robo_income = ($add_rob-$sub_robb);
            if($robo_income > 0){
                $sxql1=mysqli_query($db,"INSERT INTO `robotic_income` set `uid`='$customeid',`amount`='$robo_income',`date`=now(),`status`='1'") or die(mysqli_error($db));
                // $qufwery = $db->query("update `robotic_income` set `status` = '1' where `uid` = '$customeid' and `status`= 0");
                $sxql1=mysqli_query($db,"INSERT INTO `daily_wallet` set `uid`='$customeid',`amount`='$robo_income',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }

            $rank_income ='0';
            $ccdt = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `rank_income` WHERE `uid`='$customeid' and status='0' "));
            $add_rank = $ccdt['main_wallet'];
            // $csrse = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `rank_income` WHERE `uid`='$customeid' and status='1' "));
            // $sub_vefc = $csrse['main_wallet'];
            $rank_income = ($add_rank);
            if($rank_income > 0){
                $quwery = $db->query("update `rank_income` set `status` = '1' where `uid` = '$customeid' and `status`= 0");
                $sxql1=mysqli_query($db,"INSERT INTO `daily_wallet` set `uid`='$customeid',`amount`='$rank_income',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }

            $royalty_income ='0';
            $royt = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `royalty_income` WHERE `uid`='$customeid' and status='0' "));
            $add_roya = $royt['main_wallet'];
            // $csrse = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `royalty_income` WHERE `uid`='$customeid' and status='1' "));
            // $sub_vefc = $csrse['main_wallet'];
            $royalty_income = ($add_roya);
            if($royalty_income > 0){
                $quwery = $db->query("update `royalty_income` set `status` = '1' where `uid` = '$customeid' and `status`= 0");
                $sxql1=mysqli_query($db,"INSERT INTO `daily_wallet` set `uid`='$customeid',`amount`='$royalty_income',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }

            $global_income ='0';
            $rot1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `global_income` WHERE `uid`='$customeid' and status='0' "));
            $add_glb = $rot1['main_wallet'];
            // $csrse = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `global_income` WHERE `uid`='$customeid' and status='1' "));
            // $sub_vefc = $csrse['main_wallet'];
            $global_income = ($add_glb);
            if($global_income > 0){
                $quwery = $db->query("update `global_income` set `status` = '1' where `uid` = '$customeid' and `status`= 0");
                $sxql1=mysqli_query($db,"INSERT INTO `daily_wallet` set `uid`='$customeid',`amount`='$global_income',`date`=now(),`status`='0'") or die(mysqli_error($db));
            }
        }
    }
}

$q8d3 = mysqli_query($db,"INSERT INTO `check_cron`(`type`,`date`) VALUES ('Transfer Daily',now())");

echo json_encode(array(

    "valid"=>$success,

    "message" => $message

));

?>