<?php include_once( 'include/configuration.php' );
include('Crypto.php');
$order_id=$_SESSION['kadid'];
$result_logs=mysqli_query($link,"select * from datalogs WHERE merchant_reference='$order_id'");
$listlg=mysqli_fetch_array($result_logs);
if ( $_SESSION[ 'member_id' ] ) {
$customeid = $_SESSION[ 'member_id' ];
$res_check2=mysqli_query($link,"select * from cart WHERE userid='$customeid'"); 
while($cart_list = mysqli_fetch_array($res_check2)){
$subtotal = $subtotal + ( $cart_list[ 'price' ] * $cart_list[ 'qty' ] );
}
$reason_discount='';
	//$ad_icncome_sql = mysqli_query( $link, "select * from ad_view_wallet WHERE user_id='$customeid'" );
			 //$list_income = mysqli_fetch_array( $ad_icncome_sql );
				//$walletamount = $list_income['wallet'];
				 //$toal_half = $subtotal / 2;
				//if ($toal_half < $walletamount){
					//$subtotal= $subtotal - $toal_half;
					$reason_discount= "By maintaining 50% above current order in your AdViewWallet, you are getting a discount of 50%.";
				//}
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
			}
	
$tax=($subtotal * 18 / 100);
$grossTotal = ($subtotal + $tax);
$encryptedAmount = encrypt($grossTotal, $key);
$_SESSION['grosprice'] = $grossTotal;
$Decrypamount = decrypt($grossTotal, $key);		
}
?>
<html>
<head>
<title> Non-Seamless-kit</title>
</head>
<body>
<center>

<?php 

	error_reporting(0);
	$merchant_id='2721956';
	$currency='INR';
//	$encryptedAmount=$_SESSION['totalprice'];
	$amount = $_SESSION['grosprice'];
	
	$redirect_url='https://www.emrmarketing.in/tansaction_details.php';
	$cancel_url='https://www.emrmarketing.in/tansaction_details.php';
	
//	$redirect_url='http://localhost/emrmarketing/tansaction_details.php';
//	$cancel_url='http://localhost/emrmarketing/tansaction_details.php';
	
	$language='EN';
	$merchant_data='merchant_id='.$merchant_id.'&order_id='.$order_id.'&currency='.$currency.'&amount='.$amount.'&redirect_url='.$redirect_url.'&language='.$language;
	
	$working_key='2B26BCF6A0B3C3CD187862CEFDB36526';//Shared by CCAVENUES
	$access_code=' AVNO95KH35AF23ONFA';//Shared by CCAVENUES
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}

	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
if($listlg['total']==$amount){
	mysqli_query($link,"update datalogs SET total='$encryptedAmount',indate=now(),payment='Online',success_code='paramter missing',reason_discount='$reason_discount' WHERE merchant_reference='$order_id'");
}	
?>
	

<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
<!--		<form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction">-->
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
	<?php unset($_SESSION['totalprice']); unset($_SESSION['kadid']);?>
</body>
</html>

