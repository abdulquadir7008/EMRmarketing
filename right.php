
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
							<li>/<span>Right Team</span></li>
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
									<h1>Right Team</h1>
								</div>
							</div>
							<!-- /Page Title -->
							<!-- Categories Info -->
							<div class="info-block">
								<div class="dashboard-detail addres-book">
                                        <h4>Right Team</h4>
                                                  
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
                                                                                <th>Plan Amount</th>
                                                                                <th>Date</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tfoot>
                                                                        <?php
                                                                        $i = 1;
                                                                        $res1=GetUserByPos($db,$customeid,'R');
                                                                        $res2='';
                                                                        if(count($res1) > 0)
                                                                        {
                                                                            $res2=implode(',',$res1);
                                                                            $brnadSQL="select t2.* from membership t2 WHERE t2.member_id in ($res2) order by t2.member_id desc"; 
                                                                            // $sql="SELECT t1.uid as ttid,t1.*,t4.first_name,t4.last_name,t4.mobile from user_id t1 left join user_detail t4 on t1.uid=t4.uid  where t1.uid in ($res2) $cond order by t1.uid desc";
                                                                        }
                                                                        else
                                                                        {
                                                                            $brnadSQL="select t2.* from membership t2 WHERE t2.member_id in ('') order by t2.member_id desc"; 
                                                                            // $sql="SELECT t1.uid as ttid,t1.*,t4.first_name,t4.last_name,t4.mobile from user_id t1 left join user_detail t4 on t1.uid=t4.uid  where t1.uid in ('') $cond order by t1.uid desc";
                                                                        }
                                                                        // $brnadSQL="select t1.*,t2.* from pairing t1 join membership t2 on t2.member_id = t1.uid WHERE t1.position = 'L' and t1.uid = $customeid"; 
                                                                        $ResultSQL=mysqli_query($link,$brnadSQL); 
                                                                        while($Listbrand=mysqli_fetch_array($ResultSQL)) { 
                                                                        ?>

                                                                        <tr>
                                                                            <td><?php echo $i++;?> </td>
                                                                            <td><?php echo $Listbrand['userid'];?></td>
                                                                            <td><?php echo $Listbrand['fname']." ".$Listbrand['lname'];?> </td>
                                                                            <td><?php if($Listbrand['binary_status'] == 1){echo "2000_plan";}elseif($Listbrand['binary_status'] == 2){echo "3000_plan";}elseif($Listbrand['binary_status'] == 3){echo "In-Active";}else{echo"In-Active";}?> </td>
                                                                            <td><?php echo $Listbrand['date'];?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                        </tfoot>
                                                                    </table>

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