<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_start();
require 'vendor_email/autoload.php';
$emailtrick = new \SendGrid\Mail\Mail();
include("config.php");
if(isset($_REQUEST['temp']) && isset($_REQUEST['email'])) {
    $temp=$_REQUEST['temp'];
    $email=$_REQUEST['email'];
    
    $query="update membership SET status='2' WHERE email='$email' and status='$temp'";         
    mysqli_query($link,$query);

    $sql_cms1="select * from membership WHERE email='$email' and status='2'"; 
    $result_cms1=mysqli_query($link,$sql_cms1); 
    $row_cms1=mysqli_fetch_array($result_cms1);
    $fname=$row_cms1['fname'];
    $emailid=$row_cms1['email'];
    $pass=$_SESSION['pass'];
    $id=$row_cms1['id'];
    $gender=$row_cms1['gender'];
	$sponser_id=$row_cms1['spnoser_id'];
	$usernameID=$row_cms1['userid'];
	$_SESSION[ 'member_id' ] = $row_cms1['member_id'];

    $msg ="<div style='background:#f3f3f3; padding:40px; text-align:center;'>
      <div style='width:700px; padding:20px; background:#fff; margin:auto; font-family:Arial, Helvetica, sans-serif; font-size:14px;'>
        <div align='center'><img src='$domain_url/images/logo.jpg' width='100'></div>
        <p>Dear $fname,</p>
        <p>Thank you for verifying your email id. Now your profile has been confirmed as genuine and authoritative. Email Id verification confirms that the email id you have entered is authoritative and valid.</p>
        <p>through your email id for the process of selection.</p>
        <p><strong>YOUR ACCOUNT LOGIN DETAILS:</strong><br />
          <strong>Email :</strong> $emailid<br><strong>Username :</strong> $usernameID<br><strong>Pass:</strong> $pass</p>
		  
      </div>
    </div>";
    $mailheader = "MIME-Version: 1.0\r\n";
    $mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $mailheader .= "From:Login Details - EMR"."< noreplay@emrmarketing.in>\r\n";
    $mailheader .= "X-Priority: 3\r\n";
    $mailheader .= "X-Mailer: PHP". phpversion() ."\r\n";
//mail($email,"Login Details",$msg,$mailheader);

$emailtrick->setFrom("quadir@emrmarketing.in", "EMR Marketing");
$emailtrick->setSubject("Register confirmed");
$emailtrick->addTo($email, "Login Details");
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
unset($_SESSION['pass']);
	
if($sponser_id > 0){
		$errflag = true;
$_SESSION['verifysuccfully'] = $errmsg_arr;
session_write_close();
header('Location: ' . $domain_url.'sponser_choose_plan.php?user='.$email.'');
ob_end_flush();	
	}
	else{
	$errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for register.Your Email Verify is Successfully. Please login to below.</div>';
$errflag = true;
$_SESSION['verifysuccfully'] = $errmsg_arr;
session_write_close();
header('Location: ' . $domain_url.'login/');
ob_end_flush();	
	}
	
    }
?>