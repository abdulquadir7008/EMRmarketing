<?php
include_once( 'include/configuration.php' );
ob_start();
$SQLproductDetails = "select * from products where status='1' AND seo_keywords='$productDetailsKey'";
$MySQLProductDetails = mysqli_query($link,$SQLproductDetails); 
$ListproductDetails = mysqli_fetch_array($MySQLProductDetails);
$productDetID = $ListproductDetails['id'];
$setpagename;
$parentcat_keyword;
if(isset($_REQUEST['Uplace']) && isset($_SESSION['member_id'])){
$fname=$_REQUEST['fname'];
$lname=$_REQUEST['lname'];
$phone=$_REQUEST['phone'];
$email=$_REQUEST['email'];
$country=$_REQUEST['country'];
$stree_address=$_REQUEST['stree_address'];
$city=$_REQUEST['city'];
$state=$_REQUEST['state'];
$postalcode=$_REQUEST['postalcode'];
	$password=md5($_REQUEST['password']);
	$queryatleast="update membership SET fname='$fname',lname='$lname', date=now(),email='$email',country='$country',stree_address='$stree_address',city='$city', state='$state',postalcode='$postalcode',password='$password' WHERE member_id=$customeid";
	mysqli_query($link,$queryatleast);
	$errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for profile Update.</div>';
$errflag = true;
$_SESSION['profilerror'] = $errmsg_arr;
session_write_close();
}
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


			
			<main class="page-main">
				<div class="block">
					<div class="container">
						<ul class="breadcrumbs">
							<li><a href="index.html"><i class="icon icon-home"></i></a></li>
							<li>/<span>Dashboard</span></li>
						</ul>
					</div>
				</div>
				<div class="container">
					<!-- Two columns -->
					<div class="row row-table">
						<!-- Left column -->
						<div class="col-md-3 filter-col fixed aside">
							
							<div class="filter-container">
								
								<div class="fstart"></div>
								<div class="fixed-wrapper">
									
									<div class="fixed-scroll">
										
										<div class="filter-col-header">
											<div class="title">Filters</div>
											<a href="#" class="filter-col-toggle"></a>
											
										</div>
										<div class="filter-col-content">
											<div class="sidebar-block-top">
												<h2>My Account</h2>
												
											</div>
											<div class="sidebar-block collapsed open">
												
												
												<?php include('side.php'); ?>
											</div>
										</div>
									</div>
								</div>
								<div class="fend"></div>
							</div>
						</div>
						<!-- /Left column -->
						<!-- Center column -->
						<div class="col-md-9 aside">
							<!-- Page Title -->
							<div class="page-title">
								<div class="title center">
									<h1>DashBoard</h1>
									<a href="register_tree.php?userlink=<?php echo $customerchechlogin_row['userid'];?>">Share link</a>
								</div>
							</div>
							<!-- /Page Title -->
							<!-- Categories Info -->
							<div class="info-block">
								<div class="dashboard-detail clearfix">
									<div class="wallet_details">
										<h4>Main Wallet</h4>
										<span><?php echo number_format($customerchechlogin_row['main_wallet'],2, '.', ',');?></span>
									</div>
									<div class="wallet_details">
										<h4>Self Pool Wallet</h4>
										<span>
											<?php
											$mwp8 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `selfpool_wallet` WHERE `uid`='$customeid' and status='0' "));

											$add_wal80 = $mwp8['main_wallet'];

											$mwp81 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `selfpool_wallet` WHERE `uid`='$customeid' and status='1' "));

											$sub_wal06 = $mwp81['main_wallet'];

											$tot_wal89 = ($add_wal80-$sub_wal06);
											echo number_format($tot_wal89,2, '.', ',');
											?>
										</span> 
										<?php
											if (isMultipleOf500($tot_wal89)) { ?>
												<br><span class="badge btn btn-sm btn-primary badge-success SelfBoost" data-id="<?php echo $customeid; ?>">Enter Now </span>
											<?php }
										?>
									</div>
									<div class="wallet_details">
										<h4>Booster 1 Wallet</h4>
										<span>
											<?php
											$binary_inc ='0';
											$mwpvt = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `booster1_wallet` WHERE `uid`='$customeid' and status='0' "));

											$add_walfr = $mwpvt['main_wallet'];

											$mwpvt1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `booster1_wallet` WHERE `uid`='$customeid' and status='1' "));

											$sub_walcd = $mwpvt1['main_wallet'];

											$tot_wal5c = ($add_walfr-$sub_walcd);
											echo number_format($tot_wal5c,2, '.', ',');
											?>
										</span> 
										<?php
											if (isMultipleOf100($tot_wal5c)) { ?>
												<br><span class="badge btn btn-sm btn-primary badge-success GoldBoost" data-id="<?php echo $customeid; ?>">Boost Now </span>
											<?php }
										?>
									</div>
									<div class="wallet_details">
										<h4>Booster 2 Wallet</h4>
										<span>
											<?php
											$binary_inc ='0';
											$mwp = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `gold_wallet` WHERE `uid`='$customeid' and status='0' "));

											$add_wal = $mwp['main_wallet'];

											$mwp1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `gold_wallet` WHERE `uid`='$customeid' and status='1' "));

											$sub_wal = $mwp1['main_wallet'];

											$tot_wal = ($add_wal-$sub_wal);
											echo number_format($tot_wal,2, '.', ',');
											?>
										</span> 
										<?php
											if (isMultipleOf500($tot_wal)) { ?>
												<br><span class="badge btn btn-sm btn-primary badge-success Boost1" data-id="<?php echo $customeid; ?>">Boost Now </span>
											<?php }
										?>
									</div>
									<div class="wallet_details">
										<h4> Booster 3 Wallet</h4>
										<span>
											<?php
											$binary_inc ='0';
											$mwp01 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `diamond_wallet` WHERE `uid`='$customeid' and status='0' "));

											$add_wal01 = $mwp01['main_wallet'];

											$mwp101 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `diamond_wallet` WHERE `uid`='$customeid' and status='1' "));

											$sub_wal01 = $mwp101['main_wallet'];

											$tot_wal01 = ($add_wal01-$sub_wal01);
											echo number_format($tot_wal01,2, '.', ',');
											?>
										</span> 
										<?php
											if (isMultipleOf1000($tot_wal)) { ?>
												<br><span class="badge btn btn-sm btn-primary badge-success DiaBoost" data-id="<?php echo $customeid; ?>">Boost Now </span>
											<?php }
										?>
									</div>
									<div class="wallet_details">
										<h4>Binary Income</h4>
										<span>
											<?php
											$binary_inc ='0';
											$poolsql="select * from binary_income WHERE amount > 0 and uid='$customeid'"; 
											$listpool=mysqli_query($link,$poolsql); 
											while($Listlog=mysqli_fetch_array($listpool)) {
												$binary_inc = $binary_inc + $Listlog['amount'];                            
											}
											echo number_format($binary_inc,2, '.', ',');
											?>
										</span>
									</div>
									<div class="wallet_details">
										<h4>Sponsor Income</h4>
										<span>
											<?php
											$spon ='0';
											$pools0="select * from sponsor_income WHERE amount > 0 and uid='$customeid'"; 
											$listpooxs=mysqli_query($link,$pools0); 
											while($Listloxs=mysqli_fetch_array($listpooxs)) {
												$spon = $spon + $Listloxs['amount'];                            
											}
											echo number_format($spon,2, '.', ',');
											?>
										</span>
									</div>
									<div class="wallet_details">
										<h4>Self Pool Income</h4>
										<span>
											<?php
											$spose ='0';
											$poosed="select * from selfpool_income WHERE amount > 0 and uid='$customeid'"; 
											$lisfe=mysqli_query($link,$poosed); 
											while($Listfe=mysqli_fetch_array($lisfe)) {
												$spose = $spose + $Listfe['amount'];                            
											}
											echo number_format($spose,2, '.', ',');
											?>
										</span>
									</div>
									<div class="wallet_details">
										<h4>Pool Level Income</h4>
										<span>
											<?php
											$autos ='0';
											$autosxs="select * from autopool_income WHERE amount > 0 and uid='$customeid'"; 
											$liauto=mysqli_query($link,$autosxs); 
											while($Lisairp=mysqli_fetch_array($liauto)) {
												$autos = $autos + $Lisairp['amount'];                            
											}
											echo number_format($autos,2, '.', ',');
											?>
										</span>
									</div>
									<div class="wallet_details">
										<h4>Robotic Pool Income</h4>
										<span><?php
											$wallet_ncome ='0';
                $poolsql="select * from pool_100 WHERE wallet_ncome > 0 and memeber_id='$customeid'"; 
                $listpool=mysqli_query($link,$poolsql); 
                while($Listlog=mysqli_fetch_array($listpool)) {
                	$wallet_ncome = $wallet_ncome + $Listlog['wallet_ncome'];                            
				}
											echo number_format($wallet_ncome,2, '.', ',');
            ?></span>
									</div>
									
									<div class="wallet_details">
										<h4>Ad View Income</h4>
										<span><?php
                $adviewsql=mysqli_query($link,"select * from ad_view_wallet WHERE user_id='$customeid'"); 
                $advlist=mysqli_fetch_array($adviewsql);
											if($advlist['wallet'] > 0){
												echo number_format($advlist['wallet'],2, '.', ',');
											}
											else{
												echo number_format(0,2, '.', ',');
											}
                	              
				
											
            ?></span>
									</div>
									
<!--
									<div class="wallet_details">
										<h4>Sponser Commisssion</h4>
										<span>2000.00</span>
									</div>
-->
									
												</div>
                                                    
                                            
							</div>
							
						</div>
						<!-- /Center column -->
					</div>
					<div class="ymax"></div>
					<!-- /Two columns -->
				</div>
			</main>
			
	
<?php include('include/footer.php');?>
<script>
	$("body").on('click', '.GoldBoost', function()
	{
		var uid = $(this).attr("data-id");
		$elm = $(this);
		$elm.hide();
		$elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
		$.ajax({
			type : 'POST',
			url : "EMRadmin/afunction.php",
			data :  {
				uid : uid,
				type : "GoldBoost"
			},
			success : function(data)
			{
				$(".submit-loading").remove();
				$elm.show();
				var data = jQuery.parseJSON(data);
				if(data.valid)
				{
					$.notify({
						message: data.message
					},{
						allow_dismiss: true,
						type: 'success',
						placement: {
							from: "bottom",
							align: "right"
						},
						offset: 20,
						spacing: 10,
						z_index: 1000000
					});
					setTimeout(function(){
						location.reload();
					}, 3000);
					return false;
				}
				else
				{
					$.notify({
						message: data.message
					},{
						allow_dismiss: true,
						type: 'info',
						placement: {
							from: "bottom",
							align: "right"
						},
						offset: 20,
						spacing: 10,
						z_index: 1000000
					});
					return false;
				}
				return false;
			}
		});

	});

	$("body").on('click', '.SelfBoost', function()
	{
		var uid = $(this).attr("data-id");
		$elm = $(this);
		$elm.hide();
		$elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
		$.ajax({
			type : 'POST',
			url : "EMRadmin/afunction.php",
			data :  {
				uid : uid,
				type : "SelfBoost"
			},
			success : function(data)
			{
				$(".submit-loading").remove();
				$elm.show();
				var data = jQuery.parseJSON(data);
				if(data.valid)
				{
					$.notify({
						message: data.message
					},{
						allow_dismiss: true,
						type: 'success',
						placement: {
							from: "bottom",
							align: "right"
						},
						offset: 20,
						spacing: 10,
						z_index: 1000000
					});
					setTimeout(function(){
						location.reload();
					}, 3000);
					return false;
				}
				else
				{
					$.notify({
						message: data.message
					},{
						allow_dismiss: true,
						type: 'info',
						placement: {
							from: "bottom",
							align: "right"
						},
						offset: 20,
						spacing: 10,
						z_index: 1000000
					});
					return false;
				}
				return false;
			}
		});

	});

	$("body").on('click', '.DiaBoost', function()
	{
		var uid = $(this).attr("data-id");
		$elm = $(this);
		$elm.hide();
		$elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
		$.ajax({
			type : 'POST',
			url : "EMRadmin/afunction.php",
			data :  {
				uid : uid,
				type : "DiaBoost"
			},
			success : function(data)
			{
				$(".submit-loading").remove();
				$elm.show();
				var data = jQuery.parseJSON(data);
				if(data.valid)
				{
					$.notify({
						message: data.message
					},{
						allow_dismiss: true,
						type: 'success',
						placement: {
							from: "bottom",
							align: "right"
						},
						offset: 20,
						spacing: 10,
						z_index: 1000000
					});
					setTimeout(function(){
						location.reload();
					}, 3000);
					return false;
				}
				else
				{
					$.notify({
						message: data.message
					},{
						allow_dismiss: true,
						type: 'info',
						placement: {
							from: "bottom",
							align: "right"
						},
						offset: 20,
						spacing: 10,
						z_index: 1000000
					});
					return false;
				}
				return false;
			}
		});

	});

	$("body").on('click', '.Boost1', function()
	{
		var uid = $(this).attr("data-id");
		$elm = $(this);
		$elm.hide();
		$elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
		$.ajax({
			type : 'POST',
			url : "EMRadmin/afunction.php",
			data :  {
				uid : uid,
				type : "Boost1"
			},
			success : function(data)
			{
				$(".submit-loading").remove();
				$elm.show();
				var data = jQuery.parseJSON(data);
				if(data.valid)
				{
					$.notify({
						message: data.message
					},{
						allow_dismiss: true,
						type: 'success',
						placement: {
							from: "bottom",
							align: "right"
						},
						offset: 20,
						spacing: 10,
						z_index: 1000000
					});
					setTimeout(function(){
						location.reload();
					}, 3000);
					return false;
				}
				else
				{
					$.notify({
						message: data.message
					},{
						allow_dismiss: true,
						type: 'info',
						placement: {
							from: "bottom",
							align: "right"
						},
						offset: 20,
						spacing: 10,
						z_index: 1000000
					});
					return false;
				}
				return false;
			}
		});

	});
</script>