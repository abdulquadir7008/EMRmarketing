<?php
include_once( 'include/configuration.php' );

// $SQLproductDetails = "select * from products where status='1' AND seo_keywords='$productDetailsKey'";
// $MySQLProductDetails = mysqli_query($link,$SQLproductDetails); 
// $ListproductDetails = mysqli_fetch_array($MySQLProductDetails);
// $productDetID = $ListproductDetails['id'];
// $setpagename;
// $parentcat_keyword;

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
<style>
/* Styling for KYC request status */
.kyc-status {
    width: 300px;
    margin: 50px auto;
    padding: 20px;
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    border-radius: 5px;
    text-align: center;
}

.kyc-status h2 {
    font-size: 20px;
    margin-bottom: 10px;
}

.kyc-status p {
    font-size: 16px;
    margin-bottom: 20px;
}

.kyc-status .pending {
    color: orange;
}

.kyc-status .reject {
    color: red;
}

.kyc-status .sent {
    color: green;
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
							<li>/<span>KYC</span></li>
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
									<h1>KYC</h1>
								</div>
							</div>
							<!-- /Page Title -->
							<!-- Categories Info -->
							<div class="info-block">
                                <div class="dashboard-detail addres-book">
                                <h4>KYC</h4>
                                <!-- Success message div -->
                                <div id="success-message" style="display: none;">
                                    <p>Form submitted successfully! Reloading page...</p>
                                </div>
                                <div class="inform_h4">
                                    <?php
                                    $no_direcbus = mysqli_num_rows(mysqli_query($db, "select t1.*,t1.status as st,t2.kyc_status as kst,t1.date as sdat,t2.* from up_trans_history11 t1 join membership t2 on t2.member_id = t1.uid where t1.uid = $customeid order by t1.id DESC"));
                                    if($no_direcbus > 0){
                                        $brnadd="select t1.*,t1.status as st,t2.kyc_status as kst,t1.date as sdat,t2.* from up_trans_history11 t1 join membership t2 on t2.member_id = t1.uid where t1.uid = $customeid order by t1.id DESC"; 
                                        $Resultd=mysqli_query($link,$brnadd); 
                                        $Listbrad=mysqli_fetch_array($Resultd);
                                        if($Listbrad['st'] == 0 && $Listbrad['kst'] == 0){
                                    ?>
                                        <div class="kyc-status">
                                            <h2>KYC Request Status</h2>
                                            <p>Your KYC request has been  <span class="pending">submitted</span> and is currently awaiting  <span class="pending">approval.</span> <br> Thank you for your patience.</p>
                                            <!-- Replace "sent" and "pending" with appropriate status messages -->
                                        </div>
                                    <?php }elseif($Listbrad['st'] == 1 && $Listbrad['kst'] == 1){ ?>
                                        <div class="kyc-status">
                                            <h2>KYC Request Status</h2>
                                            <p>Your KYC request has been successfully <span class="sent">approved.</span> </span> <br> Thank you for your patience.</p>
                                            <!-- Replace "sent" and "pending" with appropriate status messages -->
                                        </div>
                                    <?php } elseif($Listbrad['st'] == 2 && $Listbrad['kst'] == 0){ ?>
                                        <div class="kyc-status">
                                            <h2>KYC Request Status</h2>
                                            <p>Your KYC request has been <span class="reject">rejected.</span>Please resend your KYC details for approval. </span> <br> Thank you for your patience.</p>
                                            <!-- Replace "sent" and "pending" with appropriate status messages -->
                                        </div>
                                    <form class="theme-form" action="kyc.php" method="post" enctype="multipart/form-data" onsubmit="showSuccessMessageAndReload()">
                                        <div class="row form-row">
                                            <div class="col-md-6">
                                                <label class="field-label">Full name of Account holder *</label>
                                                <input type="text"  name="acc_name"  class="form-control" value="" placeholder="Full name of Account holder" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Account Number *</label>
                                                <input type="number" name="acc_num" class="form-control" placeholder="Account Number" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">IFSC Code *</label>
                                                <input type="text"  name="ifsc"  class="form-control" value="" placeholder="IFSC Code" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Bank Name *</label>
                                                <input type="text"  name="bank"  class="form-control" value="" placeholder="Bank Name" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Branch Name *</label>
                                                <input type="text"  name="branch"  class="form-control" value="" placeholder="Branch Name" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Aadhar Card number *</label>
                                                <input type="text"  name="aadhar"  class="form-control" value="" placeholder="Aadhar Card number" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Pan Card number *</label>
                                                <input type="text"  name="pan"  class="form-control" value="" placeholder="Pan Card number" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Upload Aadhar Card (Front) *</label>
                                                <input type="file" class="form-control" name="image" id="image" required/>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Upload Aadhar Card (Back) *</label>
                                                <input type="file" class="form-control" name="image1" id="image1" required/>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Upload Pan Card (Back) *</label>
                                                <input type="file" class="form-control" name="image2" id="image2" required/>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Upload Cheque/Passbook *</label>
                                                <input type="file" class="form-control" name="image3" id="image3" required/>
                                            </div>
                                        </div>
                                    <button type="submit" class="btn-solid btn" name="kyc_add" style="margin-top:20px">Submit</button>
                                    </form> 
                                    <?php }} else { ?>
                                        <form class="theme-form" action="kyc.php" method="post" enctype="multipart/form-data" onsubmit="showSuccessMessageAndReload()">
                                        <div class="row form-row">
                                            <div class="col-md-6">
                                                <label class="field-label">Full name of Account holder *</label>
                                                <input type="text"  name="acc_name"  class="form-control" value="" placeholder="Full name of Account holder" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Account Number *</label>
                                                <input type="number" name="acc_num" class="form-control" placeholder="Account Number" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">IFSC Code *</label>
                                                <input type="text"  name="ifsc"  class="form-control" value="" placeholder="IFSC Code" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Bank Name *</label>
                                                <input type="text"  name="bank"  class="form-control" value="" placeholder="Bank Name" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Branch Name *</label>
                                                <input type="text"  name="branch"  class="form-control" value="" placeholder="Branch Name" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Aadhar Card number *</label>
                                                <input type="text"  name="aadhar"  class="form-control" value="" placeholder="Aadhar Card number" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Pan Card number *</label>
                                                <input type="text"  name="pan"  class="form-control" value="" placeholder="Pan Card number" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Upload Aadhar Card (Front) *</label>
                                                <input type="file" class="form-control" name="image" id="image" required/>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Upload Aadhar Card (Back) *</label>
                                                <input type="file" class="form-control" name="image1" id="image1" required/>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Upload Pan Card (Front) *</label>
                                                <input type="file" class="form-control" name="image2" id="image2" required/>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="field-label">Upload Cheque/Passbook *</label>
                                                <input type="file" class="form-control" name="image3" id="image3" required/>
                                            </div>
                                        </div>
                                    <button type="submit" class="btn-solid btn" name="kyc_add" style="margin-top:20px">Submit</button>
                                    </form> 
                                <?php } ?>
                                </div> <br>
                                <h4>KYC History</h4>
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
                                                                        <th>Full name of Account holder</th>
                                                                        <th>Account Number</th>
                                                                        <th>IFSC Code</th>
                                                                        <th>Bank Name</th>
                                                                        <th>Branch Name</th>
                                                                        <th>Aadhar Card number</th>
                                                                        <th>Pan Card number</th>
                                                                        <th>Request Date</th>
                                                                        <th>Update Date</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                <?php
                                                            ?>
                                                            <?php
                                                                $i = 1;
                                                                $brnadSQL="select t1.*,t1.status as st,t2.kyc_status as kst,t1.date as sdat,t1.mdate as adat,t2.* from up_trans_history11 t1 join membership t2 on t2.member_id = t1.uid where t1.uid = $customeid order by t1.id DESC"; 
                                                                $ResultSQL=mysqli_query($link,$brnadSQL); 
                                                                while($Listbrand=mysqli_fetch_array($ResultSQL)) { 
                                                                ?>
                                                                    <tr>
                                                                        <th><?php echo $i++;?> </th>
                                                                        <td><?php echo $Listbrand['userid'];?> (<?php echo $Listbrand['fname']." ".$Listbrand['lname'];?>)</td>
                                                                        <td><?php echo $Listbrand['acc_name'];?> </td>
                                                                        <td><?php echo $Listbrand['acc_num'];?> </td>
                                                                        <td><?php echo $Listbrand['ifsc'];?> </td>
                                                                        <td><?php echo $Listbrand['bank'];?> </td>
                                                                        <td><?php echo $Listbrand['branch'];?> </td>
                                                                        <td><?php echo $Listbrand['aadhar'];?> </td>
                                                                        <td><?php echo $Listbrand['pan'];?> </td>
                                                                        <td><?php echo $Listbrand['sdat'];?></td>
                                                                        <td><?php echo $Listbrand['adat'];?></td>
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
			
	
<?php include('include/footer.php'); 
if(isset($_REQUEST['kyc_add']) && isset($_SESSION['member_id'])){
    $acc_name=$_REQUEST['acc_name'];
    $acc_num=$_REQUEST['acc_num'];
    $ifsc = $_REQUEST['ifsc'];
    $bank = $_REQUEST['bank'];
    $branch = $_REQUEST['branch'];
    $aadhar = $_REQUEST['aadhar'];
    $pan = $_REQUEST['pan'];
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
    if($_FILES["image1"]["name"]!='')
    {
        if (($_FILES["image1"]["type"] == "image/gif")
        || ($_FILES["image1"]["type"] == "image/jpeg")
        || ($_FILES["image1"]["type"] == "image/pjpeg")
        || ($_FILES["image1"]["type"] == "image/X-PNG")
        || ($_FILES["image1"]["type"] == "image/PNG")
        || ($_FILES["image1"]["type"] == "image/png")
        || ($_FILES["image1"]["type"] == "image/x-png"))
        {
        $image1="$path".$rand1.$_FILES["image1"]["name"];
        $image01=$rand1.$_FILES["image1"]["name"];
        move_uploaded_file($_FILES["image1"]["tmp_name"],$image1);
        }
        else
        {
        $image01='';
        }
    }
    if($_FILES["image2"]["name"]!='')
    {
        if (($_FILES["image2"]["type"] == "image/gif")
        || ($_FILES["image2"]["type"] == "image/jpeg")
        || ($_FILES["image2"]["type"] == "image/pjpeg")
        || ($_FILES["image2"]["type"] == "image/X-PNG")
        || ($_FILES["image2"]["type"] == "image/PNG")
        || ($_FILES["image2"]["type"] == "image/png")
        || ($_FILES["image2"]["type"] == "image/x-png"))
        {
        $image2="$path".$rand1.$_FILES["image2"]["name"];
        $image02=$rand1.$_FILES["image2"]["name"];
        move_uploaded_file($_FILES["image2"]["tmp_name"],$image2);
        }
        else
        {
        $image02='';
        }
    }
    if($_FILES["image3"]["name"]!='')
    {
        if (($_FILES["image3"]["type"] == "image/gif")
        || ($_FILES["image3"]["type"] == "image/jpeg")
        || ($_FILES["image3"]["type"] == "image/pjpeg")
        || ($_FILES["image3"]["type"] == "image/X-PNG")
        || ($_FILES["image3"]["type"] == "image/PNG")
        || ($_FILES["image3"]["type"] == "image/png")
        || ($_FILES["image3"]["type"] == "image/x-png"))
        {
        $image3="$path".$rand1.$_FILES["image3"]["name"];
        $image03=$rand1.$_FILES["image3"]["name"];
        move_uploaded_file($_FILES["image3"]["tmp_name"],$image3);
        }
        else
        {
        $image03='';
        }
    }
    //$phone_code=$_REQUEST['phone_code'];	
    // $password=md5($_REQUEST['password']);
    // $queryatleast="insert into up_trans_history1(ifsc,amount,txn_sc,txn_id,date,status,wal_type) values('$uid','$amount','$image0','$txn_id',now(),'0','2')";
    
      $queryatleast="INSERT INTO `up_trans_history11`( `uid`, `date`, `status`, `acc_name`, `acc_num`, `ifsc`, `bank`, `branch`, `aadhar`, `image`, `image1`, `image2`, `image3`, `pan`) VALUES ('$uid',now(),'0','$acc_name','$acc_num','$ifsc','$bank','$branch','$aadhar','$image0','$image01','$image02','$image03','$pan')";
        mysqli_query($link,$queryatleast);
        $errmsg_arr= "<script>Swal.fire('Request Sent Successfully!');</script>";
    $errflag = true;
    $_SESSION['acounterror'] = $errmsg_arr;
    echo "<script type='text/javascript'>window.location.href = 'kyc.php';</script>";
    session_write_close();
}

?>
<script>
// Function to display success message and reload the page after a delay
function showSuccessMessageAndReload() {
    Swal.fire('Request Sent Successfully!');
    // var successMessage = document.getElementById('success-message');
    // successMessage.style.display = 'block'; // Display the success message

    // Reload the page after 3 seconds
    setTimeout(function() {
        window.location.reload();
    }, 10000); // 3000 milliseconds = 3 seconds
}
</script>