<?php
include_once( 'include/configuration.php' );
//echo print_r( $_GET );


error_reporting( E_ALL );
ini_set( 'display_errors', '0' );
?>

<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from big-skins.com/frontend/EMR/html/index-layout-6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Mar 2023 07:02:11 GMT -->
<?php include_once('include/head.php');?>

<body class="boxed">
<!-- Loader -->
<div id="loader-wrapper">
  <div class="cube-wrapper">
    <div class="cube-folding"> <span class="leaf1"></span> <span class="leaf2"></span> <span class="leaf3"></span> <span class="leaf4"></span> </div>
  </div>
</div>
<!-- /Loader -->

<div id="wrapper">

<!-- Page -->
<div class="page-wrapper">
  <?php include_once('include/navigation.php');?>
  <!-- Page Content -->
  <main class="page-main">
  <div class="block">
    <div class="container">
      <ul class="breadcrumbs">
        <li><a href="index.php"><i class="icon icon-home"></i></a></li>
        <li>/<span>Payment</span></li>
      </ul>
    </div>
  </div>
  <div class="block">
    <div class="container">
      
		<?php

print_r($_GET);


?>
		
		
    </div>
    <div class="divider"></div>
    </main>
    <!-- /Page Content -->
    <?php include('include/footer.php');?>