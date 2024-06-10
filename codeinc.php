<?php
include_once( 'include/configuration.php' );
// $SQLproductDetails = "select * from products where status='1' AND seo_keywords='$productDetailsKey'";
// $MySQLProductDetails = mysqli_query($link,$SQLproductDetails); 
// $ListproductDetails = mysqli_fetch_array($MySQLProductDetails);
// $productDetID = $ListproductDetails['id'];
// $setpagename;
// $parentcat_keyword;
date_default_timezone_set('Asia/Kolkata'); 
if(isset($_REQUEST['codeinc_add']) && isset($_SESSION['member_id'])){
    $code=$_REQUEST['code'];
    $uid=$_SESSION['member_id'];
    $qx10 = mysqli_query($db,"SELECT t1.* FROM `membership` t1 WHERE t1.member_id = '$uid' AND (t1.binary_status = '1' OR t1.binary_status = '2')");
    $c1 = mysqli_num_rows($qx10);
    if($c1 > 0){
        $tables_to_check = array("binary_income", "sponsor_income", "autopool_income", "boost1_income", "boost1_level_income", "goldboost_income", "diaboost_income"); // Add more tables as needed
        foreach ($tables_to_check as $table) {
            // Prepare and execute SELECT query
            $sql = "SELECT * FROM $table WHERE `uid` = $uid"; // Assuming user_id is the column name for user ID
            $result = mysqli_query($db, $sql);
            // Check if any rows are returned
            if (mysqli_num_rows($result) > 0) {
                // Data found in this table
                $dataFound = true;
                break; // Exit the loop since data is found
            }
        }
        if ($dataFound) {
            $errmsg_arr = array();
            $errflag = false;
            $errmsg_arr[] = '<div class="label_error">Not Eligible.</div>';
            $errflag = true;
            $_SESSION['ERRMSG_ARRR'] = $errmsg_arr;
            echo "<script type='text/javascript'>window.location.href = 'codeinc.php';</script>";
            session_write_close();
        } else {
            $code_income ='0';
            $csr = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `code_user_wallet` WHERE `uid`='$uid'"));
            $code_income = $csr['main_wallet'];
            if($code_income > 1000){
                $errmsg_arr = array();
                $errflag = false;
                $errmsg_arr[] = '<div class="label_error">You have crossed the capping for Code Income .</div>';
                $errflag = true;
                $_SESSION['ERRMSG_ARRR'] = $errmsg_arr;
                echo "<script type='text/javascript'>window.location.href = 'codeinc.php';</script>";
                session_write_close();
            }else {
                $query=mysqli_query($db,"SELECT * FROM `code`  WHERE `code`='$code'");
                if(mysqli_num_rows($query)>0){
                    $Listbrand=mysqli_fetch_assoc($query);
                    $code = $Listbrand['code'];
                    $f_time = $Listbrand['f_time'];
                    $t_time = $Listbrand['t_time'];
                    $fromTime = strtotime($Listbrand['f_time']); // Convert from string to timestamp
                    $toTime = strtotime($Listbrand['t_time']); // Convert from string to timestamp
                    // Get the current time
                    $currentTime = time();
                    // Check if the current time is within the range
                    if ($currentTime >= $fromTime && $currentTime <= $toTime) {
                        $qcuery=mysqli_query($db,"SELECT * FROM `code_users`  WHERE `code`='$code' and `status` = 0 and `uid` = $uid");
                        if(mysqli_num_rows($qcuery)>0){
                            $errmsg_arr = array();
                            $errflag = false;
                            $errmsg_arr[] = '<div class="label_error">Code already added.</div>';
                            $errflag = true;
                            $_SESSION['ERRMSG_ARRR'] = $errmsg_arr;
                            echo "<script type='text/javascript'>window.location.href = 'codeinc.php';</script>";
                            session_write_close();
                        }
                        else{
                            $queryatleast="insert into code_users(uid,code,date,status) values('$uid','$code',now(),'0')";
                            mysqli_query($link,$queryatleast);
                            $errmsg_arr = array();
                            $errflag = false;
                            $errmsg_arr[] = '<div class="label_error">Submitted Successfully.</div>';
                            $errflag = true;
                            $_SESSION['ERRMSGG_A'] = $errmsg_arr;
                            echo "<script type='text/javascript'>window.location.href = 'codeinc.php';</script>";
                            session_write_close();
                        }
                    }
                    elseif ($currentTime < $fromTime) {
                        $errmsg_arr = array();
                        $errflag = false;
                        $errmsg_arr[] = '<div class="label_error">Invalid Code.</div>';
                        $errflag = true;
                        $_SESSION['ERRMSG_ARRR'] = $errmsg_arr;
                        echo "<script type='text/javascript'>window.location.href = 'codeinc.php';</script>";
                        session_write_close();
                    }
                    else {
                        $errmsg_arr = array();
                        $errflag = false;
                        $errmsg_arr[] = '<div class="label_error">Code has been Expired.</div>';
                        $errflag = true;
                        $_SESSION['ERRMSG_ARRR'] = $errmsg_arr;
                        echo "<script type='text/javascript'>window.location.href = 'codeinc.php';</script>";
                        session_write_close();
                    }
                }
                else{
                    $errmsg_arr = array();
                    $errflag = false;
                    $errmsg_arr[] = '<div class="label_error">Invalid Code.</div>';
                    $errflag = true;
                    $_SESSION['ERRMSG_ARRR'] = $errmsg_arr;
                    echo "<script type='text/javascript'>window.location.href = 'codeinc.php';</script>";
                    session_write_close();
                }
            }
        }
    }
    else{
        $errmsg_arr = array();
        $errflag = false;
        $errmsg_arr[] = '<div class="label_error">You are not eligible. ID not Active</div>';
        $errflag = true;
        $_SESSION['ERRMSG_ARRR'] = $errmsg_arr;
        echo "<script type='text/javascript'>window.location.href = 'codeinc.php';</script>";
        session_write_close();
    }
}
?>
<?php
  $brnadSQL="select t1.* from admin_login t1 where t1.admin_id='1'"; 
  $ResultSQL=mysqli_query($link,$brnadSQL); 
  ($profile_row=mysqli_fetch_assoc($ResultSQL));
?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from big-skins.com/frontend/EMR/html/index-layout-6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Mar 2023 07:02:11 GMT -->
<?php include_once('include/head.php');?>
<style>
  
  .contaisner {
    max-width: 600px;
    margin: 10px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  h3 {
    text-align: center;
  }
  .qr-code {
    text-align: center;
    margin-bottom: 20px;
  }
  .qr-code img {
    max-width: 100%;
  }
  .bank-details {
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
  }
</style>
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
							<li>/<span>Enter Code for Code Income</span></li>
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
											<a href="#" class="filter-col-toggle"></a>
										</div>
										<div class="filter-col-content">
											<div class="sidebar-block-top">
												<h2>My Account</h2>
												
											</div>
											<div class="sidebar-block collapsed open">
												<div class="block-title">
													<span>My Account</span>
													<div class="toggle-arrow"></div>
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
									<h1>Enter Code for Code Income</h1>
								</div>
							</div>
							<!-- /Page Title -->
							<!-- Categories Info -->
							<div class="info-block">
                            <?php 
                            if( isset($_SESSION['ERRMSGG_A']) && is_array($_SESSION['ERRMSGG_A']) && count($_SESSION['ERRMSGG_A']) >0 ) {
                                foreach($_SESSION['ERRMSGG_A'] as $msg) {
                                echo "<div style='background:#d5f0e4; color:#3d9970; text-align:center; margin-bottom:10px; line-height:45px; font-weight:bold;'>".$msg."</div>";  
                                }
                                unset($_SESSION['ERRMSGG_A']); } 
                                if( isset($_SESSION['ERRMSG_ARRR']) && is_array($_SESSION['ERRMSG_ARRR']) && count($_SESSION['ERRMSG_ARRR']) >0 ) {
                                    foreach($_SESSION['ERRMSG_ARRR'] as $msg) {
                                echo "<div style='background:#f0d5d7; color:#e32d2d; text-align:center; margin-bottom:10px; line-height:45px; font-weight:bold;'>".$msg."</div>";  
                                }
                                unset($_SESSION['ERRMSG_ARRR']); }?>
                                <div class="dashboard-detail addres-book">
                                <h4>Enter Code for Code Income</h4>
                                <div class="inform_h4">
                                    <form class="theme-form" action="codeinc.php" method="post" enctype="multipart/form-data" >
                                        <div class="row form-row">
                                            <div class="col-md-6">
                                            <label class="field-label">Enter Code *</label>
                                            <input type="text" name="code" class="form-control" placeholder="Enter Code" value="" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn-solid btn" name="codeinc_add" style="margin-top:20px">Submit</button>
                                    </form> <br>
                                </div>
                                <h4>Entered Code Lists</h4>
                                    <div class="faq-content tab-content" id="top-tabContent">
                                        <div class="tab-pane active" id="orders">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card dashboard-table mt-0">
                                                        <div class="card-body table-responsive-sm" style="padding:0;">
                                                            
                                                            <table id="example" class="display nowrap" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Sr No</th>
                                                                        <th>UserID</th>
                                                                        <th>Code</th>
                                                                        <th>Date</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                <?php
                                                            ?>
                                                            <?php
                                                                $i = 1;
                                                                $brnadSQL="select t1.*,t1.status as st,t1.date as sdat,t2.* from code_users t1 join membership t2 on t2.member_id = t1.uid where  t1.uid='$customeid' order by t1.id DESC"; 
                                                                $ResultSQL=mysqli_query($link,$brnadSQL); 
                                                                while($Listbrand=mysqli_fetch_array($ResultSQL)) { 
                                                                ?>
                                                                    <tr>
                                                                        <th><?php echo $i++;?> </th>
                                                                        <td><?php echo $Listbrand['userid'];?> (<?php echo $Listbrand['fname']." ".$Listbrand['lname'];?>)</td>
                                                                        <td><?php echo $Listbrand['code'];?> </td>
                                                                        <td><?php echo $Listbrand['sdat'];?></td>
                                                                        <td><?php if($Listbrand['st']=='0'){echo "Pending";}elseif($Listbrand['st']=='2'){echo "Rejected";}else{echo "Approved";}?></td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tfoot>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
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
<script>
// Function to display success message and reload the page after a delay
// function showSuccessMessageAndReload() {
//     Swal.fire('Submitted Successfully!');
//     // var successMessage = document.getElementById('success-message');
//     // successMessage.style.display = 'block'; // Display the success message

//     // Reload the page after 3 seconds
//     setTimeout(function() {
//         window.location.reload();
//     }, 10000); // 3000 milliseconds = 3 seconds
// }
</script>