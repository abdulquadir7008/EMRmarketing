<?php include_once( 'config.php' );


include( 'Goconfig.php' );
include('other_function.php');

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received

if ( isset( $_GET[ "code" ] ) )

{

  //It will Attempt to exchange a code for an valid authentication token.

  $token = $google_client->fetchAccessTokenWithAuthCode( $_GET[ "code" ] );


  //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/

  if ( !isset( $token[ 'error' ] ) )

  {

    //Set the access token used for requests

    $google_client->setAccessToken( $token[ 'access_token' ] );


    //Store "access_token" value in $_SESSION variable for future use.

    $_SESSION[ 'access_token' ] = $token[ 'access_token' ];


    //Create Object of Google Service OAuth 2 class

    $google_service = new Google_Service_Oauth2( $google_client );


    //Get user profile data from google

    $data = $google_service->userinfo->get();


    //Below you can find Get profile data and store into $_SESSION variable

    if ( !empty( $data[ 'given_name' ] ) )

    {

      $_SESSION[ 'user_first_name' ] = $data[ 'given_name' ];

    }


    if ( !empty( $data[ 'family_name' ] ) )

    {

      $_SESSION[ 'user_last_name' ] = $data[ 'family_name' ];

    }


    if ( !empty( $data[ 'email' ] ) )

    {

      $_SESSION[ 'user_email_address' ] = $data[ 'email' ];

    }


    if ( !empty( $data[ 'gender' ] ) )

    {

      $_SESSION[ 'user_gender' ] = $data[ 'gender' ];

    }


    if ( !empty( $data[ 'picture' ] ) )

    {

      $_SESSION[ 'user_image' ] = $data[ 'picture' ];

    }

  }

}


//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.

if ( !isset( $_SESSION[ 'access_token' ] ) )

{


  //Create a URL to obtain user authorization

  $login_button = '<a href="' . $google_client->createAuthUrl() . '"><img src="images/sign-google.png" style="float:right;"></a>';
  $login_button_popup = '<a href="' . $google_client->createAuthUrl() . '"><img src="images/googlebtn.jpg" style="float:right;"></a>';
}


$sess = session_id();

if ( $login_button == '' || $login_button_popup == '' )

{

  $gmailID = $_SESSION[ 'user_email_address' ];

  $Gfirst = $_SESSION[ 'user_first_name' ];

  $Glast = $_SESSION[ 'user_last_name' ];

  $Ggender = $_SESSION[ 'user_gender' ];

  $gogleSql = "select * from membership WHERE email='$gmailID'";

  $goglemysql = mysqli_query( $link, $gogleSql );

  $listgoogle = mysqli_fetch_array( $goglemysql );

  if ( $listgoogle[ 'email' ] == $gmailID ) {

    $query = "update membership SET fname='$Gfirst',lname='$Glast' WHERE email=$gmailID";

    mysqli_query( $link, $query );

    $_SESSION[ 'member_id' ] = $listgoogle[ 'member_id' ];

  } else {

    $query = "insert into membership(fname,lname,email,status,date,sess,gender)values('$Gfirst','$Glast','$gmailID','2',now(),'$sess','$Ggender')";

    mysqli_query( $link, $query );

    $_SESSION[ 'member_id' ] = mysqli_insert_id( $link );

  }

}

if ( $_SESSION[ 'FBID' ] ):

  $fb_name = $_SESSION[ 'fb_name' ];

$fbid = $_SESSION[ 'FBID' ];

$fbidSql = "select * from membership WHERE fbid='$fbid'";

$fbidSqlCurr = mysqli_query( $link, $fbidSql );

$Listfbid = mysqli_fetch_array( $fbidSqlCurr );

if ( $Listfbid[ 'fbid' ] == $fbid ) {

  $query = "update membership SET fname='$fb_name',fbid='$fbid' WHERE fbid=$fbid";

  mysqli_query( $link, $query );

  $_SESSION[ 'member_id' ] = $Listfbid[ 'member_id' ];

} else {

  $query = "insert into membership(fname,status,date,sess,fbid)values('$fb_name','2',now(),'$sess','$fbid')";

  mysqli_query( $link, $query );

  $_SESSION[ 'member_id' ] = mysqli_insert_id( $link );

}


endif;


ob_start();

$curr_rate = '';

if ( isset( $_SESSION[ 'currency' ] ) )

{

  $currencyID = $_SESSION[ 'currency' ];

  $currSql = "select * from currancy WHERE keywords='$currencyID'";

  $ResCurr = mysqli_query( $link, $currSql );

  $ListCurr = mysqli_fetch_array( $ResCurr );

  $curr_rate = $ListCurr[ 'currancy_value' ];

}


/* Google Translate strat  */

$GoogleTransar = array(

  'target' => 'ar',

  'model' => 'en',

  'key' => 'AIzaSyAXZ9pGUt1u0-mLIgNfaLu-LON6PRNrcPc',

);

$googlApiURL = 'https://translation.googleapis.com/language/translate/v2/languages';

$QdGo = curl_init( $googlApiURL );

$instaload = json_encode( $GoogleTransar );

curl_setopt( $QdGo, CURLOPT_POSTFIELDS, $instaload );

curl_setopt( $QdGo, CURLOPT_HTTPHEADER, array( 'Content-Type:application/json' ) );

curl_setopt( $QdGo, CURLOPT_RETURNTRANSFER, true );

$answerG = curl_exec( $QdGo );

$httpSTG = curl_getinfo( $QdGo, CURLINFO_HTTP_CODE );

$GoogleJson = array();

if ( curl_errno( $QdGo ) ) {

  $GoogleJson = array(

    "status" => -1,

    "message" => "Error"

  );

} else {

  $GoogleJson = array(

    "status" => $httpSTG,

    "data" => json_decode( $answerG, true )

  );

}

$Googleapidata = json_encode( $GoogleJson );

$ResultGoApi = json_decode( $Googleapidata, true );

$ipaddress = $_SERVER[ 'REMOTE_ADDR' ];

$SQLProfile = "select * from admin_login WHERE admin_id='1'";

$MySQLResult = mysqli_query( $link, $SQLProfile );

$RowProfile = mysqli_fetch_array( $MySQLResult );

setlocale( LC_MONETARY, 'ar_AE.utf8' );

$page_name = basename( $_SERVER[ 'PHP_SELF' ] );

$withoutExt = preg_replace( '/\\.[^.\\s]{3,4}$/', '', $page_name );

$selected_category = ucwords( str_replace( "-", " ", $withoutExt ) );
if($_REQUEST['strmb']) {

  $_SESSION[ 'member_id' ] = $_REQUEST['strmb'];
	header('Location:profile/');

}
else if ( $_SESSION[ 'member_id' ] ) {

  $customerchechlogin_id = $_SESSION[ 'member_id' ];

} else {

  $customerchechlogin_id = "0";

}

$customerchechlogin_sql = "select * from membership WHERE member_id=$customerchechlogin_id and status='2'";

$customerchechlogin_resu = mysqli_query( $link, $customerchechlogin_sql );

$customerchechlogin_row = mysqli_fetch_array( $customerchechlogin_resu );

if ( $customerchechlogin_id != 0 && $customerchechlogin_row[ 'member_id' ] != '' ) {

  $customeid = $customerchechlogin_row[ 'member_id' ];

  $Custemail = $customerchechlogin_row[ 'email' ];

  $customerLoc = $customerchechlogin_row[ 'state' ];

  $Cuscountry = $customerchechlogin_row[ 'country' ];

  $City = $customerchechlogin_row[ 'city' ];

  $placebtn = "Uplace";

  $sqlcart_update = "update cart SET userid='$customeid' WHERE sess='$sess'";

  $result_cart = mysqli_query( $link, $sqlcart_update );


  $sql_check1 = "select * from cart WHERE userid='$customeid'";

  $res_check1 = mysqli_query( $link, $sql_check1 );


  $sqlwishlist = "update wishlist SET userid='$customeid' WHERE sess='$sess'";

  $wishcont = mysqli_query( $link, $sqlwishlist );


  $sql_wishcount = "select * from wishlist WHERE userid='$customeid' order by date DESC";


} else {

  $placebtn = "order";

  $sql_check1 = "select * from cart WHERE sess='$sess'";

  $res_check1 = mysqli_query( $link, $sql_check1 );

  $sql_wishcount = "select * from wishlist WHERE sess='$sess' order by date DESC";

}

$mylogin_check = "select * from login_check WHERE sess='$sess' and ip='$ipaddress'";

$numlistlogincheck = mysqli_query( $link, $mylogin_check );
?>