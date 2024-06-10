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
					
				//}
				$ad_icncome_sql = mysqli_query( $link, "select * from ad_view_wallet WHERE user_id='$customeid'" );
				$list_income = mysqli_fetch_array( $ad_icncome_sql );
				   $walletamount = $list_income['wallet'];
		   if($walletamount > 0){
			   $reason_discount= "By maintaining 50% above current order in your AdViewWallet, you are getting a discount of 50%.";
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

	$amount = $_SESSION['grosprice'];


if($listlg['total']==$amount){
	mysqli_query($link,"update datalogs SET total='$encryptedAmount',indate=now(),payment='Online',success_code='paramter missing',reason_discount='$reason_discount' WHERE merchant_reference='$order_id'");
}	
?>
	

<?php
// Replace these with your actual PhonePe API credentials

$merchantId = 'EMRUAT'; // sandbox or test merchantId
$apiKey="xxxx-xxx-xxxx-xxx"; // sandbox or test APIKEY
$redirectUrl = 'http://localhost/emrmarketing/tansaction_details.php';

// Set transaction details
//$order_id = uniqid(); 
$name=$customerchechlogin_row[ 'fname' ]." ".$customerchechlogin_row[ 'lname' ];
$email=$customerchechlogin_row[ 'email' ];
$mobile=$customerchechlogin_row[ 'phone' ];
//$amount = 10; // amount in INR
$description = 'Payment for Product/Service';

$merchantid  = MERCHANTIDUAT;
    $saltkey = SALTKEYUAT;
    $saltindex = SALTINDEX;
	$UserIder = $customerchechlogin_row[ 'userid' ];
    $payLoad = array(
        'merchantId' => $merchantid,
        'merchantTransactionId' => $order_id, // test transactionID
        "merchantUserId" => $UserIder,
        'amount' => $amount * 100, // phone pe works on paise
        'redirectUrl' => BASE_URL . REDIRECTURL,
        'redirectMode' => "POST",
        'callbackUrl' => BASE_URL . REDIRECTURL,
        "mobileNumber" => $mobile,
         "email" => $email,
        // "param1"=>$email,
        "paymentInstrument" => array(
            "type" => "PAY_PAGE",
        )
    );

    $jsonencode = json_encode($payLoad);

    $payloadbase64 = base64_encode($jsonencode);

    $payloaddata = $payloadbase64 . "/pg/v1/pay" . $saltkey;


    $sha256 = hash("sha256", $payloaddata);

    $checksum = $sha256 . '###' . $saltindex;


    $request = json_encode(array('request' => $payloadbase64));

    $url = '';
    if (API_STATUS == "LIVE") {
        $url = LIVEURLPAY;
    } else {
        $url = UATURLPAY;
    }





    $curl = curl_init(); // This extention should be installed

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $request,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "X-VERIFY: " . $checksum,
            "accept: application/json"
        ],
    ]);

    $response = curl_exec($curl);

    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      $res = json_decode($response);

//      echo "<br/>response===";
      print_r($res);
		echo json_encode($res);

      if (isset($res->success) && $res->success == '1') {
        // $paymentCode=$res->code;
        // $paymentMsg=$res->message;
        $payUrl = $res->data->instrumentResponse->redirectInfo->url;
        header('Location:' . $payUrl);
		ob_end_flush();
      }

    }
          
?>
	<?php unset($_SESSION['totalprice']); unset($_SESSION['kadid']);?>
</body>
</html>

