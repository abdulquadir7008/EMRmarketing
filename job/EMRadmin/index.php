<?php
session_start();
include( '../config.php' );
include( 'configset.php' );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>Dashboard | FloorNation</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Dashboard FLoorNation" name="description" />
<meta content="FloorNation" name="Quadir" />
<link rel="icon" href="<?php echo $domain_url;?>uploads/<?php echo $profile_row['favicon']; ?>" sizes="32x32" />
<link rel="icon" href="<?php echo $domain_url;?>uploads/<?php echo $profile_row['favicon']; ?>" sizes="192x192" />
<link rel="apple-touch-icon" href="<?php echo $domain_url;?>uploads/<?php echo $profile_row['favicon']; ?>" />
<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/css2.css" rel="stylesheet" type="text/css" />
<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<link href="assets/css/line.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="layout-wrapper">
  <?php include('includes/top.php')?>
  <div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0">Dashboard</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Minible</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <div class="float-end mt-2">
                  <div id="total-revenue-chart"></div>
                </div>
                <div>
                  <h4 class="mb-1 mt-1"><span class='mibaed'>INR</span><span> 0 </span></h4>
                  <p class="text-muted mb-0">Total Revenue</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <div class="float-end mt-2">
                  <div id="orders-chart"> </div>
                </div>
                <div>
                  <h4 class="mb-1 mt-1"><span data-plugin="counterup"> 0 </span></h4>
                  <p class="text-muted mb-0">Orders</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <div class="float-end mt-2">
                  <div id="customers-chart"> </div>
                </div>
                <div>
                  <h4 class="mb-1 mt-1"><span data-plugin="counterup"> 0 </span></h4>
                  <p class="text-muted mb-0">Customers</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <div class="float-end mt-2">
                  <div id="growth-chart"></div>
                </div>
                <div>
                  <h4 class="mb-1 mt-1"><span> 0 </span>%</h4>
                  <p class="text-muted mb-0">Growth</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-8">
            <div class="card">
              <div class="card-body">
                <div class="float-end">
                  <div class="dropdown"> <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton5"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"> <span class="fw-semibold">Sort By:</span> <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span> </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton5"> <a class="dropdown-item" href="#">Monthly</a> <a class="dropdown-item" href="#">Yearly</a> <a class="dropdown-item" href="#">Weekly</a> </div>
                  </div>
                </div>
                <h4 class="card-title mb-4">Sales Analytics</h4>
                <div class="mt-1">
                  <ul class="list-inline main-chart mb-0">
                    <li class="list-inline-item chart-border-left me-0 border-0">
                      <h3 class="text-primary"><span class='mibINR'>INR</span><span data-plugin="counterup">2,371</span><span class="text-muted d-inline-block font-size-15 ms-3">Income</span></h3>
                    </li>
                    <li class="list-inline-item chart-border-left me-0">
                      <h3><span data-plugin="counterup">258</span><span class="text-muted d-inline-block font-size-15 ms-3">Sales</span> </h3>
                    </li>
                    <li class="list-inline-item chart-border-left me-0">
                      <h3><span data-plugin="counterup">3.6</span>%<span class="text-muted d-inline-block font-size-15 ms-3">Conversation Ratio</span></h3>
                    </li>
                  </ul>
                </div>
                <div class="mt-3">
                  <div id="sales-analytics-chart" class="apex-charts" dir="ltr"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="card">
              <div class="card-body">
                <div class="float-end">
                  <div class="dropdown"> <a class=" dropdown-toggle" href="#" id="dropdownMenuButton2"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="text-muted">All Members<i class="mdi mdi-chevron-down ms-1"></i></span> </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2"> <a class="dropdown-item" href="#">Locations</a> <a class="dropdown-item" href="#">Revenue</a> <a class="dropdown-item" href="#">Join Date</a> </div>
                  </div>
                </div>
                <h4 class="card-title mb-4">Top Users</h4>
                <div data-simplebar style="max-height: 336px;">
                  <div class="table-responsive"> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include('includes/footer.php')?>
  </div>
</div>
<script src="assets/libs/jquery/jquery.min.js"></script> 
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script> 
<script src="assets/libs/metismenu/metisMenu.min.js"></script> 
<script src="assets/libs/simplebar/simplebar.min.js"></script> 
<script src="assets/libs/node-waves/waves.min.js"></script> 
<script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script> 
<script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script> 
<script src="assets/libs/apexcharts/apexcharts.min.js"></script> 
<script src="assets/js/pages/dashboard.init.js"></script> 
<script src="assets/js/app.js"></script>
</body>
</html>