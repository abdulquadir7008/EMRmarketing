<?php
include_once( 'include/configuration.php' );
ob_start();
require 'vendor_email/autoload.php';
$email_send = new \SendGrid\Mail\Mail();
include('Crypto.php');
if(isset($_POST['merchantId']) && isset($_POST['transactionId']) && isset($_POST['amount']) )
    {

        $merchantId=$_POST['merchantId'];
        $transactionId=$_POST['transactionId'];
        $amount=$_POST['amount'];
		$order_id = $transactionId;


if (API_STATUS == "LIVE") {
    $url = LIVESTATUSCHECKURL . $merchantId . "/" . $transactionId;
    $saltkey = SALTKEYLIVE;
    $saltindex = SALTINDEX;
} else {
    $url = STATUSCHECKURL . $merchantId . "/" . $transactionId;
    $saltkey = SALTKEYUAT;
    $saltindex = SALTINDEX;
}



$st = "/pg/v1/status/" . $merchantId . "/" . $transactionId . $saltkey;

$dataSha256 = hash("sha256", $st);

$checksum = $dataSha256 . "###" . $saltindex;


//GET API CALLING
$headers = array(
    "Content-Type: application/json",
    "accept: application/json",
    "X-VERIFY: " . $checksum,
    "X-MERCHANT-ID:" . $merchantId
);



$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, '0');
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, '0');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$resp = curl_exec($curl);

curl_close($curl);

$responsePayment = json_decode($resp, true);

//echo "<pre>";
//print_r($responsePayment);
//echo "</pre>";


$tran_id = $responsePayment['data']['transactionId'];
$succammount = $responsePayment['data']['amount'];
$succammount = $succammount/100;


    if ($responsePayment['success'] && $responsePayment['code'] == "PAYMENT_SUCCESS")
    {
        //Send Email and redirect to success page
	
$result_logs = mysqli_query( $link, "select * from datalogs WHERE merchant_reference='$order_id'" );
$listlg = mysqli_fetch_array( $result_logs );
$custEmail = $listlg[ 'email' ];
$subtotalRow = $listlg[ 'total' ];
$plan = $listlg[ 'plan' ];
$subtotal = decrypt( $subtotalRow, $key );
$datalogid = $listlg[ 'dil_id' ];
$custID = $listlg[ 'member_id' ];
$_SESSION[ 'member_id' ] = $custID;
$sess = $listlg[ 'sess' ];
		
$uq = mysqli_query( $db, "UPDATE `membership` SET `binary_status`=3 where `member_id` = '$custID'" );

$customerchechlogin_resu = mysqli_query( $link, "select * from membership INNER JOIN states ON membership.state = states.id INNER JOIN cities ON membership.city = cities.id  WHERE member_id=$custID and status='2'" );
$customerchechlogin_row = mysqli_fetch_array( $customerchechlogin_resu );

if($customerchechlogin_row['spnoser_id']){
	$cordId= "emr00".$customerchechlogin_row['spnoser_id'];
	$sqlCorAct = mysqli_query( $link, "select * from cordinator_activation   WHERE userid='$cordId'" );
	
while($arrayCodActiv = mysqli_fetch_array( $sqlCorAct )){
	$codin_id = $arrayCodActiv['codin_id'];
	if($arrayCodActiv['cordinator']=='district'){
		$commission = $arrayCodActiv['commission'] + 40;
	}
	else if($arrayCodActiv['cordinator']=='state'){
		$commission = $arrayCodActiv['commission'] + 20;
	}
	else if($arrayCodActiv['cordinator']=='regional'){
		$commission = $arrayCodActiv['commission'] + 10;
	}
	else if($arrayCodActiv['cordinator']=='national'){
		$commission = $arrayCodActiv['commission'] + 5;
	}
	else{
		$commission =0;
	}
	mysqli_query( $db, "UPDATE `cordinator_activation` SET `commission`='$commission' where `codin_id` = '$codin_id'" );
}
	
}

$sql_cart = "select * from cart WHERE sess='$sess'";
$result_cart = mysqli_query( $link, $sql_cart );
$main_wallet = '0';
if ( $plan == '2000_plan' ) {
  $userc04 = mysqli_num_rows( mysqli_query( $db, "select * from `pairing_1` where uid='$custID'" ) );
  if ( $userc04 > 0 ) {} else {
    AddTopCount( $db, $custID, "200" );
    $uq = mysqli_query( $db, "UPDATE `membership` SET `binary_status`=1 where `member_id` = '$custID'" );

    $type = 1;
    $slot_count = mysqli_num_rows( mysqli_query( $db, "SELECT * FROM `child_counter_1` WHERE `uid` LIKE '$custID%'" ) );
    $cc = $slot_count + 1;
    $uidd = $custID . "." . $cc;
    $cds = BoostIncome1( $db, $uidd, $type );
    $ts = CheckSelfPool( $db );
    $q83 = mysqli_query( $db, "INSERT INTO `pool_activation`(`uid`,`pool`,`date`) VALUES ($user_id,'1',now())" );

    // $type=1;
    // $cds = BoostIncome($db,$custID,$type,$subtotalRow,2);

    // $ts = CheckSelfPool($db);

    $nparent_idd = mysqli_fetch_assoc( mysqli_query( $db, "select `sponsor_id` from `pairing` where `uid`='$custID'" ) );
    $nnsponsor_id = $nparent_idd[ 'sponsor_id' ];

    $r = mysqli_fetch_assoc( mysqli_query( $db, "SELECT `percent` FROM `admin_login` WHERE `admin_id`='1' " ) );
    $percent = $r[ 'percent' ];

    $q83 = mysqli_query( $db, "INSERT INTO `sponsor_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nnsponsor_id,$custID,'$percent',now())" );
  }
} elseif ( $plan == '3000_plan' ) {
  $userc04 = mysqli_num_rows( mysqli_query( $db, "select * from `pairing_1` where uid='$custID'" ) );
  if ( $userc04 > 0 ) {} else {
    $uq = mysqli_query( $db, "UPDATE `membership` SET `binary_status`=2 where `member_id` = '$custID'" );
    AddTopCount( $db, $custID, "200" );
    $type = 1;
    $slot_count = mysqli_num_rows( mysqli_query( $db, "SELECT * FROM `child_counter_1` WHERE `uid` LIKE '$custID%'" ) );
    $cc = $slot_count + 1;
    $uidd = $custID . "." . $cc;
    $cds = BoostIncome1( $db, $uidd, $type );
    $ts = CheckSelfPool( $db );
    $q83 = mysqli_query( $db, "INSERT INTO `pool_activation`(`uid`,`pool`,`date`) VALUES ($user_id,'1',now())" );

    $nparent_idd = mysqli_fetch_assoc( mysqli_query( $db, "select `sponsor_id` from `pairing` where `uid`='$custID'" ) );
    $nnsponsor_id = $nparent_idd[ 'sponsor_id' ];

    $r = mysqli_fetch_assoc( mysqli_query( $db, "SELECT `percent2` FROM `admin_login` WHERE `admin_id`='1' " ) );
    $percent = $r[ 'percent2' ];

    $q83 = mysqli_query( $db, "INSERT INTO `sponsor_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nnsponsor_id,$custID,'$percent',now())" );
  }
}
if ( $_SESSION[ 'sponserplan' ] == '2000_plan' ) {
  $discountAmount = $succammount * ( 20 / 100 );
  $cus_wallet_total = $customerchechlogin_row[ 'main_wallet' ];
  $main_wallet = $cus_wallet_total + $discountAmount;
  mysqli_query( $link, "insert into sponser_benift(user_id,amount,plan_type,gen_date) values('$custID','$discountAmount','2000_plan',now())" );
} else if ( $_SESSION[ 'sponserplan' ] == '3000_plan' ) {
  $discountAmount = $succammount * ( 30 / 100 );
  $cus_wallet_total = $customerchechlogin_row[ 'main_wallet' ];
  $main_wallet = $cus_wallet_total + $discountAmount;
  mysqli_query( $link, "insert into sponser_benift(user_id,amount,plan_type,gen_date) values('$custID','$discountAmount','2000_plan',now())" );
}


//$quvery = $db->query("select * from orderproduct WHERE customer_email='$custEmail'");
//$dq = $quvery->num_rows;
//if($dq>0)
//{}else {
$checkd = $db->query( "select `binary_status` from `membership` WHERE email='$custEmail' and `binary_status` = 0" );
$cdf = $checkd->num_rows;
if ( $cdf > 0 ) {
  $sql1 = mysqli_query( $db, "INSERT INTO `robotic_wallet` set `uid`='$custID',`amount`='100',`date`=now(),`status`='0'" )or die( mysqli_error( $db ) );
}
//}

while ( $row_cart = mysqli_fetch_array( $result_cart ) ) {
  $price = $row_cart[ 'price' ];
  $qty = $row_cart[ 'qty' ];
  $product_id = $row_cart[ 'product_id' ];
  $varient_names = $row_cart[ 'varient_names' ];
  $verientlist = $row_cart[ 'verientlist' ];

  $query_order = "insert into orderproduct(price,qty,product_id,varient_names,verientlist,sess,customer_email,date,Orderid,datalogid) values('$price','$qty','$product_id','$varient_names','$verientlist','$sess','$custEmail',now(),'$order_id','$datalogid')";
  mysqli_query( $link, $query_order );
}
$sql_order = "select * from orderproduct WHERE customer_email='$custEmail' AND datalogid='$datalogid'";
$result_order = mysqli_query( $link, $sql_order );
while ( $row_order = mysqli_fetch_array( $result_order ) ) {
  $cart_prod_id = $row_order[ 'product_id' ];
  $sqlwishDel = "delete from wishlist where product_id='$cart_prod_id' AND userid='$custID'";
  mysqli_query( $link, $sqlwishDel );
  $product_cart = "select * from products where id='$cart_prod_id'";
  $result_product_cart = mysqli_query( $link, $product_cart );
  $List_product_cart = mysqli_fetch_array( $result_product_cart );

  $order_qty = $row_order[ 'qty' ];
  $real_prod_stock = $List_product_cart[ 'inventory' ];
  $product_stock_inventory = $real_prod_stock - $order_qty;

  $query4007008 = "update products SET inventory='$product_stock_inventory' WHERE id=$cart_prod_id";
  mysqli_query( $link, $query4007008 );

  $order_total = str_replace( ',', '', $row_order[ 'price' ] ) * str_replace( ',', '', $row_order[ 'qty' ] );
  $order_sub_total = ( $order_sub_total + $order_total );
  $wg_total = $List_product_cart[ "weight" ] * $row_order[ 'qty' ];

  $wgtotal = ( $wgtotal + $wg_total );
  $Lntotal = ( $Lntotal + $List_product_cart[ "length" ] );
  $cwtotal = ( $cwtotal + $List_product_cart[ "width" ] );
  $qhtotal = ( $qhtotal + $List_product_cart[ "height" ] );
  $cubeswh = ( $cubeswh + $List_product_cart[ "cubicweight" ] );

  $newsdet .= "<tr><td style='border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 10px'><img src='" . $domain_url . $product_paath . $List_product_cart[ 'image2' ] . "' alt='' width='70'>
</td><td valign='top' style='border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 10px'><h5 style='margin-top: 15px;'>" . $List_product_cart[ 'title' ] . $codeMt . $codemt2 . "</h5></td><td valign='top' style='border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 10px'><h5 style='font-size: 14px; color:#444;margin-top: 10px;'>QTY : <span>" . $row_order[ 'qty' ] . "</span></h5></td>
<td valign='top' style='border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 10px'><h5 style='font-size: 14px; color:#444;margin-top:15px'><b>" . $row_order[ 'price' ] . "</b></h5></td></tr>";
}
$subtotal = $order_sub_total;
$reason_discount = '';
if ($listlg['reason_discount']){
$ad_icncome_sql = mysqli_query( $link, "select * from ad_view_wallet WHERE user_id='$custID'" );
$list_income = mysqli_fetch_array( $ad_icncome_sql );
$walletamount = $list_income[ 'wallet' ];
if ( $walletamount > 0 ) {
  $maxDiscountPercentage = 50;
  $totalAmount = $order_sub_total;
  $adViewWalletAmount = $walletamount;

  // Calculate the maximum discount amount allowed (50% of the total amount)
  $maxDiscountAmount = $totalAmount * ( $maxDiscountPercentage / 100 );

  // Check if the ad view wallet amount is greater than the maximum discount amount
  if ( $adViewWalletAmount > $maxDiscountAmount ) {
    // If the ad view wallet amount exceeds the maximum discount amount, limit it to the maximum discount amount
    $discountAmount = $maxDiscountAmount;

  } else {
    // Otherwise, the full ad view wallet amount can be used for the discount
    $discountAmount = $adViewWalletAmount;
  }

  // Calculate the remaining amount after applying the discount
  $remainingAmount = $totalAmount - $discountAmount;
  $subtotal = $remainingAmount;
  $nparent_idd = mysqli_fetch_assoc( mysqli_query( $db, "select `sponsor_id` from `pairing` where `uid`='$custID'" ) );
  $nnsponsor_id = $nparent_idd[ 'sponsor_id' ];
  $s = SetRepurchase( $db, $subtotal, 1, $nnsponsor_id, $custID );
  //$ad_icncome_sql = mysqli_query( $link, "select * from ad_view_wallet WHERE user_id='$custID'" );
  // $list_income = mysqli_fetch_array( $ad_icncome_sql );
  // $walletamount = $list_income['wallet'];
  $wallet_update = $walletamount - $discountAmount;

  mysqli_query( $link, "update ad_view_wallet SET wallet='$wallet_update' WHERE user_id='$custID'" );
}
	$reason_discount = "<b>".$listlg['reason_discount']."</b> : ".$discountAmount;
}
$tax = number_format( $subtotal * 18 / 100, 2, '.', ',' );
$quvrry = $db->query( "select * from orderproduct WHERE customer_email='$custEmail'" );
$ffq = $quvrry->num_rows;
if ( $ffq > 0 ) {
  $checkd04 = $db->query( "select `binary_status` from `membership` WHERE email='$custEmail' AND (binary_status = '1' OR binary_status = '2')" );
  $cd25 = $checkd04->num_rows;
  if ( $cd25 > 0 ) {
    if ( $subtotal >= 2000 ) {
      $sql1 = mysqli_query( $db, "INSERT INTO `robotic_wallet` set `uid`='$custID',`amount`='100',`date`=now(),`status`='0'" )or die( mysqli_error( $db ) );
    }
  }
}

$codTotal = $order_sub_total + $tax;

$msg = "<div style='margin: auto; text-align: center; padding: 0 30px;background-color: #f9f9f9; -webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);width: 100%; width: 700px;'>
 <table align='center' border='0' cellpadding='0' cellspacing='0' style='width: 100%;'>
        <tbody>
            <tr>
                <td>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
                        <tr align='left'>
                            <td>
                                <img src='" . $domain_url . "images/logo.jpg' alt=''
                                    style=';margin-bottom: 30px; width: 100px; padding-top: 20px'>
                            </td>
                        </tr>
                        <tr align='center'>
                            <td>
                                <img src='" . $domain_url . "images/success.png' alt=''>
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
                                <p>Oder ID:" . $order_id . "</p>
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
                        " . $newsdet . "
                        <tr>
                            <td colspan='2' style='line-height: 49px;font-size: 13px;color: #000000;
                                    padding-left: 20px;text-align:left;border-right: unset;'></td>
                            <td colspan='3' class='price'
                                style='line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;'>
								
                                <b>TOTAL :" . $order_sub_total . "</b> <br>Tax:".$tax."<br>".$reason_discount."
								<br><b>Total Paid</b>: ".$succammount."
								</td>
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
                                        " . $customerchechlogin_row[ 'stree_address' ] . $landk . ",<br> " . $customerchechlogin_row[ 'city' ] . ", <br> " . $customerchechlogin_row[ 'name' ] . " ,India
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
                                        " . $customerchechlogin_row[ 'stree_address' ] . $landk . ",<br> " . $customerchechlogin_row[ 'city' ] . ", <br> " . $customerchechlogin_row[ 'name' ] . " ,India
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
                            <a href='#'><img src='" . $domain_url . "images/facebook.png' alt=''></a> 
                        </td>
                        <td style='padding:0 5px'>
                            <a href='#'><img src='" . $domain_url . "images/instagram.png' alt=''></a> 
                        </td>
                        <td style='padding:0 5px'>
                            <a href='#'><img src='" . $domain_url . "images/snap.png' alt=''></a> 
                        </td >
                        <td style='padding:0 5px'>
                            <a href='#'><img src='" . $domain_url . "images/whatsap.png' alt=''></a> 
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

$order_status = $responsePayment['code'];
$paymentquery = "update datalogs SET total='$succammount',payup='2',indate=now(),merchant_reference='$order_id',success_code='$order_status',bank_ref_no='$tran_id' WHERE dil_id='$datalogid'";
mysqli_query( $link, $paymentquery );

$auto_pool_10 = 'InActive';
$daliy_lavel = 'InActive';
$auto_pool_500 = 'InActive';
$pool_price_one = '';
$pool_price_two = '';
$pool_name = $customerchechlogin_row[ 'fname' ];

if ( $succammount >= 500 && $customerchechlogin_row[ 'sponser_status' ] == 'no' ) {
  $auto_pool_10 = 'Active';
  $pool_price_one = '100';
  $currentTime = time();
  for ( $i = 1; $i <= 10; $i++ ) {
    //$iterationTime = strtotime("+$i hour", $currentTime);
    $iterationTime = strtotime( "+$i hour", $currentTime );
    $formattedTime = date( 'H:00:00', $iterationTime );
    $endTime = date( 'H:00:00', strtotime( "+1 hour", $iterationTime ) );

    $start_id_time = date( 'H:00:00', $currentTime );
    $str = strtotime( $start_id_time );
    $end_id_Time = date( 'H:00:00', strtotime( "+1 hour", $str ) );
    $data_pool = mysqli_query( $link, "select * from pool_100 WHERE start_time='$formattedTime' AND end_time='$endTime' AND status!='close'" );
    $listpoolrt = mysqli_fetch_array( $data_pool );

    if ( $listpoolrt ) {
      $sponserId = $listpoolrt[ 'id' ];
    } else {
      $sponserId = '0';
    }
    $query_pool = "insert into pool_100(memeber_id,date,start_time,end_time,level,sponser_id,pool_count,status,wallet_ncome,comission_income)values('$custID',now(),'$formattedTime','$endTime','0','$sponserId','1','active','0','0')";
    mysqli_query( $link, $query_pool );


    $pool_local_id = mysqli_insert_id( $link );

    $generete_id = $sponserId;

    $mysql_pool_count = mysqli_query( $link, "select * from pool_100 WHERE start_time='$start_id_time' AND end_time='$end_id_Time' AND status!='close' order by pool_count DESC" );
    $listpoolcount = mysqli_fetch_array( $mysql_pool_count );
    $poolrecord = $listpoolcount[ 'pool_count' ] * 2;
    $levelcount = $listpoolcount[ 'level' ];


    if ( $poolrecord ) {

      $sql_pool_close = mysqli_query( $link, "select * from pool_100 WHERE start_time='$start_id_time' AND end_time='$end_id_Time' limit $poolrecord" );
      $status = 'active';
      if ( mysqli_num_rows( $sql_pool_close ) == $poolrecord ) {
        if ( mysqli_num_rows( $sql_pool_close ) >= 64 ) {
          $status = 'closed';
        }

        $level = $levelcount + 1;
        $pool_count = $poolrecord;
        $rate = $poolrecord;
        $wl_income = ( $rate * 2 );
        $tenPercent = $wl_income * 0.01;
        $wl_income -= $wl_income * 0.01;

        mysqli_query( $link, "update pool_100 SET pool_count='$pool_count',level='$level',status='$status',wallet_ncome='$wl_income',comission_income='$tenPercent' WHERE id='$generete_id'" );


        if ( $i > 1 ) {
          mysqli_query( $link, "update pool_100 SET pool_count='1',level='0',status='active',wallet_ncome='',comission_income='' WHERE id='$generete_id'" );
        }
      }

    }
  }
}
if ( $succammount >= 1500 && $succammount <= 2499 ) {
  $daliy_lavel = 'Active';
} else if ( $succammount >= 2500 ) {
  $daliy_lavel = 'Active';
  $auto_pool_500 = 'Active';
  $pool_price_two = '500';
}


$cartSqlspon = mysqli_query( $link, "select * from cart WHERE sess='$sess'" );
$listCartSpon = mysqli_fetch_array( $cartSqlspon );
$sponser_id = $customerchechlogin_row[ 'spnoser_id' ];
if ( $listCartSpon[ 'sponser_status' ] == 'active' ) {
  $spsSqlmemr = mysqli_query( $link, "select * from membership WHERE member_id='$sponser_id'" );
  $listspnsRow = mysqli_fetch_array( $spsSqlmemr );
  $pool_price_two = '500';
  $auto_pool_500 = 'Active';
  $binary_root = $listCartSpon[ 'binary_status' ];
  if ( $listCartSpon[ 'sponserplan' ] == '2000_plan' ) {
    $WalletSponser = $listspnsRow[ 'main_wallet' ] + ( $order_sub_total * 20 / 100 );
  } else if ( $listCartSpon[ 'sponserplan' ] == '3000_plan' ) {
    $WalletSponser = $listspnsRow[ 'main_wallet' ] + ( $order_sub_total * 33 / 100 );;
  }

} else {
  $WalletSponser = $customerchechlogin_row[ 'main_wallet' ];
  $binary_root = '';
}
$memberupdate = "update membership SET auto_pool_100='$auto_pool_10',auto_pool_500='$auto_pool_500',daliy_lavel='$daliy_lavel',binary_root='$binary_root' WHERE member_id='$custID'";
mysqli_query( $link, $memberupdate );

$memberupdate7008 = "update membership SET main_wallet='$WalletSponser' WHERE member_id='$sponser_id'";
mysqli_query( $link, $memberupdate7008 );


$query = "insert into wallet(pool_100,pool_500,member_id,create_date)values('$pool_price_one','$pool_price_two','$custID',now())";
mysqli_query( $link, $query );


$query12 = "delete from cart WHERE userid='$custID'";
mysqli_query( $link, $query12 );
$subject2 = "Order - EMR Marketing";
$subject = "Order - from" . $order_id;
$ctoremail = $customerchechlogin_row[ 'email' ];

$email_send->setFrom( "quadir@emrmarketing.in", "EMR Marketing" );
$email_send->setSubject( $subject );
$email_send->addTo( $ctoremail, $customerchechlogin_row[ 'fname' ] );
//$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email_send->addContent(
  "text/html", $msg
);
$sendgrid = new \SendGrid( 'xxxx-xxx-xxxx-xxx' );
try {
  $response = $sendgrid->send( $email_send );
  print $response->statusCode() . "\n";
  print_r( $response->headers() );
  print $response->body() . "\n";
} catch ( Exception $e ) {
//      echo 'Caught exception: '. $e->getMessage() ."\n";
}		
        if($r)
        header('Location:' . BASE_URL . "tansaction_details.php?tid=" . $tran_id . "&amount=" . $amount);
        else
        header('Location:' . BASE_URL . "tansaction_details.php?tid=" . $tran_id . "&amount=" . $amount);

}
else {

    header('Location:' . BASE_URL . "failure.php?tid=" . $tran_id . "&amount=" . $amount);

    }







    }


?>