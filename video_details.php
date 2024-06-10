<?php
include_once( 'include/configuration.php' );
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from big-skins.com/frontend/EMR/html/index-layout-6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Mar 2023 07:02:11 GMT -->
<?php include_once('include/head.php');?>
<?php
if ( isset( $_REQUEST[ 'embed' ] ) ) {
  $embed = $_REQUEST[ 'embed' ];
  $sql_video_details = mysqli_query( $link, "select * from video WHERE seo_keyword='$embed'" );
  $list_video_list = mysqli_fetch_array( $sql_video_details );
  $video_id = $list_video_list[ 'id' ];

  $wallet_video_sql = mysqli_query( $link, "select * from ad_view_wallet WHERE user_id='$customeid'" );
  $list_wallet = mysqli_fetch_array( $wallet_video_sql );
	
  
  $cur_date = strtotime( date( 'Y-m-d', time() ) );
  $currentDate = new DateTime();
  $currentDate->modify( '+30 days' );
  $resultDateString = $currentDate->format( 'Y-m-d H:i:s' );	
 	$nowdate = date("Y-m-d");
	
  $sql_adlimit2 = mysqli_query( $link, "select * from ad_view_income_list WHERE user_id='$customeid' and start_date='$nowdate'" );
	
//$sqlDataLog = mysqli_query( $link, "select * from datalogs WHERE member_id='$customeid' and success_code='PAYMENT_SUCCESS'" );
	
$memeberPerc = mysqli_query( $link, "select * from membership WHERE member_id='$customeid'" );	
$listmemebr202405 = mysqli_fetch_array( $memeberPerc );
	
  $sql_adlimit = mysqli_query( $link, "select * from ad_view_income_list WHERE user_id='$customeid' and start_date='$nowdate' AND video_id='$video_id'" );
  $listadviewLimit = mysqli_fetch_array( $sql_adlimit );	

  	$UserExpiredate = strtotime( date( "Y-m-d", strtotime( $list_wallet[ 'end_date' ] ) ) );
    if( $UserExpiredate != $cur_date){
		if(mysqli_num_rows($sql_adlimit2) <= 9){
			if($listadviewLimit['video_id']!=$video_id && $list_wallet[ 'wallet' ] < 30000 && $listmemebr202405['binary_status']>0){
				if ( $list_wallet[ 'user_id' ] == $customeid ) {
	
	$query = "insert into ad_view_income_list(user_id,video_id,income,start_date) values('$customeid','$video_id','100',now())";
    mysqli_query( $link, $query );	
      $wallet_count = $list_wallet[ 'wallet' ] + 100;
      $video_watch_count = $list_wallet[ 'video_watch_count' ] + 1;
      $query = "update ad_view_wallet SET user_id='$customeid',wallet='$wallet_count',video_watch_count='$video_watch_count' WHERE user_id=$customeid";
      mysqli_query( $link, $query );
    } else {
		
	$query = "insert into ad_view_income_list(user_id,video_id,income,start_date) values('$customeid','$video_id','100',now())";
    mysqli_query( $link, $query );

      $query = "insert into ad_view_wallet(user_id,wallet,video_watch_count,start_date,end_date) values('$customeid','100','1',now(),'$resultDateString')";
      mysqli_query( $link, $query );
    }
			}
			else{

    
  }
		}
	}
	
}
?>
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
            <li>/<span>Ad View Income</span></li>
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
                      
                      <div class="block-content">
                        <ul class="category-list">
                          <li><a href="profile/" class="value">Account Dashboard</a> </li>
                          <li><a href="address.php">Address Book</a> </li>
                          <li><a href="account_info.php">Account Information</a> </li>
                          <li><a href="order.php">My Order</a>
                            <?php
                            $totalorder = '';
                            $order_email11 = $customerchechlogin_row[ 'email' ];
                            $sql_logs11 = "select * from datalogs where email='$order_email11' order by indate DESC";
                            $res_logs11 = mysqli_query( $link, $sql_logs11 );
                            while ( $listlogs11 = mysqli_fetch_array( $res_logs11 ) ) {
                              if ( $listlogs11[ 'ship_details' ] ) {
                                $datalog_id11 = $listlogs11[ 'dil_id' ];
                                $sql_order11 = "select * from orderproduct WHERE datalogid='$datalog_id11'";
                                $result_order11 = mysqli_query( $link, $sql_order11 );
                                $totalorder = ( $totalorder + mysqli_num_rows( $result_order11 ) );

                              }
                            }
                            if ( $totalorder > 0 ) {
                              echo "<span class='ordnumcount'>" . $totalorder . "</span>";
                            }
                            ?>
                          </li>
                          <li><a href="wishlist/">Wishlist</a></li>
                          <li class="active"><a href="ad-view-income/">Ad View Income</a></li>
                        </ul>
                        <div class="bg-striped"></div>
                      </div>
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
                <h1>Ad View Income</h1>
              </div>
            </div>
            <!-- /Page Title --> 
            <!-- Categories Info -->
            <div class="info-block">
              <div class="dashboard-detail">
                <p><strong>N </strong>If you watch the complete video below then you will get 100 rupees in your wallet as reward, this is for all the videos. And you can spend this Rs 100 only on product repurchase.</p>
                <div class="col-md-12 detailsvideo">
                  <?php if ($list_video_list['video']) { ?>
                  <div class="video-container">
                    <video width="100%" height="100%" controls autoplay>
                      <source src="<?php echo $video_path.$list_video_list['video']; ?>" type="video/mp4">
                    </video>
                  </div>
                  <?php } else if ($list_video_list['video_link']) { ?>
                  <div class="video-container">
                    <iframe width="100%" height="450" src="<?php echo $list_video_list['video_link'];?>?autoplay=1" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <?php } ?>
                  <h4><?php echo $list_video_list['title']; ?></h4>
                </div>
                <div class="row">
                  <?php
                  $ResultSQL = mysqli_query( $link, "select * from video WHERE status='1' order by id DESC" );
                  while ( $Listbrand = mysqli_fetch_array( $ResultSQL ) ) {
                    ?>
                  <div class="col-md-3 adincome">
                    <div class="video-list"> <a href="video_details.php?embed=<?php echo $Listbrand['seo_keyword'];?>"> <span><img src="images/plybtn.png"></span>
                      <?php if($Listbrand['image2']){?>
                      <img src="<?php echo $video_path.$Listbrand['image2'];?>">
                      <?php } else { ?>
                      <img src="images/emr-cover.jpg">
                      <?php } ?>
                      </a> </div>
                    <h5><a href="video_details.php?embed=<?php echo $Listbrand['seo_keyword'];?>"><?php echo $Listbrand['title'];?></a></h5>
                  </div>
                  <?php } ?>
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
    <?php include('include/footer.php');?>