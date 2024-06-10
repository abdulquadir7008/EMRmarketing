
<?php
include_once( 'include/configuration.php' );
ob_start();
$SQLproductDetails = "select * from products where status='1' AND seo_keywords='$productDetailsKey'";
$MySQLProductDetails = mysqli_query($link,$SQLproductDetails); 
$ListproductDetails = mysqli_fetch_array($MySQLProductDetails);
$productDetID = $ListproductDetails['id'];
$setpagename;
$parentcat_keyword;
if(isset($_REQUEST['Uplace'])){
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
$_SESSION['ordererror'] = $errmsg_arr;
session_write_close();
header('Location: ' . $domain_url.'profile/');	
ob_end_flush();
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
							<li>/<span>Robotic Income</span></li>
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
												<div class="block-title">
													<span>My Account</span>
													<div class="toggle-arrow"></div>
												</div>
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
									<h1>Robotic Income</h1>
								</div>
							</div>
							<!-- /Page Title -->
							<!-- Categories Info -->
							<div class="info-block">
								<div class="dashboard-detail addres-book">
                                                <h4>Robotic History</h4>
                                                  
                    <div class="faq-content tab-content" id="top-tabContent">
                        
                        
                        <div class="tab-pane active" id="orders">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card dashboard-table mt-0">
                                        <div class="card-body table-responsive-sm" style="padding:0;">
                                            
                                            <table id="example" class="display nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sr No</th>
                                                        <th>UserID</th>
                                                        <th>Fullname</th>
                                                        <th>Amount</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                <?php
											
											?>
                                             <?php
                                                $i = 1;
                                                 $brnadSQL="select t1.*,t1.date as dr,t2.* from `robotic_income` t1 join membership t2 on t2.member_id = t1.uid where  t1.amount > 0 and  t1.uid='$customeid' order by t1.id DESC"; 
                                                $ResultSQL=mysqli_query($link,$brnadSQL); 
                                                while($Listbrand=mysqli_fetch_array($ResultSQL)) { 
                                                ?>
                                                    <tr>
                                                        <th><?php echo $i++;?> </th>
                                                        <td><?php echo $Listbrand['userid'];?></td>
                                                        <td><?php echo $Listbrand['fname']." ".$Listbrand['lname'];?> </td>
                                                        <td><?php echo $Listbrand['amount'];?> </td>
                                                        <!-- <td><?php if($Listbrand['spnoser_id']){echo "emr00".$Listbrand['spnoser_id'];}?> </td> -->
                                                        <td><?php echo $Listbrand['dr'];?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tfoot>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="profile">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mt-0">
                                        <div class="card-body">
                                            <div class="dashboard-box">
                                                <div class="dashboard-title">
                                                    <h4>Order</h4>
                                                    <span><a href="profile-edit/">edit</a></span>
                                                </div>
                                                <div class="dashboard-detail">
                                                    <ul>
                                                        <li>
                                                            <div class="details">
                                                                <div class="left">
                                                                    <h6>Fullname name</h6>
                                                                </div>
                                                                <div class="right">
                                                                    <h6><?php echo $customerchechlogin_row['fname']." ".$customerchechlogin_row['lname'];?></h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="details">
                                                                <div class="left">
                                                                    <h6>email address</h6>
                                                                </div>
                                                                <div class="right">
                                                                    <h6><?php echo $customerchechlogin_row['email'];?></h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="details">
                                                                <div class="left">
                                                                    <h6>Country / Region</h6>
                                                                </div>
                                                                <div class="right">
                                                                    <h6><?php echo $customerchechlogin_row['country'];?></h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="details">
                                                                <div class="left">
                                                                    <h6>State</h6>
                                                                </div>
                                                                <div class="right">
                                                                    <h6><?php echo $customerchechlogin_row['state'];?></h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="details">
                                                                <div class="left">
                                                                    <h6>Stree Address</h6>
                                                                </div>
                                                                <div class="right">
                                                                    <h6><?php echo $customerchechlogin_row['stree_address'];?></h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        
                                                        
                                                        <li>
                                                            <div class="details">
                                                                <div class="left">
                                                                    <h6>city</h6>
                                                                </div>
                                                                <div class="right">
                                                                    <h6><?php echo $customerchechlogin_row['city'];?></h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="details">
                                                                <div class="left">
                                                                    <h6>zip</h6>
                                                                </div>
                                                                <div class="right">
                                                                    <h6><?php echo $customerchechlogin_row['postalcode'];?></h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
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