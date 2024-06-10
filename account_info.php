<?php
include_once( 'include/configuration.php' );
$SQLproductDetails = "select * from products where status='1' AND seo_keywords='$productDetailsKey'";
$MySQLProductDetails = mysqli_query($link,$SQLproductDetails); 
$ListproductDetails = mysqli_fetch_array($MySQLProductDetails);
$productDetID = $ListproductDetails['id'];
$setpagename;
$parentcat_keyword;
if(isset($_REQUEST['account_update']) && isset($_SESSION['member_id'])){
$fname=$_REQUEST['fname'];
$lname=$_REQUEST['lname'];
$phone=$_REQUEST['phone'];
$email=$_REQUEST['email'];
$altphone=$_REQUEST['altphone'];
//$phone_code=$_REQUEST['phone_code'];	
$password=md5($_REQUEST['password']);
	$queryatleast="update membership SET fname='$fname',lname='$lname', date=now(),email='$email',phone='$phone',altphone='$altphone' WHERE member_id=$customeid";
	mysqli_query($link,$queryatleast);
	$errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for profile Update.</div>';
$errflag = true;
$_SESSION['acounterror'] = $errmsg_arr;
echo "<script type='text/javascript'>window.location.href = 'profile/';</script>";
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
							<li>/<span>Account Information</span></li>
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
									<h1>Account Information</h1>
								</div>
							</div>
							<!-- /Page Title -->
							<!-- Categories Info -->
							<div class="info-block">
								<div class="dashboard-detail addres-book">
                                                <h4>Account Information</h4>
                                                    <div class="inform_h4">
                            <form class="theme-form" action="account_info.php" method="post" enctype="multipart/form-data">
                                
                                <div class="row form-row">
                                    <div class="col-md-6">
                                        <label class="field-label">First Name *</label>
                                        <input type="text" name="fname" value="<?php echo $customerchechlogin_row['fname'];?>" class="form-control" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label">Last Name *</label>
                                      <input type="text" name="lname" class="form-control" placeholder="Last Name" value="<?php echo $customerchechlogin_row['lname'];?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label">Phone *</label>
										<div>
										
                                        <input type="text" name="phone" class="form-control" placeholder="Phone" value="<?php echo $customerchechlogin_row['phone'];?>">
										</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label">Email Address *</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email Address" value="<?php echo $customerchechlogin_row['email'];?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label">Alternate number  </label>
                                        <input type="text" name="altphone" class="form-control" placeholder="Phone" value="<?php echo $customerchechlogin_row['altphone'];?>">
                                    </div>
									
                                    
                                    
                                </div>
							 <button type="submit" class="btn-solid btn" name="account_update" style="margin-top:20px">Update</button>
						</form> 
                                                    
                                                    </div>

                                                    
                                                    
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