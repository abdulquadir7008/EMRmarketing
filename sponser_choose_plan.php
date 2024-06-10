<?php
include_once( 'include/configuration.php' );
ob_start();
$SQLproductDetails = "select * from products where status='1' AND seo_keywords='$productDetailsKey'";
$MySQLProductDetails = mysqli_query($link,$SQLproductDetails); 
$ListproductDetails = mysqli_fetch_array($MySQLProductDetails);
$productDetID = $ListproductDetails['id'];
$setpagename;
$parentcat_keyword;

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
							<li><a href="index.html"><i class="icon icon-home"></i></a></li>
							<li>/<span>Choose Plan</span></li>
						</ul>
					</div>
				</div>
				<div class="block" id="cart_table">
					<div class="container">
						<?php if ( $_SESSION[ 'member_id' ] ) {?>
						<h4>The plan choose is mandadatory for Sponser Level</h4>
						<form action="sponser_process.php?user=<?php echo $Custemail;?>" method="post">
							<div class="sponser_plan_input">
								<input type="radio" name="spanser_plan" value="ecommerce" required>
								<strong>Ecommerce</strong><br>
								<p>After clicking Ecommerce, you will directly go to our product list page, then from there you have to purchase a product above Rs. 500, then you will join the sponsor level of our pool income. </p>
							</div>
							<div class="sponser_plan_input">
								<input type="radio" name="spanser_plan" value="2000_plan" required>
								<strong>2000 Amount</strong><br>
								<p>In Rs 2000 plan you have to purchase 2 of our products worth Rs 1000 each. And with this you will get 20% benefit in your wallet. Also you will joined the Sponser and Pool Income. </p>
							</div>
							<div class="sponser_plan_input">
								<input type="radio" name="spanser_plan" value="3000_plan" required>
								<strong>3000 Amount</strong><br>
								<p>In Rs 3000 plan you have to purchase 2 of our products worth Rs 3000 each. And with this you will get 30% benefit in your wallet. Also you will joined the Sponser and Pool Income.</p>
							</div>
<!--							<h5 class="binary-title"><span>Choose root for Binary Income</span></h5>-->
							
                            
                            <input type="hidden" name="binary_status" id="123" class="checkbox target_hit" value="Right">
                            
                         
							<button type="submit" name="sponser_process_submit" class="btn btn-info reeptape">Continue</button>
						</form>
						<?php } else{?>
						
							<?php } ?>
						
					</div>
				</div>
			</main>

    <!-- /Page Content -->
    <?php include('include/footer.php');?>