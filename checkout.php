<?php
include_once( 'include/configuration.php' );
include( 'Crypto.php' );
ob_start();
if ( empty( $_SESSION[ 'member_id' ] ) ) {
  header( 'Location: ' . $domain_url . 'login/' );
  ob_end_flush();
}
$SQLproductDetails = "select * from products where status='1' AND seo_keywords='$productDetailsKey'";
$MySQLProductDetails = mysqli_query( $link, $SQLproductDetails );
$ListproductDetails = mysqli_fetch_array( $MySQLProductDetails );
$productDetID = $ListproductDetails[ 'id' ];
$setpagename;
$parentcat_keyword;
$_SESSION[ 'metamount' ] = $total;
$sql = "delete from datalogs where payup='0'";
mysqli_query( $link, $sql );
$sqldel = "delete from installment_plan where memberid='$customeid'";
mysqli_query( $link, $sqldel );


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
          <li>/<span>Checkout</span></li>
        </ul>
      </div>
    </div>
    <div class="block">
      <div class="container">
        <div class="row">
          <?php
          if ( isset( $_SESSION[ 'chkeror' ] ) && is_array( $_SESSION[ 'chkeror' ] ) && count( $_SESSION[ 'chkeror' ] ) > 0 ) {
            foreach ( $_SESSION[ 'chkeror' ] as $msg ) {
              echo $msg;
            }
            unset( $_SESSION[ 'chkeror' ] );
          }
          ?>
          <div class="col-md-6">
          <h2>Billing Details</h2>
          <form class="white" action="include/order_submit.php" method="post">
			  <input type="hidden" name="country" value="95">
			  <input type="hidden" value="<?php echo $customerchechlogin_row['company'];?>" name="company">
            <div class="row">
				<div class="col-sm-6">
                <label>First Name<span class="required">*</span></label>
                <input type="text" class="form-control" name="fname" value="<?php echo $customerchechlogin_row['fname'];?>" placeholder="First Name" required>
              </div>
              <div class="col-sm-6">
                <label>Last Name<span class="required">*</span></label>
                <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php echo $customerchechlogin_row['lname'];?>" required>
              </div>
				<div class="col-md-12">
				<label>Street Address</label>
            <textarea name="stree_address" class="form-control" required><?php echo $customerchechlogin_row['stree_address'];?>
			  </textarea>
				</div>
				 <div class="col-sm-6">
                <label>State/Province <span class="required">*</span></label>
				 <select name="state" class="form-control" required onChange="showCity(this);" style="-webkit-appearance:inner-spin-button;">
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
				<div class="col-sm-6">
                <label>District <span class="required">*</span></label>
               <select class="form-control" name="city" id="cityoutput" required style="-webkit-appearance:inner-spin-button;">
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
          
              
            </div>
            
            <div class="row">
             
              <div class="col-sm-6">
                <label>Postcode / Zip<span class="required">*</span></label>
                <input type="text" class="form-control" name="postalcode" value="<?php echo $customerchechlogin_row['postalcode'];?>">
              </div>
				<div class="col-sm-6">
                <label>Landmark<span class="required">*</span></label>
                <input type="text" class="form-control" name="landmark" placeholder="Land Mark" value="<?php echo $customerchechlogin_row['landmark'];?>">
              </div>
            </div>
            <div class="row">
              
              
           
            </div>
            <div class="row">
              <div class="col-sm-6">
                <label>E-mail<span class="required">*</span></label>
                <input type="email" readonly class="form-control" name="email" placeholder="Email Address" value="<?php echo $customerchechlogin_row['email'];?>" required>
              </div>
              <div class="col-sm-6">
                <label>Phone Number<span class="required">*</span></label>
                <input type="text" class="form-control phonecode" maxlength="11" name="phone" placeholder="Phone" value="<?php echo $customerchechlogin_row['phone'];?>" required>
              </div>
            </div>
            <div>
              <?php  if($customerchechlogin_id!=0 && $customerchechlogin_row['member_id']!='') {?>
              <input type="hidden" name="member_option">
              <?php }else{?>
              <div class="checkbox-group">
                <input type="checkbox" name="member_option" value="member" id="account-option">
                <label for="checkbox-createAccount"><span class="check"></span><span class="box"></span>Create an Account ?</label>
              </div>
              <?php } ?>
            </div>
            </div>
            <div class="col-md-6">
            <h2>Your Order</h2>
            <div class="cart-table cart-table--sm">
              <div class="table-header">
                <div class="photo"> Product Image </div>
                <div class="name"> Product Name </div>
                <div class="price"> Unit Price </div>
                <div class="qty"> Qty </div>
                <div class="subtotal"> Subtotal </div>
              </div>
              <?php
              $res_check2 = mysqli_query( $link, $sql_check1 );
              while ( $cart_list = mysqli_fetch_array( $res_check2 ) ) {
                $cart_prod_id = $cart_list[ 'product_id' ];
                $product_cart = "select * from products where id='$cart_prod_id'";
                $result_product_cart = mysqli_query( $link, $product_cart );
                $List_product_cart = mysqli_fetch_array( $result_product_cart );
                ?>
              <div class="table-row">
                <div class="photo"> <a href="product.html"><img src="<?php echo $domain_url.$product_paath.$List_product_cart['image2']; ?>" alt=""></a> </div>
                <div class="name"> <a href=""><?php echo $List_product_cart['title'];?></a>
                 
					  <div style="position: relative">
                    <?php
				  	if($cart_list['varient_names']){
		echo "<strong>Size: </strong>".$cart_list['varient_names'];
	}
	if($cart_list['verientlist']){
		echo ", <strong>Color: </strong><span style='width:15px;position: absolute;margin-top: 4px; margin-left:5px; border-radius: 100%; height:15px; background:".$cart_list['verientlist']."'></span>";
	}
//                    $tags = preg_replace( '/,+/', ',', $cart_list[ 'varient_names' ] );
//                    $splittedstring = explode( ",", $tags );
//                    foreach ( $splittedstring as $value ) {
//                      echo "<strong>" . $value . " : </strong>";
//                    }
                    ?>
						  </div>
                    <?php
//                    $tags2 = preg_replace( '/,+/', ',', $cart_list[ 'verientlist' ] );
//                    $splittedstring2 = explode( ",", $tags2 );
//                    foreach ( $splittedstring2 as $value2 ) {
//                      echo "<strong>" . $value2 . "</strong>";
//                    }
                    ?>
                  
                </div>
                <div class="price"> <?php echo str_replace(',','',$cart_list['price']);?> </div>
                <div class="qty"> <?php echo $cart_list['qty'];?> </div>
                <div class="subtotal"> <?php echo $kd_toal=str_replace(',','',$cart_list['price'])*str_replace(',','',$cart_list['qty']);?> </div>
              </div>
              <?php } ?>
            </div>
            <div class="coupon_code">
              
               </div>
            <table class="total-price">
              <tr>
                <td>Subtotal</td>
                <td><?php echo number_format($subtotal,2, '.', ',');?></td>
              </tr>
				<?php
              $ad_icncome_sql = mysqli_query( $link, "select * from ad_view_wallet WHERE user_id='$customeid'" );
			 $list_income = mysqli_fetch_array( $ad_icncome_sql );
				$walletamount = $list_income['wallet'];
        if($walletamount > 0){
          $maxDiscountPercentage = 50;
          $totalAmount = $subtotal;
          $adViewWalletAmount = $walletamount;
          
          // Calculate the maximum discount amount allowed (50% of the total amount)
          $maxDiscountAmount = $totalAmount * ($maxDiscountPercentage / 100);
          
          // Check if the ad view wallet amount is greater than the maximum discount amount
          if ($adViewWalletAmount > $maxDiscountAmount) {
              // If the ad view wallet amount exceeds the maximum discount amount, limit it to the maximum discount amount
              $discountAmount = $maxDiscountAmount;
              
          } else {
              // Otherwise, the full ad view wallet amount can be used for the discount
              $discountAmount = $adViewWalletAmount;
          }
          
          // Calculate the remaining amount after applying the discount
          $remainingAmount = $totalAmount - $discountAmount;
          $subtotal= $remainingAmount;
          ?>
				  <tr>
            <td><div class='fivtyoffer'><span>AdViewWallet</span></div></td>
            <td>-<?php echo number_format($discountAmount,2, '.', ',');?></td>
          </tr>
          <tr>
            <td><div class='fivtyoffer'>You are getting a discount of upto 50%.</div></td>
            <td><?php echo number_format($subtotal,2, '.', ',');?></td>
          </tr>
				<?php }
				
              ?>
				
				
				
              <tr>
                <td>Tax</td>
                <td><?php echo $tax=number_format($subtotal * 18 / 100,2, '.', ',') ?></td>
              </tr>
              <tr class="total">
                <td>Grand Total</td>
                <td><?php echo number_format(($subtotal + $tax),2, '.', ',');?></td>
              </tr>
            </table>
				
				
				
            <div class="clearfix"></div>
				<?php if($_SESSION['sponserplan']=='2000_plan'){
//					$discountAmount = $subtotal * (20 / 100);
//					$subtotal = $subtotal - $discountAmount;
				?>
				
				<div class='fivtyoffer'>On purchase you will get <span>20% Reward</span> in your main wallet as per current transaction.</div>
				<?php } else if($_SESSION['sponserplan']=='3000_plan'){
//					$discountAmount = $subtotal * (30 / 100);
//					$subtotal = $subtotal - $discountAmount;
				?>
				
				<div class='fivtyoffer'>On purchase you will get <span>33% Reward</span> in your main wallet as per current transaction.</div>
		  
		  <?php } ?>
            <h2>Order Notes</h2>
            <label>Notes about your order, e.g. special notes for delivery</label>
            <textarea class="form-control"></textarea>
            <div>
              <div class="payment-options">
                <ul>
                  <li>
                    <div class="radio-option paypal">
                      <input type="radio" name="payment" value="amazon" id="payment-3" required>
                      <label for="payment-3">Pay Credit/Debit Card<span class="image"><img
                                                                        src="../assets/images/paypal.png"
                                                                        alt=""></span></label>
                    </div>
                  </li>
                  <!--
                                                    <li>
                                                        <div class="radio-option">
                                                            <input type="radio" name="payment" value="cash_on_delivery" id="payment-2" required>
                                                            <label for="payment-2">Cash On Delivery</label>
                                                        </div>
                                                        
                                                        
                                                    </li>
-->
                  
                  <li>
                    <div class="radio-option">
                      <input type="radio" name="payment" value="bank_transfer" id="payment-1"
                                                                 required>
                      <label for="payment-1">Bank Transfer</label>
                    </div>
                  </li>
                </ul>
              </div>
              <?php
              $SetAmount = ( $subtotal + $tax );
              $encryptedAmount = encrypt( $SetAmount, $key );
              ?>
              <input type="hidden" name="totalprice" value="<?php echo $encryptedAmount;?>">
              <input type="hidden" name="memberid" value="<?php echo $customerchechlogin_row['member_id'];?>">
              <button class="btn btn-alt" type="submit" name="<?php echo $placebtn;?>">PLACE ORDER</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    </div>
    <div class="divider"></div>
  </main>
  <!-- /Page Content -->
  <?php include('include/footer.php');?>