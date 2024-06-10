<?php
include_once( 'include/configuration.php' );
ob_start();

if ( isset( $_REQUEST[ 'kycSubmit' ] ) ) {
  $benifcyname = $_REQUEST[ 'benifcyname' ];
  $accountnumber = $_REQUEST[ 'accountnumber' ];
  $ifsccode = $_REQUEST[ 'ifsccode' ];
  $bankname = $_REQUEST[ 'bankname' ];
  $branch = $_REQUEST[ 'branch' ];


  if ( $_FILES[ "adharupload" ][ "name" ] != '' ) {
    if ( ( $_FILES[ "adharupload" ][ "type" ] == "image/gif" ) ||
      ( $_FILES[ "adharupload" ][ "type" ] == "image/jpeg" ) ||
      ( $_FILES[ "adharupload" ][ "type" ] == "image/svg+xml" ) ||
      ( $_FILES[ "adharupload" ][ "type" ] == "image/X-PNG" ) ||
      ( $_FILES[ "adharupload" ][ "type" ] == "image/PNG" ) ||
      ( $_FILES[ "adharupload" ][ "type" ] == "image/png" ) ||
      ( $_FILES[ "adharupload" ][ "type" ] == "image/x-png" ) ) {
      $adharupload = "$kycupload" . $rand1 . $_FILES[ "adharupload" ][ "name" ];
      $adharupload0 = $rand1 . $_FILES[ "adharupload" ][ "name" ];
      move_uploaded_file( $_FILES[ "adharupload" ][ "tmp_name" ], $adharupload );
    } else {
      $adharupload0 = '';
    }
  }

  if ( $_FILES[ "cheque" ][ "name" ] != '' ) {
    if ( ( $_FILES[ "cheque" ][ "type" ] == "image/gif" ) ||
      ( $_FILES[ "cheque" ][ "type" ] == "image/jpeg" ) ||
      ( $_FILES[ "cheque" ][ "type" ] == "image/svg+xml" ) ||
      ( $_FILES[ "cheque" ][ "type" ] == "image/X-PNG" ) ||
      ( $_FILES[ "cheque" ][ "type" ] == "image/PNG" ) ||
      ( $_FILES[ "cheque" ][ "type" ] == "image/png" ) ||
      ( $_FILES[ "cheque" ][ "type" ] == "image/x-png" ) ) {
      $cheque = "$kycupload" . $rand1 . $_FILES[ "cheque" ][ "name" ];
      $cheque0 = $rand1 . $_FILES[ "cheque" ][ "name" ];
      move_uploaded_file( $_FILES[ "cheque" ][ "tmp_name" ], $cheque );
    } else {
      $cheque0 = '';
    }
  }

  if ( $_FILES[ "pancard" ][ "name" ] != '' ) {
    if ( ( $_FILES[ "pancard" ][ "type" ] == "image/gif" ) ||
      ( $_FILES[ "pancard" ][ "type" ] == "image/jpeg" ) ||
      ( $_FILES[ "pancard" ][ "type" ] == "image/svg+xml" ) ||
      ( $_FILES[ "pancard" ][ "type" ] == "image/X-PNG" ) ||
      ( $_FILES[ "pancard" ][ "type" ] == "image/PNG" ) ||
      ( $_FILES[ "pancard" ][ "type" ] == "image/png" ) ||
      ( $_FILES[ "pancard" ][ "type" ] == "image/x-png" ) ) {
      $pancard = "$kycupload" . $rand1 . $_FILES[ "pancard" ][ "name" ];
      $pancard0 = $rand1 . $_FILES[ "pancard" ][ "name" ];
      move_uploaded_file( $_FILES[ "pancard" ][ "tmp_name" ], $pancard );
    } else {
      $pancard0 = '';
    }
  }

  $pancard = $_REQUEST[ 'pancard' ];
  $cheque = $_REQUEST[ 'cheque' ];
  $query = "insert into kyc(benifcyName,userId,accountNumber,ifscCode,bankName,branch,adharUpload,pancard,genDate,cheque) values('$benifcyname','$customeid','$accountnumber','$ifsccode','$bankname','$branch','$adharupload0','$pancard0',now(),'$cheque0')";
  mysqli_query( $link, $query );
  $errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for Submit the KYC Form. We will review then approve it.</div>';
  $errflag = true;
  $_SESSION[ 'kyc_mesage' ] = $errmsg_arr;
  session_write_close();
  header( 'Location: ' . $domain_url . 'kyc.php' );
  ob_end_flush();
}

else if(isset($_REQUEST['del']))
{
$id=$_REQUEST['del'];
$query="delete from kyc WHERE kycId=$id";
mysqli_query($link,$query);
} 


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
    <main class="page-main">
      <div class="block">
        <div class="container">
          <ul class="breadcrumbs">
            <li><a href="index.html"><i class="icon icon-home"></i></a></li>
            <li>/<span>Kyc</span></li>
          </ul>
        </div>
      </div>
      <div class="container"> 
        <!-- Two columns -->
        <div class="row row-table"> 
          <!-- Left column -->
          <div class="col-md-3 filter-col fixed aside">
            <div class="filter-container">
              <div class="fstart"></div>
              <div class="fixed-wrapper">
                <div class="fixed-scroll">
                  <div class="filter-col-header">
                    <div class="title">Filters</div>
                    <a href="#" class="filter-col-toggle"></a> </div>
                  <div class="filter-col-content">
                    <div class="sidebar-block-top">
                      <h2>My Account</h2>
                    </div>
                    <div class="sidebar-block collapsed open">
                      
                      <?php include('side.php'); ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="fend"></div>
            </div>
          </div>
          <!-- /Left column --> 
          <!-- Center column -->
          <div class="col-md-9 aside"> 
            <!-- Page Title -->
            <div class="page-title">
              <div class="title center">
                <h1>KYC</h1>
              </div>
            </div>
            <!-- /Page Title --> 
            <!-- Categories Info -->
            <div class="info-block">
              <div class="dashboard-detail addres-book">
                <h4>Kyc</h4>
                <div class="faq-content tab-content" id="top-tabContent">
                  <div class="tab-pane active" id="orders">
                    <div class="row">
                      <div class="col-12">
                        <div class="card dashboard-table mt-0">
                          <div class="card-body table-responsive-sm" style="padding:0;">
                            <table id="example" class="display nowrap table table-responsive" style="width:100%">
                              <thead>
                                <tr>
                                  <th>Sr No</th>
                                  <th>BenifcyName</th>
                                  <th>AccountNumber</th>
                                  <th>IFSCCode</th>
                                  <th>BankName</th>
                                  <th>Branch</th>
                                  <th>Adhar</th>
                                  <th>Pancard</th>
                                  <th>Cheque or Pass</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
								  $i=1;
                                $kycListSql = mysqli_query( $link, "select * from kyc WHERE userId='$customeid' " );
                                while($kyclistrun = mysqli_fetch_array( $kycListSql )){
                                ?>
                                <tr>
                                  <td><?php echo $i;?></td>
                                  <td><?php echo $kyclistrun['benifcyName'];?></td>
                                  <td><?php echo $kyclistrun['accountNumber'];?></td>
                                  <td><?php echo $kyclistrun['ifscCode'];?></td>
                                  <td><?php echo $kyclistrun['bankName'];?></td>
                                  <td><?php echo $kyclistrun['branch'];?></td>
                                  <td><?php if($kyclistrun['adharUpload']){echo "Yes";}?></td>
                                  <td><?php if($kyclistrun['pancard']){echo "Yes";}?></td>
                                  <td><?php if($kyclistrun['cheque']){echo "Yes";}?></td>
                                  <td><?php if($kyclistrun['astatus']==0){echo "<span style='color:#cfaa00'>Pending</span>";} else if($kyclistrun['astatus']==1){echo "<span style='color:#068e06'>Aproved</span>";}else{echo "<span style='color:#ff0a49'>Reject</span>";} ?></td>
                                  <td><a href="kyc.php?del=<?php echo $kyclistrun['kycId'];?>" onClick="return confirm('Do you really want to remove it?')"><i class="icon icon-close-2" style='color:#ff0a49'></i></a></td>
                                </tr>
                                <?php $i++;} ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
					
					 <?php
if( isset($_SESSION['kyc_mesage']) && is_array($_SESSION['kyc_mesage']) && count($_SESSION['kyc_mesage']) >0 ) {
foreach($_SESSION['kyc_mesage'] as $msg) {
echo $msg;  
}
unset($_SESSION['kyc_mesage']); }?>
					
					
					<h3 style="margin: 30px 0">KYC Form</h3>
                  <form action="kyc.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Benificy name *</label>
                        <input type="text" class="form-control" name="benifcyname" required>
                      </div>
                      <div class="col-md-6">
                        <label>Account Number *</label>
                        <input type="text" class="form-control" name="accountnumber" required>
                      </div>
                      <div class="col-md-4">
                        <label>IFCS Code *</label>
                        <input type="text" class="form-control" name="ifsccode" required>
                      </div>
                      <div class="col-md-4">
                        <label>Bank name *</label>
                        <input type="text" class="form-control" name="bankname" required>
                      </div>
                      <div class="col-md-4">
                        <label>Branch *</label>
                        <input type="text" class="form-control" name="branch" required>
                      </div>
                      <div class="col-md-4">
                        <label>Ahdar Card Upload</label>
                        <input type="file" name="adharupload" required>
                      </div>
                      <div class="col-md-4">
                        <label>Pan Card Upload *</label>
                        <input type="file" name="pancard" required>
                      </div>
                      <div class="col-md-4">
                        <label>Cheque book or Passbook *</label>
                        <input type="file" name="cheque" required>
                      </div>
                    </div>
					  <div style="margin: 50px; text-align: center;">
						  <button type="submit" name="kycSubmit" class="btn btn-primary">Submit</button>
					  </div>
                    
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- /Center column --> 
        </div>
        <div class="ymax"></div>
        <!-- /Two columns --> 
      </div>
    </main>
    <?php


    function GetUsersIDSelfPool( $db, $level, $mlmid, $type )

    {

      $res1 = GetUidsSelfPool( $db, $mlmid, $type );

      if ( $level == 1 )

      {

        $res = $res1;

      }

      if ( $level == 2 )

      {

        $res = getSelfLevelPool2( $db, $res1, $type );

      }

      if ( $level == 3 )

      {

        $res = getSelfLevelPool3( $db, $res1, $type );

      }

      if ( $level == 4 )

      {

        $res = getSelfLevelPool4( $db, $res1, $type );

      }

      if ( $level == 5 )

      {

        $res = getSelfLevelPool5( $db, $res1, $type );

      }

      if ( $level == 6 )

      {

        $res = getSelfLevelPool6( $db, $res1, $type );

      }

      if ( $level == 7 )

      {

        $res = getSelfLevelPool7( $db, $res1, $type );

      }

      if ( $level == 8 )

      {

        $res = getSelfLevelPool8( $db, $res1, $type );

      }

      if ( $level == 9 )

      {

        $res = getSelfLevelPool9( $db, $res1, $type );

      }

      if ( $level == 10 )

      {

        $res = getSelfLevelPool10( $db, $res1, $type );

      }

      return $res;

    }


    function GetUidsSelfPool( $db, $uid, $type )

    {

      $uids = array();

      $q1 = mysqli_query( $db, "select * from `$type` where parent_id = '$uid' and `status` = 0" );

      if ( mysqli_num_rows( $q1 ) > 0 )

      {

        while ( $q4 = mysqli_fetch_assoc( $q1 ) )

        {

          $uid = $q4[ 'uid' ];

          $uids[] = $uid;

        }

        return $uids;


      } else

      {

        return $uids;

      }

    }

    function getSelfLevelPool2( $db, $res, $type )

    {

      $res2 = array();

      //echo "<pre>";print_r($res);

      foreach ( $res as $key => $value ) {

        $res1 = GetUidsSelfPool( $db, $value, $type );

        if ( count( $res1 ) > 0 )

        {

          $res2 = array_merge( $res2, $res1 );

        }

      }

      return $res2;

    }

    function getSelfLevelPool3( $db, $res_arr, $type )

    {

      $res3 = array();

      $res1 = getSelfLevelPool2( $db, $res_arr, $type );

      //echo "<pre>";print_r($res1);

      foreach ( $res1 as $key => $value )

      {

        $res2 = GetUidsSelfPool( $db, $value, $type );

        // print_r($res2);

        if ( count( $res2 ) > 0 && !empty( $res2[ 0 ] ) )

        {

          $res3 = array_merge( $res2, $res3 );

          //echo "<pre>";print_r($res3);

        }

      }

      return ( $res3 );

    }

    function getSelfLevelPool4( $db, $res_arr, $type )

    {

      $res3 = array();

      $res1 = getSelfLevelPool3( $db, $res_arr, $type );

      //echo "<pre>";print_r($res1);

      foreach ( $res1 as $key => $value )

      {

        $res2 = GetUidsSelfPool( $db, $value, $type );

        //print_r($res2);

        if ( count( $res2 ) > 0 && !empty( $res2[ 0 ] ) )

        {

          $res3 = array_merge( $res2, $res3 );

          //echo "<pre>";print_r($res3);

        }

      }

      return ( $res3 );

    }

    function getSelfLevelPool5( $db, $res_arr, $type )

    {

      $res3 = array();

      $res1 = getSelfLevelPool4( $db, $res_arr, $type );

      //echo "<pre>";print_r($res1);

      foreach ( $res1 as $key => $value )

      {

        $res2 = GetUidsSelfPool( $db, $value, $type );

        //print_r($res2);

        if ( count( $res2 ) > 0 && !empty( $res2[ 0 ] ) )

        {

          $res3 = array_merge( $res2, $res3 );

          //echo "<pre>";print_r($res3);

        }

      }

      return ( $res3 );

    }

    function getSelfLevelPool6( $db, $res_arr, $type )

    {

      $res3 = array();

      $res1 = getSelfLevelPool5( $db, $res_arr, $type );

      //echo "<pre>";print_r($res1);

      foreach ( $res1 as $key => $value )

      {

        $res2 = GetUidsSelfPool( $db, $value, $type );

        //print_r($res2);

        if ( count( $res2 ) > 0 && !empty( $res2[ 0 ] ) )

        {

          $res3 = array_merge( $res2, $res3 );

          //echo "<pre>";print_r($res3);

        }

      }

      return ( $res3 );

    }

    function getSelfLevelPool7( $db, $res_arr, $type )

    {

      $res3 = array();

      $res1 = getSelfLevelPool6( $db, $res_arr, $type );

      //echo "<pre>";print_r($res1);

      foreach ( $res1 as $key => $value )

      {

        $res2 = GetUidsSelfPool( $db, $value, $type );

        //print_r($res2);

        if ( count( $res2 ) > 0 && !empty( $res2[ 0 ] ) )

        {

          $res3 = array_merge( $res2, $res3 );

          //echo "<pre>";print_r($res3);

        }

      }

      return ( $res3 );

    }

    function getSelfLevelPool8( $db, $res_arr, $type )

    {

      $res3 = array();

      $res1 = getSelfLevelPool7( $db, $res_arr, $type );

      //echo "<pre>";print_r($res1);

      foreach ( $res1 as $key => $value )

      {

        $res2 = GetUidsSelfPool( $db, $value, $type );

        //print_r($res2);

        if ( count( $res2 ) > 0 && !empty( $res2[ 0 ] ) )

        {

          $res3 = array_merge( $res2, $res3 );

          //echo "<pre>";print_r($res3);

        }

      }

      return ( $res3 );

    }

    function getSelfLevelPool9( $db, $res_arr, $type )

    {

      $res3 = array();

      $res1 = getSelfLevelPool8( $db, $res_arr, $type );

      //echo "<pre>";print_r($res1);

      foreach ( $res1 as $key => $value )

      {

        $res2 = GetUidsSelfPool( $db, $value, $type );

        //print_r($res2);

        if ( count( $res2 ) > 0 && !empty( $res2[ 0 ] ) )

        {

          $res3 = array_merge( $res2, $res3 );

          //echo "<pre>";print_r($res3);

        }

      }

      return ( $res3 );

    }

    function getSelfLevelPool10( $db, $res_arr, $type )

    {

      $res3 = array();

      $res1 = getSelfLevelPool9( $db, $res_arr, $type );

      //echo "<pre>";print_r($res1);

      foreach ( $res1 as $key => $value )

      {

        $res2 = GetUidsSelfPool( $db, $value, $type );

        //print_r($res2);

        if ( count( $res2 ) > 0 && !empty( $res2[ 0 ] ) )

        {

          $res3 = array_merge( $res2, $res3 );

          //echo "<pre>";print_r($res3);

        }

      }

      return ( $res3 );

    }


    ?>
    <?php include('include/footer.php');?>