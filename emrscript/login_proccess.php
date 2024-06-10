<?php include("../config.php");

$ip = $_SERVER['REMOTE_ADDR'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$sess=session_id();
//$password = $_POST['password'];

if($email!='' || $password!='')
{	
$qry="SELECT * FROM membership WHERE (email = '$email' or userid='$email') AND password='".$password."' AND status=2";
$result=mysqli_query($link,$qry);
if(mysqli_num_rows($result) == 1) {
$member = mysqli_fetch_assoc($result);
$id=$_SESSION['member_id'] = $member['member_id'];
$logcheck_delete="delete from login_check where sess='$sess' and ip='$ip'";
mysqli_query($link,$logcheck_delete);	
$errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for Login.</div>';
$errflag = true;
$_SESSION['loginerror'] = $errmsg_arr;
session_write_close();
header('Location: ' . $domain_url.'index.php');	


}
else 
{
	
$query="insert into login_check(ip,sess)values('$ip','$sess')"; 
mysqli_query($link,$query);

$errmsg_arr[] = '<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Error!</strong> Please enter your valid email and password</div>';
$errflag = true;
$_SESSION['loginerror'] = $errmsg_arr;
//session_write_close();
header('Location: ' . $domain_url.'login/');
}

}
else 
{
	
$query="insert into login_check(ip,sess)values('$ip','$sess')";
mysqli_query($link,$query);
	
$errmsg_arr[] = '<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Error!</strong> This email/password combination is incorrect</div>';
$errflag = true;
$_SESSION['loginerror'] = $errmsg_arr;
//session_write_close();
header('Location: ' . $domain_url.'login/');
}


?>