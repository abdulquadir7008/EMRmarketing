<?php 
include('includes/configset.php');
ob_start();
if(isset($_REQUEST['cash']))
{
    $ider = $_REQUEST['cash'];
$query100="update datalogs SET success_code='cashed' WHERE dil_id=$ider";
 mysqli_query($link,$query100);
 $errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' Cashed on Delivery payment Recieve !Successed.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
 header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['bank']))
{
    $bankid = $_REQUEST['bank'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $purchaseorderid = uniqid();
$logs_sql="select * from datalogs WHERE dil_id='$bankid'";
$result_logs=mysqli_query($link,$logs_sql);
$listlg=mysqli_fetch_array($result_logs);
$custEmail = $listlg['email'];
$custID = $listlg['member_id'];
$subtotal = $listlg['total'];

$logs_mm="select * from membership WHERE member_id='$custID'";
$result_mm=mysqli_query($link,$logs_mm);
$listlgmm=mysqli_fetch_array($result_mm);
$purchaseorderid = uniqid();

    $sql_order="select * from orderproduct WHERE customer_email='$custEmail' AND datalogid='$bankid'"; 
    $result_order=mysqli_query($link,$sql_order); 
    while($row_order=mysqli_fetch_array($result_order)) {
        $cart_prod_id = $row_order['product_id'];
            $product_cart = "select * from products where id='$cart_prod_id'";	
                $result_product_cart = mysqli_query($link,$product_cart); 
                    $List_product_cart = mysqli_fetch_array($result_product_cart);
                        
                            $wgtotal = ($wgtotal + $List_product_cart["weight"]);
                            $Lntotal = ($Lntotal + $List_product_cart["length"]);
                            $cwtotal = ($cwtotal + $List_product_cart["width"]);
                            $qhtotal = ($qhtotal + $List_product_cart["height"]);
                            $cubeswh = ($cubeswh + $List_product_cart["cubicweight"]);

                            $order_total=str_replace(',','',$row_order['price'])*str_replace(',','',$row_order['qty']);
  						$order_sub_total = ($order_sub_total + $order_total);
    
                }

                $cartcountship = mysqli_num_rows($result_order);
                $curl = curl_init();
                 date_default_timezone_set(date_default_timezone_get());
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
                      "ReceiverName": "'.$listlgmm['fname']." ".$listlgmm['lname'].'",
                      "ReceiverCompanyName": "",
                      "ReceiverCountryCode": "'.$listlgmm['country'].'",
                      "ReceiverAdd1": "'.$listlgmm['stree_address'].'",
                      "ReceiverAddCity": "'.$listlgmm['city'].'",
                      "ReceiverAddPostcode": "'.$listlgmm['postalcode'].'",
                      "ReceiverPhone": "'.$listlgmm['phone'].'",
                      "ReceiverEmail": "'.$listlgmm['email'].'"
                    },
                    "PackageDetails": {
                      "CustomValue": '.$order_sub_total.',
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
                        "ItemCustomValue": '.$order_sub_total.',
                        "ItemCustomCurrencyCode": "AED",
                        "Notes": "item notes",
                        "Pieces":[{
                          "Quantity":'.$cartcountship.',
                          "Weight":'.$wgtotal.',
                          "ManufactureCountryCode":"AE",
                          "OriginCountryCode":"AE",
                          "CurrencyCode":"AED",
                          "CustomsValue":'.$order_sub_total.'
                        }]
                      }],
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
    
$query100="update datalogs SET oder_pending='$purchaseorderid',success_code='bank',ship_details='$response' WHERE dil_id=$bankid";
 mysqli_query($link,$query100);
 $errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' Bank Transfer payment Recieve !Successed.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
 header('Location: ' . $_SERVER['HTTP_REFERER']);
}
 ob_end_flush();
?>