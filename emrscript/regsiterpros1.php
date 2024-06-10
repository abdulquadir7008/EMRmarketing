<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config.php");
require '../vendor_email/autoload.php';
	$emailtrick = new \SendGrid\Mail\Mail();
	ob_start();
	$sess=session_id();
	$fname=$_REQUEST['fname'];
	$lname=$_REQUEST['lname'];
	$phone=$_REQUEST['phone'];
	$email=$_REQUEST['email'];
	$country=$_REQUEST['country'];
	$stree_address=$_REQUEST['stree_address'];
	$city=$_REQUEST['city'];
	$state=$_REQUEST['state'];
	$gender=$_REQUEST['gender'];
	$ref=$_REQUEST['ref'];
	$postalcode=$_REQUEST['postalcode'];
	$password=md5($_REQUEST['password']);
	$phone_code=$_REQUEST['phone'];
	$sponser_status=$_REQUEST['sponser_status'];
	$position=$_REQUEST['position'];

	$spnoser_id = '0';
	$result_sponser = '0';
	if(isset($_REQUEST['spnoser_id'])){
		echo $spnoser_id = $_REQUEST['spnoser_id'];
		echo "select * from membership where email='$email' and spnoser_id='$spnoser_id' and status ='2'";
		$result_sponser=mysqli_query($link,"select * from membership where email='$email' and spnoser_id='$spnoser_id' and status ='2'");

		$SqlSponsergen = mysqli_query($link,"select * from membership where userid='$spnoser_id'"); 
		$ListSponserList = mysqli_fetch_array($SqlSponsergen);
		$spnoser_id=$ListSponserList['member_id'];	
	}die;


	if($email!='')
	{	
		$result=mysqli_query($link,"select * from membership where email='$email' and status ='2'");
		if(mysqli_num_rows($result)==0)
		{
			if(mysqli_num_rows($result_sponser)==0)
			{
				if($ref == 1){
					$sponsor_id = $spnoser_id;
					
					if(isset($position) && empty($position)){
						$position = 'L';
					}
					if(isset($sponsor_id) && !empty($sponsor_id)){
						$act_pos = $position;
						$parent_id = GetValidParentId($db, $sponsor_id, $position);
						if ($parent_id != $sponsor_id) {
							if ($position == 'C') {
								$position = 'L';
							}
						}
					}
				}

				$query="insert into membership(fname,lname,phone,email,country,stree_address,city,state,postalcode,status,password,date,sess,gender,sponser_status,spnoser_id,binary_root)values('$fname','$lname','$phone','$email','$country','$stree_address','$city','$state','$postalcode','$sess','$password',now(),'$sess','$gender','$sponser_status','$spnoser_id','$act_pos')"; 
				mysqli_query($link,$query); 	
				$user_id=$_SESSION['member_id']=mysqli_insert_id($link);
				$emrUser = 'emr00'.$user_id;
				mysqli_query($link,"update membership SET userid='$emrUser' WHERE member_id=$user_id");
				
				if($ref == 1){
					if (isset($parent_id) && !empty($parent_id) && isset($sponsor_id) && !empty($sponsor_id)) {
						$sp1 = mysqli_query($db,"select uid,status from pairing where uid='$parent_id'");
						$spno = mysqli_num_rows($sp1);
						if ($spno > 0) {
							$sqry = mysqli_query($db,"select member_id from membership where member_id='$sponsor_id'");
							$spno1 = mysqli_num_rows($sqry);
							if ($spno1 > 0) {
								$userid = mysqli_fetch_assoc($sp1);
								$parent_id = $userid['uid'];
								$paired = $userid['status'] + 1;
								// echo "select uid from pairing where parent_id='$parent_id'";die;
								$chkqry = mysqli_num_rows(mysqli_query($db,"select uid from pairing where parent_id='$parent_id'"));
								if ($chkqry >= 2) {
									$msg = "You can not add User under this parent,Parent Already have 2 Childs.";
								} else {
									$check_position = mysqli_query($db,"SELECT uid FROM pairing WHERE parent_id='$parent_id' AND position='$position'") or die(mysqli_error($db));
									$chkqry2 = mysqli_num_rows($check_position);
									if ($chkqry2 > 0) {
										$msg = 'Already assiged a user to this side';
									} else {
										// echo $user_id, $parent_id,$sponsor_id, $position,$act_pos;
										UserPairing($db, $user_id, $parent_id,$sponsor_id, $position,$act_pos,$paired);
										// die;
									}
								}
							}
							else {
								$msg = "Enter valid Sponsor Id!";
							}
						}
						else {
							$msg = "Enter valid Parent Id!";
						}
					}
				}
			}
			else{
				$errmsg_arr[] = '<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Error!</strong> This Sponser ID has register with similar User. If any query contact Admin!</div>';
				$errflag = true;
				$_SESSION['registerpro'] = $errmsg_arr;
				session_write_close();
				header('Location: ' . $_SERVER['HTTP_REFERER']);
				ob_end_flush();
			}

			$msg ="<div style='background:#f3f3f3; padding:40px; text-align:center;'>
			<div style='width:700px; padding:20px; background:#fff; margin:auto; font-family:Arial, Helvetica, sans-serif; font-size:14px;'>
				<div align='center'><img src='$domain_url/images/logo.jpg' width='100'></div>
				<p><strong>Hi $fname,</strong></p>
				<div>Thank you create account in <strong>EMR Marketing LLC</strong></div>
				<div style='background:#09F; padding:10px 20px; font-weight:bold; text-align:center; font-size:15px; font-weight:bold; width:270px; margin:20px auto;'><a href='$domain_url/regester_verify.php?temp=$sess&&email=$email' style=' display:block;color:#fff; text-decoration:none;'>Click here to Verify Your Account</a>
				</div>
				<p>OR</p>
				<P><strong>Copy here: $domain_url/regester_verify.php?temp=$sess&&email=$email</strong></p>
			</div>
			</div>";

		
		
			$mailheader = "MIME-Version: 1.0\r\n";
			$mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$mailheader .= "From:Verify - EMR"."< noreplay@emrmarketing.in>\r\n";
			$mailheader .= "X-Priority: 3\r\n";
			$mailheader .= "X-Mailer: PHP". phpversion() ."\r\n";
			mail($email,"Register confirm Email",$msg,$mailheader);

			$emailtrick->setFrom("quadir@emrmarketing.in", "EMR Marketing");
			$emailtrick->setSubject("Register confirm Email");
			$emailtrick->addTo($email, "Verify Email");
			//$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
			$emailtrick->addContent(
				"text/html", $msg
			);
			$sendgrid = new \SendGrid('xxxxx-xxxxx-xxxxx-xxxxx');
			try {
				$response = $sendgrid->send($emailtrick);
				print $response->statusCode() . "\n";
				print_r($response->headers());
				print $response->body() . "\n";
			} catch (Exception $e) {
				echo 'Caught exception: '. $e->getMessage() ."\n";
			}	
		


			$errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>VERIFY!</strong>Thank you for register. Please verify your email.</div>';
			$errflag = true;
			$_SESSION['registerpro'] = $errmsg_arr;
			session_write_close();
			header('Location: ../register-verify/');
			ob_end_flush();	
		}
		else
		{
			$errmsg_arr[] = '<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Error!</strong> This Email is already use</div>';
			$errflag = true;
			$_SESSION['registerpro'] = $errmsg_arr;
			session_write_close();
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			ob_end_flush();	
		}
	}
	else
	{
		$errmsg_arr[] = 'Error: Please filled the Register form.';
		$errflag = true;
		$_SESSION['registerpro'] = $errmsg_arr;
		session_write_close();
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		ob_end_flush();	
	} 

	function GetValidParentId($db,$sponsor_id,$position)
	{
		$parent_name='';
		$res=GetUserCountPos($db,$sponsor_id,$position);
		$parent_id=end($res);
		$sp1=mysqli_query($db,"select member_id from membership where member_id='$parent_id'");
		$spno=mysqli_num_rows($sp1);
		if($spno > 0)
		{
			$userid=mysqli_fetch_assoc($sp1);
			$parent_id=$userid['member_id'];
			$check_position1 = mysqli_query($db,"SELECT uid FROM pairing WHERE parent_id='$parent_id' AND position='$position'") or die(mysqli_error($db));
			$chkqry21 = mysqli_num_rows($check_position1);
			if($chkqry21>0){
				//echo 2;
				GetValidParentId($db,$parent_id,$position);
			}
		}
		else
		{
			//echo 3;
			GetValidParentId($db,$parent_id,$position);
		}
		return $parent_id;
	}
	$all_user=array();
	function GetUserCountPos($db,$sponsor_id,$position)
	{
		global $all_user;
		$all_user=array();
		$sql = "select t1.uid from pairing t1 left join membership t2 on t1.parent_id=t2.member_id where t2.member_id='$sponsor_id' and t1.position='$position'";
		//echo "SQL1 : $sql <br>";
		$sql=mysqli_query($db,$sql);
		if($no=mysqli_num_rows($sql) > 0)
		{
			$r1=mysqli_fetch_assoc($sql);
			$uid=$r1['uid'];
			if($position=='C'){$position='L';}
			$res= GetAllUserCountPos($db,$uid,$position);
			return $res;
		}
		else
		{
			$r1=mysqli_fetch_assoc(mysqli_query($db,"select member_id from membership where member_id='$sponsor_id'"));
			$new_array = array($r1['member_id']);
			return $new_array;
		}

	}
	function GetAllUserCountPos($db,$uid,$position)
	{
		global $all_user;
		$all_user[]=$uid;
		$sql2 = "select * from pairing t1 where t1.parent_id='$uid' and t1.position='$position'";
		//echo "SQL2 : $sql2 <br>";
		$sql=mysqli_query($db,$sql2);
		if($no=mysqli_num_rows($sql) > 0)
		{
			$r1=mysqli_fetch_assoc($sql);
			$uid1=$r1['uid'];
			GetAllUserCountPos($db,$uid1,$position);
		}
		return $all_user;
	}
	
	function UserPairing($db,$uid,$parent_id,$sponsor_id,$position=null,$act_pos=null,$paired)
	{
		// echo "INSERT INTO `pairing`(`uid`, `parent_id`, `sponsor_id`,`position`,`act_pos`, `date`) VALUES ('$uid','$parent_id','$sponsor_id','$position','$act_pos',now())";
		$sql = "INSERT INTO `pairing`(`uid`, `parent_id`, `sponsor_id`,`position`,`act_pos`, `date`,`status`) VALUES ('$uid','$parent_id','$sponsor_id','$position','$act_pos',now(),'$paired')";
		$pair=mysqli_query($db,$sql);
		$q6 = mysqli_query($db,"INSERT INTO `child_counter`(`uid`) VALUES ($uid)");
		$q7 = mysqli_query($db,"UPDATE `child_counter` SET `count`=`count`+1 WHERE uid='$parent_id'");
		ChildAddedBinaryCount($db,$uid);
		$q7 = mysqli_query($db,"UPDATE `child_counter` SET `total_direct_count`=`total_direct_count`+1 WHERE uid='$sponsor_id'");

		return;
	}

	
	function ChildAddedBinaryCount($db,$uid){
		$plan_binary_count=1;
		$r1=mysqli_fetch_assoc(mysqli_query($db,"SELECT `parent_id` FROM pairing  WHERE uid='$uid'"));
		$parent_id=$r1['parent_id'];
		$query=mysqli_query($db,"SELECT * FROM pairing  WHERE uid='$uid'");
		if(mysqli_num_rows($query)>0){
			$row=mysqli_fetch_assoc($query);
			if($row['position']=="L")
			{
				mysqli_query($db,"UPDATE child_counter SET total_left_count=total_left_count+$plan_binary_count WHERE uid='$parent_id'");
			}
			else if($row['position']=="R")
			{
				mysqli_query($db,"UPDATE child_counter SET total_right_count=total_right_count+$plan_binary_count WHERE uid='$parent_id'");
			}
			if($parent_id==85){}
			else
			{
				ChildAddedBinaryCount($db,$parent_id);
			}
		}
		return true;
	}


?>