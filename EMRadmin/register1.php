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
<title>New Registeration | EMR Marketing</title>
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
              <h4 class="mb-0">New Registeration</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">EMR</a></li>
                  <li class="breadcrumb-item active">New Registeration</li>
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
                  
                    <form action="script/registerpos1.php" method="post" enctype="multipart/form-data" name="cont"  id="register" onSubmit="return validate();">
                      <div class="row">
                        <h4 class="card-title">New Registeration</h4>
                        <div class="col-md-6">
                          <div class="">
                            <label>Sponsor ID *</label>
                            <input type="text" name='spnoser_id' class="form-control" placeholder="Sponsor ID" value="" required >
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>First Name *</label>
                            <input type="text" class="form-control" name="fname" placeholder="First Name" value="<?php echo $q60['fname'];?>" required>
                          </div> <br>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Last Name *</label>
                            <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php echo $q60['lname'];?>" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Phone *</label>
                            <input type="tel" class="form-control" name="phone" placeholder="Phone" value="<?php echo $q60['phone'];?>" required >
                          </div><br>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Email Address *</label>
                            <input type="email" class="form-control" name="email" placeholder="Email Address" value="<?php echo $q60['email'];?>" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Password *</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" value="" required>
                          </div><br>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Repeat Password *</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Repeat Password" value="" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Select Position *</label>
                            <select class="form-control" name="position" id=""  required>
                                <option value="L" selected>Left</option>
                                <option value="R" >Right</option>
                            </select>
                            <!-- <input type="text" class="form-control" name="lname" placeholder="Select Position" value="" required> -->
                          </div><br>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Address *</label>
                            <input type="text" class="form-control" name="stree_address" placeholder="Address" value="" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>City *</label>
                            <input type="text" class="form-control" name="city" placeholder="City" value="" required>
                          </div><br>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>State *</label>
                            <input type="text" class="form-control" name="state" placeholder="State" value="" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Postal Code *</label>
                            <input type="text" class="form-control" name="postalcode" placeholder="Postal Code" value="" required>
                            <input type="hidden" name="ref" value="1" >
                          </div><br>
                        </div>
                        <!-- <div class="col-md-6">
                          <div class="">
                            <label>Address *</label>
                            <input type="text" class="form-control" name="stree_address" placeholder="Address" value="" required>
                          </div>
                        </div> -->
                        <div class="col-md-6">
                          <div class="">
                            <label>Select Gender *</label>
                            <select class="form-control" name="gender" id="" required>
                                <option value="male" selected>Male</option>
                                <option value="female" >Female</option>
                            </select>
                            <!-- <input type="text" class="form-control" name="lname" placeholder="Select Position" value="" required> -->
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Select Plan *</label>
                            <select class="form-control" name="plan" id="" required>
                                <option value="2000_plan" selected>2000</option>
                                <option value="3000_plan" >3000</option>
                            </select>
                            <!-- <input type="text" class="form-control" name="lname" placeholder="Select Position" value="" required> -->
                          </div><br>
                        </div>
                        

                      </div>
                      <button type="submit" name="registeracc" class="btn btn-primary">Save</button>
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