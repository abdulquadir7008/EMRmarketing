<?php include_once( 'include/configuration.php' );
ob_start();
$SQLproductDetails = "select * from products where status='1' AND seo_keywords='$productDetailsKey'";
$MySQLProductDetails = mysqli_query($link,$SQLproductDetails); 
$ListproductDetails = mysqli_fetch_array($MySQLProductDetails);
$productDetID = $ListproductDetails['id'];
$setpagename;
$parentcat_keyword;
if($customerchechlogin_id!=0 && $customerchechlogin_row['member_id']!=''){
	echo '<script type="text/javascript">
           window.location = "'.$domain_url.'profile/"
     </script>';
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
<!-- Page Content -->
<main class="page-main">
				<div class="block">
					<div class="container">
						<ul class="breadcrumbs">
							<li><a href="index.html"><i class="icon icon-home"></i></a></li>
							<li>/<span>Reset Password</span></li>
						</ul>
					</div>
				</div>
				<div class="block">
					<div class="container">
						<div class="row row-eq-height">
							
							<div class="col-sm-6">
								<div class="form-card">
									<h4>Reset Password</h4>
									
									
									<form class="theme-form" name="cutomber" id="cutomber" method="post" action="include/forgotpass_script.php" enctype="multipart/form-data">
          <div class="formpanel">
            <div class="formrow">
            <input type="password" class="form-control" name="password" placeholder="Type Your New Password">
            <input type="hidden" class="form-control" name="uniqid" value="<?php if(isset($_REQUEST['reset'])){ echo $_REQUEST['reset']; } ?>">
            </div>
            
            <input type="submit" name="updatepassword" class="btn btn-solid" value="Submit">
          </div>
          </form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
    <!-- /Page Content -->
    <?php include('include/footer.php');?>