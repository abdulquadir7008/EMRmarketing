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
		$spnoser_id = $_REQUEST['spnoser_id'];
		// echo "select * from membership where email='$email' and spnoser_id='$spnoser_id' and status ='2'";
		$result_sponser=mysqli_query($link,"select * from membership where email='$email' and spnoser_id='$spnoser_id' and status ='2'");

		$SqlSponsergen = mysqli_query($link,"select * from membership where userid='$spnoser_id'"); 
		$ListSponserList = mysqli_fetch_array($SqlSponsergen);
		$spnoser_id=$ListSponserList['member_id'];	
	}

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

				$query="insert into membership(fname,lname,phone,email,country,stree_address,city,state,postalcode,status,password,date,sess,gender,sponser_status,spnoser_id,binary_root)values('$fname','$lname','$phone','$email','$country','$stree_address','$city','$state','$postalcode','2','$password',now(),'$sess','$gender','$sponser_status','$spnoser_id','$act_pos')"; 
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
                                        if($plan == '2000_plan'){
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
                                        elseif($plan == '3000_plan'){
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


		
		


			$errmsg_arr = array();
            $errflag = false;
            $errmsg_arr[] = '<div class="label_error">Registered successfully.</div>';
            $errflag = true;
            $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
            session_write_close();
            header('Location: ../register1.php');
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
    
    header('location:../setting.php');

    $errmsg_arr = array();
    $errflag = false;
    $errmsg_arr[] = '<div class="label_error">Registered successfully.</div>';
    $errflag = true;
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
	header('Location: ../register1.php');
}

?>
