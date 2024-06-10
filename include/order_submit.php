<?php
include("../config.php");
include('../Crypto.php');
ob_start();
if ( $_SESSION[ 'member_id' ] ) {
$customeid = $_SESSION[ 'member_id' ];
$sql_check1 = "select * from cart WHERE userid='$customeid'";
$res_check2=mysqli_query($link,$sql_check1); 
while($cart_list = mysqli_fetch_array($res_check2)){
$subtotal = $subtotal + ( $cart_list[ 'price' ] * $cart_list[ 'qty' ] );
}
$tax=number_format($subtotal * 18 / 100,2, '.', ',');
$grossTotal = number_format(($subtotal + $tax),2, '.', ',');
$encryptedAmount = encrypt($grossTotal, $key);

}
$kd_uniq = uniqid();
$ip = $_SERVER['REMOTE_ADDR'];
$_SESSION['kadid'] = $kd_uniq;
$sess=session_id();
$fname=$_REQUEST['fname'];
$lname=$_REQUEST['lname'];
$phone=$_REQUEST['phone'];
$email=$_REQUEST['email'];
$_SESSION["msemail"] = $email;
$plan = $_SESSION['plan'];

$country=$_REQUEST['country'];
$stree_address=$_REQUEST['stree_address'];
$city=$_REQUEST['city'];
$state=$_REQUEST['state'];
$postalcode=$_REQUEST['postalcode'];
$password='';
$status ='1';
$payment=$_REQUEST['payment'];
$memberid=$_REQUEST['memberid'];
$totalprice=$_REQUEST['totalprice'];
$_SESSION['totalprice'] = $totalprice;
$Decrypamount = decrypt($totalprice, $key);
$landmark=$_REQUEST['landmark'];
$altphone=$_REQUEST['altphone'];
$phone_code=$_REQUEST['phone_code'];
$company =$_REQUEST['company'];

if($_REQUEST['member_option'] == 'member'){
	$newpwd = rand(100000,999999);
	$password= md5($newpwd);
	$status ='2';
}


if($email)
{
$sql="select * from membership where email='$email' and status ='2'";	
$result=mysqli_query($link,$sql);
	if(isset($_REQUEST['Uplace'])){ $emailch = $email;}else{$emailch = mysqli_num_rows($result)==0;}
if($emailch)
{
if(isset($_REQUEST['Uplace'])){
	$query="update membership SET fname='$fname',lname='$lname', date=now(),email='$email',country='$country',stree_address='$stree_address',city='$city', state='$state',phone='$phone',postalcode='$postalcode',landmark='$landmark' WHERE member_id=$memberid";
	mysqli_query($link,$query);
	$user_id=$memberid;
	
} else if(isset($_REQUEST['order'])){
$member_option = $_REQUEST['member_option'];
$query="insert into membership(fname,lname,phone,email,country,stree_address,city,state,postalcode,status,password,member_option,payment,date,sess,company)values('$fname','$lname','$phone','$email','$country','$stree_address','$city','$state','$postalcode','$status','$password','$member_option','$payment',now(),'$sess','$company')"; 
mysqli_query($link,$query);
$user_id=$_SESSION['member_id']=mysqli_insert_id($link);
}
$carttop="update cart SET userid='$user_id' WHERE sess='$sess'";
mysqli_query($link,$carttop);

if($_REQUEST['payment'] =='amazon'){
$logsquery="insert into datalogs(merchant_reference,payment,member_id,total,email,sess,`plan`)values('$kd_uniq','$payment','$user_id','$Decrypamount','$email','$sess','$plan')"; 
mysqli_query($link,$logsquery);	
header('Location: ' . $domain_url.'phonepeRequest.php');	
ob_end_flush();		
}
else if($_REQUEST['payment'] =='cash_on_delivery'){
	$logsquery="insert into datalogs(merchant_reference,payment,member_id,total,email,sess)values('$sess','$payment','$user_id','$totalprice','$email','$sess')"; 
	mysqli_query($link,$logsquery);
	header('Location: ' . $domain_url.'order-cash.php');	
ob_end_flush();	
}
	else{
	$logsquery="insert into datalogs(merchant_reference,payment,member_id,total,email,ipcatch)values('$sess','$payment','$user_id','$totalprice','$email','$ip')"; 
mysqli_query($link,$logsquery);	
		
$errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for register.</div>';
$errflag = true;
$_SESSION['chkeror'] = $errmsg_arr;
session_write_close();
header('Location: ' . $domain_url.'order-success/');	
ob_end_flush();		
	}
	

//////////////////////////////////////////////////////////////////////////////////////////////////////////////



}
else
{
$errmsg_arr[] = '<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Error!</strong> This Email is already use <a href="login/">LOGIN</a></div>';
$errflag = true;
$_SESSION['chkeror'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);

}
}
else
{
$errmsg_arr[] = 'Error: Please filled the Register form.';
$errflag = true;
$_SESSION['chkeror'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
} 
?>