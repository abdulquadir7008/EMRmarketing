<?php
include_once( 'include/configuration.php' );
ob_start();
$SQLproductDetails = "select * from products where status='1' AND seo_keywords='$productDetailsKey'";
$MySQLProductDetails = mysqli_query( $link, $SQLproductDetails );
$ListproductDetails = mysqli_fetch_array( $MySQLProductDetails );
$productDetID = $ListproductDetails[ 'id' ];
$setpagename;
$parentcat_keyword;
if ( isset( $_REQUEST[ 'Uplace' ] ) && isset( $_SESSION[ 'member_id' ] ) ) {
  $fname = $_REQUEST[ 'fname' ];
  $lname = $_REQUEST[ 'lname' ];
  $phone = $_REQUEST[ 'phone' ];
  $email = $_REQUEST[ 'email' ];
  $country = $_REQUEST[ 'country' ];
  $stree_address = $_REQUEST[ 'stree_address' ];
  $city = $_REQUEST[ 'city' ];
  $state = $_REQUEST[ 'state' ];
  $postalcode = $_REQUEST[ 'postalcode' ];
  $password = md5( $_REQUEST[ 'password' ] );
  $queryatleast = "update membership SET fname='$fname',lname='$lname', date=now(),email='$email',country='$country',stree_address='$stree_address',city='$city', state='$state',postalcode='$postalcode',password='$password' WHERE member_id=$customeid";
  mysqli_query( $link, $queryatleast );
  $errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for profile Update.</div>';
  $errflag = true;
  $_SESSION[ 'profilerror' ] = $errmsg_arr;
  session_write_close();
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
        <li>/<span>Dashboard</span></li>
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
                <div class="title">Menu</div>
                <a href="#" class="filter-col-toggle"></a> </div>
              <div class="filter-col-content"> 
                <!--
											<div class="sidebar-block-top">
												<h2>My Account</h2>
												
											</div>
-->
                <div class="sidebar-block collapsed open">
                  <div class="block-title"> <span>My Account</span>
                    <div class="filtr_row"><a href="#" class="filter-col-toggle"></a></div>
                  </div>
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
            <h1>DashBoard</h1>
            <a href="whatsapp://send?text=https://www.emrmarketing.in/register_tree.php?userlink=<?php echo $customerchechlogin_row['userid'];?>" data-action="share/whatsapp/share" style="background: #00a82d; padding: 10px 20px 10px 10px; color: #fff;"> <img src="images/whatsicon.png" width="20" style="margin-right: 5px;"> Share Referral Link to Whatsapp</a> <a href="register_tree.php?userlink=<?php echo $customerchechlogin_row['userid'];?>">Share link</a> </div>
        </div>
        <!-- /Page Title --> 
        <!-- Categories Info -->
        <div class="info-block">
          <div class="dashboard-detail clearfix">
            <div class="wallet_details">
              <h4>Main Wallet</h4>
              <!-- <span><?php echo number_format($customerchechlogin_row['main_wallet'],2, '.', ',');?></span> --> 
              <span>
              <?php
              $main_t = 0;
              $maomm = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `main_wallet` WHERE `uid`='$customeid' and status='0' " ) );

              $add_mainn = $maomm[ 'main_wallet' ];

              $mwce1 = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `main_wallet` WHERE `uid`='$customeid' and status='1' " ) );

              $sub_wavde = $mwce1[ 'main_wallet' ];

              $main_t = ( $add_mainn - $sub_wavde );
              echo number_format( $main_t, 2, '.', ',' );
              ?>
              </span>
              <?php
              $userc04 = mysqli_num_rows( mysqli_query( $db, "select uid from up_trans_history111 where uid='$customeid' and (status = 0 or status = 3)" ) );
              if ( ( $main_t > 0 ) ) {
                ?>
              <?php
              if ( $userc04 > 0 ) {
                echo "<h4>Already Requested</h4>";
              } else {
                ?>
              <br>
              <span class="badge btn btn-sm btn-primary badge-success WithdrawR" data-id="<?php echo $customeid; ?>">Withdraw </span>
              <?php } ?>
              <?php
              }
              ?>
              <br>
              <a href="viewwal.php" class="badge btn btn-sm btn-primary badge-success">View</a> </div>
            <div class="wallet_details">
              <h4>Daily Wallet</h4>
              <span>
              <?php
              $tot_wave = 0;
              $mwce = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `daily_wallet` WHERE `uid`='$customeid' and status='0' " ) );

              $add_wafer = $mwce[ 'main_wallet' ];

              //$mdai = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `daily_wallet` WHERE `uid`='$customeid' and status='1' "));

              //$sub_dai = $mdai['main_wallet'];

              $tot_wave = ( $add_wafer );
              echo number_format( $tot_wave, 2, '.', ',' );
              ?>
              </span> </div>
            <div class="wallet_details">
              <h4> Pool 2 Wallet</h4>
              <span>
              <?php
              $tot_wal89 = 0;
              $mwp8 = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `selfpool_wallet` WHERE `uid`='$customeid' and status='0' " ) );

              $add_wal80 = $mwp8[ 'main_wallet' ];

              $mwself = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `selfpool_wallet` WHERE `uid`='$customeid' and status='1' " ) );

              $sub_self = $mwself[ 'main_wallet' ];

              $tot_wal89 = ( $add_wal80 - $sub_self );
              echo number_format( $tot_wal89, 2, '.', ',' );
              ?>
              </span>
              <?php
              // if (isMultipleOf500($tot_wal89)) { ?>
              <br>
              <span class="badge btn btn-sm btn-primary badge-success SelfBoost" data-id="<?php echo $customeid; ?>">Enter Now </span>
              <?php //}
              ?>
              <br>
              <a href="pool2.php" class="badge btn btn-sm btn-primary badge-success">Deposite</a> </div>
            <div class="wallet_details">
              <h4>Booster 1 Wallet</h4>
              <span>
              <?php
              $tot_wal5c = '0';
              $mwpvt = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `booster1_wallet` WHERE `uid`='$customeid' and status='0' " ) );

              $add_walfr = $mwpvt[ 'main_wallet' ];

              $mwboo1 = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `booster1_wallet` WHERE `uid`='$customeid' and status='1' " ) );

              $sub_boo1 = $mwboo1[ 'main_wallet' ];

              $tot_wal5c = ( $add_walfr - $sub_boo1 );
              echo number_format( $tot_wal5c, 2, '.', ',' );
              ?>
              </span>
              <?php
              //if (isMultipleOf100($tot_wal5c)) { ?>
              <br>
              <span class="badge btn btn-sm btn-primary badge-success Boost1" data-id="<?php echo $customeid; ?>">Enter Now </span>
              <?php //}
              ?>
              <br>
              <a href="booster1.php" class="badge btn btn-sm btn-primary badge-success">Deposite</a> </div>
            <div class="wallet_details">
              <h4>Booster 2 Wallet</h4>
              <span>
              <?php
              $tot_wal = '0';
              $mwp = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `gold_wallet` WHERE `uid`='$customeid' and status='0' " ) );

              $add_wal = $mwp[ 'main_wallet' ];

              $mwgold = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `gold_wallet` WHERE `uid`='$customeid' and status='1' " ) );

              $sub_gold = $mwgold[ 'main_wallet' ];

              $tot_wal = ( $add_wal - $sub_gold );
              echo number_format( $tot_wal, 2, '.', ',' );
              ?>
              </span>
              <?php
              // if (isMultipleOf500($tot_wal)) { ?>
              <br>
              <span class="badge btn btn-sm btn-primary badge-success GoldBoost" data-id="<?php echo $customeid; ?>">Enter Now </span>
              <?php //}
              ?>
              <br>
              <a href="gold.php" class="badge btn btn-sm btn-primary badge-success">Deposite</a> </div>
            <div class="wallet_details">
              <h4> Booster 3 Wallet</h4>
              <span>
              <?php
              $tot_wal01 = '0';
              $mwp01 = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `diamond_wallet` WHERE `uid`='$customeid' and status='0' " ) );

              $add_wal01 = $mwp01[ 'main_wallet' ];

              $mwdia = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `diamond_wallet` WHERE `uid`='$customeid' and status='1' " ) );

              $sub_dia = $mwdia[ 'main_wallet' ];

              $tot_wal01 = ( $add_wal01 - $sub_dia );
              echo number_format( $tot_wal01, 2, '.', ',' );
              ?>
              </span>
              <?php
              // if (isMultipleOf1000($tot_wal)) { ?>
              <br>
              <span class="badge btn btn-sm btn-primary badge-success DiaBoost" data-id="<?php echo $customeid; ?>">Enter Now </span>
              <?php //}
              ?>
              <br>
              <a href="diamond.php" class="badge btn btn-sm btn-primary badge-success">Deposite</a> </div>
            <div class="wallet_details">
              <h4> Robotic Wallet</h4>
              <span>
              <?php
              $tot_rob = '0';
              $mwrc = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `robotic_wallet` WHERE `uid`='$customeid' and status='0' " ) );

              $add_rob = $mwrc[ 'main_wallet' ];

              $mwprob = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `robotic_wallet` WHERE `uid`='$customeid' and status='1' " ) );

              $sub_rob = $mwprob[ 'main_wallet' ];

              $tot_rob = ( $add_rob - $sub_rob );
              echo number_format( $tot_rob, 2, '.', ',' );
              ?>
              </span> <br>
              <a href="robow.php" class="badge btn btn-sm btn-primary badge-success">Deposite</a> </div>
            <div class="wallet_details">
              <h4>Binary Income</h4>
              <span>
              <?php
              $binary_inc = '0';
              $mwfe = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `binary_income` WHERE `uid`='$customeid' and status='0' " ) );
              $add_fe = $mwfe[ 'main_wallet' ];
              // $mgr = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `binary_income` WHERE `uid`='$customeid' and status='1' "));
              // $sub_wgr = $mgr['main_wallet'];
              $binary_inc = ( $add_fe );
              echo number_format( $binary_inc, 2, '.', ',' );
              ?>
              </span> </div>
            <div class="wallet_details">
              <h4>Sponsor Income</h4>
              <span>
              <?php
              $sponsor_income = '0';
              $spe = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `sponsor_income` WHERE `uid`='$customeid' and status='0' " ) );
              $add_sp = $spe[ 'main_wallet' ];
              // $sprf = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `sponsor_income` WHERE `uid`='$customeid' and status='1' "));
              // $sub_sp = $sprf['main_wallet'];
              $sponsor_income = ( $add_sp );
              echo number_format( $sponsor_income, 2, '.', ',' );
              ?>
              </span> </div>
            <div class="wallet_details">
              <h4>Pool 2 Income</h4>
              <span>
              <?php
              $pool2 = '0';
              // echo "SELECT SUM(amount) AS main_wallet FROM `selfpool_income` WHERE `uid`='$customeid' and status='0' ";
              $sodf = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `selfpool_income` WHERE `uid`='$customeid' and status='0' " ) );
              $add_sl = $sodf[ 'main_wallet' ];
              // $mspf = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `selfpool_income` WHERE `uid`='$customeid' and status='1' "));
              // $sub_wsp = $mspf['main_wallet'];
              $pool2 = ( $add_sl );
              echo number_format( $pool2, 2, '.', ',' );
              ?>
              </span> </div>
            <div class="wallet_details">
              <h4>Pool 2 Level Income</h4>
              <span>
              <?php
              $pool2_level = '0';
              $tegc = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `autopool_income` WHERE `uid`='$customeid' and status='0' " ) );
              $add_pdd = $tegc[ 'main_wallet' ];
              // $tegc1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `autopool_income` WHERE `uid`='$customeid' and status='1' "));
              // $sub_wvx = $tegc1['main_wallet'];
              $pool2_level = ( $add_pdd );
              echo number_format( $pool2_level, 2, '.', ',' );
              ?>
              </span> </div>
            <div class="wallet_details">
              <h4>Booster 1 Income</h4>
              <span>
              <?php
              $boost1_income = '0';
              $mdwp = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `boost1_income` WHERE `uid`='$customeid' and status='0' " ) );
              $add_wal05 = $mdwp[ 'main_wallet' ];
              // $mwpc1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `boost1_income` WHERE `uid`='$customeid' and status='1' "));
              // $sub_wab1 = $mwpc1['main_wallet'];
              $boost1_income = ( $add_wal05 );
              echo number_format( $boost1_income, 2, '.', ',' );
              ?>
              </span> </div>
            <div class="wallet_details">
              <h4>Booster 1 Level Income</h4>
              <span>
              <?php
              $boost1_level_income = '0';
              $mwp01 = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `boost1_level_income` WHERE `uid`='$customeid' and status='0' " ) );
              $add_wal01 = $mwp01[ 'main_wallet' ];
              // $mwp101 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `boost1_level_income` WHERE `uid`='$customeid' and status='1' "));
              // $sub_wal01 = $mwp101['main_wallet'];
              $boost1_level_income = ( $add_wal01 );
              echo number_format( $boost1_level_income, 2, '.', ',' );
              ?>
              </span> </div>
            <div class="wallet_details">
              <h4>Booster 2 Income</h4>
              <span>
              <?php
              $boost2_income = '0';
              $mwfp = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `goldboost_income` WHERE `uid`='$customeid' and status='0' " ) );
              $add_wcal = $mwfp[ 'main_wallet' ];
              // $mwptts = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `goldboost_income` WHERE `uid`='$customeid' and status='1' "));
              // $sub_wadl = $mwptts['main_wallet'];
              $boost2_income = ( $add_wcal );
              echo number_format( $boost2_income, 2, '.', ',' );
              ?>
              </span> </div>
            <div class="wallet_details">
              <h4>Booster 3 Income</h4>
              <span>
              <?php
              $boost3_income = '0';
              $ccsr = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `diaboost_income` WHERE `uid`='$customeid' and status='0' " ) );
              $add_ce = $ccsr[ 'main_wallet' ];
              // $csrse = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `diaboost_income` WHERE `uid`='$customeid' and status='1' "));
              // $sub_vefc = $csrse['main_wallet'];
              $boost3_income = ( $add_ce );
              echo number_format( $boost3_income, 2, '.', ',' );
              ?>
              </span> </div>
            <div class="wallet_details">
              <h4>Code Income</h4>
              <span>
              <?php
              $code_income = '0';
              $csvr = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `code_user_wallet` WHERE `uid`='$customeid' and status='0' " ) );
              $add_cec = $csvr[ 'main_wallet' ];
              // $codeu = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `code_user_wallet` WHERE `uid`='$customeid' and status='1' "));
              // $sub_coded = $codeu['main_wallet'];
              $code_income = ( $add_cec );
              echo number_format( $code_income, 2, '.', ',' );
              ?>
              </span> </div>
            <div class="wallet_details">
              <h4>Repurchase Income</h4>
              <span>
              <?php
              $rep_income = '0';
              $csrep = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `repurchase_income` WHERE `uid`='$customeid' and status='0' " ) );
              $add_rep = $csrep[ 'main_wallet' ];
              // $csrep1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `diaboost_income` WHERE `uid`='$customeid' and status='1' "));
              // $sub_rep1 = $csrep1['main_wallet'];
              $rep_income = ( $add_rep );
              echo number_format( $rep_income, 2, '.', ',' );
              ?>
              </span> </div>
            <div class="wallet_details">
              <h4>Robotic Pool Income</h4>
              <span>
              <?php
              $robotic = '0';
              $csrd = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `robotic_income` WHERE `uid`='$customeid' and status='0' " ) );
              $add_rob = $csrd[ 'main_wallet' ];
              $csrdrob = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `robotic_income` WHERE `uid`='$customeid' and status='1' " ) );
              $sub_robb = $csrdrob[ 'main_wallet' ];
              $robotic = ( $add_rob - $sub_robb );
              echo number_format( $robotic, 2, '.', ',' );
              ?>
              </span> </div>
            <div class="wallet_details">
              <h4>Rank Club Income</h4>
              <span>
              <?php
              $rank_income = '0';
              $crank = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `rank_income` WHERE `uid`='$customeid' and status='0' " ) );
              $add_rabk = $crank[ 'main_wallet' ];
              // $csrep1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `diaboost_income` WHERE `uid`='$customeid' and status='1' "));
              // $sub_rep1 = $csrep1['main_wallet'];
              $rank_income = ( $add_rabk );
              echo number_format( $rank_income, 2, '.', ',' );
              ?>
              </span> </div>
            <div class="wallet_details">
              <h4>Rank Club Royalty Income</h4>
              <span>
              <?php
              $royalty_income = '0';
              $croy = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `royalty_income` WHERE `uid`='$customeid' and status='0' " ) );
              $add_roy = $croy[ 'main_wallet' ];
              // $csrep1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `diaboost_income` WHERE `uid`='$customeid' and status='1' "));
              // $sub_rep1 = $csrep1['main_wallet'];
              $royalty_income = ( $add_roy );
              echo number_format( $royalty_income, 2, '.', ',' );
              ?>
              </span> </div>
            <div class="wallet_details">
              <h4>Global Pool Carier Income</h4>
              <span>
              <?php
              $global_income = '0';
              $glb = mysqli_fetch_assoc( mysqli_query( $db, "SELECT SUM(amount) AS main_wallet FROM `global_income` WHERE `uid`='$customeid' and status='0' " ) );
              $add_glb = $glb[ 'main_wallet' ];
              // $csrep1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `diaboost_income` WHERE `uid`='$customeid' and status='1' "));
              // $sub_rep1 = $csrep1['main_wallet'];
              $global_income = ( $add_glb );
              echo number_format( $global_income, 2, '.', ',' );
              ?>
              </span> </div>
            <!-- <div class="wallet_details">
										<h4>Robotic Pool Income</h4>
										<span><?php
											$wallet_ncome ='0';
                                                $poolsql="select * from pool_100 WHERE wallet_ncome > 0 and memeber_id='$customeid'"; 
                                                $listpool=mysqli_query($link,$poolsql); 
                                                while($Listlog=mysqli_fetch_array($listpool)) {
                                                	$wallet_ncome = $wallet_ncome + $Listlog['wallet_ncome'];                            
                                				}
                                											echo number_format($wallet_ncome,2, '.', ',');
                                            ?></span>
									</div> -->
            
            <div class="wallet_details">
              <h4>Ad View Income</h4>
              <span>
              <?php
              $adviewsql = mysqli_query( $link, "select * from ad_view_wallet WHERE user_id='$customeid'" );
              $advlist = mysqli_fetch_array( $adviewsql );
              if ( $advlist[ 'wallet' ] > 0 ) {
                echo number_format( $advlist[ 'wallet' ], 2, '.', ',' );
              } else {
                echo number_format( 0, 2, '.', ',' );
              }


              ?>
              </span> </div>
            
            <!--
									<div class="wallet_details">
										<h4>Sponser Commisssion</h4>
										<span>2000.00</span>
									</div>
--> 
            
          </div>
        </div>
      </div>
      <!-- /Center column --> 
    </div>
    <div class="ymax"></div>
    <!-- /Two columns --> 
  </div>
</main>
<?php include('include/footer.php');?>
<style>
	.modal-dialog .btn, .modal-dialog input {
		margin-bottom: 0px !important;
	}
</style>
<script>
	$("body").on('click', '.GoldBoost', function()
	{
		$elm=$(this);
		bootbox.confirm({
			message: "Warning: You are about to Enter Booster 2. Continue to Enter?",
			buttons: {
				confirm: {
					label: 'Yes',
					className: 'btn-success'
				},
				cancel: {
					label: 'No',
					className: 'btn-danger'
				}
			},
			callback: function (result)
			{
				if(result == true)
				{
					$('.bootbox-confirm').modal('hide');
					$elm.hide();
					$elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
					var uid = $elm.attr("data-id");
					$.ajax({
						type : 'POST',
						url : "EMRadmin/afunction.php",
						data :  {
							uid : uid,
							type : "GoldBoost"
						},
						success : function(data)
						{
							$(".submit-loading").remove();
							$elm.show();
							var data = jQuery.parseJSON(data);
							if(data.valid)
							{
								$.notify({
									message: data.message
								},{
									allow_dismiss: true,
									type: 'success',
									placement: {
										from: "bottom",
										align: "right"
									},
									offset: 20,
									spacing: 10,
									z_index: 1000000
								});
								setTimeout(function(){
									location.reload();
								}, 3000);
								return false;
							}
							else
							{
								$.notify({
									message: data.message
								},{
									allow_dismiss: true,
									type: 'info',
									placement: {
										from: "bottom",
										align: "right"
									},
									offset: 20,
									spacing: 10,
									z_index: 1000000
								});
								return false;
							}
							return false;
						}
					});
				}
			}
		});
	});

	$("body").on('click', '.SelfBoost', function()
	{
		$elm=$(this);
		bootbox.confirm({
			message: "Warning: You are about to Enter Pool 2. Continue to Enter?",
			buttons: {
				confirm: {
					label: 'Yes',
					className: 'btn-success'
				},
				cancel: {
					label: 'No',
					className: 'btn-danger'
				}
			},
			callback: function (result)
			{
				if(result == true)
				{
					$('.bootbox-confirm').modal('hide');
					$elm.hide();
					$elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
					var uid = $elm.attr("data-id");
					$.ajax({
						type : 'POST',
						url : "EMRadmin/afunction.php",
						data :  {
							uid : uid,
							type : "SelfBoost"
						},
						success : function(data)
						{
							$(".submit-loading").remove();
							$elm.show();
							var data = jQuery.parseJSON(data);
							if(data.valid)
							{
								$.notify({
									message: data.message
								},{
									allow_dismiss: true,
									type: 'success',
									placement: {
										from: "bottom",
										align: "right"
									},
									offset: 20,
									spacing: 10,
									z_index: 1000000
								});
								setTimeout(function(){
									location.reload();
								}, 3000);
								return false;
							}
							else
							{
								$.notify({
									message: data.message
								},{
									allow_dismiss: true,
									type: 'info',
									placement: {
										from: "bottom",
										align: "right"
									},
									offset: 20,
									spacing: 10,
									z_index: 1000000
								});
								return false;
							}
							return false;
						}
					});
				}
			}
		});
	});

	$("body").on('click', '.WithdrawR', function()
	{
		$elm=$(this);
		bootbox.confirm({
			message: "Warning: You are about to Withdraw Main Wallet Amount. Continue to Withdraw?",
			buttons: {
				confirm: {
					label: 'Yes',
					className: 'btn-success'
				},
				cancel: {
					label: 'No',
					className: 'btn-danger'
				}
			},
			callback: function (result)
			{
				if(result == true)
				{
					$('.bootbox-confirm').modal('hide');
					$elm.hide();
					$elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
					var uid = $elm.attr("data-id");
					$.ajax({
						type : 'POST',
						url : "EMRadmin/afunction.php",
						data :  {
							uid : uid,
							type : "WithdrawR"
						},
						success : function(data)
						{
							$(".submit-loading").remove();
							$elm.show();
							var data = jQuery.parseJSON(data);
							if(data.valid)
							{
								$.notify({
									message: data.message
								},{
									allow_dismiss: true,
									type: 'success',
									placement: {
										from: "bottom",
										align: "right"
									},
									offset: 20,
									spacing: 10,
									z_index: 1000000
								});
								setTimeout(function(){
									location.reload();
								}, 3000);
								return false;
							}
							else
							{
								$.notify({
									message: data.message
								},{
									allow_dismiss: true,
									type: 'info',
									placement: {
										from: "bottom",
										align: "right"
									},
									offset: 20,
									spacing: 10,
									z_index: 1000000
								});
								return false;
							}
							return false;
						}
					});
					return false;
				}
			}
		});
	});

	$("body").on('click', '.DiaBoost', function()
	{
		$elm=$(this);
		bootbox.confirm({
			message: "Warning: You are about to Enter Booster 3. Continue to Enter?",
			buttons: {
				confirm: {
					label: 'Yes',
					className: 'btn-success'
				},
				cancel: {
					label: 'No',
					className: 'btn-danger'
				}
			},
			callback: function (result)
			{
				if(result == true)
				{
					$('.bootbox-confirm').modal('hide');
					$elm.hide();
					$elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
					var uid = $elm.attr("data-id");
					$.ajax({
						type : 'POST',
						url : "EMRadmin/afunction.php",
						data :  {
							uid : uid,
							type : "DiaBoost"
						},
						success : function(data)
						{
							$(".submit-loading").remove();
							$elm.show();
							var data = jQuery.parseJSON(data);
							if(data.valid)
							{
								$.notify({
									message: data.message
								},{
									allow_dismiss: true,
									type: 'success',
									placement: {
										from: "bottom",
										align: "right"
									},
									offset: 20,
									spacing: 10,
									z_index: 1000000
								});
								setTimeout(function(){
									location.reload();
								}, 3000);
								return false;
							}
							else
							{
								$.notify({
									message: data.message
								},{
									allow_dismiss: true,
									type: 'info',
									placement: {
										from: "bottom",
										align: "right"
									},
									offset: 20,
									spacing: 10,
									z_index: 1000000
								});
								return false;
							}
							return false;
						}
					});
				}
			}
		});
	});
	$("body").on('click', '.Boost1', function()
	{
		$elm=$(this);
		bootbox.confirm({
			message: "Warning: You are about to Enter Booster 1. Continue to Enter?",
			buttons: {
				confirm: {
					label: 'Yes',
					className: 'btn-success'
				},
				cancel: {
					label: 'No',
					className: 'btn-danger'
				}
			},
			callback: function (result)
			{
				if(result == true)
				{
					$('.bootbox-confirm').modal('hide');
					$elm.hide();
					$elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
					var uid = $elm.attr("data-id");
					$.ajax({
						type : 'POST',
						url : "EMRadmin/afunction.php",
						data :  {
							uid : uid,
							type : "Boost1"
						},
						success : function(data)
						{
							$(".submit-loading").remove();
							$elm.show();
							var data = jQuery.parseJSON(data);
							if(data.valid)
							{
								$.notify({
									message: data.message
								},{
									allow_dismiss: true,
									type: 'success',
									placement: {
										from: "bottom",
										align: "right"
									},
									offset: 20,
									spacing: 10,
									z_index: 1000000
								});
								setTimeout(function(){
									location.reload();
								}, 3000);
								return false;
							}
							else
							{
								$.notify({
									message: data.message
								},{
									allow_dismiss: true,
									type: 'info',
									placement: {
										from: "bottom",
										align: "right"
									},
									offset: 20,
									spacing: 10,
									z_index: 1000000
								});
								return false;
							}
							return false;
						}
					});
				}
			}
		});
	});
</script>