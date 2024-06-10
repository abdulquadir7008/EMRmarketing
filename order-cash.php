<?php
include_once( 'include/configuration.php' );
ob_start();
$ip = $_SERVER['REMOTE_ADDR'];
$landk = '';
$logs_sql="select * from datalogs WHERE merchant_reference='$sess' order by dil_id DESC";
$result_logs=mysqli_query($link,$logs_sql);
$listlg=mysqli_fetch_array($result_logs);
$custEmail = $listlg['email'];
$custID = $listlg['member_id'];
$subtotal_del = $listlg['total'];
$dil_id = $listlg['dil_id'];
$amount_payment = $subtotal * 100;
$ROPemail =$_SESSION["msemail"];
$shippchg = $listlg["shipping_charges"];
$_SESSION['member_id'] = $custID;
$codcharge = '50';

if($customerchechlogin_row['landmark']){
    $landk = ", Near - ".$listorderlog['landmark']; 
}
?>

<?Php 
$curl = curl_init();
$grtprice = $total;

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
        <h1>Cash On Delivery</h1>
        
			<!--form action="include/cartprocess.php" id="registerForm" name="cartform2" method="post" enctype="multipart/form-data"-->
            <div class="row" id="cart_table">
                <div class="container">
						<div class="cart-table">
							<div class="table-header">
								<div class="photo">
									Product Image
								</div>
								<div class="name">
									Product Name
								</div>
								<div class="price">
									Unit Price
								</div>
								<div class="qty">
									Qty
								</div>
								<div class="subtotal">
									Subtotal
								</div>
								<div class="remove">
									<span class="hidden-sm hidden-xs">Remove</span>
								</div>
							</div>
							
							<?php $res_check2=mysqli_query($link,$sql_check1); while($cart_list = mysqli_fetch_array($res_check2)){
			  			$cart_prod_id = $cart_list['product_id'];
							$subtotal2 = $subtotal2 + ( $cart_list[ 'price' ] * $cart_list[ 'qty' ] );
							$product_cart = "select * from products where id='$cart_prod_id'";	
								$result_product_cart = mysqli_query($link,$product_cart); 
 									$List_product_cart = mysqli_fetch_array($result_product_cart);
			  						?>
							<div class="table-row">
								<div class="photo">
									<a href="product.html"><img src="<?php echo $domain_url.$product_paath.$List_product_cart['image2']; ?>" alt=""></a>
								</div>
								<div class="name">
									<a href=""><?php echo $List_product_cart['title'];?></a>
									<div class="road-list-crupm">
										<?php
												$tags = preg_replace('/,+/', ',', $cart_list['varient_names']);
													 $splittedstring=explode(",",$tags);
														foreach ($splittedstring as  $value) {
															echo "<div>".$value." : </div>";
														}
										?>
										</div>
										<div class="col-md-5" style="float:left; width:auto;">
										<?php
													$tags2 = preg_replace('/,+/', ',', $cart_list['verientlist']);
	 														$splittedstring2=explode(",",$tags2);
														foreach ($splittedstring2 as  $value2) {
															echo "<div>".$value2."</div>";
														}
										?>
										</div>
								</div>
								<div class="price">
									<?php  
    echo number_format($cart_list['price'] ,2, '.', ',');?>
								</div>
								<div class="qty qty-changer">
								<?php echo $cart_list['qty'];?>
<!--
									<fieldset>
										<input type="button" value="&#8210;" class="decrease">
										<input type="text" class="qty-input" value="2" data-min="0" data-max="5">
										<input type="button" value="+" class="increase">
									</fieldset>
-->
								</div>
								<div class="subtotal">
									<?php $cartqytprice = str_replace(',','',$cart_list['price'])*str_replace(',','',$cart_list['qty']); 
    echo number_format($cartqytprice ,2, '.', ',');?>
								</div>
								<div class="remove">
									<a href="include/delete_f.php?cart_id=<?php echo $cart_list['cart_id']; ?>" class="icon icon-close-2"></a>
								</div>
							</div>
							
							<?php 
	  } ?>
<!--
							<div class="table-footer">
								<button class="btn btn-alt">CONTINUE SHOPPING</button>
								<button class="btn btn-alt pull-right"><i class="icon icon-bin"></i><span>Clear Shopping Cart</span></button>
								<button class="btn btn-alt pull-right"><i class="icon icon-sync"></i><span>UPDATE</span></button>
							</div>
-->
						</div>
						<div class="row">
							<div class="col-md-3 total-wrapper">
								<table class="total-price">
									<tr>
										<td>Subtotal</td>
										<td><?php echo number_format($subtotal2,2, '.', ',');?></td>
									</tr>
									<tr>
										<td>Tax</td>
										<td><?php echo $tax=number_format($subtotal2 * 5 / 100,2, '.', ',') ?></td>
									</tr>
									<tr class="total">
										<td>Grand Total</td>
										<td><?php echo number_format($subtotal_del,2, '.', ',');?></td>
									</tr>
								</table>
								<div class="cart-action">
									<div>
										<a href="order-success/" class="btn">Finish Order</a>
									</div>
<!--									<a href="#">Checkout with Multiple Addresses</a>-->
								</div>
							</div>
							
							
						</div>
					</div>
                
            </div>
            
				</div>
				<div class="divider"></div>
			</main>
    <!-- /Page Content -->
    <?php include('include/footer.php');?>