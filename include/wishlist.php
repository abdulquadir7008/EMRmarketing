<?php include("../config.php");
ob_start();
if(isset($_REQUEST['wish']))
{
echo $sess=session_id();
echo $cart_id=$_REQUEST['wish'];
$ip = $_SERVER['REMOTE_ADDR'];
$query="insert into wishlist(product_id,sess,pc_ip,date)values('$cart_id','$sess','$ip',now())";
mysqli_query($link,$query);
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['close']))
{
	$closeID = $_REQUEST['close'];
	$sql="delete from wishlist where wishlist_id=$closeID";
	mysqli_query($link,$sql);
	session_write_close();
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
ob_end_flush();
?>