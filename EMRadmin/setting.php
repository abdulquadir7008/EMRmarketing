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
<title>Setting | EMR Marketing</title>
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
              <h4 class="mb-0">Page Setting</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">EMR</a></li>
                  <li class="breadcrumb-item active">Page Setting</li>
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
                <ul class="nav nav-pills" role="tablist">
                  <li class="nav-item waves-effect waves-light"> <a class="nav-link active" data-bs-toggle="tab" href="#general-elements"
                                                role="tab"> <span class="d-block d-sm-none"><i class="fas fa-home"></i></span> <span class="d-none d-sm-block">General Elements</span> </a> </li>
                  <li class="nav-item waves-effect waves-light"> <a class="nav-link" data-bs-toggle="tab" href="#serach-engine-optimize" role="tab"> <span class="d-block d-sm-none"><i class="far fa-user"></i></span> <span class="d-none d-sm-block">Serach Engine Optimize</span> </a> </li>
                  <li class="nav-item waves-effect waves-light"> <a class="nav-link" data-bs-toggle="tab" href="#social-network-links" role="tab"> <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span> <span class="d-none d-sm-block">Social Network Links</span> </a> </li>
                  <li class="nav-item waves-effect waves-light"> <a class="nav-link" data-bs-toggle="tab" href="#profile-details" role="tab"> <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span> <span class="d-none d-sm-block">Profile Details</span> </a> </li>
                  <li class="nav-item waves-effect waves-light"> 
                  <a class="nav-link" data-bs-toggle="tab" href="#currancyadd" role="tab"> 
                  <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span> 
                  <span class="d-none d-sm-block">Currency</span> </a> </li>
					
					<li class="nav-item waves-effect waves-light"> 
                  <a class="nav-link" data-bs-toggle="tab" href="#cityManage" role="tab"> 
                  <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span> 
                  <span class="d-none d-sm-block">City Manage</span> </a> </li>
					
                </ul>
                <div class="tab-content p-3 text-muted">
					
					<div class="tab-pane" id="profile-details" role="tabpanel">
                    <form action="script/setting_script.php" method="post" enctype="multipart/form-data" name="cont"  id="register" onSubmit="return validate();">
                      <div class="row">
                        <h4 class="card-title">Profile</h4>
                        <div class="col-md-6">
                          <div class="input-group mb-3">
                            <div class="input-group-text">@</div>
                            <input type="text" name='username' class="form-control" placeholder="Username" value="<?php echo $profile_row['username']; ?>" disabled>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-group mb-3">
                            <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                            <input type="text" class="form-control" name="email_address" placeholder="Email" value="<?php echo $profile_row['email_address']; ?>" disabled>
                          </div>
                        </div>
                    
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Logo Input</label>
                            <?php if($profile_row['image']!='') { image_size(); ?>
                            <img src="../uploads/<?php echo $profile_row['image'];?>" width="<?php echo $width; ?>150" height="<?php echo $height; ?>" class="alignLeft" /> <br>
                            <?php } ?>
                            <input type="file" name="image" id="image" />
                            <input type="hidden" name="hiddenimage" id="image" value="<?php echo $profile_row['image']; ?>" />
                          </div>
                        </div>
                      </div>
                      <button type="submit" name="adminupdate" class="btn btn-primary">Save</button>
                    </form>
                  </div>
					
					
                  <div class="tab-pane active" id="general-elements" role="tabpanel">
                    <form action="script/setting_script.php" method="post" enctype="multipart/form-data" name="cont"  id="register" onSubmit="return validate();">
                      <div class="row">
                        <h4 class="card-title">General Elements</h4>
                        <div class="col-md-6">
                          <label>First Name</label>
                          <input type="text" class="form-control" name="firstname" placeholder="Enter ..." value="<?php echo $profile_row['firstname']; ?>" />
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="lastname" placeholder="Enter ..." value="<?php echo $profile_row['lastname']; ?>"  />
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label">URL</label>
                            <input type="text" class="form-control"  name="url" id="exampleInputPassword1" placeholder="Enter ..." value="<?php echo $profile_row['url']; ?>" >
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter ..." value="<?php echo $profile_row['phone']; ?>" >
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label for="exampleInputPassword1">Time</label>
                            <input type="text" class="form-control" name="time" placeholder="Enter ..." value="<?php echo $profile_row['time']; ?>" >
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Copy Right</label>
                            <input type="text" class="form-control" name="copyright" id="exampleInputPassword1" placeholder="Enter ..." value="<?php echo $profile_row['copyright']; ?>" >
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" placeholder="Enter ..." value="<?php echo $profile_row['address']; ?>" >
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Alt Email</label>
                            <input type="text" class="form-control" name="altemail" placeholder="Enter ..." value="<?php echo $profile_row['altemail']; ?>" >
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Alt Phone</label>
                            <input type="text" class="form-control" name="altphone" placeholder="Enter ..." value="<?php echo $profile_row['altphone']; ?>" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Footer Description</label>
                            <textarea name="footer_description" class="form-control"><?php echo $profile_row['footer_description']; ?></textarea>
                          </div>
                        </div>
                      <div class="mb-3">
                        <button type="submit" name="generalsetting" class="btn btn-primary">Save</button>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane" id="serach-engine-optimize" role="tabpanel">
                   <form action="script/setting_script.php" method="post" enctype="multipart/form-data" name="cont"  id="register" onSubmit="return validate();">
                   <div class="box-body">
          <div class="form-group">
          <div class="mb-3">
            <label>Meta Title</label>
            <input type="text" class="form-control" name="metatitle" placeholder="Enter ..." value="<?php echo $profile_row['metatitle']; ?>" />
            </div>
          </div>
          <div class="form-group">
          <div class="mb-3">
            <label>Meta Keywords</label>
            <textarea class="form-control" rows="3" name="metakeywords" placeholder="Enter ..."><?php echo $profile_row['metakeywords']; ?></textarea>
            </div>
          </div>
          <div class="form-group">
          <div class="mb-3">
            <label>Meta Description</label>
            <textarea class="form-control" rows="3" name="metadescription" placeholder="Enter ..."><?php echo $profile_row['metadescription']; ?></textarea>
            </div>
          </div>
          
          
        
        </div>
         <div class="mb-3">
                        <button type="submit" name="searchengine" class="btn btn-primary">Save</button>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane" id="social-network-links" role="tabpanel">
                     <form action="script/setting_script.php" method="post" enctype="multipart/form-data" name="cont"  id="register" onSubmit="return validate();">
                    <div class="box-body">
   
    <div class="form-group">
     <div class="mb-3">
        <label>Facebook Link </label>
        <span>
        <?php if($profile_row['fbchk']) { ?>
        <input type="checkbox" value="1" checked="checked" name="fbchk"  />
        <?php } else { ?>
        <input type="checkbox" name="fbchk" value="1"  />
        <?php } ?>
        
        Frontend</span>
        <input type="text" class="form-control" name="fblink" placeholder="Enter ..." value="<?php echo $profile_row['fblink']; ?>" />
        </div>
      </div>
      <div class="form-group">
       <div class="mb-3">
        <label>Instagram Link</label>
        <span>
        <?php if($profile_row['yuchk']) { ?>
        <input type="checkbox" value="1" checked="checked" name="yuchk"  />
        <?php } else { ?>
        <input type="checkbox" name="yuchk" value="1"  />
        <?php } ?>
        Frontend</span>
        <input type="text" class="form-control" name="yulink" placeholder="Enter ..." value="<?php echo $profile_row['yulink']; ?>" />
        </div>
      </div>
      <div class="form-group">
       <div class="mb-3">
        <label>Twitter Link</label>
        <span>
        <?php if($profile_row['twchk']) { ?>
        <input type="checkbox" value="1" checked="checked" name="twchk"  />
        <?php } else { ?>
        <input type="checkbox" name="twchk" value="1"  />
        <?php } ?>
        Frontend</span>
        <input type="text" class="form-control" name="twlink" placeholder="Enter ..." value="<?php echo $profile_row['twlink']; ?>"  />
         </div>
      </div>
      
      <!-- textarea -->
      <div class="form-group">
       <div class="mb-3">
        <label>Linked Link</label>
        <span>
        <?php if($profile_row['lichk']) { ?>
        <input type="checkbox" value="1" checked="checked" name="lichk"  />
        <?php } else { ?>
        <input type="checkbox" name="lichk" value="1"  />
        <?php } ?>
        Frontend</span>
        <input type="text" class="form-control" name="lilink" placeholder="Enter ..." value="<?php echo $profile_row['lilink']; ?>" />
        </div>
      </div>
      
      <div class="form-group">
       <div class="mb-3">
        <label>GPlus Link</label>
        <span>
        <?php if($profile_row['gpchk']) { ?>
        <input type="checkbox" value="1" checked="checked" name="gpchk"  />
        <?php } else { ?>
        <input type="checkbox" name="gpchk" value="1"  />
        <?php } ?>
        Frontend</span>
        <input type="text" class="form-control" name="gplus" placeholder="Enter ..." value="<?php echo $profile_row['gplus']; ?>" />
         </div>
      </div>
      
    
   </div>
                    
                    <div class="mb-3">
                        <button type="submit" name="socialnetwork" class="btn btn-primary">Save</button>
                      </div>
                    </form>
                  </div>
                  
                  
                  <div class="tab-pane" id="currancyadd" role="tabpanel">
                  
                   <div class="col-lg-12">
                               
                                <div class="table-responsive mb-4">
                                    <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th><input type="checkbox" class="form-check-input" id="ordercheck"><label class="form-check-label" for="ordercheck"></label></th>
                                                <th>Currancy Name</th>
                                                <th>Currancy Value</th>
                                                <th style="width: 220px;">Action</th>
                                            </tr>


                                        </thead>
                                        <tbody>
                                        <?php
				  
$brnadSQL="select * from currancy order by currancy_id DESC"; 
 $ResultSQL=mysqli_query($link,$brnadSQL); 
 while($Listbrand=mysqli_fetch_array($ResultSQL)) { 
?>

<tr>
	<td><div class="form-check text-center font-size-16"><input type="checkbox" name="users[]" value="<?php echo $row_cms["currancy_id"]; ?>" /><label class="form-check-label" for="ordercheck1"></label></div></td>
	
	<td><?php echo $Listbrand['currency_name'];?><br> </td>
    <td><?php echo $Listbrand['currancy_value'];?><br> </td>
	
	<td>
    	<a href="setting.php?currancy=<?php echo $Listbrand['currancy_id'];?>" class="px-3 text-primary"><i class="fa bx bx-edit-alt font-size-18"></i></a>
        
        <a href="script/setting_script.php?Curdel=<?php echo $Listbrand['currancy_id']; ?>" class="px-3 text-danger" onClick="return confirm('Do you really want to remove it?')"><i class="bx bx-trash font-size-18"></i></a>
	</td>
</tr>
<?php } ?>
</tbody>
                                    </table>
                                </div>
                                <!-- end table -->
                            </div>
                  
                    <form action="script/setting_script.php" method="post" enctype="multipart/form-data" name="cont"  id="register" onSubmit="return validate();">
                      <div class="row">
                        <h4 class="card-title">Currancy Add</h4>
                        <div class="col-md-6">
                          <div class="input-group mb-3">
                            
                            <input type="text" name='currency_name' class="form-control" placeholder="Currancy Name" value="<?php echo $row_currancy['currency_name']; ?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-group mb-3">
                            
                            <input type="text" class="form-control" name="currancy_value" placeholder="Currancy Value" value="<?php echo $row_currancy['currancy_value']; ?>">
                          </div>
                        </div>
                        <input type="hidden" class="form-control" name="currancy_id" placeholder="Currancy Value" value="<?php echo $row_currancy['currancy_id']; ?>">
                        
                      </div>
                      <button type="submit" name="<?php echo $Curbutton;?>" class="btn btn-primary">Add</button>
                    </form>
                  </div>
					
                  <div class="tab-pane" id="cityManage" role="tabpanel">
                  
                  
                  
                    <form action="script/setting_script.php" method="post" enctype="multipart/form-data" name="cont"  id="register" onSubmit="return validate();">
                      <div class="row">
                        <h4 class="card-title">State</h4>
                        <div class="col-md-6">
                          <div class="input-group mb-3">
                            <select name="state" required class="form-control select2">
							  <option value="">--Select State---</option>
								<?php 
								$stateSql=mysqli_query($link,"select * from states order by name ASC"); 
								while($listRow=mysqli_fetch_array($stateSql)){
								?>
								<option value="<?php echo $listRow['id'];?>"><?php echo $listRow['name'];?></option>
								<?php } ?>
							  </select>
                            
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-group mb-3">
                            
                            <input type="text" class="form-control" name="city" placeholder="Type New City Name" required>
                          </div>
                        </div>
                        
                        
                      </div>
                      <button type="submit" name="addNewCity" class="btn btn-primary">Add</button>
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