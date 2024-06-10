<?php include('../config.php');
require '../vendor_email/autoload.php';
$emailtrick = new \SendGrid\Mail\Mail();
if (isset($_REQUEST['submit']))
{
$rs_search = mysqli_query($link,"select * from membership where email='$_POST[email]' and status='2'");
$user_count = mysqli_num_rows($rs_search);
if ($user_count != 0)
{
  $kd_uniq = uniqid();
mysqli_query($link,"UPDATE membership set uniqid='$kd_uniq' where email='$_POST[email]' and status='2'");


$msg ="<table width='700' border='0' cellpadding='0' cellspacing='0' style='background:#f3f3f3; line-height:21px; border:1px solid #ccc;  font-family:Arial, Helvetica, sans-serif; font-size:13px; color:
#333;' align='center'>
<tr>
	<td width='171'><div align='left'><img src='$domain_url/images/emr-cover.jpg' border='0'  /></div></td>
	<td width='527' style='background:#000; font-size:23px; text-align:center; color:#fff; text-shadow:0 0 2px #000; font-weight:bold;'><p>Reset The Password</p></td>
</tr>
<tr>
    <td colspan='2' style='padding:10px;'>
<p>Welcome to EMR, </p>
Please go through the below link RESET your Password.</p>
<p>$domain_url/password.php?reset=$kd_uniq</p>
<p><strong>If you did not send this request, you can safely ignore this email.</strong></p>
<br/>
<p>Thank you. This is an automated response. PLEASE DO NOT REPLY.</p>

 
<p><b>Regards</b></p>
    <p align='left'><strong style='color:#1d81c2;'><strong >EMR Marketing LLC</strong>.</strong></p>
	<p align='left'><strong style='color:#1d81c2;'><a href='https://www.emrmarkteing.in/'>Go to EMR Website</a></strong></p>
</td>
  </tr>
</table>";

$mailheader1 = "MIME-Version: 1.0\r\n";
$mailheader1 .= "Content-type: text/html; charset=iso-8859-1\r\n";
$mailheader1 .= "From: www.MissitalyBrand.com"."<support@MissitalyBrand.com>\r\n";
//@mail($_POST['email'],"Password Reset",$message,$mailheader1);

$emailtrick->setFrom("quadir@emrmarketing.in", "EMR Marketing");
$emailtrick->setSubject("Password Reset");
$emailtrick->addTo($_POST['email'], "Password Reset");
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

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you. Please go to your register email for Reset Link.</div>';
$errflag = true;
$_SESSION['resetarror'] = $errmsg_arr;
session_write_close();	
} 
else if($_POST['email']=='')
{
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = '<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Waaring!</strong> Please give your correct email address</div>';
$errflag = true;
$_SESSION['resetarror'] = $errmsg_arr;
session_write_close();
}
else
{
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = '<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Error Message!</strong> Account with given email does not exist</div>';
$errflag = true;
$_SESSION['resetarror'] = $errmsg_arr;
session_write_close();
}
mysqli_close($link);
header('Location: ' . $_SERVER['HTTP_REFERER']);
}


if(isset($_REQUEST['updatepassword'])){
  $password = md5($_REQUEST['password']);
  $uniqid = $_REQUEST['uniqid'];
  mysqli_query($link,"UPDATE membership set password='$password', uniqid='' where uniqid='$uniqid'");

  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Password Change Successfully.</div>';
  $errflag = true;
  $_SESSION['passwordch'] = $errmsg_arr;
  session_write_close();
  mysqli_close($link);
  header('Location: ../login/');
}
?>