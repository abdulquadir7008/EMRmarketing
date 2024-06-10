<?php session_start();
$userseeion=$_REQUEST['username'];
unset($_SESSION['admin_id']);
$_SESSION['username'] = $userseeion;
header("location:index.php");
?>