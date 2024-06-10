<?php include('includes/configset.php');
if (isset($_REQUEST['currancy'])){
	$currancy_id=$_REQUEST['currancy'];
	$Curbutton = "currancy_update";
}
else
{
$currancy_id=0;
$Curbutton = "currancy_add";
}
$sql_currancy="select * from currancy WHERE currancy_id=$currancy_id"; 
$result_currancy=mysqli_query($link,$sql_currancy); 
$row_currancy=mysqli_fetch_array($result_currancy);
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Bank Details | EMR Marketing</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesbrand" name="author" />
<!-- App favicon -->
<link rel="icon" href="../favicon.png" sizes="32x32" />
		<link rel="icon" href="../favicon.png" sizes="192x192" />
		<link rel="apple-touch-icon" href="../favicon.png" />

<!-- Bootstrap Css -->
<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="assets/css/css2.css" rel="stylesheet" type="text/css" />
<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<link href="assets/css/line.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body>

<!-- <body data-layout="horizontal" data-topbar="colored"> --> 

<!-- Begin page -->
<div id="layout-wrapper">
  <?php include('includes/top.php')?>
  <!-- ========== Left Sidebar Start ========== --> 
  
  <!-- Left Sidebar End --> 
  
  <!-- ============================================================== --> 
  <!-- Start right Content here --> 
  <!-- ============================================================== -->
  <div class="main-content">
    <div class="page-content">
      <div class="container-fluid"> 
        
        <!-- start page title -->
        <div class="row">
          <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0">Bank Details</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">EMR</a></li>
                  <li class="breadcrumb-item active">Bank Details</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- end page title --> 
        
        <!-- end row--> 
        
        <!-- end row--> 
        
        <!-- end row -->
        
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <?php if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
foreach($_SESSION['ERRMSG_ARR'] as $msg) {
echo "<div style='background:#d5f0e4; color:#3d9970; text-align:center; margin-bottom:10px; line-height:45px; font-weight:bold;'>".$msg."</div>";  
}
unset($_SESSION['ERRMSG_ARR']); }?>
        <div class="card-body">
            <div class="tab-content p-3 text-muted">
                <div class="tab-pane active" id="general-elements" role="tabpanel">
                    <form action="script/setting_script.php" method="post" enctype="multipart/form-data" name="cont"  id="register" onSubmit="return validate();">
                      <div class="row">
                        <h4 class="card-title">Bank Details</h4>
                        <div class="col-md-6">
                          <div class="">
                            <label>Account Name</label>
                            <input type="text" name='accname' class="form-control" placeholder="Account Name" value="<?php echo $profile_row['accname']; ?>" >
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Account Number</label>
                            <input type="text" class="form-control" name="accnumber" placeholder="Account Number" value="<?php echo $profile_row['accnumber']; ?>" >
                          </div> <br>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Bank Name</label>
                            <input type="text" class="form-control" name="bank" placeholder="Bank Name" value="<?php echo $profile_row['bank']; ?>" >
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>IFSC Code</label>
                            <input type="text" class="form-control" name="ifsc" placeholder="IFSC Code" value="<?php echo $profile_row['ifsc']; ?>" >
                          </div><br>
                        </div>

                        
                    
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label">QR Code</label>
                            <?php if($profile_row['qr']!='') { image_size(); ?>
                            <img src="../uploads/<?php echo $profile_row['qr'];?>" width="<?php echo $width; ?>150" height="<?php echo $height; ?>" class="alignLeft" /> <br>
                            <?php } ?>
                            <input type="file" name="qr" id="qr" />
                            <input type="hidden" name="qrc" id="qr" value="<?php echo $profile_row['qr']; ?>" />
                          </div>
                        </div>
                      </div>
                      <button type="submit" name="banksetting" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
          </div>
        </div>
        <!-- end row --> 
        
      </div>
      <!-- container-fluid --> 
    </div>
    <!-- End Page-content -->
    
    <?php include('includes/footer.php')?>
  </div>
  <!-- end main content--> 
  
</div>
<!-- END layout-wrapper --> 

<!-- Right Sidebar --> 

<!-- /Right-bar --> 

<!-- Right bar overlay--> 

<!-- JAVASCRIPT --> 
<script src="assets/libs/jquery/jquery.min.js"></script> 
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script> 
<script src="assets/libs/metismenu/metisMenu.min.js"></script> 
<script src="assets/libs/simplebar/simplebar.min.js"></script> 
<script src="assets/libs/node-waves/waves.min.js"></script> 
<script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script> 
<script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script> 

<!-- apexcharts --> 
<script src="assets/libs/apexcharts/apexcharts.min.js"></script> 
<script src="assets/js/pages/dashboard.init.js"></script> 
<script src="assets/js/app.js"></script>
<script>
$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
</body>
</html>