<?php

set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once( 'config.php' );

$message = "";

$url="";

$success = false;
$cur_date = date('Y-m-d');
$sql1 = "SELECT t1.left_ccount,t1.self_buss,t1.right_ccount,t1.uid,t1.left_paid_count,t1.right_paid_count,t1.total_left_paid_bvcount,t1.total_right_paid_bvcount FROM `child_counter` t1 join membership t4 on t1.uid=t4.member_id  where total_left_paid_bvcount>0 and total_right_paid_bvcount>0  and t1.uid != '85'";
$q1 = mysqli_query($db,$sql1);
$c1 = mysqli_num_rows($q1);
if($c1>0){
    $k = $l= 0;
    while($r1 = mysqli_fetch_assoc($q1)){
        $uid = $r1['uid'];
        $leftcount = $r1["total_left_paid_bvcount"]/200;
        $rightcount = $r1['total_right_paid_bvcount']/200;
        $xq1 = mysqli_num_rows($db->query("SELECT * FROM `pool_activation` WHERE `uid`='$uid' and `pool` = 1 ORDER BY `date` ASC limit 1"));
        if($xq1 > 0){
            $auio = mysqli_fetch_assoc(mysqli_query($db,"SELECT *,DATE(`date`) as dt FROM `pool_activation` WHERE `uid`='$uid' and `pool` = 1 ORDER BY `date` ASC limit 1"));
            $act_date = $auio['dt'];
            $dateObj1 = new DateTime($act_date);
            $dateObj2 = new DateTime($cur_date);
            $dateDiff = $dateObj1->diff($dateObj2);
            $daysDiff = $dateDiff->days;
            if(($leftcount >= '190560') && ($rightcount >= '190560') && ($daysDiff >= '190560')){
                $query = $db->query("UPDATE `membership` SET `rank` = 'Crown',`rank_capping` = '18910000' WHERE `member_id` = '$uid'");
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '2000000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Crown','2000000','1000000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '1000000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Baron','1000000','500000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '500000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Topaz','500000','250000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '250000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Ruby','250000','125000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '50000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Titan','50000','25000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '10000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Star','10000','5000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '2000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Gold','2000','1000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '1000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Silver','1000','500',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '200'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Bronze','200','100',now(),'0','0')");
                }
            }
            elseif(($leftcount >= '90560' && $leftcount < '190560') && ($rightcount >= '90560' && $rightcount < '190560') && ($daysDiff >= '1290' && $daysDiff < '1740')){
                $query = $db->query("UPDATE `membership` SET `rank` = 'Baron',`rank_capping` = '8910000' WHERE `member_id` = '$uid'");
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '1000000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Baron','1000000','500000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '500000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Topaz','500000','250000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '250000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Ruby','250000','125000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '50000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Titan','50000','25000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '10000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Star','10000','5000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '2000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Gold','2000','1000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '1000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Silver','1000','500',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '200'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Bronze','200','100',now(),'0','0')");
                }
            }
            elseif(($leftcount >= '40560' && $leftcount < '90560') && ($rightcount >= '40560' && $rightcount < '90560') && ($daysDiff >= '930' && $daysDiff < '1290')){
                $query = $db->query("UPDATE `membership` SET `rank` = 'Topaz',`rank_capping` = '3910000' WHERE `member_id` = '$uid'");
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '500000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Topaz','500000','250000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '250000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Ruby','250000','125000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '50000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Titan','50000','25000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '10000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Star','10000','5000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '2000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Gold','2000','1000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '1000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Silver','1000','500',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '200'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Bronze','200','100',now(),'0','0')");
                }
            }
            elseif(($leftcount >= '15560' && $leftcount < '40560') && ($rightcount >= '15560' && $rightcount < '40560') && ($daysDiff >= '660' && $daysDiff < '930')){
                $query = $db->query("UPDATE `membership` SET `rank` = 'Ruby',`rank_capping` = '1410000' WHERE `member_id` = '$uid'");
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '250000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Ruby','250000','125000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '50000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Titan','50000','25000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '10000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Star','10000','5000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '2000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Gold','2000','1000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '1000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Silver','1000','500',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '200'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Bronze','200','100',now(),'0','0')");
                }
            }
            elseif(($leftcount >= '3060' && $leftcount < '15560') && ($rightcount >= '3060' && $rightcount < '15560') && ($daysDiff >= '450' && $daysDiff < '660')){
                $query = $db->query("UPDATE `membership` SET `rank` = 'Titan',`rank_capping` = '910000' WHERE `member_id` = '$uid'");
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '50000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Titan','50000','25000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '10000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Star','10000','5000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '2000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Gold','2000','1000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '1000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Silver','1000','500',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '200'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Bronze','200','100',now(),'0','0')");
                }
            }
            elseif(($leftcount >= '560' && $leftcount < '3060') && ($rightcount >= '560' && $rightcount < '3060') && ($daysDiff >= '300' && $daysDiff < '450')){
                $query = $db->query("UPDATE `membership` SET `rank` = 'Star',`rank_capping` = '410000' WHERE `member_id` = '$uid'");
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '10000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Star','10000','5000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '2000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Gold','2000','1000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '1000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Silver','1000','500',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '200'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Bronze','200','100',now(),'0','0')");
                }
            }
            elseif(($leftcount >= '160' && $leftcount < '560') && ($rightcount >= '160' && $rightcount < '560') && ($daysDiff >= '180' && $daysDiff < '300')){
                $query = $db->query("UPDATE `membership` SET `rank` = 'Gold',`rank_capping` = '160000' WHERE `member_id` = '$uid'");
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '2000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Gold','2000','1000',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '1000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Silver','1000','500',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '200'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Bronze','200','100',now(),'0','0')");
                }
            }
            elseif(($leftcount >= '60' && $leftcount < '160') && ($rightcount >= '60' && $rightcount < '160') && ($daysDiff >= '90' && $daysDiff < '180')){
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '1000'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Silver','1000','500',now(),'0','0')");
                }
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '200'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Bronze','200','100',now(),'0','0')");
                }
                $query = $db->query("UPDATE `membership` SET `rank` = 'Silver',`rank_capping` = '60000' WHERE `member_id` = '$uid'");
            }
            elseif(($leftcount >= '10' && $leftcount < '60') && ($rightcount >= '10' && $rightcount < '60') && ($daysDiff >= '30' && $daysDiff < '90')){
                $dxd52 = mysqli_query($db, "SELECT * FROM `rank` WHERE `uid` = '$uid' and `amount` = '200'");
                $jve15 = $dxd52->num_rows;
                if($jve15>0)
                {
                }
                else{
                    $q83 = mysqli_query($db,"INSERT INTO `rank`(`uid`, `rank_name`, `amount`, `pamount`, `date`, `count`, `status`) VALUES ('$uid','Bronze','200','100',now(),'0','0')");
                }
                $query = $db->query("UPDATE `membership` SET `rank` = 'Bronze',`rank_capping` = '10000' WHERE `member_id` = '$uid'");
            }
        }
    }
}

$q8d3 = mysqli_query($db,"INSERT INTO `check_cron`(`type`,`date`) VALUES ('Rank Club',now())");

function checkisFirst($db,$uid){
    $q1 = mysqli_num_rows($db->query("SELECT * FROM `binary_income` WHERE `uid`='$uid'"));
    if($q1 > 0){
        $auto = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS auto_pay FROM `binary_income` WHERE `uid`='$uid' "));
        $auto_pay=isset($auto['auto_pay']) && $auto['auto_pay'] > 0?$auto['auto_pay']:0;
        if($auto_pay>0){
            return false;
        }else{
            return true;
        }
    }
    else{
        return true;
    }
}



function GetUserByPos($db,$sponsor_id,$position)
{
    global $all_user1;
    $all_user1=array();
    $sql=$db->query("select t1.uid from pairing t1 left join membership t2 on t1.parent_id=t2.member_id where t2.member_id='$sponsor_id' and t1.position='$position'");
    if($no=mysqli_num_rows($sql) > 0)
    {
        $r1=mysqli_fetch_assoc($sql);
        $uid=$r1['uid'];
        //$res=GetAllUserPos($db,$uid,$position);
        $res1 = array($uid);
        $res=GetUids($db,$uid);
        if(count($res) > 0)
        {
            $res2=array();
            $res2=getLevelid($db,$res);
            $res1=array_merge($res1,$res2);
        }
        return $res1;
    }
    else
    {
        $new_array = array();
        return $new_array;
    }

}

function getGreenId1($db,$uid_array = array())
{
    global $db;
    $greenid = 0;
    if(!empty($uid_array)){
        if(!empty($uid_array[0])){
            $uids = "'".implode("','",$uid_array)."'";
            $sql1 = "SELECT count(`member_id`) as ucount FROM `membership` WHERE `member_id` IN($uids) AND (`binary_status` = '1' OR `binary_status` = '2')";
            $query1 = $db->query($sql1) or die(mysqli_error($db));
            $row1 = mysqli_fetch_assoc($query1);
            $greenid = $row1['ucount'];
        }
    }
    return $greenid;
}

// function getChildIds($db,$paired,$parent_id)
// {
//     $user_ids=array();
//     $qry1=mysqli_query($db,"select * from user_id where paired=$paired");
//     while ($r1=mysqli_fetch_assoc($qry1))
//     {
//         $user_ids[]=$r1['uid'];
//     }
//     $uids=implode(',', $user_ids);
//     $sql="SELECT t1.*,t2.* from pairing t1 join user_id t2 on t1.uid=t2.uid where t1.parent_id=$parent_id and t1.uid in ($uids)";
//     $qry2=mysqli_query($db,"select * from pairing where parent_id=$parent_id and uid in ($uids)");
// }

$all_user1=array();
function getLevelid($db,$res)
{
    global $all_user1;
    $all_user1=array_merge($all_user1,$res);
    $res1=array();
    //echo "<pre>";print_r($res);
    foreach ($res as $key => $value) {
        //$all_user1[]=$value;
        $res1=GetUids($db,$value);
        if(count($res1) > 0)
        {
            //$all_user1=array_merge($all_user1,$res1);
            getLevelid($db,$res1);
        }
    }
    /*if(!empty($res1))
    {
        getLevelid($db,$res1);
    }*/
    return $all_user1;
}

function GetUids($db,$uid)
{
    $uids=array();
    //echo "\n select * from pairing where parent_id = '$uid'";
    $q1 = mysqli_query($db,"select * from pairing where parent_id = '$uid'");
    if(mysqli_num_rows($q1)>0)
    {
        while ($q4 = mysqli_fetch_assoc($q1))
        {
            $uid=$q4['uid'];
            $uids[]= $uid;
        }
        return $uids;
        
    }
    else
    {  
         return $uids;
    }
}
function getLevel2($db,$res)
{
    $res2=array();
    //echo "<pre>";print_r($res);
    foreach ($res as $key => $value) {
        $res1=GetUids($db,$value);
        if(count($res1) > 0)
        {
            $res2=array_merge($res2,$res1);
        }
    }
    return $res2;
}
function getLevel3($db,$res_arr)
{
    $res3=array();
    $res1=getLevel2($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        // print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel4($db,$res_arr)
{
    $res3=array();
    $res1=getLevel3($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel5($db,$res_arr)
{
    $res3=array();
    $res1=getLevel4($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel6($db,$res_arr)
{
    $res3=array();
    $res1=getLevel5($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel7($db,$res_arr)
{
    $res3=array();
    $res1=getLevel6($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel8($db,$res_arr)
{
    $res3=array();
    $res1=getLevel7($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel9($db,$res_arr)
{
    $res3=array();
    $res1=getLevel8($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel10($db,$res_arr)
{
    $res3=array();
    $res1=getLevel9($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel11($db,$res_arr)
{
    $res3=array();
    $res1=getLevel10($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel12($db,$res_arr)
{
    $res3=array();
    $res1=getLevel11($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel13($db,$res_arr)
{
    $res3=array();
    $res1=getLevel12($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel14($db,$res_arr)
{
    $res3=array();
    $res1=getLevel13($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel15($db,$res_arr)
{
    $res3=array();
    $res1=getLevel14($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel16($db,$res_arr)
{
    $res3=array();
    $res1=getLevel15($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel17($db,$res_arr)
{
    $res3=array();
    $res1=getLevel16($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel18($db,$res_arr)
{
    $res3=array();
    $res1=getLevel17($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel19($db,$res_arr)
{
    $res3=array();
    $res1=getLevel18($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel20($db,$res_arr)
{
    $res3=array();
    $res1=getLevel19($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function GetUsersID($db,$level,$mlmid)
{
    $res1=GetUids($db,$mlmid);
    if($level==1)
    {
        $res=$res1;
    }
    if($level==2)
    {
        $res=getLevel2($db,$res1);
    }
    if($level==3)
    {
        $res=getLevel3($db,$res1);
    }
    if($level==4)
    {
        $res=getLevel4($db,$res1);
    }
    if($level==5)
    {
        $res=getLevel5($db,$res1);
    }
    if($level==6)
    {
        $res=getLevel6($db,$res1);
    }
    if($level==7)
    {
        $res=getLevel7($db,$res1);
    }
    if($level==8)
    {
        $res=getLevel8($db,$res1);
    }
    if($level==9)
    {
        $res=getLevel9($db,$res1);
    }
    if($level==10)
    {
        $res=getLevel10($db,$res1);
    }
    if($level==11)
    {
        $res=getLevel11($db,$res1);
    }
    if($level==12)
    {
        $res=getLevel12($db,$res1);
    }
    if($level==13)
    {
        $res=getLevel13($db,$res1);
    }
    if($level==14)
    {
        $res=getLevel14($db,$res1);
    }
    if($level==15)
    {
        $res=getLevel15($db,$res1);
    }
    return $res;
}




// $pay2=mysqli_query($db,"INSERT INTO `cron_level`( `date`) VALUES (now())");

echo json_encode(array(

    "valid"=>$success,

    "message" => $message

));

?>