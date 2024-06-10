<?php include('includes/configset.php');
if (isset($_GET['id'])){
	$id=$_GET['id'];
    $brnadSQL="select t1.*,t1.status as st,t1.date as sdat,t2.* from up_trans_history111 t1 join membership t2 on t2.member_id = t1.uid where t1.status = 0 and t1.id = $id"; 
    $ResultSQL=mysqli_query($link,$brnadSQL); 
    ($Listbrand=mysqli_fetch_assoc($ResultSQL)); 
    $brnadd="select t1.*,t1.status as st,t2.kyc_status as kst,t1.date as sdat,t2.* from up_trans_history11 t1 join membership t2 on t2.member_id = t1.uid where t1.uid = $Listbrand[uid] order by t1.id DESC"; 
    $Resultd=mysqli_query($link,$brnadd); 
    $Listbrad=mysqli_fetch_array($Resultd);
    $bank_detail=$Listbrad['acc_name'].", ".$Listbrad['bank']." (AC- ".$Listbrad['acc_num'].")"." (IFSC- ".$Listbrad['ifsc'].")"." (Branch - ".$Listbrad['branch'].")";
    $at = $Listbrand['amount']; 
    $tds = number_format($at*(5.25)/100,2); 
    $admin = number_format($at*(10)/100,2); 
    $fin = number_format($at-($tds+$admin),2); 
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Approve Withdraw Request | EMR Marketing</title>
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
              <h4 class="mb-0">Approve Withdraw Request</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">EMR</a></li>
                  <li class="breadcrumb-item active">Approve Withdraw Request</li>
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
          <div class="col-lg-12">
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
                        <h4 class="card-title">Approve Withdraw Request</h4>
                        <div class="col-md-6">
                          <div class="">
                            <label>Account Name</label>
                            <input type="text" readonly name='' class="form-control" placeholder="Account Name" value="<?php echo $Listbrad['acc_name']; ?>" >
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Account Number</label>
                            <input type="text" readonly class="form-control" name="" placeholder="Account Number" value="<?php echo $Listbrad['acc_num']; ?>" >
                          </div> <br>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Bank Name</label>
                            <input type="text" readonly class="form-control" name="" placeholder="Bank Name" value="<?php echo $Listbrad['bank']; ?>" >
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Branch Name</label>
                            <input type="text" readonly class="form-control" name="" placeholder="Branch Name" value="<?php echo $Listbrad['branch']; ?>" >
                          </div><br>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>IFSC Code</label>
                            <input type="text" readonly class="form-control" name="" placeholder="IFSC Code" value="<?php echo $Listbrad['ifsc']; ?>" >
                          </div><br>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Payable Amount</label>
                            <input type="text" readonly class="form-control" name="" placeholder="Payable Amount" value="<?php echo $fin; ?>" >
                          </div><br>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Add Remark</label>
                            <input type="text" required class="form-control" name="remark" placeholder="Add Remark" value="" >
                            <input type="hidden" required class="form-control" name="id" placeholder="Add Remark" value="<?php echo $id; ?>" >
                          </div><br>
                        </div>
                        
                      </div>
                      <div class="col-md-12" style="text-align: center;">
                        <button type="submit" name="approverem" class="btn btn-primary">Approve</button>
                      </div>
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