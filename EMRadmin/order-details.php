<?php 
include('includes/configset.php');
$sql="delete from orderproduct where datalogid='0'";
mysqli_query($link,$sql);
if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}else{$id=0;}
$sql_cms="select * from datalogs WHERE dil_id=$id"; 
$result_cms=mysqli_query($link,$sql_cms); 
$row_cms=mysqli_fetch_array($result_cms);
$memberID = $row_cms['member_id'];
$sql_cms2="select * from membership WHERE member_id=$memberID"; 
$result_cms2=mysqli_query($link,$sql_cms2); 
$row_cms2=mysqli_fetch_array($result_cms2);

$countrycode = $row_cms2['country'];
$codcharge = '0';
if($row_cms['payment'] == 'cash_on_delivery' && $_REQUEST['id']){
    $codcharge = '50'; 
}

$sql_con1="select * from country WHERE code='$countrycode'"; 
$result_con1=mysqli_query($link,$sql_con1); 
$row_con1=mysqli_fetch_array($result_con1);
if(isset($_REQUEST['order']))
{
$order=$_REQUEST['order'];
$sql="delete from orderproduct where order_id=$order";
mysqli_query($link,$sql);
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Orders | Minible - Admin & Dashboard Template</title>
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
                                    <h4 class="mb-0">Orders</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                            <li class="breadcrumb-item active">Orders Details</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
foreach($_SESSION['ERRMSG_ARR'] as $msg) {
echo "<div class='pad margin no-print'><div style='margin: 20px !important;' class='alert alert-success alert-dismissible fade show'><i class='fa fa-info'></i><b>Note:</b>" .$msg."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                                                
                                                </button></div></div>";  
}
unset($_SESSION['ERRMSG_ARR']); }?>
                                 
                                <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="invoice-title">
                                            <h4 class="font-size-16" style="float: left;">Invoice #EMR0<?php echo $row_cms['dil_id'];?> 
                                            <br><span><strong>Payment :</strong> <?php echo $row_cms['payment'];?></span>
                                        </h4>
											
											<h4 class="font-size-16" style="float: right; line-height: 25px"><strong>Order ID : </strong> <?php echo $row_cms['merchant_reference'];?> 
                                            <br><span><strong>Tracking ID :</strong> <?php echo $row_cms['oder_pending'];?></span>
												<br><span><strong>Bank Refrence No  :</strong> <?php echo $row_cms['bank_ref_no'];?></span>
                                        </h4>
                                        <div class="clearfix"></div>
                                            <div class="mb-4">
                                                
                                            </div>
                                            <div class="text-muted">
                                            <?php if($row_cms['success_code']='PAYMENT_SUCCESS' && $row_cms['payup']=='2'){?>
                                                <span class="badge bg-success font-size-12 ms-2">Paid</span>
                                                <br><span><strong>Payment :</strong> <?php echo $row_cms['success_code'];?></span>
                                                <?php } else if($row_cms['success_code']=='cashed' && $row_cms['payup']=='2'){?>
                                                    <span class="badge bg-success font-size-12 ms-2">Paid</span>
                                                <br><span><strong>Order ID :</strong> <?php echo $row_cms['oder_pending'];?></span>
                                                <?php } else if($row_cms['success_code']=='bank' && $row_cms['payup']=='3'){?>
                                                    <span class="badge bg-success font-size-12 ms-2">Paid</span>
                                                <br><span><strong>Order ID :</strong> <?php echo $row_cms['oder_pending'];?></span>
                                                    <?php }else if($row_cms['success_code']=='Failed'){ ?>
                                                        <span class="badge bg-danger font-size-12 ms-2">Failed</span>
                                                        <br><span><strong>Merchant Reference :</strong> <?php echo $row_cms['merchant_reference'];?></span>
                                                        <br><span><?php echo $row_cms['success_code'];?> : <?php echo $row_cms['notification'];?></span>
                                                        <?php } else if($row_cms['payment']=='cash_on_delivery'){ ?>
                                                            <span class="badge bg-warning font-size-12 ms-2">Unpaid</span>
                                                            <br><span><strong>Order ID :</strong> <?php echo $row_cms['oder_pending'];?></span>
                                                            <?php } ?>
                                            </div>


                                        </div>

                                        <hr class="my-4">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="text-muted">
<?php
$sql_st2004 = mysqli_query( $link, "select * from states where id='".$row_cms2['state']."'" );
$stateSqli2004 = mysqli_fetch_array( $sql_st2004 );
$sql_city2004 = mysqli_query( $link, "select * from cities where id='".$row_cms2['city']."'" );
$citySqli2004 = mysqli_fetch_array( $sql_city2004 );
													?>
                                                    <h5 class="font-size-16 mb-3">Billed To:</h5>
                                                    <h5 class="font-size-15 mb-2"><?php echo $row_cms2['fname']." ".$row_cms2['lname'];?></h5>
                                                    <p class="mb-1"><?php echo $row_cms2['stree_address'].", ".$stateSqli2004['name'].", ".$citySqli2004['city'].", ".$row_cms2['postalcode']."<br><strong> India</strong>";?></p>
                                                    <p class="mb-1"><?php echo $row_cms2['email'];?></p>
                                                    <p><?php echo $row_cms2['phone'];?></p>
                                                </div>
                                                <div class="text-muted">
                                               
                                                


                                                <?php if($row_cms['success_code'] && $row_cms['payup']=='14000'){ ?>
                                                    <h5 class="font-size-16 mb-3">Shippment Details:</h5>
                                                <?php 
                                                $Getjsone = $row_cms['ship_details'];
                                                $arrget = json_decode($Getjsone, true);
                                                foreach($arrget as $item) { 
                                                   $shipment .= $item['ShipmentNumber'];
                                                   $accountcde .= $item['AcccountCode'];
                                                   $labelurl .= $item['LabelURL'];
                                                }?>
                                <p><strong>ShipmentNumber</strong> : <?php echo $shipment;?>
                                <br><strong>AcccountCode</strong> : <?php echo $accountcde;?>
                                </p><p>
                <a href="<?php echo $labelurl;?>" class="btn btn-primary"><span class="bx bxs-file-pdf"></span> Download slip</a></p>
<?php } else if($row_cms['payment']=='cash_on_delivery' && $row_cms['payup']=='2'){?>
    <?php 
                                                $Getjsone = $row_cms['ship_details'];
                                                $arrget = json_decode($Getjsone, true);
                                                foreach($arrget as $item) { 
                                                   $shipment .= $item['ShipmentNumber'];
                                                   $accountcde .= $item['AcccountCode'];
                                                   $labelurl .= $item['LabelURL'];
                                                }?>
                                <p><strong>ShipmentNumber</strong> : <?php echo $shipment;?>
                                <br><strong>AcccountCode</strong> : <?php echo $accountcde;?>
                                </p><p>
                <a href="<?php echo $labelurl;?>" class="btn btn-primary"><span class="bx bxs-file-pdf"></span> Download slip</a></p>

<?php } else if($row_cms['payment']=='bank_transfer' && $row_cms['payup']=='3' && $row_cms['ship_details']){?>
    <?php 
                                                $Getjsone = $row_cms['ship_details'];
                                                $arrget = json_decode($Getjsone, true);
                                                foreach($arrget as $item) { 
                                                   $shipment .= $item['ShipmentNumber'];
                                                   $accountcde .= $item['AcccountCode'];
                                                   $labelurl .= $item['LabelURL'];
                                                }?>
                                <p><strong>ShipmentNumber</strong> : <?php echo $shipment;?>
                                <br><strong>AcccountCode</strong> : <?php echo $accountcde;?>
                                </p><p>
                <a href="<?php echo $labelurl;?>" class="btn btn-primary"><span class="bx bxs-file-pdf"></span> Download slip</a></p>
<?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="text-muted text-sm-end">
                                                    
                                                    <div class="mt-4">
                                                        <h5 class="font-size-16 mb-1">Invoice Date:</h5>
                                                        <p><?php echo $row_cms['indate'];?></p>
                                                    </div>
                                                    <?php if($row_cms['success_code'] && $row_cms['payup']=='14000'){?>
                                                    <div class="mt-4">
                                                        <h5 class="font-size-16 mb-1">Order No:</h5>
                                                        <p><?php echo $row_cms['success_code'];?></p>
                                                    </div>
                                                    <?php } ?>
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
<?php
$iv = '1';
$sql_order="select * from orderproduct WHERE datalogid=$id"; 
$result_order=mysqli_query($link,$sql_order); 
														$order_sub_total=0;
while($row_order=mysqli_fetch_array($result_order)) {
	$cart_prod_id = $row_order['product_id'];
		$product_cart = "select * from products where id='$cart_prod_id'";	
			$result_product_cart = mysqli_query($link,$product_cart); 
				$List_product_cart = mysqli_fetch_array($result_product_cart);
?>
                                                        <tr>
                                                            <th scope="row"><?php echo $iv;?></th>
                                                            <td>
                                                                <h5 class="font-size-15 mb-1"><?php echo $List_product_cart['title'];?></h5>
                                                                <ul class="list-inline mb-0">
                                                                <li class="list-inline-item"><?php
												$tags = preg_replace('/,+/', ',', $row_order['varient_names']);
													 $splittedstring=explode(",",$tags);
														foreach ($splittedstring as  $value) {
															echo $codeMt ="<div class='col-md-5'><i>".$value." : </i></div>";
														}
										?>
									<?php
													$tags2 = preg_replace('/,+/', ',', $row_order['verientlist']);
	 														$splittedstring2=explode(",",$tags2);
														foreach ($splittedstring2 as  $value2) {
															echo $codemt2 ="<div class='col-md-5'><i>".$value2."</i></div>";
														}
										?></li>
                                                                  
                                                    </ul>
                                                    <?php if($row_order['rt'] == '1'){?>
                                <span class="btn btn-primary btn-sm waves-effect waves-light">
                                    <a href="order-details.php?order=<?php echo $row_order['order_id'];?>" style="color:#fff">Request for Return</a></span>
                                                                <?php } ?>
                                                            </td>
                                                            <td><?php echo $row_order['price'];?></td>
                                                            <td><?php echo $row_order['qty'];?></td>
                                                            <td class="text-end"><?php echo str_replace(',','',$row_order['price'])*str_replace(',','',$row_order['qty']);?><span class='mibaed'> INR</span></td>
                                                        </tr>
                                                        
<?php $order_total=str_replace(',','',$row_order['price'])*str_replace(',','',$row_order['qty']);
  						$order_sub_total= ($order_sub_total + $order_total); $iv++;} ?>
                                                        


                                                        <tr>
                                                            <th scope="row" colspan="4" class="text-end">Sub Total :</th>
                                                            <td class="text-end"><?php echo number_format($order_sub_total,2, '.', ',');?> <span class='mibaed'>INR</span></td>
                                                        </tr>
														
														<?php if($row_cms['reason_discount']){?>
														<tr>
                                                            <th scope="row" colspan="4" class="text-end"><?php echo $row_cms['reason_discount'];?> :</th>
                                                            <td class="text-end">-<?php echo $order_sub_total= $order_sub_total / 2;?> <span class='mibaed'>INR</span></td>
                                                        </tr>
														<?php } ?>
                                                        <tr>
                                                            <th scope="row" colspan="4" class="text-end">Tax :</th>
                                                            <td class="text-end"><?php echo $tax=number_format($order_sub_total * 18 / 100,2, '.', ',') ?> <span class='mibaed'>INR</span></td>
                                                        </tr>
                                                        
                                                       
                                    <?php if($row_cms['payment'] == 'cash_on_delivery' && $_REQUEST['id']){?>
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">COD Charge : </th>
                                            <td class="border-0 text-end"><h4 class="m-0"><?php echo $codcharge;?><span class='mibaed'>INR</span></td>
                                        </tr>

                                    <?php }?>
                                                        
                                                        <tr>
                                                            <th scope="row" colspan="4" class="border-0 text-end">Total :</th>
                                                            <td class="border-0 text-end"><h4 class="m-0"><?php echo number_format(($order_sub_total + $tax ),2, '.', ',');?> <span class='mibaed'>INR</span></h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="d-print-none mt-4">
                                                <div class="float-end">

                                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                                    <?php if($row_cms['success_code']){}else{?>
                                                        <?php if($row_cms['payment'] == 'cash_on_delivery'){?>
                                                    <a href="cashpayment.php?cash=<?php echo $id;?>" class="btn btn-primary w-md waves-effect waves-light">Recipt Payment</a>
                                                    <?php } else if($row_cms['payment'] == 'bank_transfer'){?>
                                                        <a href="cashpayment.php?bank=<?php echo $id;?>" class="btn btn-primary w-md waves-effect waves-light">Recipt Payment</a>
                                                    <?php }?>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <!-- End Page-content -->

                
                
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
