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
<title>Generate Code | EMR Marketing</title>
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
              <h4 class="mb-0">Generate Code</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">EMR</a></li>
                  <li class="breadcrumb-item active">Generate Code</li>
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
unset($_SESSION['ERRMSG_ARRR']); } 
if( isset($_SESSION['ERRMSG_ARRR']) && is_array($_SESSION['ERRMSG_ARRR']) && count($_SESSION['ERRMSG_ARRR']) >0 ) {
    foreach($_SESSION['ERRMSG_ARRR'] as $msg) {
echo "<div style='background:#f0d5d7; color:#e32d2d; text-align:center; margin-bottom:10px; line-height:45px; font-weight:bold;'>".$msg."</div>";  
}
unset($_SESSION['ERRMSG_ARRR']); }
date_default_timezone_set('Asia/Kolkata'); $datee = date('Y-m-d'); $day = date('d');?>
        <div class="card-body">
            <div class="tab-content p-3 text-muted">
                <div class="tab-pane active" id="general-elements" role="tabpanel">
                    <form action="script/setting_script.php" method="post" enctype="multipart/form-data" name="cont"  id="register" onSubmit="return validate();">
                      <div class="row">
                        <h4 class="card-title">Generate Code</h4>
                        <!-- <div class="col-md-6">
                          <div class="">
                            <label>Date</label>
                        </div>
                    </div> -->
                    <div class="col-md-6">
                        <div class="">
                            <label>From Time</label>
                            <input type="hidden" id="date" name='date' class="form-control " placeholder="Date" value="<?php echo $datee; ?>" >
                            <input type="hidden" id="day" name='day' class="form-control " placeholder="Date" value="<?php echo $day; ?>" >
                            <input type="time" class="form-control" name="f_time" placeholder="From Time" value="<?php echo date('H:i'); ?>" >
                          </div> <br>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>To Time</label>
                            <input type="time" class="form-control" name="t_time" placeholder="To Time" value="<?php echo $newTime = date('H:i', strtotime('+1 hour')); ?>" >
                          </div><br>
                        </div> 
                      </div>
                      <div class="col-md-12" style="text-align: center;">
                        <button type="submit" name="code" class="btn btn-primary">Generate</button>
                      </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive mb-4">
                <h4 class="card-title"> Code Lists</h4>
                <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                    <thead>
                        <tr class="bg-transparent">
                            <th>Sr No</th>
                            <th>Code</th>
                            <th>Date</th>
                            <th>From Time</th>
                            <th>To Time</th>
                            <th>Status</th>
                        </tr>


                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    $brnadSQL="select t1.* from code t1 order by t1.id DESC"; 
                    $ResultSQL=mysqli_query($link,$brnadSQL); 
                    while($Listbrand=mysqli_fetch_assoc($ResultSQL)) { 
                    ?>

                    <tr>
                        <td><?php echo $i++;?> </td>
                        <td><?php echo $Listbrand['code'];?> </td>
                        <td><?php echo $Listbrand['date'];?> </td>
                        <td><?php echo $Listbrand['f_time'];?> </td>
                        <td><?php echo $Listbrand['t_time'];?> </td>
                        <td><?php // Assume $fromTime and $toTime are the values retrieved from the database
                            $fromTime = strtotime($Listbrand['f_time']); // Convert from string to timestamp
                            $toTime = strtotime($Listbrand['t_time']); // Convert from string to timestamp
                            // Get the current time
                            $currentTime = time();
                            $date = $Listbrand['date'];
                            $tod = date('Y-m-d');
                            // Check if the current time is within the range
                            if ($tod == $date && $currentTime >= $fromTime && $currentTime <= $toTime) {
                                // The value is within the range, so it's active
                                echo "Active";
                            } elseif ($tod == $date && $currentTime < $fromTime) {
                                // Value is pending
                                echo "Pending";
                            } elseif ($tod == $date) {
                                // The value is outside the range, so it's expired
                                echo "Expired";
                            }
                            else {
                                echo "Expired";
                            }
                            ?> 
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
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
<script>
// Get today's date in the format yyyy-mm-dd
var today = new Date().toISOString().split('T')[0];

// Set the value of the date input to today's date
document.getElementById('dateInput').value = today;
</script>
</body>
</html>