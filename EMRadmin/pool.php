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
<title>Pool Activation | EMR Marketing</title>
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
              <h4 class="mb-0">Pool Activation</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">EMR</a></li>
                  <li class="breadcrumb-item active">Pool Activation</li>
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
                    <div class="table-responsive mb-4">
                        <form action="script/pooladd.php" method="post" enctype="multipart/form-data" name="cont"  id="register" onSubmit="return validate();">
                            <div class="row">
                                <h4 class="card-title">Pool Activation</h4>
                                <br>
                                <div class="col-md-6">
                                    <div class="">
                                        <label class="" for="level">Select User *</label>
                                        <select class = "form-select form-select2 select2" name = "user_id" id = "user_id" required>
                                            <?php
                                            $sql=mysqli_query($db,"SELECT t1.*
                                            FROM membership t1
                                            WHERE t1.binary_status IN (1, 2) AND t1.member_id != 85");
                                            while($row = mysqli_fetch_assoc($sql))
                                            { 
                                            ?>
                                            <option value ="<?php echo $row['member_id']; ?>"><?php echo $row['fname']." ".$row['lname'];?> ( <?php echo $row['userid'];?> )</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <label>Select Pool *</label>
                                        <select class="form-select form-select2 select2" name="pool" id="pool" required>
                                            <option value="1">Pool 2</option>
                                            <option value="2">Booster 1</option>
                                            <option value="3">Booster 2</option>
                                            <option value="4">Booster 3</option>
                                        </select>
                                        <!-- <input type="text" class="form-control" name="fname" placeholder="First Name" value="<?php echo $q60['fname'];?>" required> -->
                                    </div> <br>
                                </div>
                            </div>
                            <div class="col-md-12" style="text-align: center;">
                                <button type="submit" name="poolacc" class="btn btn-primary text-center">Save</button>
                            </div>
                            <br>
                        </form>
                    <?php ?>  
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