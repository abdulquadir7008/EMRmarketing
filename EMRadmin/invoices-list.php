<?php 
include('includes/configset.php');
?>
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Invoice List | Minible - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- bootstrap-datepicker css -->
        <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

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
                                    <h4 class="mb-0">Invoice List</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                                            <li class="breadcrumb-item active">Invoice List</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-md-4">
                                <div>
                                    <button type="button" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Add Invoice</button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="float-end">
                                    <div class=" mb-3">
                                        <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                            <input type="text" class="form-control text-start" placeholder="From" name="From" />
                                            <input type="text" class="form-control text-start" placeholder="To" name="To" />
                                            
                                            <button type="button" class="btn btn-primary"><i class="mdi mdi-filter-variant"></i></button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                
                                <div class="table-responsive mb-4">
                                    <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th style="width: 24px;">
                                                    <div class="form-check text-center">
                                                        <input type="checkbox" class="form-check-input" id="invoicecheck">
                                                        <label class="form-check-label" for="invoicecheck"></label>
                                                    </div>
                                                </th>
                                                <th>Invoice ID</th>
                                                <th>Date</th>
                                                <th>Billing Name</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Download Pdf</th>
                                                <th style="width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>
                                                    <div class="form-check text-center">
                                                        <input type="checkbox" class="form-check-input" id="invoicecheck1">
                                                        <label class="form-check-label" for="invoicecheck1"></label>
                                                    </div>
                                                </td>
                                                
                                                <td><a href="javascript: void(0);" class="text-dark fw-bold">#MN0131</a> </td>
                                                <td>
                                                    10 Jul, 2020
                                                </td>
                                                <td>Connie Franco</td>
                                                
                                                <td>
                                                    $141
                                                </td>
                                                <td>
                                                    <div class="badge bg-soft-success font-size-12">Paid</div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <button class="btn btn-light btn-sm w-xs">Pdf <i class="uil uil-download-alt ms-2"></i></button>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check text-center">
                                                        <input type="checkbox" class="form-check-input" id="invoicecheck2">
                                                        <label class="form-check-label" for="invoicecheck2"></label>
                                                    </div>
                                                </td>
                                                
                                                <td><a href="javascript: void(0);" class="text-dark fw-bold">#MN0130</a> </td>
                                                <td>
                                                    09 Jul, 2020
                                                </td>
                                                <td>Paul Reynolds</td>
                                                
                                                <td>
                                                    $153
                                                </td>
                                                <td>
                                                    <div class="badge bg-soft-success font-size-12">Paid</div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <button class="btn btn-light btn-sm w-xs">Pdf <i class="uil uil-download-alt ms-2"></i></button>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check text-center">
                                                        <input type="checkbox" class="form-check-input" id="invoicecheck3">
                                                        <label class="form-check-label" for="invoicecheck3"></label>
                                                    </div>
                                                </td>
                                                
                                                <td><a href="javascript: void(0);" class="text-dark fw-bold">#MN0129</a> </td>
                                                <td>
                                                    09 Jul, 2020
                                                </td>
                                                <td>Ronald Patterson</td>
                                                
                                                <td>
                                                    $220
                                                </td>
                                                <td>
                                                    <div class="badge bg-soft-warning font-size-12">Pending</div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <button class="btn btn-light btn-sm w-xs">Pdf <i class="uil uil-download-alt ms-2"></i></button>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check text-center">
                                                        <input type="checkbox" class="form-check-input" id="invoicecheck4">
                                                        <label class="form-check-label" for="invoicecheck4"></label>
                                                    </div>
                                                </td>
                                                
                                                <td><a href="javascript: void(0);" class="text-dark fw-bold">#MN0128</a> </td>
                                                <td>
                                                    08 Jul, 2020
                                                </td>
                                                <td>Adella Perez</td>
                                                
                                                <td>
                                                    $175
                                                </td>
                                                <td>
                                                    <div class="badge bg-soft-success font-size-12">Paid</div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <button class="btn btn-light btn-sm w-xs">Pdf <i class="uil uil-download-alt ms-2"></i></button>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check text-center">
                                                        <input type="checkbox" class="form-check-input" id="invoicecheck5">
                                                        <label class="form-check-label" for="invoicecheck5"></label>
                                                    </div>
                                                </td>
                                                
                                                <td><a href="javascript: void(0);" class="text-dark fw-bold">#MN0127</a> </td>
                                                <td>
                                                    07 Jul, 2020
                                                </td>
                                                <td>Theresa Mayers</td>
                                                
                                                <td>
                                                    $160
                                                </td>
                                                <td>
                                                    <div class="badge bg-soft-success font-size-12">Paid</div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <button class="btn btn-light btn-sm w-xs">Pdf <i class="uil uil-download-alt ms-2"></i></button>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check text-center">
                                                        <input type="checkbox" class="form-check-input" id="invoicecheck6">
                                                        <label class="form-check-label" for="invoicecheck6"></label>
                                                    </div>
                                                </td>
                                                
                                                <td><a href="javascript: void(0);" class="text-dark fw-bold">#MN0126</a> </td>
                                                <td>
                                                    06 Jul, 2020
                                                </td>
                                                <td>Michael Wallace</td>
                                                
                                                <td>
                                                    $150
                                                </td>
                                                <td>
                                                    <div class="badge bg-soft-success font-size-12">Paid</div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <button class="btn btn-light btn-sm w-xs">Pdf <i class="uil uil-download-alt ms-2"></i></button>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check text-center">
                                                        <input type="checkbox" class="form-check-input" id="invoicecheck7">
                                                        <label class="form-check-label" for="invoicecheck7"></label>
                                                    </div>
                                                </td>
                                                
                                                <td><a href="javascript: void(0);" class="text-dark fw-bold">#MN0125</a> </td>
                                                <td>
                                                    05 Jul, 2020
                                                </td>
                                                <td>Oliver Gonzales</td>
                                                
                                                <td>
                                                    $165
                                                </td>
                                                <td>
                                                    <div class="badge bg-soft-warning font-size-12">Pending</div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <button class="btn btn-light btn-sm w-xs">Pdf <i class="uil uil-download-alt ms-2"></i></button>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check text-center">
                                                        <input type="checkbox" class="form-check-input" id="invoicecheck8">
                                                        <label class="form-check-label" for="invoicecheck8"></label>
                                                    </div>
                                                </td>
                                                
                                                <td><a href="javascript: void(0);" class="text-dark fw-bold">#MN0124</a> </td>
                                                <td>
                                                    05 Jul, 2020
                                                </td>
                                                <td>David Burke</td>
                                                
                                                <td>
                                                    $170
                                                </td>
                                                <td>
                                                    <div class="badge bg-soft-success font-size-12">Paid</div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <button class="btn btn-light btn-sm w-xs">Pdf <i class="uil uil-download-alt ms-2"></i></button>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check text-center">
                                                        <input type="checkbox" class="form-check-input" id="invoicecheck9">
                                                        <label class="form-check-label" for="invoicecheck9"></label>
                                                    </div>
                                                </td>
                                                
                                                <td><a href="javascript: void(0);" class="text-dark fw-bold">#MN0123</a> </td>
                                                <td>
                                                    04 Jul, 2020
                                                </td>
                                                <td>Willie Verner</td>
                                                
                                                <td>
                                                    $140
                                                </td>
                                                <td>
                                                    <div class="badge bg-soft-warning font-size-12">Pending</div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <button class="btn btn-light btn-sm w-xs">Pdf <i class="uil uil-download-alt ms-2"></i></button>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check text-center">
                                                        <input type="checkbox" class="form-check-input" id="invoicecheck10">
                                                        <label class="form-check-label" for="invoicecheck10"></label>
                                                    </div>
                                                </td>
                                                
                                                <td><a href="javascript: void(0);" class="text-dark fw-bold">#MN0122</a> </td>
                                                <td>
                                                    03 Jul, 2020
                                                </td>
                                                <td>Felix Perry</td>
                                                
                                                <td>
                                                    $155
                                                </td>
                                                <td>
                                                    <div class="badge bg-soft-success font-size-12">Paid</div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <button class="btn btn-light btn-sm w-xs">Pdf <i class="uil uil-download-alt ms-2"></i></button>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check text-center">
                                                        <input type="checkbox" class="form-check-input" id="invoicecheck11">
                                                        <label class="form-check-label" for="invoicecheck11"></label>
                                                    </div>
                                                </td>
                                                
                                                <td><a href="javascript: void(0);" class="text-dark fw-bold">#MN0121</a> </td>
                                                <td>
                                                    02 Jul, 2020
                                                </td>
                                                <td>Virgil Kelley</td>
                                                
                                                <td>
                                                    $165
                                                </td>
                                                <td>
                                                    <div class="badge bg-soft-success font-size-12">Paid</div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <button class="btn btn-light btn-sm w-xs">Pdf <i class="uil uil-download-alt ms-2"></i></button>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check text-center">
                                                        <input type="checkbox" class="form-check-input" id="invoicecheck12">
                                                        <label class="form-check-label" for="invoicecheck12"></label>
                                                    </div>
                                                </td>
                                                
                                                <td><a href="javascript: void(0);" class="text-dark fw-bold">#MN0120</a> </td>
                                                <td>
                                                    02 Jul, 2020
                                                </td>
                                                <td>Matthew Lawler</td>
                                                
                                                <td>
                                                    $170
                                                </td>
                                                <td>
                                                    <div class="badge bg-soft-warning font-size-12">Pending</div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <button class="btn btn-light btn-sm w-xs">Pdf <i class="uil uil-download-alt ms-2"></i></button>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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

        <!-- bootstrap datepicker -->
        <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

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
