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
if(isset($_GET['level']) && !empty($_GET['level']))
{
  $member_id = $_GET['level'];
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>ID Acitvation | EMR Marketing</title>
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
              <h4 class="mb-0">ID Acitvation</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">EMR</a></li>
                  <li class="breadcrumb-item active">ID Acitvation</li>
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
                <div class="widget-content widget-content-area">
                    <form name="LevelFilter" action="" method="get" class="row row-cols-lg-auto align-items-center">
                        <div class="col-12 col-lg-9">
                            <label class="visually-hidden" for="level">Select User</label>
                            <select class = "form-select form-select2 select2" name = "level" id = "level" required>
                                <?php
                                $sql=mysqli_query($db,"SELECT t1.*
                                FROM membership t1
                                WHERE t1.binary_status = 0");
                                while($row = mysqli_fetch_assoc($sql))
                                { 
                                  ?>
                                  <option value ="<?php echo $row['member_id']; ?>"><?php echo $row['fname']." ".$row['lname'];?> ( <?php echo $row['userid'];?> )</option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-12 col-lg-3">
                            <input type="submit" class="btn btn-info" id="LevelFilter" data-form="LevelFilter" value="Submit"/>
                        </div>
                    </form> <br>
                </div>
                <div class="tab-pane active" id="general-elements" role="tabpanel">
                <div class="table-responsive mb-4">
                  <?php 
                    $q60 = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `membership` where `member_id`= '$member_id'"));
                    if($q60['sponser_status'] == 'yes'){
                      $spnoser_id = $q60['spnoser_id'];
                      $q6x0 = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `membership` where `member_id`= '$spnoser_id'"));
                      $suder = $q6x0['userid'];
                      $q6x0 = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `pairing` where `uid`= '$member_id'"));
                      $position = $q6x0['position'];
                    }
                    else {
                      $suder = "";
                    }
                  ?>
                    <form action="script/registerpos.php" method="post" enctype="multipart/form-data" name="cont"  id="register" onSubmit="return validate();">
                      <div class="row">
                        <h4 class="card-title">ID Acitvation</h4>
                        <div class="col-md-6">
                          <div class="">
                            <label>Sponsor ID *</label>
                            <input type="text" name='spnoser_id' class="form-control" placeholder="Sponsor ID" value="<?php echo $suder; ?>" <?php if($suder == ""){echo"required";}else{echo "readonly";} ?> >
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>First Name *</label>
                            <input type="text" class="form-control" name="fname" placeholder="First Name" value="<?php echo $q60['fname'];?>" readonly>
                          </div> <br>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Last Name *</label>
                            <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php echo $q60['lname'];?>" readonly>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Phone *</label>
                            <input type="tel" class="form-control" name="phone" placeholder="Phone" value="<?php echo $q60['phone'];?>" readonly >
                          </div><br>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Email Address *</label>
                            <input type="email" class="form-control" name="email" placeholder="Email Address" value="<?php echo $q60['email'];?>" readonly>
                          </div>
                        </div>
                        <!-- <div class="col-md-6">
                          <div class="">
                            <label>Password *</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" value="" readonly>
                          </div><br>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Repeat Password *</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Repeat Password" value="" readonly>
                          </div>
                        </div> -->
                        <div class="col-md-6">
                          <div class="">
                            <label>Select Position *</label>
                            <select class="form-control" name="position" id="" disabled required>
                                <option value="L" <?php if($position == 'L'){echo "selected";}?>>Left</option>
                                <option value="R" <?php if($position == 'R'){echo "selected";}?>>Right</option>
                            </select>
                            <!-- <input type="text" class="form-control" name="lname" placeholder="Select Position" value="" required> -->
                          </div><br>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Address *</label>
                            <input type="text" class="form-control" name="stree_address" placeholder="Address" value="<?php echo $q60['stree_address'];?>" readonly>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>City *</label>
							  <select name="city" class="form-control">
			<?php
				$sqlCities = mysqli_query( $link, "select * from cities WHERE id='".$q60['city']."'" );
  	  			while($listCities = mysqli_fetch_array( $sqlCities )){
					echo "<option value='".$listCities['id']."'>".$listCities['city']."</option>";
				}
								  ?>
							  </select>
                           
                          </div><br>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>State *</label>
							  <select name="state" class="form-control">
			<?php
				$sqlRegion = mysqli_query( $link, "select * from states WHERE id='".$q60['state']."'" );
  	  			while($listRegion = mysqli_fetch_array( $sqlRegion )){
					echo "<option value='".$listRegion['id']."'>".$listRegion['name']."</option>";
				}
								  ?>
							  </select>
                            
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label>Postal Code *</label>
                            <input type="text" class="form-control" name="postalcode" placeholder="Postal Code" value="<?php echo $q60['postalcode'];?>" readonly>
                            <input type="hidden" name="ref" value="1" >
                            <input type="hidden" name="position" value="<?php echo $position;?>" >
                            <input type="hidden" name="user_id" value="<?php echo $member_id;?>" >
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