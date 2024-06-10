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
							<li>/<span>Order</span></li>
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
									<h1>Order</h1>
								</div>
							</div>
							<!-- /Page Title -->
							<!-- Categories Info -->
							<div class="info-block">
								<div class="dashboard-detail addres-book">
                                                <h4>Order Details</h4>
                                                  
                    <div class="faq-content tab-content" id="top-tabContent">
                        
                        
                        <div class="tab-pane active" id="orders">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card dashboard-table mt-0">
                                        <div class="card-body table-responsive-sm" style="padding:0;">
                                            
                                            <div class="row">
<?php
$order_email= $customerchechlogin_row['email'];
$sql_logs = "select * from datalogs where email='$order_email' order by indate DESC";	
			$res_logs = mysqli_query($link,$sql_logs);
            if(mysqli_num_rows($res_logs)>0){      
				while($listlogs = mysqli_fetch_array($res_logs)){
$datalog_id = $listlogs['dil_id'];

    
$sql_order="select * from orderproduct WHERE datalogid='$datalog_id' order by date DESC"; 
$result_order=mysqli_query($link,$sql_order);
if(mysqli_num_rows($result_order)>0){ 
while($row_order=mysqli_fetch_array($result_order)) {
	$cart_prod_id = $row_order['product_id'];
    $order_id = $row_order['order_id'];
	$product_cart = "select * from products where id='$cart_prod_id'";	
			$result_product_cart = mysqli_query($link,$product_cart); 
				$List_product_cart = mysqli_fetch_array($result_product_cart);

	?>
    
    <div class ="trans-order col-md-3 <?php if($row_order['rt']=='1'){echo "prodreturn";}?>">
    <?php if($row_order['rt']=='1'){?>
    <div class="distrk"><span>Requested for Return </span></div>
<?php } ?>
        <div class="col-md-12 order-transc"> Order ID : 
        <?php if($row_order['transaction_id']){echo $row_order['transaction_id'];}
    if($row_order['Orderid']){echo $row_order['Orderid'];}	
			?>

        </div>
        <div class="row">
    <div class="order-img">
        <img src="<?php echo $domain_url.$product_paath.$List_product_cart['image2']; ?>" alt="" class="img-fluid blur-up lazyload">
    </div>
    <div class="order-prod-title">
        <h4><?php echo $List_product_cart['title'];?></h4>
        <?php if($_SESSION['currency'] == 'dollar'){?>
            <h5> $ <?php echo number_format( $row_order['price'] / $curr_rate,2, '.', ',');?></h5>
            <?php }else { ?>
        <h5><span class='mibaed'></span><?php echo $row_order['price'];?></h5>
        <?php } ?>
<!--
        <a href="order-track.php?prod=<?php echo $order_id;?>&&shipid=<?php echo $shipment;?>" style="color:#fff; float:left; background: #000; padding: 5px 10px; font-weight: bold;">Track Order</a>
        <a href="include/return.php?return=<?php echo $order_id;?>" style="color:#000; float:right; padding: 5px 10px; text-decoration: underline; font-weight: bold;">Return</a>
-->
    </div>
</div>
    

    </div>


                                                    
                                                    <?php } } } }  else{ ?>
                                                            <div class="container-fluid mt-100">
    <div class="row">
        <div class="col-md-12">
           
                
                <div class="card-body cart">
                    <div class="col-sm-12 empty-cart-cls text-center"> <img src="assets/images/cartemty.png" width="130" height="130" class="img-fluid mb-4 mr-3">
                        <h3><strong>Your Order is Empty</strong></h3>
                        <h4>Add something to make me happy.</h4> 
                        
                    </div>
               
            </div>
        </div>
    </div>
</div>
                                                            <?php } 
                                                           
                                                            ?>
</div>  
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