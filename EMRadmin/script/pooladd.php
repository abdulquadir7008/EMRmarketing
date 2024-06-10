<?php include("../../config.php");
include("../../include/other_function.php");
ob_start();
$usen=$_SESSION['SESS_ADMIN_USER'];
$profile_sett="select * from admin_login where username='$usen'"; 
$result_profile=mysqli_query($link,$profile_sett); 
$profile_row=mysqli_fetch_array($result_profile);
$admin_id=$profile_row['admin_id']; 
if(isset($_REQUEST['poolacc']))
{
	$pool=$_REQUEST['pool'];
	$uid=$_REQUEST['user_id'];
	if($pool == 1){
		$type=1;
		$slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `child_counter_1` WHERE `uid` LIKE '$uid%'"));
		$cc = $slot_count+1;
		$uidd = $uid.".".$cc;
		$cds = BoostIncome1($db,$uidd,$type);
		$ts = CheckSelfPool($db);
		// UpgradeBo($db);
		$q83 = mysqli_query($db,"INSERT INTO `pool_activation`(`uid`,`pool`,`date`) VALUES ($uid,'1',now())");
		$errmsg_arr = array();
		$errflag = false;
		$errmsg_arr[] = '<div class="label_error">Pool 2 Acitvated successfully.</div>';
		$errflag = true;
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header('Location: ../pool.php');
	}
	elseif($pool == 2){
		$slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `child_counter_4` WHERE `uid` LIKE '$uid%'"));
		$cc = $slot_count+1;
		$uidd = $uid.".".$cc;
		$type=4;
		$cds = BoostIncome2($db,$uidd,$type);
		$ts = CheckBoost1($db,'child_counter_4','pairing_4',4);
		$q83 = mysqli_query($db,"INSERT INTO `pool_activation`(`uid`,`pool`,`date`) VALUES ($uid,'2',now())");
		$errmsg_arr = array();
		$errflag = false;
		$errmsg_arr[] = '<div class="label_error">Booster 1 Acitvated successfully.</div>';
		$errflag = true;
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header('Location: ../pool.php');
	}
	elseif($pool == 3){
		$slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `child_counter_2` WHERE `uid` LIKE '$uid%'"));
		$cc = $slot_count+1;
		$uidd = $uid.".".$cc;
		$type=2;
		$cds = BoostIncome3($db,$uidd,$type);
		$ts = CheckGoldBoost($db);
		$q83 = mysqli_query($db,"INSERT INTO `pool_activation`(`uid`,`pool`,`date`) VALUES ($uid,'3',now())");
		$errmsg_arr = array();
		$errflag = false;
		$errmsg_arr[] = '<div class="label_error">Booster 2 Acitvated successfully.</div>';
		$errflag = true;
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header('Location: ../pool.php');
	}
	elseif($pool == 4){
		$slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `child_counter_3` WHERE `uid` LIKE '$uid%'"));
		$cc = $slot_count+1;
		$uidd = $uid.".".$cc;
		$type=3;
		$cds = BoostIncome3($db,$uidd,$type);
		$ts = CheckDiaBoost($db);
		$q83 = mysqli_query($db,"INSERT INTO `pool_activation`(`uid`,`pool`,`date`) VALUES ($uid,'4',now())");
		$errmsg_arr = array();
		$errflag = false;
		$errmsg_arr[] = '<div class="label_error">Booster 3 Acitvated successfully.</div>';
		$errflag = true;
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header('Location: ../pool.php');
	}
	
}
?>
