<?php 
include('includes/configset.php');
?>
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Invoice Detail | Minible - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

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
                                    <h4 class="mb-0">Invoice Detail</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                                            <li class="breadcrumb-item active">Invoice Detail</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="invoice-title">
                                            <h4 class="float-end font-size-16">Invoice #MN0131 <span class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                                            <div class="mb-4">
                                                <img src="assets/images/logo.png" alt="logo" height="100"/>
                                            </div>
                                            <div class="text-muted">
                                                <p class="mb-1">641 Counts Lane Wilmore, KY 40390</p>
                                                <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> abc@123.com</p>
                                                <p><i class="uil uil-phone me-1"></i> 012-345-6789</p>
                                            </div>
                                        </div>

                                        <hr class="my-4">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="text-muted">
                                                    <h5 class="font-size-16 mb-3">Billed To:</h5>
                                                    <h5 class="font-size-15 mb-2">Preston Miller</h5>
                                                    <p class="mb-1">4450 Fancher Drive Dallas, TX 75247</p>
                                                    <p class="mb-1">PrestonMiller@armyspy.com</p>
                                                    <p>001-234-5678</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="text-muted text-sm-end">
                                                    <div>
                                                        <h5 class="font-size-16 mb-1">Invoice No:</h5>
                                                        <p>#MN0131</p>
                                                    </div>
                                                    <div class="mt-4">
                                                        <h5 class="font-size-16 mb-1">Invoice Date:</h5>
                                                        <p>09 Jul, 2020</p>
                                                    </div>
                                                    <div class="mt-4">
                                                        <h5 class="font-size-16 mb-1">Order No:</h5>
                                                        <p>#1123456</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="py-2">
                                            <h5 class="font-size-15">Order summary</h5>

                                            <div class="table-responsive">
                                                <table class="table table-nowrap table-centered mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 70px;">No.</th>
                                                            <th>Item</th>
                                                            <th>Price</th>
                                                            <th>Quantity</th>
                                                            <th class="text-end" style="width: 120px;">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">01</th>
                                                            <td>
                                                                <h5 class="font-size-15 mb-1">Nike N012 Running Shoes</h5>
                                                                <ul class="list-inline mb-0">
                                                                    <li class="list-inline-item">Color : <span class="fw-medium">Gray</span></li>
                                                                    <li class="list-inline-item">Size : <span class="fw-medium">08</span></li>
                                                                </ul>
                                                            </td>
                                                            <td>$260</td>
                                                            <td>1</td>
                                                            <td class="text-end">$260.00</td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th scope="row">02</th>
                                                            <td>
                                                                <h5 class="font-size-15 mb-1">Adidas Running Shoes</h5>
                                                                <ul class="list-inline mb-0">
                                                                    <li class="list-inline-item">Color : <span class="fw-medium">Black</span></li>
                                                                    <li class="list-inline-item">Size : <span class="fw-medium">09</span></li>
                                                                </ul>
                                                            </td>
                                                            <td>$250</td>
                                                            <td>1</td>
                                                            <td class="text-end">$250.00</td>
                                                        </tr>


                                                        <tr>
                                                            <th scope="row" colspan="4" class="text-end">Sub Total</th>
                                                            <td class="text-end">$510.00</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                                Discount :</th>
                                                            <td class="border-0 text-end">- $50.00</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                                Shipping Charge :</th>
                                                            <td class="border-0 text-end">$25.00</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                                Tax</th>
                                                            <td class="border-0 text-end">$13.00</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                                            <td class="border-0 text-end"><h4 class="m-0">$498.00</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="d-print-none mt-4">
                                                <div class="float-end">
                                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                                    <a href="#" class="btn btn-primary w-md waves-effect waves-light">Send</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Minible.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="https://themesbrand.com/" target="_blank" class="text-reset">Themesbrand</a>
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

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>



                <!-- Settings -->
                <hr class="mt-0" />
                <h6 class="text-center mb-0">Choose Layouts</h6>

                <div class="p-4">
                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch" checked />
                        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css" />
                        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-5">
                        <input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch" data-appStyle="assets/css/app-rtl.min.css" />
                        <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>

            
                </div>

            </div> <!-- end slimscroll-menu-->
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

        <script src="assets/js/app.js"></script>

    </body>
</html>
