<?php
include_once( 'include/configuration.php' );
// $SQLproductDetails = "select * from products where status='1' AND seo_keywords='$productDetailsKey'";
// $MySQLProductDetails = mysqli_query($link,$SQLproductDetails); 
// $ListproductDetails = mysqli_fetch_array($MySQLProductDetails);
// $productDetID = $ListproductDetails['id'];
// $setpagename;
// $parentcat_keyword;
if(isset($_REQUEST['gold_add']) && isset($_SESSION['member_id'])){
$amount=$_REQUEST['amount'];
$txn_id=$_REQUEST['txn_id'];
$uid = $_SESSION['member_id'];
// $image=$_REQUEST['image'];
if($_FILES["image"]["name"]!='')
{
if (($_FILES["image"]["type"] == "image/gif")
|| ($_FILES["image"]["type"] == "image/jpeg")
|| ($_FILES["image"]["type"] == "image/pjpeg")
|| ($_FILES["image"]["type"] == "image/X-PNG")
|| ($_FILES["image"]["type"] == "image/PNG")
|| ($_FILES["image"]["type"] == "image/png")
|| ($_FILES["image"]["type"] == "image/x-png"))
{
$image="$path".$rand1.$_FILES["image"]["name"];
$image0=$rand1.$_FILES["image"]["name"];
move_uploaded_file($_FILES["image"]["tmp_name"],$image);
}
else
{
$image0='';
}
}
//$phone_code=$_REQUEST['phone_code'];	
// $password=md5($_REQUEST['password']);
  $queryatleast="insert into up_trans_history1(uid,amount,txn_sc,txn_id,date,status,wal_type) values('$uid','$amount','$image0','$txn_id',now(),'0','6')";
	mysqli_query($link,$queryatleast);
	$errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Request Sent Successfully.</div>';
$errflag = true;
$_SESSION['acounterror'] = $errmsg_arr;
echo "<script type='text/javascript'>window.location.href = 'booster1.php';</script>";
session_write_close();
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
							<li>/<span>Booster 1 Wallet</span></li>
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
									<h1>Booster 1 Wallet</h1>
								</div>
							</div>
							<!-- /Page Title -->
							<!-- Categories Info -->
							<div class="info-block">
                            <div class="dashboard-detail addres-book">
                            <h4>Booster 1 Wallet</h4>
                            <div class="inform_h4">
                                <div class="row form-row">
                                <div class="contaisner">
                                    <h3>Bank Account Details</h3>
                                    <div class="qr-code">
                                        <img height="200" src="uploads/<?php echo $profile_row['qr'];?>" alt="QR Code">
                                    </div>
                                    <div class="bank-details">
                                        <p></p>
                                        <p>Account Name: <?php echo $profile_row['accname']; ?></p>
                                        <p>Account Number: <?php echo $profile_row['accnumber']; ?></p>
                                        <p>Bank Name: <?php echo $profile_row['bank']; ?></p>
                                        <p>IFSC Code: <?php echo $profile_row['ifsc']; ?></p>
                                    </div>
                                </div>
                                </div>
                                <form class="theme-form" action="booster1.php" method="post" enctype="multipart/form-data">
                                <div class="row form-row">
                                    <div class="col-md-6">
                                    <label class="field-label">Amount *</label>
                                    <input type="number" min="100" name="amount"  class="form-control" placeholder="Amount" required>
                                    </div>
                                    <div class="col-md-6">
                                    <label class="field-label">Transaction ID *</label>
                                    <input type="text" name="txn_id" class="form-control" placeholder="Transaction ID" value="" required>
                                    </div>
                                    <div class="col-md-6">
                                    <label class="field-label">Transaction Screen Shot *</label>
                                    <input type="file" class="form-control" name="image" id="image" />
                                    <!-- <input type="file" name="txn_id" class="form-control" placeholder="Transaction ID" value="" required> -->
                                    </div>
                                </div>
                                <button type="submit" class="btn-solid btn" name="gold_add" style="margin-top:20px">Submit</button>
                                </form> 
                            </div>
                            <h4>Booster 1 Wallet History</h4>
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
                                                                    <th>Transaction ID</th>
                                                                    <th>Transaction Screen Shot</th>
                                                                    <th>Amount</th>
                                                                    <th>Date</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tfoot>
                                                            <?php
                                                        ?>
                                                        <?php
                                                            $i = 1;
                                                            $brnadSQL="select t1.*,t1.status as st,t1.date as sdat,t2.* from up_trans_history1 t1 join membership t2 on t2.member_id = t1.uid where  t1.amount > 0 and t1.wal_type = '6' and  t1.uid='$customeid' order by t1.id DESC"; 
                                                            $ResultSQL=mysqli_query($link,$brnadSQL); 
                                                            while($Listbrand=mysqli_fetch_array($ResultSQL)) { 
                                                            ?>
                                                                <tr>
                                                                    <th><?php echo $i++;?> </th>
                                                                    <td><?php echo $Listbrand['userid'];?> (<?php echo $Listbrand['fname']." ".$Listbrand['lname'];?>)</td>
                                                                    <td><?php echo $Listbrand['txn_id'];?> </td>
                                                                    <td><img src="uploads/<?php echo $Listbrand['txn_sc'];?>" width="100" height="100" class="alignLeft" /> </td>
                                                                    <td><?php echo $Listbrand['amount'];?> </td>
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