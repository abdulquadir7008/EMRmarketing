<?php
include_once( 'include/configuration.php' );
$ip = $_SERVER['REMOTE_ADDR'];
$landk = '';
$logs_sql="select * from datalogs WHERE merchant_reference='$sess' order by dil_id DESC";
$result_logs=mysqli_query($link,$logs_sql);
$listlg=mysqli_fetch_array($result_logs);
$codcharge = '0';
if ($customerchechlogin_row['payment'] == 'cash_on_delivery'){
    $codcharge = '50';
}
$custEmail = $listlg['email'];
$custID = $listlg['member_id'];
$codpayment = $listlg['payment'];
$subtotal = $listlg['total'];
$dil_id = $listlg['dil_id'];
$amount_payment = $subtotal * 100;
$ROPemail =$_SESSION["msemail"];
$shippchg = $listlg["shipping_charges"];
$_SESSION['member_id'] = $custID;

if($customerchechlogin_row['landmark']){
    $landk = ", Near - ".$customerchechlogin_row['landmark']; 
}
?>

<?Php 
$curl = curl_init();
$grtprice = $total;
if ($customerchechlogin_row['payment'] == 'cash_on_delivery'){
    $grtprice = $total + $codcharge;
}


$gettwo = $grtprice *100; 
$rowcheckmysql=mysqli_query($link,$sql_check1);
while($Rowcartchecl=mysqli_fetch_array($rowcheckmysql)){
$productID = $Rowcartchecl['product_id'];
$Productweight="select * from products WHERE id=$productID";
$Prodweight=mysqli_query($link,$Productweight);
$Rowprd=mysqli_fetch_array($Prodweight);
$shipp_arr[] = array(
    "Weight" => $Rowprd["weight"], 
    "Length" => $Rowprd["length"], 
    "Width" => $Rowprd["width"], 
    "Height" => $Rowprd["height"],
    "CubicWeight" => $Rowprd["cubicweight"]
);
$wgtotal = ($wgtotal + $Rowprd["weight"]);
}

$cartitemcount = mysqli_num_rows($rowcheckmysql);
$jsonmis = json_encode($shipp_arr,JSON_NUMERIC_CHECK);
$someJSON = '{
    "DepartureCountryCode": "AE",
    "DeparturePostcode": "",
    "DepartureLocation": "Dubai",
    "ArrivalCountryCode": "'.$Cuscountry.'",
    "ArrivalPostcode": "",
    "ArrivalLocation": "'.$City.'",
    "PaymentCurrencyCode": "AED",
    "WeightMeasure": "KG",
    "Weight": '.$wgtotal.',
    "NumofItem": "'.$cartitemcount.'",
    "ServiceType": "EN",
    "DimensionUnit": "CM",
    "CustomCurrencyCode": "AED",
    "CustomAmount": "'.$grtprice.'",
    "Items":'.$jsonmis.'}';


curl_setopt_array($curl, array(
    
  CURLOPT_URL => 'https://api.postshipping.com/api2/rates',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $someJSON,
  CURLOPT_HTTPHEADER => array(
    'Token: C6986A044F25EC73DE37B7BEB5DB6503',
    'Content-Type: application/json',
  ),
));

$shipping_response = curl_exec($curl);
curl_close($curl);
$shipping_response;
$shippingdata = json_decode($shipping_response, true);

$TotShip_Cost = $shippingdata['PricingResponseDetails'];
foreach($TotShip_Cost as $shipdate) {
    $chforlog .= $shipdate['TotalAmount'];
    if($Cuscountry == 'AE'){
        $shipcharge='0';
        $codamount .= $grtprice;
    }else{
$shipcharge .= $shipdate['TotalAmount'];
$codamount .= $grtprice + $shipdate['TotalAmount'];
        }
}

 
 $custome_value = ($shipcharge * 100) + $gettwo;
 
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
							<li>/<span>Cash On Delivery</span></li>
						</ul>
					</div>
				</div>
				<div class="block">
					 <div class="container">
    <?php if ($customerchechlogin_row['payment'] == 'cash_on_delivery' || $customerchechlogin_row['payment'] == 'bank_transfer'){
$purchaseorderid = uniqid();
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
                        <h2>thank you</h2>
                        <?php if ($customerchechlogin_row['payment'] == 'cash_on_delivery'){?>
                        <p>Order is successfully processsed and your order is on the way</p>
                        <p style="font-weight-bold; ">Order ID:<span style="text-transform: uppercase;"><?php echo $purchaseorderid; ?></span></p>
                        <?php } else if ($customerchechlogin_row['payment'] == 'bank_transfer'){?>
                            <p>Your Order is received, and pending for the payment, 
                            
                            Please complete the payment through <br>bank transfer and share the receipt number to <a href="https://api.whatsapp.com/send?phone=971553792929#" target="_blank">+971-55-379-2929</a>.</p>
                        <?php } ?>

                    </div>
<section class="section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-order">
                        
						
						
<?php

$sql_cart="select * from cart WHERE sess='$sess'"; 
$result_cart=mysqli_query($link,$sql_cart);
	
while($row_cart=mysqli_fetch_array($result_cart)) { 
$price=$row_cart['price'];
$qty=$row_cart['qty'];
$product_id=$row_cart['product_id'];
$varient_names=$row_cart['varient_names'];
$verientlist=$row_cart['verientlist'];

$query_order="insert into orderproduct(price,qty,product_id,varient_names,verientlist,sess,customer_email,date,Orderid,ipcatch,datalogid) values('$price','$qty','$product_id','$varient_names','$verientlist','$sess','$Custemail',now(),'$purchaseorderid','$ip','$dil_id')";
mysqli_query($link,$query_order);
}
$sql_order="select * from orderproduct WHERE customer_email='$Custemail' AND datalogid='$dil_id'"; 
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
                            <div class="col-3"><img src="<?php echo $domain_url.$product_paath.$List_product_cart['image2']; ?>" alt=""
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
                                    <?php if($_SESSION['currency'] == 'dollar'){?>
                                        $ <?php echo number_format($row_order['price'] / $curr_rate,2, '.', ',');?>
                                        <?php } else{?>
                                    <h5><?php echo $row_order['price'];?><span class='mibaed'>AED</span></h5>
                                    <?php } ?>
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
                                <?php if($customerchechlogin_row['country'] == 'AE'){
                                   
                                   ?>
                                               <li>Shipping <span class="count">Free Shipping</span></li>
                                               <?php }else{
                                                  
                                                   ?>

                                                   <li>shipping <span>
                                                   <?php if($_SESSION['currency'] == 'dollar'){?>
                                        $ <?php echo number_format($shipcharge / $curr_rate,2, '.', ',');?>
                                        <?php } else{?>
                                            <?php echo number_format($shipcharge,2, '.', ',');?> <span class='mibaed'>AED</span>
                                    <?php } ?>
                                                      
                                                    
                                                    </span>
                                                      </li>
                                                      <?php } ?>
                                                      <?php if ($customerchechlogin_row['payment'] == 'cash_on_delivery'){?>  
                                                    <li>COD Charge :  <span>
                                                   <?php if($_SESSION['currency'] == 'dollar'){?>
                                        $ <?php echo number_format($codcharge / $curr_rate,2, '.', ',') ?>
                                        
                                        <?php } else{?>
                                            <span class="count">  <?php echo number_format($codcharge,2, '.', ',') ?><span class='mibaed'>AED</span>
                                    <?php } ?>
                                                      
                                                    
                                                    </span></li>
                                                    <?php } ?>


                                             
                                
                            </ul>
                        </div>
                        <div class="final-total">
                            <h3>total <span>
                            <?php if($_SESSION['currency'] == 'dollar'){?>
                                        $ <?php echo number_format(($order_sub_total + $codcharge) / $curr_rate,2, '.', ',');?>
                                        <?php } else{?>
                                            <?php echo number_format(($order_sub_total + $shipcharge + $codcharge),2, '.', ',');?> <span class='mibaed'>AED</span>
                                    <?php } ?>
                               
                            
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
                                    <li>order ID: <?php echo $purchaseorderid;?></li>
                                    <li>Order Date: <?php echo date("d M Y"); ?></li>
                                    <li>Order Total: <?php echo $order_sub_total;?></li>
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
                            <div class="col-sm-12 payment-mode">
                                <h4>payment method</h4>
								<?php if($customerchechlogin_row['payment'] == 'cash_on_delivery'){?>
								<p><strong>PAYMENT METHOD</strong> : Cash on delivery</p>
                                <p>Pay on Delivery (Cash/Card). Cash on delivery (COD) available. Card/Net banking
                                    acceptance subject to device availability.</p>
								<?php } else if($customerchechlogin_row['payment'] == 'bank_transfer'){?>
									<p><strong>PAYMENT METHOD</strong> : Direct Bank Transfer</p>
									<p><strong>BANK Name : </strong> Emirates Islamic Bank<br>
                                    <strong>ACCOUNT NAME : </strong> MISS ITALY COMMERCIAL BROKER<br>
										<strong>ACCOUNT NUMBER : </strong> 3708433545801<br>
										<strong>IBAN : </strong> AE480340003708433545801</p>
								<?php } else if($customerchechlogin_row['payment'] == 'amazon'){?>
								<p><strong>PAYMENT METHOD</strong> : amazon Payment</p>
								<p style="font-weight-bold; ">Transaction ID:<span style="text-transform: uppercase;"><?php echo $_REQUEST['fort_id'];?></span></p>
								<?PHP } ?>
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
	$codTotal = $order_sub_total + $codcharge + $shipcharge;

$msg="<div style='margin: auto; text-align: center; padding: 0 30px;background-color: #f9f9f9; -webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);width: 100%; width: 700px;'>
 <table align='center' border='0' cellpadding='0' cellspacing='0' style='width: 100%;'>
        <tbody>
            <tr>
                <td>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
                        <tr align='left'>
                            <td>
                                <img src='".$domain_url."uploads/12missitalybrand-black.png' alt=''
                                    style=';margin-bottom: 30px; width: 100px; padding-top: 20px'>
                            </td>
                        </tr>
                        <tr align='center'>
                            <td>
                                <img src='".$domain_url."assets/images/email_temp/success.png' alt=''>
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
                                <p>Oder ID:".$purchaseorderid."</p>
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
                            <a href='#'><img src='".$domain_url."assets/images/email_temp/facebook.png' alt=''></a> 
                        </td>
                        <td style='padding:0 5px'>
                            <a href='#'><img src='".$domain_url."assets/images/email_temp/instagram.png' alt=''></a> 
                        </td>
                        <td style='padding:0 5px'>
                            <a href='#'><img src='".$domain_url."assets/images/email_temp/snap.png' alt=''></a> 
                        </td >
                        <td style='padding:0 5px'>
                            <a href='#'><img src='".$domain_url."assets/images/email_temp/whatsap.png' alt=''></a> 
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

if ($customerchechlogin_row['payment'] == 'cash_on_delivery' && $customerchechlogin_row['country']=='AE'){
$cartcountship = mysqli_num_rows($result_order);
$curl = curl_init();
echo date_default_timezone_set(date_default_timezone_get());
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.postshipping.com/api2/shipments',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'[{
    "ThirdPartyToken":"", 
    "SenderDetails": {
      "SenderName": "Misitaly",
      "SenderCompanyName": "MISSITALY COMMERCIAL BROKER",
      "SenderCountryCode": "AE",
      "SenderAdd1": "United Arab Emirates",
      "SenderAddCity": "Sharjah",
      "SenderAddPostcode": "208573",
      "SenderPhone": "0552208000",
      "SenderEmail": "missitalybrand@gmail.com"
    },
    "ReceiverDetails": {
      "ReceiverName": "'.$customerchechlogin_row['fname']." ".$customerchechlogin_row['lname'].'",
      "ReceiverCompanyName": "",
      "ReceiverCountryCode": "'.$customerchechlogin_row['country'].'",
      "ReceiverAdd1": "'.$customerchechlogin_row['stree_address'].$landk.'",
      "ReceiverAddCity": "'.$customerchechlogin_row['city'].'",
      "ReceiverAddPostcode": "'.$customerchechlogin_row['postalcode'].'",
      "ReceiverPhone": "'.$customerchechlogin_row['phone'].'",
      "ReceiverMobile": "'.$customerchechlogin_row['altphone'].'",
      "ReceiverEmail": "'.$customerchechlogin_row['email'].'"
    },
    "PackageDetails": {
      "CustomValue": '.$grtprice.',
      "CustomCurrencyCode": "AED",
      "GoodsOriginCountryCode": "AE",
      "Weight": '.$wgtotal.',
      "WeightMeasurement": "KG",
      "NoOfItems": '.$cartcountship.',
      "CubicL": '.$Lntotal.',
      "CubicW": '.$cwtotal.',
      "CubicH": '.$qhtotal.',
      "CubicWeight": '.$cubeswh.',
      "ServiceTypeName": "EN",
      "BookPickUP": true,
      "SenderRef1": "'.$purchaseorderid.'",
      "ShipmentResponseItem": [{ 
        "ItemCubicL": '.$Lntotal.',
        "ItemCubicW": '.$cwtotal.',
        "ItemCubicH": '.$qhtotal.',
        "ItemWeight": '.$wgtotal.',
        "ItemCubicWeight": '.$cubeswh.',
        "ItemCustomValue": '.$grtprice.',
        "ItemCustomCurrencyCode": "AED",
        "Notes": "item notes",
        "Pieces":[{
          "Quantity":'.$cartcountship.',
          "Weight":'.$wgtotal.',
          "ManufactureCountryCode":"AE",
          "OriginCountryCode":"AE",
          "CurrencyCode":"AED",
          "CustomsValue":'.$grtprice.'
        }]
      }],
      "CODAmount": '.$codamount.',
	    "CODCurrencyCode": "AED",
      "DeadWeight": 3,
    }
  }]',
  CURLOPT_HTTPHEADER => array(
    'Token: C6986A044F25EC73DE37B7BEB5DB6503',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
curl_close($curl); 
$response;

$paymentquery="update datalogs SET oder_pending='$purchaseorderid',shipping_charges='$chforlog',ship_details='$response',total='$custome_value',payup='2',indate=now() WHERE merchant_reference='$sess' and email='$Custemail' and dil_id='$dil_id'";
mysqli_query($link,$paymentquery);

}
if ($customerchechlogin_row['payment'] == 'bank_transfer'){
    $paymentquery="update datalogs SET oder_pending='$purchaseorderid',shipping_charges='$chforlog',total='$custome_value',payup='3',indate=now() WHERE merchant_reference='$sess' and email='$Custemail' and dil_id='$dil_id'";
    mysqli_query($link,$paymentquery);
}
$query12="delete from cart WHERE userid='$customeid'"; mysqli_query($link,$query12);		
$subject2 = "Order - Missitalybrand";
$subject = "Order - from".$purchaseorderid;	
$ctoremail = $customerchechlogin_row['email'];	
$email_conf='missitalybrand@gmail.com';
$mailheader1 = "MIME-Version: 1.0\r\n";
$mailheader1 .= "Content-type: text/html; charset=iso-8859-1\r\n";
$mailheader1 .= "From: Order"."<order@missitalybrand.com>\r\n";
@mail($ctoremail,$subject2,$msg,$mailheader1);
@mail($email_conf,$subject,$msg,$mailheader1);	
} 
?>
            
				</div>
				<div class="divider"></div>
			</main>
    <!-- /Page Content -->
    <?php include('include/footer.php');?>