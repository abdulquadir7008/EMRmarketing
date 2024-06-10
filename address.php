<?php
include_once( 'include/configuration.php' );
$SQLproductDetails = "select * from products where status='1' AND seo_keywords='$productDetailsKey'";
$MySQLProductDetails = mysqli_query($link,$SQLproductDetails); 
$ListproductDetails = mysqli_fetch_array($MySQLProductDetails);
$productDetID = $ListproductDetails['id'];
$setpagename;
$parentcat_keyword;
if(isset($_REQUEST['addressUpd']) && isset($_SESSION['member_id'])){
    $country=$_REQUEST['country'];
    $stree_address=$_REQUEST['stree_address'];
    $city=$_REQUEST['city'];
    $postalcode=$_REQUEST['postalcode'];
    $landmark=$_REQUEST['landmark'];
	$queryatleast="update membership SET country='$country',city='$city',stree_address='$stree_address', 
    date=now(),postalcode='$postalcode',landmark='$landmark' WHERE member_id=$customeid";
	mysqli_query($link,$queryatleast);
	$errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for profile Update.</div>';
$errflag = true;
$_SESSION['addresserror'] = $errmsg_arr;
session_write_close();
echo "<script type='text/javascript'>window.location.href = 'profile/';</script>";
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
							<li>/<span>Address Book</span></li>
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
									<h1>Address Book</h1>
								</div>
							</div>
							<!-- /Page Title -->
							<!-- Categories Info -->
							<div class="info-block">
								<div class="dashboard-detail addres-book">
                                                <h4>Shipping Address</h4>
                                                    <div class="inform_h4">
                                                    <form class="theme-form" action="address.php" method="post" enctype="multipart/form-data">
                                
                                <div class="row form-row">
                                    
                                    <div class="col-md-6">
                                        <label class="field-label">Country *</label>
                                        <select name="country" class="form-control">
                                        <option value="IN">India</option>
                                       
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label">Address *</label>
                                        <input type="text" name="stree_address" class="form-control" placeholder="Street address" value="<?php echo $customerchechlogin_row['stree_address'];?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label">Land Mark *</label>
                                        <input type="text" name="landmark" class="form-control" placeholder="landmark" value="<?php echo $customerchechlogin_row['landmark'];?>">
                                    </div>
									
									<div class="col-md-6">
                                        <label class="field-label">State *</label>
                                       <select name="state" class="form-control" required onChange="showCity(this);">
					  <option>--Select State -- </option>
					  <?php
$stateSql = mysqli_query( $link, "select * from states order by name ASC" );
while($stateSqli = mysqli_fetch_array( $stateSql )){
	if($customerchechlogin_row['state']==$stateSqli['id']){
		$selected = "selected";
	}
	else{
		$selected = "";
	}
	echo "<option value='".$stateSqli['id']."' ".$selected." >".$stateSqli['name']."</option>";
}
?>
					</select>
                                    </div>
									
                                    <div class="col-md-6">
                                        <label class="field-label">Town/City *</label>
                                        <select class="form-control" name="city" id="cityoutput" required>
											<?php
$stateSqlt = mysqli_query( $link, "select * from cities WHERE state_id='".$customerchechlogin_row['state']."' order by city ASC" );
while($stateSqlit = mysqli_fetch_array( $stateSqlt )){
	if($customerchechlogin_row['city']==$stateSqlit['id']){
		$selected = "selected";
	}
	else{
		$selected = "";
	}
	echo "<option value='".$stateSqlit['id']."' ".$selected." >".$stateSqlit['city']."</option>";
}
?>
					</select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="field-label">Postal Code *</label>
                                        <input type="text" name="postalcode" class="form-control" placeholder="Postal Code" value="<?php echo $customerchechlogin_row['postalcode'];?>">
                                    </div>
                                    
                                    
                                </div>
							 <button type="submit" class="btn-solid btn" name="addressUpd" style="margin-top:20px">Update</button>
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