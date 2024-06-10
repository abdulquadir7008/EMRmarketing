<?php
include( 'includes/configset.php' );
$id=$_REQUEST['del'];
$query="delete from membership WHERE member_id=$id";
mysqli_query($link,$query);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Customers | EMR Marketing</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesbrand" name="author" />
<!-- App favicon -->
<link rel="icon" href="../favicon.png" sizes="32x32" />
		<link rel="icon" href="../favicon.png" sizes="192x192" />
		<link rel="apple-touch-icon" href="../favicon.png" />

<!-- DataTables -->
<link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Bootstrap Css -->
<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body>

<!-- <body data-layout="horizontal" data-topbar="colored"> --> 

<!-- Begin page -->
<div id="layout-wrapper">
  <?php include('includes/top.php')?>
  
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
              <h4 class="mb-0">Customers</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                  <li class="breadcrumb-item active">Customers</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
          <div class="col-lg-12">
            <div>
              
              <div class="table-responsive mb-4">
                <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                  <thead>
                    <tr class="bg-transparent">
                      <th style="width: 20px;"> <div class="form-check text-center">
                          <input type="checkbox" class="form-check-input" id="customercheck">
                          <label class="form-check-label" for="customercheck"></label>
                        </div>
                      </th>
                      <th style="width: 120px;">Customer ID</th>
                      <th>Customer</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Join Date</th>
                      <th>Location</th>
                      <th style="width: 120px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $SQlmembship = "select * from membership where status='2' order by date DESC";
                    $Mysqlmembership = mysqli_query( $link, $SQlmembship );
                    while ( $listMembers = mysqli_fetch_array( $Mysqlmembership ) ) {
                      ?>
                    <tr>
                      <td><div class="form-check text-center">
                          <input type="checkbox" class="form-check-input" id="customercheck1">
                          <label class="form-check-label" for="customercheck1"></label>
                        </div></td>
                      <td><a href="javascript: void(0);" class="text-dark fw-bold">#MIB<?php echo $listMembers['member_id'];?></a></td>
                      <td> <span><?php echo $listMembers['fname']." ". $listMembers['lname'];?></span></td>
                      <td><?php echo $listMembers['email'];?></td>
                      <td><?php echo $listMembers['phone'];?></td>
                      <td><?php echo $listMembers['date'];?></td>
						<td><?php echo $listMembers['city'];?></td>
                      <td><a href="ecommerce-customers.php?del=<?php echo $listMembers['member_id']; ?>" class="px-3 text-danger" onClick="return confirm('Do you really want to remove it?')"><i class="bx bx-trash font-size-18"></i></a></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- end row --> 
        
      </div>
      <!-- container-fluid --> 
    </div>
    <!-- End Page-content -->
    
    <footer class="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6"> 
            <script>document.write(new Date().getFullYear())</script> © EMR Maketing. </div>
          <div class="col-sm-6">
           <div class="text-sm-end d-none d-sm-block">
                                    Crafted with  by <a href="https://tangibletechnosis.in/" target="_blank" class="text-reset">Tangible</a>
                                </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <!-- end main content--> 
  
</div>
<!-- END layout-wrapper --> 

<!-- Right Sidebar -->
<div class="right-bar">
  <div data-simplebar class="h-100">
    <div class="rightbar-title d-flex align-items-center px-3 py-4">
      <h5 class="m-0 me-2">Settings</h5>
      <a href="javascript:void(0);" class="right-bar-toggle ms-auto"> <i class="mdi mdi-close noti-icon"></i> </a> </div>
    
    <!-- Settings -->
    <hr class="mt-0" />
    <h6 class="text-center mb-0">Choose Layouts</h6>
    <div class="p-4">
      <div class="mb-2"> <img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt=""> </div>
      <div class="form-check form-switch mb-3">
        <input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch" checked />
        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
      </div>
      <div class="mb-2"> <img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt=""> </div>
      <div class="form-check form-switch mb-3">
        <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css" />
        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
      </div>
      <div class="mb-2"> <img src="assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt=""> </div>
      <div class="form-check form-switch mb-5">
        <input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch" data-appStyle="assets/css/app-rtl.min.css" />
        <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
      </div>
    </div>
  </div>
  <!-- end slimscroll-menu--> 
</div>
<!-- /Right-bar --> 

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT --> 
<script src="assets/libs/jquery/jquery.min.js"></script> 
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script> 
<script src="assets/libs/metismenu/metisMenu.min.js"></script> 
<script src="assets/libs/simplebar/simplebar.min.js"></script> 
<script src="assets/libs/node-waves/waves.min.js"></script> 
<script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script> 
<script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script> 

<!-- Required datatable js --> 
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script> 
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script> 

<!-- Responsive examples --> 
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script> 
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script> 

<!-- init js --> 
<script src="assets/js/pages/ecommerce-datatables.init.js"></script> 
<script src="assets/js/app.js"></script>
</body>
</html>
