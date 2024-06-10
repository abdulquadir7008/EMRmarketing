<style>
    #loader-wrapper {
        display: none !important;
    }
</style>
<?php  include_once( 'include/configuration.php' );

require 'vendor_email/autoload.php';
$email = new \SendGrid\Mail\Mail();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include('Crypto.php');
// $workingKey='2B26BCF6A0B3C3CD187862CEFDB36526';		//Working Key should be provided here.
// 	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
// 	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
// 	$order_status="";
// 	$decryptValues=explode('&', $rcvdString);
// 	$dataSize=sizeof($decryptValues);
// 	echo "<center>";

// 	for($i = 0; $i < $dataSize; $i++) 
// 	{
// 		$information=explode('=',$decryptValues[$i]);
// 		if($i==0)	$order_id=$information[1];
// 		if($i==1)	$tracking_id=$information[1];
// 		if($i==2)	$bank_ref_no=$information[1];
// 		if($i==3)	$order_status=$information[1];
// 		if($i==5)	$payment_mode=$information[1];
// 		if($i==10)	$succammount=$information[1];
// 	}
$order_status="Success";
$logs_sql="select * from datalogs WHERE merchant_reference='65ca1138d59c0'";
$result_logs=mysqli_query($link,$logs_sql);
$listlg=mysqli_fetch_array($result_logs);
$custEmail = $listlg['email'];
$subtotalRow = $listlg['total'];
$plan = $listlg['plan'];
$subtotal = decrypt($subtotalRow, $key);
$datalogid= $listlg['dil_id'];
$custID= 292;
$_SESSION[ 'member_id' ]=$custID;
$sess=$listlg['sess'];
$customerchechlogin_resu = mysqli_query( $link,  "select * from membership WHERE member_id=$custID and status='2'" );
$customerchechlogin_row = mysqli_fetch_array( $customerchechlogin_resu );

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
						 if($order_status==="Success")
	{ 
			
				
						 
						 ?>
		

<div class="success-text">
                        <div class="checkmark">
                            <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                </path>
                            </svg>
                            <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                </path>
                            </svg>
                            <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                </path>
                            </svg>
                            <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                </path>
                            </svg>
                            <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                </path>
                            </svg>
                            <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                </path>
                            </svg>
                            <svg class="checkmark__check" height="36" viewBox="0 0 48 36" width="48"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M47.248 3.9L43.906.667a2.428 2.428 0 0 0-3.344 0l-23.63 23.09-9.554-9.338a2.432 2.432 0 0 0-3.345 0L.692 17.654a2.236 2.236 0 0 0 .002 3.233l14.567 14.175c.926.894 2.42.894 3.342.01L47.248 7.128c.922-.89.922-2.34 0-3.23">
                                </path>
                            </svg>
                            <svg class="checkmark__background" height="115" viewBox="0 0 120 115" width="120"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M107.332 72.938c-1.798 5.557 4.564 15.334 1.21 19.96-3.387 4.674-14.646 1.605-19.298 5.003-4.61 3.368-5.163 15.074-10.695 16.878-5.344 1.743-12.628-7.35-18.545-7.35-5.922 0-13.206 9.088-18.543 7.345-5.538-1.804-6.09-13.515-10.696-16.877-4.657-3.398-15.91-.334-19.297-5.002-3.356-4.627 3.006-14.404 1.208-19.962C10.93 67.576 0 63.442 0 57.5c0-5.943 10.93-10.076 12.668-15.438 1.798-5.557-4.564-15.334-1.21-19.96 3.387-4.674 14.646-1.605 19.298-5.003C35.366 13.73 35.92 2.025 41.45.22c5.344-1.743 12.628 7.35 18.545 7.35 5.922 0 13.206-9.088 18.543-7.345 5.538 1.804 6.09 13.515 10.696 16.877 4.657 3.398 15.91.334 19.297 5.002 3.356 4.627-3.006 14.404-1.208 19.962C109.07 47.424 120 51.562 120 57.5c0 5.943-10.93 10.076-12.668 15.438z">
                                </path>
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
$main_wallet = '0';
if($plan == '2000_plan'){
    echo "f";
    AddTopCount($db,$custID,"200");
    $type=1;
    $cds = BoostIncome($db,$custID,$type,$subtotalRow,2);

    $ts = CheckSelfPool($db);

    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select `sponsor_id` from `pairing` where `uid`='$custID'"));
    $nnsponsor_id = $nparent_idd['sponsor_id'];

    $r=mysqli_fetch_assoc(mysqli_query($db,"SELECT `percent` FROM `admin_login` WHERE `admin_id`='1' "));
    $percent=$r['percent'];

    $q83 = mysqli_query($db,"INSERT INTO `sponsor_income`(`uid`,`amount`,`date`) VALUES ($nnsponsor_id,'$percent',now())");
}
elseif($plan == '3000_plan'){
    AddTopCount($db,$custID,"300");
    $type=1;
    $cds = BoostIncome($db,$custID,$type,$subtotalRow,2);

    $ts = CheckSelfPool($db);

    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select `sponsor_id` from `pairing` where `uid`='$custID'"));
    $nnsponsor_id = $nparent_idd['sponsor_id'];

    $r=mysqli_fetch_assoc(mysqli_query($db,"SELECT `percent` FROM `admin_login` WHERE `admin_id`='1' "));
    $percent=$r['percent'];

    $q83 = mysqli_query($db,"INSERT INTO `sponsor_income`(`uid`,`amount`,`date`) VALUES ($nnsponsor_id,'$percent',now())");
}
if($_SESSION['sponserplan']=='2000_plan'){
	$discountAmount = $succammount * (20 / 100);
	$cus_wallet_total = $customerchechlogin_row['main_wallet'];
	$main_wallet = $cus_wallet_total + $discountAmount;
mysqli_query($link,"insert into sponser_benift(user_id,amount,plan_type,gen_date) values('$custID','$discountAmount','2000_plan',now())");
} else if($_SESSION['sponserplan']=='3000_plan'){
	$discountAmount = $succammount * (30 / 100);
	$cus_wallet_total = $customerchechlogin_row['main_wallet'];
	$main_wallet = $cus_wallet_total + $discountAmount;
	mysqli_query($link,"insert into sponser_benift(user_id,amount,plan_type,gen_date) values('$custID','$discountAmount','2000_plan',now())");
}
							 
$sql_cart="select * from cart WHERE sess='$sess'"; 
$result_cart=mysqli_query($link,$sql_cart);
	
while($row_cart=mysqli_fetch_array($result_cart)) { 
$price=$row_cart['price'];
$qty=$row_cart['qty'];
$product_id=$row_cart['product_id'];
$varient_names=$row_cart['varient_names'];
$verientlist=$row_cart['verientlist'];

$query_order="insert into orderproduct(price,qty,product_id,varient_names,verientlist,sess,customer_email,date,Orderid,datalogid) values('$price','$qty','$product_id','$varient_names','$verientlist','$sess','$custEmail',now(),'$order_id','$datalogid')";
mysqli_query($link,$query_order);
}
$sql_order="select * from orderproduct WHERE customer_email='$custEmail' AND datalogid='$datalogid'"; 
$result_order=mysqli_query($link,$sql_order); 
while($row_order=mysqli_fetch_array($result_order)) {
	$cart_prod_id = $row_order['product_id'];
	$sqlwishDel="delete from wishlist where product_id='$cart_prod_id' AND userid='$custID'";
	mysqli_query($link,$sqlwishDel);
		$product_cart = "select * from products where id='$cart_prod_id'";	
			$result_product_cart = mysqli_query($link,$product_cart); 
				$List_product_cart = mysqli_fetch_array($result_product_cart);
                
                $order_qty = $row_order['qty'];
                $real_prod_stock = $List_product_cart['inventory'];
                $product_stock_inventory = $real_prod_stock - $order_qty;

                $query4007008="update products SET inventory='$product_stock_inventory' WHERE id=$cart_prod_id";
	            mysqli_query($link,$query4007008);


	
?>
                        <div class="row product-order-detail">
                            <div class="col-3 prodCoverImg"><img src="<?php echo $domain_url.$product_paath.$List_product_cart['image2']; ?>" alt=""
                                    class="img-fluid blur-up lazyload"></div>
                            <div class="col-5 order_detail">
                                <div>
                                    <h4>product name</h4>
                                    <h5><?php echo $List_product_cart['title'];?></h5>
									
									<div class="road-list-crupm row" style="margin-left: 0;">
										<?php
												$tags = preg_replace('/,+/', ',', $row_order['varient_names']);
													 $splittedstring=explode(",",$tags);
														foreach ($splittedstring as  $value) {
															echo "<div class='col-md-5'><i>".$value." : </i></div>";
															$codeMt ="<div class='col-md-5'><i>".$value." : </i></div>";
														}
										?>
									<?php
													$tags2 = preg_replace('/,+/', ',', $row_order['verientlist']);
	 														$splittedstring2=explode(",",$tags2);
														foreach ($splittedstring2 as  $value2) {
															echo "<div class='col-md-5'><i>".$value2."</i></div>";
															$codemt2 ="<div class='col-md-5'><i>".$value2."</i></div>";
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
                                   <?php echo number_format($row_order['price'],2, '.', ',');?>
                                </div>
                            </div>
                        </div>
						
						<?php $order_total=str_replace(',','',$row_order['price'])*str_replace(',','',$row_order['qty']);
  						$order_sub_total= ($order_sub_total + $order_total);
                          $wg_total = $List_product_cart["weight"] * $row_order['qty'];

                            $wgtotal = ($wgtotal + $wg_total);
                            $Lntotal = ($Lntotal + $List_product_cart["length"]);
                            $cwtotal = ($cwtotal + $List_product_cart["width"]);
                            $qhtotal = ($qhtotal + $List_product_cart["height"]);
                            $cubeswh = ($cubeswh + $List_product_cart["cubicweight"]);

$newsdet .="<tr><td style='border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 10px'><img src='".$domain_url.$product_paath.$List_product_cart['image2']."' alt='' width='70'>
</td><td valign='top' style='border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 10px'><h5 style='margin-top: 15px;'>".$List_product_cart['title'].$codeMt.$codemt2."</h5></td><td valign='top' style='border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 10px'><h5 style='font-size: 14px; color:#444;margin-top: 10px;'>QTY : <span>".$row_order['qty']."</span></h5></td>
<td valign='top' style='border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 10px'><h5 style='font-size: 14px; color:#444;margin-top:15px'><b>".$row_order['price']."</b></h5></td></tr>";
} ?>
                        
						
						<div class="total-sec">
                            <ul>
                            
                                <li>subtotal <span><?php echo $order_sub_total ;?></span></li>
								<?php if ($listlg['reason_discount']){?>
								
								<li><?php echo $listlg['reason_discount'];?> : <span><?php echo $order_sub_total = $order_sub_total /2 ;?></span></li>
								
                                <?php $ad_icncome_sql = mysqli_query( $link, "select * from ad_view_wallet WHERE user_id='$custID'" );
			 $list_income = mysqli_fetch_array( $ad_icncome_sql );
				$walletamount = $list_income['wallet'];
																	  $wallet_update = $list_income['wallet'] -$order_sub_total; 
																	  mysqli_query($link,"update ad_view_wallet SET wallet='$wallet_update' WHERE user_id='$custID'");
																	 }?>
                                                      
                                                    <li>Tax :  <span>
                                                   
                                            <span class="count">  <?php echo $tax=number_format($order_sub_total * 18 / 100,2, '.', ',') ?><span class='mibaed'>INR</span>
                                  
                                                      
                                                    
                                                    </span></li>
                                                   


                                           
                                
                            </ul>
                        </div>
                        <div class="final-total">
                            <h3>total <span>
                            <?php echo number_format(($order_sub_total + $tax),2, '.', ',' );
                                         ?>
                               
                            
                            </span></h3>
							
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
                                    <li><?php echo $customerchechlogin_row['stree_address'].$landk;?>
                                    </li>
                                    <li><?php echo $customerchechlogin_row['city'];?></li>
                                    <li>Contact No. <?php echo $customerchechlogin_row['phone_code']." ".$customerchechlogin_row['phone'];?></li>
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
						 
	$codTotal = $order_sub_total + $tax;

$msg="<div style='margin: auto; text-align: center; padding: 0 30px;background-color: #f9f9f9; -webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);width: 100%; width: 700px;'>
 <table align='center' border='0' cellpadding='0' cellspacing='0' style='width: 100%;'>
        <tbody>
            <tr>
                <td>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
                        <tr align='left'>
                            <td>
                                <img src='".$domain_url."images/logo.jpg' alt=''
                                    style=';margin-bottom: 30px; width: 100px; padding-top: 20px'>
                            </td>
                        </tr>
                        <tr align='center'>
                            <td>
                                <img src='".$domain_url."images/success.png' alt=''>
                            </td>
                        </tr>
                        <tr align='center'>
                            <td>
                                <h2 style='font-size: 22px; margin: 10px 0'>Thank You</h2>
                            </td>
                        </tr>
                        <tr align='center'>
                            <td>
                                <p>Payment Is Successfully Processsed And Your Order Is On The Way</p>
                                <p>Oder ID:".$order_id."</p>
                            </td>
                        </tr>
                        <tr>

                            <td>
                                <div style='border-top:1px solid #777;height:1px;margin-top: 30px;'>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src='../assets/images/email-temp/order-success.png' alt=''
                                    style='margin-top: 30px;'>
                            </td>
                        </tr>
                    </table>
                    <h2 style='margin: 30px 0; font-size: 1.4em;'>YOUR ORDER DETAILS</h2>
                    <table class='order-detail' border='0' cellpadding='0' cellspacing='0' align='left' style='border: 1px solid #ddd; width: 100%'>
                        <tr align='left'>
                            <th style='border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 10px'>PRODUCT</th>
                            <th style='border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 10px'>DESCRIPTION</th>
                            <th style='border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 10px'>QUANTITY</th>
                            <th style='border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 10px'>PRICE </th>
                        </tr>
                        ".$newsdet."
                        <tr>
                            <td colspan='2' style='line-height: 49px;font-size: 13px;color: #000000;
                                    padding-left: 20px;text-align:left;border-right: unset;'>TOTAL PAID :</td>
                            <td colspan='3' class='price'
                                style='line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;'>
								<p>$reason_discount</p>
                                <b>".$codTotal."</b></td>
                        </tr>
                    </table>
                    <table cellpadding='0' cellspacing='0' border='0' align='left'
                        style='width: 100%;margin-top: 30px;    margin-bottom: 30px;'>
                        <tbody>
                            <tr>
                                <td
                                    style='font-size: 13px; font-weight: 400; color: #444444; letter-spacing: 0.2px;width: 50%;'>
                                    <h5
                                        style='font-size: 16px; font-weight: 500;color: #000; line-height: 16px; padding-bottom: 13px; border-bottom: 1px solid #e6e8eb; letter-spacing: -0.65px; margin-top:0; margin-bottom: 13px; text-align: left;'>
                                        DILIVERY ADDRESS</h5>
                                    <p
                                        style='text-align: left;font-weight: normal; font-size: 14px; color: #000000;line-height: 21px;    margin-top: 0;'>
                                        ".$customerchechlogin_row['stree_address'].$landk.",<br> ".$customerchechlogin_row['city']." , ".$customerchechlogin_row['country']."
                                       </p>
                                </td>
                                <td width='57' height='25' class='user-info'></td>
                                <td class='user-info'
                                    style='font-size: 13px; font-weight: 400; color: #444444; letter-spacing: 0.2px;width: 50%;'>
                                    <h5
                                        style='font-size: 16px;font-weight: 500;color: #000; line-height: 16px; padding-bottom: 13px; border-bottom: 1px solid #e6e8eb; letter-spacing: -0.65px; margin-top:0; margin-bottom: 13px; text-align: left;'>
                                        SHIPPING ADDRESS</h5>
                                    <p
                                        style='text-align: left;font-weight: normal; font-size: 14px; color: #000000;line-height: 21px;    margin-top: 0;'>
                                        ".$customerchechlogin_row['stree_address'].$landk.",<br> ".$customerchechlogin_row['city'].",".$customerchechlogin_row['country']."
                                        </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                </td>
            </tr>
        </tbody>
    </table>
    <table class='main-bg-light text-center top-0' align='center' border='0' cellpadding='0' cellspacing='0'
        width='100%'>
        <tr align='center'>
            <td style='padding: 30px;'>
                <div>
                    <h4 class='title' style='margin:0;text-align: center;'>Follow us</h4>
                </div>
                <table border='0' cellpadding='0' cellspacing='10' class='footer-social-icon' align='center'
                    class='text-center' style='margin-top:20px;'>
                    <tr align='center'>
                        <td style='padding:0 5px'>
                            <a href='#'><img src='".$domain_url."images/facebook.png' alt=''></a> 
                        </td>
                        <td style='padding:0 5px'>
                            <a href='#'><img src='".$domain_url."images/instagram.png' alt=''></a> 
                        </td>
                        <td style='padding:0 5px'>
                            <a href='#'><img src='".$domain_url."images/snap.png' alt=''></a> 
                        </td >
                        <td style='padding:0 5px'>
                            <a href='#'><img src='".$domain_url."images/whatsap.png' alt=''></a> 
                        </td>
                        
                        
                    </tr>
                </table>
                <div style='border-top: 1px solid #ddd; margin: 20px auto 0;'></div>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='margin: 20px auto 0;'>
                    
                    <tr>
                        <td align='center'>
                            <p style='font-size:13px; margin:0;'>2020 - 21 Copy Right by Missitalybrand powerd by Splendid
                                </p>
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
</div>";
	 

	 
// $paymentquery="update datalogs SET oder_pending='$tracking_id',total='$succammount',payup='2',indate=now(),merchant_reference='$order_id',success_code='$order_status',bank_ref_no='$bank_ref_no' WHERE dil_id='$datalogid'";
// mysqli_query($link,$paymentquery);

// 	 $auto_pool_10 = 'InActive';
// 	 $daliy_lavel='InActive';
// 	 $auto_pool_500='InActive';
// 	 $pool_price_one = '';
// 	 $pool_price_two = '';
// 	 $pool_name =  $customerchechlogin_row['fname'];
	 
	//  if($succammount >= 500 && $customerchechlogin_row['sponser_status']=='no'){
	// 	$auto_pool_10 = 'Active';
	// 	$pool_price_one = '100';
	// 	$currentTime = time();
	// 	for ($i = 1; $i <= 10; $i++) {
			
    //         //			$iterationTime = strtotime("+$i hour", $currentTime);
	// 		$iterationTime = strtotime("+$i hour", $currentTime);
	// 		$formattedTime = date('H:00:00', $iterationTime);
	// 		$endTime = date('H:00:00',strtotime("+1 hour", $iterationTime));
			
	// 		$start_id_time = date('H:00:00',$currentTime);
	// 		$str = strtotime($start_id_time);
	// 		$end_id_Time = date('H:00:00',strtotime("+1 hour", $str));
	// 		$data_pool=mysqli_query($link,"select * from pool_100 WHERE start_time='$formattedTime' AND end_time='$endTime' AND status!='close'");
	// 		$listpoolrt=mysqli_fetch_array($data_pool);
    		
	// 		if($listpoolrt){
	// 			$sponserId = $listpoolrt['id'];
	// 		}
	// 		else{
	// 			$sponserId ='0';
	// 		}
	// 		$query_pool="insert into pool_100(memeber_id,date,start_time,end_time,level,sponser_id,pool_count,status,wallet_ncome,comission_income)values('$custID',now(),'$formattedTime','$endTime','0','$sponserId','1','active','0','0')"; 
	// 		mysqli_query($link,$query_pool);
			
			
	// 		$pool_local_id =mysqli_insert_id($link);
			
	// 		$generete_id =$sponserId;
			
	// 		$mysql_pool_count=mysqli_query($link,"select * from pool_100 WHERE start_time='$start_id_time' AND end_time='$end_id_Time' AND status!='close' order by pool_count DESC");
	// 		$listpoolcount=mysqli_fetch_array($mysql_pool_count);
	// 		$poolrecord = $listpoolcount['pool_count'] * 2;
	// 		$levelcount = $listpoolcount['level'];
			
			
			
	// 		if($poolrecord){
				
	// 			$sql_pool_close=mysqli_query($link,"select * from pool_100 WHERE start_time='$start_id_time' AND end_time='$end_id_Time' limit $poolrecord");
	// 			$status='active';
	// 			if(mysqli_num_rows($sql_pool_close)==$poolrecord){
	// 				if(mysqli_num_rows($sql_pool_close)>=64){
	// 					$status='closed';
	// 				}
					
	// 				$level = $levelcount + 1;
	// 				$pool_count = $poolrecord;
	// 				$rate= $poolrecord;	
	// 				$wl_income = ($rate * 2);
	// 				$tenPercent = $wl_income * 0.01;
	// 				$wl_income -= $wl_income * 0.01;
					
	// 				mysqli_query($link,"update pool_100 SET pool_count='$pool_count',level='$level',status='$status',wallet_ncome='$wl_income',comission_income='$tenPercent' WHERE id='$generete_id'");
				
					
	// 				if($i>1){
	// 					mysqli_query($link,"update pool_100 SET pool_count='1',level='0',status='active',wallet_ncome='',comission_income='' WHERE id='$generete_id'");
	// 				}
	// 			}
				
	// 		}	
	// 	}
	//  }
	//  if($succammount >= 1500 && $succammount <= 2499){
	// 	$daliy_lavel = 'Active';
	//  }
	//  else if($succammount >= 2500){
	// 	$daliy_lavel = 'Active';
	// 	$auto_pool_500 = 'Active';
	//  	$pool_price_two = '500';
	//  }
	

 
// $cartSqlspon=mysqli_query($link,"select * from cart WHERE sess='$sess'");
// $listCartSpon=mysqli_fetch_array($cartSqlspon); 
// $sponser_id = $customerchechlogin_row['spnoser_id'];
// if($listCartSpon['sponser_status'] == 'active'){
// 	$spsSqlmemr=mysqli_query($link,"select * from membership WHERE member_id='$sponser_id'");
// 	$listspnsRow=mysqli_fetch_array($spsSqlmemr);
// 		$pool_price_two = '500';
// 		$auto_pool_500 = 'Active';
// 		$binary_root = $listCartSpon['binary_status'];
// 	if($listCartSpon['sponserplan']=='2000_plan'){
// 		$WalletSponser = $listspnsRow['main_wallet'] + ($order_sub_total * 20 / 100);
// 	}
// 	else if($listCartSpon['sponserplan']=='3000_plan'){
// 		$WalletSponser = $listspnsRow['main_wallet'] + ($order_sub_total * 33 / 100);;	
// 	}

// }
// else{
//     $WalletSponser=$customerchechlogin_row['main_wallet'];
//     $binary_root = '';
// // }
// $memberupdate="update membership SET auto_pool_100='$auto_pool_10',auto_pool_500='$auto_pool_500',daliy_lavel='$daliy_lavel',binary_root='$binary_root' WHERE member_id='$custID'";
// mysqli_query($link,$memberupdate);
							 
// $memberupdate7008="update membership SET main_wallet='$WalletSponser' WHERE member_id='$sponser_id'";
// mysqli_query($link,$memberupdate7008);
							 
	 
// $query="insert into wallet(pool_100,pool_500,member_id,create_date)values('$pool_price_one','$pool_price_two','$custID',now())"; 
// mysqli_query($link,$query);	 

// // Binary Income Start 

// $leftCount = 0;
// $rightCount = 0;

// $sqlBinaryPool=mysqli_query($link,"select * from membership WHERE spnoser_id='$sponser_id'");
// if(mysqli_num_rows($sqlBinaryPool)>0){
// while($listBinaryPool=mysqli_fetch_array($sqlBinaryPool)){
	
// 	if ($listBinaryPool['binary_root'] == "Left") {
//         $leftCount++;
//     } elseif ($listBinaryPool['binary_root'] == "Right") {
//         $rightCount++;
//     }
// }

// $sqlBinarydata = mysqli_query( $link, "select * from binary_income WHERE sponser_id='$sponser_id' order by binary_id DESC");
// $listBinaryData=mysqli_fetch_array($sqlBinarydata);
// 	if(mysqli_num_rows($sqlBinarydata) > 0){
// $bnLeft = $listBinaryData['leftA'] + 1;
// $bnRight = $listBinaryData['rightR'] + 1;
// 	}
// 	else{
// 		$bnLeft = '0';
// 		$bnRight = '0';
// 	}

// if(($leftCount == $bnLeft && $rightCount==$bnRight)){
// 	$query="insert into binary_income(user_id,sponser_id,income,leftA,rightR,date)values('$custID','$sponser_id','200','$leftCount','$rightCount',now())"; 
// mysqli_query($link,$query);
// }
// else if(($leftCount == 1 && $rightCount==2) || ($leftCount == 2 && $rightCount==1)){
// 	$query="insert into binary_income(user_id,sponser_id,income,leftA,rightR,date)values('$custID','$sponser_id','200','$leftCount','$rightCount',now())"; 
// mysqli_query($link,$query);
// }	
// $currentDate = date("Y-m-d");
// 	$BinaryIncomeTotal = '0';
// $sqlBinarydata2 = mysqli_query($link, "SELECT * FROM binary_income WHERE sponser_id='$sponser_id' AND DATE(date) = '$currentDate' ORDER BY binary_id DESC");
// while($listBinaryData2=mysqli_fetch_array($sqlBinarydata2)){
// 	$BinaryIncomeTotal = $BinaryIncomeTotal + $listBinaryData2['income'];
// }
// 	echo $BinaryIncomeTotal;
// 	echo $perDay_income_value = '1200';
// 	if($BinaryIncomeTotal==$perDay_income_value){
// 		$memberupdate="update membership SET binary_root='' WHERE member_id='$custID'";
// 		mysqli_query($link,$memberupdate);
// 		mysqli_query($link,"delete from binary_income WHERE sponser_id='$sponser_id' and user_id='$custID'");
// 	}
// }

// Binary Income End
							 
// $query12="delete from cart WHERE userid='$custID'"; mysqli_query($link,$query12);		
// $subject2 = "Order - EMR Marketing";
// $subject = "Order - from".$order_id;	
// $ctoremail = $customerchechlogin_row['email'];	
							 
// $email->setFrom("quadir@emrmarketing.in", "EMR Marketing");
// $email->setSubject($subject);
// $email->addTo($ctoremail, $customerchechlogin_row['fname']);
// //$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
// $email->addContent(
//     "text/html", $msg
// );
// $sendgrid = new \SendGrid('xxxxx-xxxxx-xxxxx-xxxxx');
// try {
//     $response = $sendgrid->send($email);
//     print $response->statusCode() . "\n";
//     print_r($response->headers());
//     print $response->body() . "\n";
// } catch (Exception $e) {
// //    echo 'Caught exception: '. $e->getMessage() ."\n";
// }							 
							 
//$email_conf='support@emrmarketing.in';
//$mailheader1 = "MIME-Version: 1.0\r\n";
//$mailheader1 .= "Content-type: text/html; charset=iso-8859-1\r\n";
//$mailheader1 .= "From: Order"."<order@emrmarketing.in>\r\n";
//@mail($ctoremail,$subject2,$msg,$mailheader1);
//@mail($email_conf,$subject,$msg,$mailheader1);	

//  }
// 	else if($order_status==="Aborted")
// 	{
// 		echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
// 		$paymentquery="update datalogs SET total='$succammount',payup='0',indate=now(),merchant_reference='$order_id',success_code='$order_status' WHERE dil_id='$datalogid'";
// mysqli_query($link,$paymentquery);
	
// 	}
// 	else if($order_status==="Failure")
// 	{
// 		echo "<h2>Transaction Fail: </h2><br>Thank you for shopping with us.However,the transaction has been declined.";
// 		$paymentquery="update datalogs SET total='$succammount',payup='0',indate=now(),merchant_reference='$order_id',success_code='$order_status' WHERE dil_id='$datalogid'";
// mysqli_query($link,$paymentquery);
// 	}
// 	else
// 	{ 
// 		echo "<h2>Security Error: </h2><br>Illegal access detected";
// 		$paymentquery="update datalogs SET total='$succammount',payup='0',indate=now(),merchant_reference='$order_id',success_code='$order_status' WHERE dil_id='$datalogid'";
// mysqli_query($link,$paymentquery);
	
// 	}
    }
    








?>
		<?php //include('other_function.php');?>				 
          
				</div>
				<div class="divider"></div>
			</main>
    <!-- /Page Content -->
    <?php include('include/footer.php');?>