<?php

set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once( 'config.php' );
include_once( 'include/other_function.php' );

$message = "";
$url="";
$success = false;

// $sql1 = "SELECT t4.* FROM membership t4 WHERE t4.member_id != '85'";
// $q1 = mysqli_query($db,$sql1);
// $c1 = mysqli_num_rows($q1);
// if($c1>0){
//     $k = $l= 0;
//     while($r1 = mysqli_fetch_assoc($q1)){
//         $uid = $r1['member_id'];
//         $binary_status = $r1['binary_status'];
//         $main_wallet = '0';
//         if($binary_status == '1'){
            
//             $type=1;
//             $cds = BoostIncome($db,$uid,$type,0,2);

//             $ts = CheckSelfPool($db);

//             $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select `sponsor_id` from `pairing` where `uid`='$uid'"));
//             $nnsponsor_id = $nparent_idd['sponsor_id'];

//             $r=mysqli_fetch_assoc(mysqli_query($db,"SELECT `percent` FROM `admin_login` WHERE `admin_id`='1' "));
//             $percent=$r['percent'];

//             $q83 = mysqli_query($db,"INSERT INTO `sponsor_income`(`uid`,`amount`,`date`) VALUES ($nnsponsor_id,'$percent',now())");
//         }
//         elseif($binary_status == '2'){

//             $type=1;
//             $cds = BoostIncome($db,$uid,$type,0,2);

//             $ts = CheckSelfPool($db);

//             $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select `sponsor_id` from `pairing` where `uid`='$uid'"));
//             $nnsponsor_id = $nparent_idd['sponsor_id'];

//             $r=mysqli_fetch_assoc(mysqli_query($db,"SELECT `percent2` FROM `admin_login` WHERE `admin_id`='1' "));
//             $percent=$r['percent2'];

//             $q83 = mysqli_query($db,"INSERT INTO `sponsor_income`(`uid`,`amount`,`date`) VALUES ($nnsponsor_id,'$percent',now())");
//         }
//     }
// }
// $sql1 = "select t1.* from membership t1 where t1.member_id !='85'  and (t1.binary_status = 1 OR t1.binary_status = 2  ) ORDER BY member_id ASC limit 1 ";

// // $sql1 = "SELECT t4.* FROM pool_activation t4 WHERE t4.uid != '85' and `pool` = 1";
// $q1 = mysqli_query($db,$sql1);
// $c1 = mysqli_num_rows($q1);
// if($c1>0){
//     $k = $l= 0;
//     while($r1 = mysqli_fetch_assoc($q1)){
//         $uid = 86;
//         $type=1;
// 		$slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `child_counter_1` WHERE `uid` LIKE '$uid%'"));
// 		$cc = $slot_count+1;
// 		$uidd = $uid.".".$cc;
// 		$cds = BoostIncome1($db,$uidd,$type);
// 		$q83 = mysqli_query($db,"INSERT INTO `pool_activation`(`uid`,`pool`,`date`) VALUES ($uid,'1',now())");
//     }
// }
// $ts = CheckSelfPool($db);
// for ($i=1; $i < 12; $i++) { 
//     $res=GetUsersIDPool($db,$i,'88.1','pairing_1');  
//     print_r($res);
// }

// $res1=GetUserByPos($db,85,'R');
// $res2=implode("','",$res1);
// $delrecord = mysqli_query($db,"DELETE FROM membership WHERE member_id IN ('$res2')");
// $delrecord = mysqli_query($db,"DELETE FROM `child_counter` WHERE `uid` IN ('$res2')");
// $delrecord = mysqli_query($db,"DELETE FROM `pairing` WHERE `uid` IN ('$res2')");
// $delrecord = mysqli_query($db,"DELETE FROM `sponsor_income` WHERE `uid` IN ('$res2')");
// $res = GetUids($db,88);
// $lc = getGreenId1($db,$res);
// echo $tot_c = $lc;
$brnadSQL="select t1.*,t1.status as st,t1.date as sdat,t2.* from up_trans_history111 t1 join membership t2 on t2.member_id = t1.uid where t1.status = 0 order by t1.id DESC"; 
$ResultSQL=mysqli_query($link,$brnadSQL); 
while($Listbrand=mysqli_fetch_assoc($ResultSQL)) { 
    $qx10 = mysqli_query($db,"SELECT t1.*,t2.* FROM `pairing` t1 join `membership` t2 on t1.uid = t2.member_id WHERE t1.sponsor_id = '$Listbrand[uid]' AND (t2.binary_status = '1' OR t2.binary_status = '2')");
    echo $c1 = mysqli_num_rows($qx10);
    echo "<br>";
    echo $Listbrand['uid'];
    echo "<br>";
}
?>
