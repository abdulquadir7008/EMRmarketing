<?php
include_once( 'include/configuration.php' );
//echo print_r( $_GET );


error_reporting( E_ALL );
ini_set( 'display_errors', '0' );
if(isset($_REQUEST['tid'])){
	$tid = $_REQUEST['tid'];
	
}
$logs_sql = "select * from datalogs WHERE bank_ref_no='$tid'";
$result_logs = mysqli_query( $link, $logs_sql );
$listlg = mysqli_fetch_array( $result_logs );
$custEmail = $listlg[ 'email' ];
$subtotalRow = $listlg[ 'total' ];
$datalogid = $listlg[ 'dil_id' ];
$custID = $listlg[ 'member_id' ];
$_SESSION[ 'member_id' ] = $custID;
$sess = $listlg[ 'sess' ];
$order_id= $listlg[ 'merchant_reference' ];
$customerchechlogin_resu = mysqli_query( $link, "select * from membership INNER JOIN states ON membership.state = states.id INNER JOIN cities ON membership.city = cities.id  WHERE member_id=$custID and status='2'" );
$customerchechlogin_row = mysqli_fetch_array( $customerchechlogin_resu );
$quvrry = $db->query( "select * from orderproduct WHERE customer_email='$custEmail' and Orderid = '$order_id'" );
$ffq = $quvrry->num_rows;
if ( $ffq < 0 ) {
	echo "test";
  ?>
<script>
		// Function to redirect after 5 seconds
		setTimeout(function() {
			window.location.href = "profile.php"; // Redirect to profile.php
		}, 1000); // 5000 milliseconds = 5 seconds
	</script>
<?php
} else {
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
      if ( $tid ) {


        ?>
      <div class="success-text">
        <div class="checkmark">
          <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
            <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z"> </path>
          </svg>
          <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
            <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z"> </path>
          </svg>
          <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
            <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z"> </path>
          </svg>
          <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
            <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z"> </path>
          </svg>
          <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
            <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z"> </path>
          </svg>
          <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
            <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z"> </path>
          </svg>
          <svg class="checkmark__check" height="36" viewBox="0 0 48 36" width="48"
                                xmlns="http://www.w3.org/2000/svg">
            <path
                                    d="M47.248 3.9L43.906.667a2.428 2.428 0 0 0-3.344 0l-23.63 23.09-9.554-9.338a2.432 2.432 0 0 0-3.345 0L.692 17.654a2.236 2.236 0 0 0 .002 3.233l14.567 14.175c.926.894 2.42.894 3.342.01L47.248 7.128c.922-.89.922-2.34 0-3.23"> </path>
          </svg>
          <svg class="checkmark__background" height="115" viewBox="0 0 120 115" width="120"
                                xmlns="http://www.w3.org/2000/svg">
            <path
                                    d="M107.332 72.938c-1.798 5.557 4.564 15.334 1.21 19.96-3.387 4.674-14.646 1.605-19.298 5.003-4.61 3.368-5.163 15.074-10.695 16.878-5.344 1.743-12.628-7.35-18.545-7.35-5.922 0-13.206 9.088-18.543 7.345-5.538-1.804-6.09-13.515-10.696-16.877-4.657-3.398-15.91-.334-19.297-5.002-3.356-4.627 3.006-14.404 1.208-19.962C10.93 67.576 0 63.442 0 57.5c0-5.943 10.93-10.076 12.668-15.438 1.798-5.557-4.564-15.334-1.21-19.96 3.387-4.674 14.646-1.605 19.298-5.003C35.366 13.73 35.92 2.025 41.45.22c5.344-1.743 12.628 7.35 18.545 7.35 5.922 0 13.206-9.088 18.543-7.345 5.538 1.804 6.09 13.515 10.696 16.877 4.657 3.398 15.91.334 19.297 5.002 3.356 4.627-3.006 14.404-1.208 19.962C109.07 47.424 120 51.562 120 57.5c0 5.943-10.93 10.076-12.668 15.438z"> </path>
          </svg>
        </div>
        <h2>Thank You</h2>
        <p><strong>Order is successfully processsed and your order is on the way.</strong></p>
        <p style="font-weight-bold; ">Order ID:<span style="text-transform: uppercase;"><?php echo $order_id; ?></span></p>
      </div>
      <section class="section-b-space">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="product-order">
                <?php

		  	$order_sub_total = 0;
		  
                $sql_order = "select * from orderproduct WHERE customer_email='$custEmail' AND datalogid='$datalogid'";
                $result_order = mysqli_query( $link, $sql_order );
                while ( $row_order = mysqli_fetch_array( $result_order ) ) {
                  $cart_prod_id = $row_order[ 'product_id' ];
                  $sqlwishDel = "delete from wishlist where product_id='$cart_prod_id' AND userid='$custID'";
                  mysqli_query( $link, $sqlwishDel );
                  $product_cart = "select * from products where id='$cart_prod_id'";
                  $result_product_cart = mysqli_query( $link, $product_cart );
                  $List_product_cart = mysqli_fetch_array( $result_product_cart );


             
                  ?>
                <div class="row product-order-detail">
                  <div class="col-3 prodCoverImg"><img src="<?php echo $domain_url.$product_paath.$List_product_cart['image2']; ?>" alt=""
                                    class="img-fluid blur-up lazyload"></div>
                  <div class="col-5 order_detail">
                    <div>
                      <h4>product name</h4>
                      <h5><?php echo $List_product_cart['title'];?></h5>
                      <div class="road-list-crupm row" style="margin-left: 0;position: relative">
                        <?php
                        if ( $row_order[ 'varient_names' ] ) {
                          echo $codeMt = "<strong>Size: </strong>" . $row_order[ 'varient_names' ];
                        }
                        if ( $row_order[ 'verientlist' ] ) {
                          echo $codemt2 = ", <strong>Color: </strong><span style='width:15px;position: absolute;margin-top: 4px; margin-left:5px; border-radius: 100%; height:15px; background:" . $row_order[ 'verientlist' ] . "'></span>";
                        }
                     
                        ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-2 order_detail">
                    <div>
                      <h4>quantity</h4>
                      <h5><?php echo $row_order['qty'];?></h5>
                    </div>
                  </div>
                  <div class="col-2 order_detail">
                    <div>
                      <h4>price</h4>
                      <?php echo number_format($row_order['price'],2, '.', ',');?> </div>
                  </div>
                </div>
                <?php
                $order_total = $row_order[ 'price' ]  * $row_order[ 'qty' ] ;
                $order_sub_total +=  $order_total;
                $wg_total = $List_product_cart[ "weight" ] * $row_order[ 'qty' ];

//                $wgtotal = ( $wgtotal + $wg_total );
//                $Lntotal = ( $Lntotal + $List_product_cart[ "length" ] );
//                $cwtotal = ( $cwtotal + $List_product_cart[ "width" ] );
//                $qhtotal = ( $qhtotal + $List_product_cart[ "height" ] );
//                $cubeswh = ( $cubeswh + $List_product_cart[ "cubicweight" ] );

     
                }
                ?>
                <div class="total-sec">
                  <ul>
                    <li>subtotal <span>
                      <?php  $subtotal= $order_sub_total;?>
                      <?php echo $order_sub_total ;?></span></li>
                    
                    <?php
				
					$reason_discount = '';
                    if ( $listlg['reason_discount'] ) {
                      $maxDiscountPercentage = 50;
                      $totalAmount = $order_sub_total;

                      // Calculate the maximum discount amount allowed (50% of the total amount)
                      $maxDiscountAmount = $totalAmount * ( $maxDiscountPercentage / 100 );

                      // Check if the ad view wallet amount is greater than the maximum discount amount
                    

                      // Calculate the remaining amount after applying the discount
                      $remainingAmount = $totalAmount - $maxDiscountAmount;
                      $subtotal = $remainingAmount;
                   
                      ?>
                    <li><?php echo $listlg['reason_discount'];?> : <span><?php echo $maxDiscountAmount;?></span></li>
                    <?php 
                    }
                    
		 
                    ?>
                    <li>Tax : <span> <span class="count"> <?php echo $tax=number_format($subtotal * 18 / 100,2, '.', ',') ?><span class='mibaed'>INR</span> </span></li>
                    
                  </ul>
                </div>
                <div class="final-total">
                  <h3>Total <span> <?php echo number_format ( ( $subtotal + $tax ), 2, '.', ',' );
                  ?> </span></h3>
					
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="order-success-sec">
                <div class="row">
                  <div class="col-sm-6">
                    <h4>summery</h4>
                    <ul class="order-detail">
                      <li>order ID: <?php echo $order_id;?></li>
                      <li>Order Date: <?php echo date("d M Y"); ?></li>
                      <li>Order Total: <?php echo ($order_sub_total + $tax);?></li>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <h4>shipping address</h4>
                    <ul class="order-detail">
                      <li><?php echo $customerchechlogin_row['stree_address'];?> </li>
                      <li><?php echo $customerchechlogin_row['city'];?></li>
                      <li>Contact No. <?php echo $customerchechlogin_row['phone'];?></li>
                    </ul>
                  </div>
                  <div class="col-md-12">
                    <div class="delivery-sec">
                      <h3>expected date of delivery: <span><?php echo $lastWeek = date("d M, Y", strtotime("+7 days"));?></span></h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php
      }  
      ?>
    </div>
    <div class="divider"></div>
    </main>
    <!-- /Page Content -->
    <?php include('include/footer.php');?>
<?php } ?>