<?php include("../config.php");
ob_start();
if(isset($_REQUEST['cart_id']))
{
echo $sess=session_id();
echo $cart_id=$_REQUEST['cart_id'];


if($_SESSION['member_id']) {
    $userid= $_SESSION['member_id'];
    $sql="delete from cart where userid = '$userid' AND cart_id=$cart_id";
}
else{
    $sql="delete from cart where sess = '$sess' AND cart_id=$cart_id";
}
mysqli_query($link,$sql);
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else 
{
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
ob_end_flush();
?>