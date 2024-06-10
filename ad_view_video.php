<?php
include_once( 'include/configuration.php' );
ob_start();
$SQLproductDetails = "select * from products where status='1' AND seo_keywords='$productDetailsKey'";
$MySQLProductDetails = mysqli_query( $link, $SQLproductDetails );
$ListproductDetails = mysqli_fetch_array( $MySQLProductDetails );
$productDetID = $ListproductDetails[ 'id' ];
$setpagename;
$parentcat_keyword;
if ( isset( $_REQUEST[ 'Uplace' ] ) && isset( $_SESSION[ 'member_id' ] ) ) {
  $fname = $_REQUEST[ 'fname' ];
  $lname = $_REQUEST[ 'lname' ];
  $phone = $_REQUEST[ 'phone' ];
  $email = $_REQUEST[ 'email' ];
  $country = $_REQUEST[ 'country' ];
  $stree_address = $_REQUEST[ 'stree_address' ];
  $city = $_REQUEST[ 'city' ];
  $state = $_REQUEST[ 'state' ];
  $postalcode = $_REQUEST[ 'postalcode' ];
  $password = md5( $_REQUEST[ 'password' ] );
  $queryatleast = "update membership SET fname='$fname',lname='$lname', date=now(),email='$email',country='$country',stree_address='$stree_address',city='$city', state='$state',postalcode='$postalcode',password='$password' WHERE member_id=$customeid";
  mysqli_query( $link, $queryatleast );
  $errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for profile Update.</div>';
  $errflag = true;
  $_SESSION[ 'profilerror' ] = $errmsg_arr;
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
            <li>/<span>Ad View Income</span></li>
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
                    <a href="#" class="filter-col-toggle"></a> </div>
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
                <h1>Ad View Income</h1>
              </div>
            </div>
            <!-- /Page Title --> 
            <!-- Categories Info -->
            <div class="info-block">
              <div class="dashboard-detail">
                <p><strong>N </strong>If you watch the complete video below then you will get 100 rupees in your wallet as reward, this is for all the videos. And you can spend this Rs 100 only on product repurchase.</p>
                <div class="row">
                  <?php
$ResultSQL = mysqli_query($link, "select * from video WHERE status='1' order by id DESC");
while ($Listbrand = mysqli_fetch_array($ResultSQL)) {
?>
  <div class="col-md-4 adincome">
    <div class="video-list">
		<a href="video_details.php?embed=<?php echo $Listbrand['seo_keyword'];?>">
		<span><img src="images/plybtn.png"></span>
		<?php if($Listbrand['image2']){?>
	  	<img src="<?php echo $video_path.$Listbrand['image2'];?>">
		<?php } else { ?>
			<img src="images/emr-cover.jpg">
		<?php } ?>
		</a>
	  </div>
	  <h5><a href="video_details.php?embed=<?php echo $Listbrand['seo_keyword'];?>"><?php echo $Listbrand['title'];?></a></h5>
  </div>
<?php } ?>
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