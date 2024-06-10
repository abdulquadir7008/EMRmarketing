<?php
include('includes/configset.php');
$invoice_no	= $_REQUEST['invoice_no'];
$place_supply = $_REQUEST['place_supply'];	
$reverse_charge	= $_REQUEST['reverse_charge'];	
$transport = $_REQUEST['transport'];	
$vehicle_no	= $_REQUEST['vehicle_no'];	
$station	= $_REQUEST['station'];	
$e_way_bill_no	= $_REQUEST['e_way_bill_no'];	
$order_by	= $_REQUEST['order_by'];	
$brand_name	= $_REQUEST['brand_name'];	
$payment_terms	= $_REQUEST['payment_terms'];	
$biller_name	= $_REQUEST['biller_name'];	
$address	= $_REQUEST['address'];
$party_mobile_no	= $_REQUEST['party_mobile_no'];
$gstn_unit	= $_REQUEST['gstn_unit'];
$name	= $_REQUEST['name'];
$shipp_address	= $_REQUEST['shipp_address'];
$invoice_id =$_REQUEST['invoice_id'];
$date= $_REQUEST['date'];
$utr_num = $_REQUEST['utr_num'];
if(isset($_REQUEST['update']))
{	
$query="update invoice SET invoice_no='$invoice_no',date='$date',place_supply='$place_supply',reverse_charge='$reverse_charge',transport='$transport',vehicle_no='$vehicle_no',station='$station',	e_way_bill_no='$e_way_bill_no',order_by='$order_by',brand_name='$brand_name',payment_terms='$payment_terms',biller_name='$biller_name',address='$address',party_mobile_no='$party_mobile_no',gstn_unit='$gstn_unit',name='$name',shipp_address='$shipp_address',utr_num='$utr_num' WHERE invoice_id=$invoice_id";
mysqli_query($link,$query);

foreach($_POST['group_a'] as $index => $postValues) {
	
	$vname = $postValues['vname'];
	$hsn_sac_code = $postValues['hsn_sac_code'];
	$qty = $postValues['qty'];
	$unit = $postValues['unit'];
	$mrp = $postValues['mrp'];
	$price = $postValues['price'];
	$gst = $postValues['gst'];
	$ider = $postValues['item_id'];
	
	if ( $ider ) {
		$query100="update invoice_item SET vname='$vname',hsn_sac_code='$hsn_sac_code',qty='$qty',unit='$unit',mrp='$mrp',price='$price',gst='$gst' WHERE item_id=$ider";
		 mysqli_query($link,$query100);
	} else {
		$query100 = "INSERT INTO invoice_item(vname,hsn_sac_code,qty,unit,mrp,price,gst,invoice_id) values ('$vname','$hsn_sac_code','$qty','$unit','$mrp','$price','$gst','$invoice_id')";
  		mysqli_query($link,$query100);

    }
	
	
}
$query123 = "delete from invoice_item WHERE invoice_id='$invoice_id' and vname=''";
mysqli_query( $link, $query123 );
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' Record modified successfully.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	

}

else if(isset($_REQUEST['add']))
{
$query="insert into invoice(invoice_no,date,place_supply,reverse_charge,transport,vehicle_no,station,e_way_bill_no,order_by,brand_name,payment_terms,biller_name,address,party_mobile_no,gstn_unit,name,shipp_address,utr_num) values('$invoice_no','$date','$place_supply','$reverse_charge','$transport','$vehicle_no','$station','$e_way_bill_no','$order_by','$brand_name','$payment_terms','$biller_name','$address','$party_mobile_no','$gstn_unit','$name','$shipp_address','$utr_num')";
mysqli_query($link,$query);

$last_id = mysqli_insert_id($link);
foreach($_POST['group_a'] as $index => $postValues) {
	$vname = $postValues['vname'];
	$hsn_sac_code = $postValues['hsn_sac_code'];
	$qty = $postValues['qty'];
	$unit = $postValues['unit'];
	$mrp = $postValues['mrp'];
	$price = $postValues['price'];
	$gst = $postValues['gst'];
  	$query100 = "INSERT INTO invoice_item(vname,hsn_sac_code,qty,unit,mrp,price,gst,invoice_id) values ('$vname','$hsn_sac_code','$qty','$unit','$mrp','$price','$gst','$last_id')";
  mysqli_query($link,$query100);
}

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' Record Add successfully.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
}


else if(isset($_REQUEST['del']))
{
$id=$_REQUEST['del'];
mysqli_query($link,"delete from invoice WHERE invoice_id=$id");
mysqli_query( $link, "delete from invoice_item WHERE invoice_id=$id" );	
} ?>
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Product | EMR Marketing</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon 
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
       <link href="assets/css/awesome/css/all.css" rel="stylesheet">

    </head>

    
    <body>

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
                                    <h4 class="mb-0">Invoice</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                                            <li class="breadcrumb-item active">Invoice</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                        <div>
                        <?php
						if(isset($_POST['category_id']))
							$category_id=implode(',',$_POST['category_id']);
						?>
                        
                                    <a href="invoice-form.php"><button type="button" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Create Invoice</button></a>
                                </div>
                        <?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
foreach($_SESSION['ERRMSG_ARR'] as $msg) {
echo "<div class='pad margin no-print'><div style='margin: 20px !important;' class='alert alert-success alert-dismissible fade show'><i class='fa fa-info'></i><b>Note:</b>" .$msg."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                                                
                                                </button></div></div>";  
}
unset($_SESSION['ERRMSG_ARR']); }?>
                            <div class="col-lg-12">
                               
                                <div class="table-responsive mb-4">
                                    <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th style="width: 20px;">
                                                    <div class="form-check text-center font-size-16">
                                                        <input type="checkbox" class="form-check-input" id="ordercheck">
                                                        <label class="form-check-label" for="ordercheck"></label>
                                                    </div>
                                                </th>
                                                <th>Sr.no</th>
												<th>Invoice Number</th>
                                                <th>Biller Name</th>
                                                <th>Station</th>
                                                <th>Order By</th>
                                                <th>transport</th>
                                                <th>Total Price</th>
                                                <th>Date</th>
                                               
                                                <th style="width: 120px;">Action</th>
                                            </tr>


                                        </thead>
                                        <tbody>
                                        <?php
				  
$brnadSQL="select * from invoice order by invoice_id DESC"; 
 $ResultSQL=mysqli_query($link,$brnadSQL); 
 while($Listbrand=mysqli_fetch_array($ResultSQL)) { 
?>

<tr>
	<td><div class="form-check text-center font-size-16"><input type="checkbox" name="users[]" value="<?php echo $row_cms["id"]; ?>" /><label class="form-check-label" for="ordercheck1"></label></div></td>
	<td><a href="javascript: void(0);" class="text-dark fw-bold"><?php echo $Listbrand['invoice_id'];?></a> </td>
	<td><?php echo $Listbrand['invoice_no'];?></td>
	<td><?php echo $Listbrand['biller_name'];?></td>
    <td><?php echo $Listbrand['station'];?></td>
	<td><?php echo $Listbrand['order_by'];?></td>
    <td><?php echo $Listbrand['transport'];?></td>
	<td></td>
	<td><?php echo $Listbrand['date'];?></td>
	

	<td>
    	<a href="invoice-form.php?cms=<?php echo $Listbrand['invoice_id'];?>" class="px-3 text-primary"><i class="fa bx bx-edit-alt font-size-18"></i></a>
        <a href="invoiceGen.php?view=<?php echo $Listbrand['invoice_id'];?>" target="_blank" class="px-3 text-primary"><i class="fas fa-file-invoice-dollar font-size-18"></i></a>
        <a href="invoice-manage.php?del=<?php echo $Listbrand['invoice_id']; ?>" class="px-3 text-danger" onClick="return confirm('Do you really want to remove it?')"><i class="bx bx-trash font-size-18"></i></a>
	</td>
</tr>
<?php } ?>
</tbody>
                                    </table>
                                </div>
                                <!-- end table -->
                            </div>
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
<?php include('includes/footer.php')?>
                
                
            </div>
            <!-- end main content-->

        </div>
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
