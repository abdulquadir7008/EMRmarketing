<?php include("../../config.php");
include("../../include/other_function.php");
ob_start();
$usen=$_SESSION['SESS_ADMIN_USER'];
$profile_sett="select * from admin_login where username='$usen'"; 
$result_profile=mysqli_query($link,$profile_sett); 
$profile_row=mysqli_fetch_array($result_profile);
 
$admin_id=$profile_row['admin_id']; 
if(isset($_REQUEST['registeracc']))
{
    $fname=$_REQUEST['fname'];
	$lname=$_REQUEST['lname'];
	$phone=$_REQUEST['phone'];
	$email=$_REQUEST['email'];
    $sess="";
    $status="2";
    $plan=$_REQUEST['plan'];
	// $country=$_REQUEST['country'];
	$stree_address=$_REQUEST['stree_address'];
	$city=$_REQUEST['city'];
	$state=$_REQUEST['state'];
	$gender=$_REQUEST['gender'];
	$ref=$_REQUEST['ref'];
	$postalcode=$_REQUEST['postalcode'];
	// $password=md5($_REQUEST['password']);
	$phone_code=$_REQUEST['phone'];
	// $sponser_status=$_REQUEST['sponser_status'];
	$position=$_REQUEST['position'];
	$user_id=$_REQUEST['user_id'];
	$spnoser_id = $_REQUEST['spnoser_id'];
	$result_sponser = '0';
	
if($spnoser_id){
	$sqlCorAct = mysqli_query( $link, "select * from cordinator_activation" );
	
while($arrayCodActiv = mysqli_fetch_array( $sqlCorAct )){
	if($arrayCodActiv['cordinator']=='regional'){
	  $sqlRegion = mysqli_query( $link, "select * from states WHERE id='$state'" );
  	  $listRegion = mysqli_fetch_array( $sqlRegion );
	  $cordChange = $listRegion['region_id'];
	}
	else{
		$cordChange = '';
	}
	$codin_id = $arrayCodActiv['codin_id'];
	$neh = $arrayCodActiv['cordinator'];
	if($arrayCodActiv['cordinator']=='district' && $arrayCodActiv['cordinator_chane']==$city){
		$commission = $arrayCodActiv['commission'] + 40;
		$com2= 40;
		$q83 = mysqli_query($db,"INSERT INTO `codinator_history`(sponser_id,userId,codigntor,commission,date) VALUES ('$codin_id','$user_id','$neh','$com2',now())");
	}
	else if($arrayCodActiv['cordinator']=='state' && $arrayCodActiv['cordinator_chane']==$state){
		$commission = $arrayCodActiv['commission'] + 20;
		$com2= 20;
		$q83 = mysqli_query($db,"INSERT INTO `codinator_history`(sponser_id,userId,codigntor,commission,date) VALUES ('$codin_id','$user_id','$neh','$com2',now())");
	}
	else if($arrayCodActiv['cordinator']=='regional' && $arrayCodActiv['cordinator_chane']==$cordChange){
		$commission = $arrayCodActiv['commission'] + 10;
		$com2= 10;
		$q83 = mysqli_query($db,"INSERT INTO `codinator_history`(sponser_id,userId,codigntor,commission,date) VALUES ('$codin_id','$user_id','$neh','$com2',now())");
	}
	else if($arrayCodActiv['cordinator']=='national' && $arrayCodActiv['cordinator_chane']=='In'){
		$commission = $arrayCodActiv['commission'] + 5;
		$com2= 5;
		$q83 = mysqli_query($db,"INSERT INTO `codinator_history`(sponser_id,userId,codigntor,commission,date) VALUES ('$codin_id','$user_id','$neh','$com2',now())");
	}
	else{
		$commission =$arrayCodActiv['commission'];
	}
	
	
	
	
	mysqli_query( $db, "UPDATE `cordinator_activation` SET `commission`='$commission' where `codin_id` = '$codin_id'" );
}
	
}
	
	
	
	if($plan == '2000_plan'){
		$userc04=mysqli_num_rows(mysqli_query($db,"select * from `pairing_1` where uid='$user_id'"));
		if($userc04 > 0){
		}
		else{
			$uq = mysqli_query($db,"UPDATE `membership` SET `binary_status`=1,`status`=2 where `member_id` = '$user_id'");

			AddTopCount($db,$user_id,"200");
			$type=1;
			$slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `child_counter_1` WHERE `uid` LIKE '$user_id%'"));
			$cc = $slot_count+1;
			$uidd = $user_id.".".$cc;
			$cds = BoostIncome1($db,$uidd,$type);
			$ts = CheckSelfPool($db);
			$q83 = mysqli_query($db,"INSERT INTO `pool_activation`(`uid`,`pool`,`date`) VALUES ($user_id,'1',now())");
		
			$nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select `sponsor_id` from `pairing` where `uid`='$user_id'"));
			$nnsponsor_id = $nparent_idd['sponsor_id'];
		
			$r=mysqli_fetch_assoc(mysqli_query($db,"SELECT `percent` FROM `admin_login` WHERE `admin_id`='1' "));
			$percent=$r['percent'];
		
			        $q83 = mysqli_query($db,"INSERT INTO `sponsor_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nnsponsor_id,$user_id,'$percent',now())");

		}
	}
	elseif($plan == '3000_plan'){
		$userc04=mysqli_num_rows(mysqli_query($db,"select * from `pairing_1` where uid='$user_id'"));
		if($userc04 > 0){
		}
		else{
			$uq = mysqli_query($db,"UPDATE `membership` SET `binary_status`=2,`status`=2 where `member_id` = '$user_id'");
			AddTopCount($db,$user_id,"200");
			$type=1;
			$slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `child_counter_1` WHERE `uid` LIKE '$user_id%'"));
			$cc = $slot_count+1;
			$uidd = $user_id.".".$cc;
			$cds = BoostIncome1($db,$uidd,$type);
			$ts = CheckSelfPool($db);
			$q83 = mysqli_query($db,"INSERT INTO `pool_activation`(`uid`,`pool`,`date`) VALUES ($user_id,'1',now())");
		
			$nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select `sponsor_id` from `pairing` where `uid`='$user_id'"));
			$nnsponsor_id = $nparent_idd['sponsor_id'];
		
			$r=mysqli_fetch_assoc(mysqli_query($db,"SELECT `percent2` FROM `admin_login` WHERE `admin_id`='1' "));
			$percent=$r['percent2'];
		
			        $q83 = mysqli_query($db,"INSERT INTO `sponsor_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nnsponsor_id,$user_id,'$percent',now())");

		}
	}


    $errmsg_arr = array();
    $errflag = false;
    $errmsg_arr[] = '<div class="label_error">ID Acitvated successfully.</div>';
    $errflag = true;
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
	header('Location: ../register.php');
	

}

?>
