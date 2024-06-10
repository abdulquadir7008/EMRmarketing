<?php include('includes/configset.php');

$product_id=$_REQUEST['product_id'];
$uploads_dir = '../uploads/productcolor/';


    

if(isset($_REQUEST['update']))
{
	foreach($_POST['group_a'] as $index => $postValues) {
	$product_size = $postValues['prodsize'];
	$product_price = $postValues['product_price'];
	$ider = $postValues['ider'];
		$seokeyword = str_replace(str_split('&\\/:*?"<>| ().'), '-', $product_size);
$sekey2=mb_strtolower($seokeyword);
		if($ider){
  	$query100="update prod_verient SET prodsize='$product_size',product_price='$product_price',keyword='$sekey2',status='1' WHERE verient_id=$ider";
 mysqli_query($link,$query100);
		}
		else
		{
			
		$query100 = "INSERT INTO prod_verient(prodsize,product_price,product_id,status) values ('$product_size','$product_price','$product_id','1')";
  mysqli_query($link,$query100);
			
		}
}
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' Record modified successfully.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	

}

else if(isset($_REQUEST['add']))
{	
foreach($_POST['group_a'] as $index => $postValues) {
	$prodsize = $postValues['prodsize'];
	$product_price = $postValues['product_price'];
	$seokeyword = str_replace(str_split('&\\/:*?"<>| ().'), '-', $prodsize);
$sekey2=mb_strtolower($seokeyword);
	if($prodsize || $product_price){
  	$query1000 = "INSERT INTO prod_verient(prodsize,product_price,product_id,status,keyword) values ('$prodsize','$product_price','$product_id','1','$sekey2')";
  mysqli_query($link,$query1000);
	}
}

	
	
	

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' Record Add successfully.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
}

else if(isset($_REQUEST['page_id']) || isset($_REQUEST['page_id1']))
{
if(isset($_REQUEST['page_id']))
{
$page_id=$_REQUEST['page_id'];
$status='0';
}
else if(isset($_REQUEST['page_id1']))
{
$page_id=$_REQUEST['page_id1'];	
$status='1';
}
else
{
$status='0';	
}
$query="update prod_verient SET status='$status' WHERE verient_id='$page_id'";         
mysqli_query($link,$query);
}
else if(isset($_REQUEST['del']))
{
$id=$_REQUEST['del'];
$query="delete from prod_verient WHERE verient_id=$id";
mysqli_query($link,$query);
}

?>
<?php if(isset($_REQUEST['dateget'])){echo $_REQUEST['date'];}?>
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Brand | EMR Marketing</title>
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
                                    <h4 class="mb-0">Page</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                                            <li class="breadcrumb-item active">Page</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
							
							
		
							
                        <div>
                                    <a href="product-verient-form.php"><button type="button" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Add Verient</button></a>
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
                                                <th>Product Name</th>
                                                <th>Product Verient</th>
                                                <th>List</th>
                                               
                                               
                                                <th style="width: 120px;">Action</th>
                                            </tr>


                                        </thead>
                                        <tbody>
                                        <?php
				  
$brnadSQL="select * from prod_verient LEFT JOIN products ON prod_verient.product_id=products.id group by product_id"; 
 $ResultSQL=mysqli_query($link,$brnadSQL); 
 while($Listbrand=mysqli_fetch_array($ResultSQL)) { 
	 $productId= $Listbrand['product_id'];
?>

<tr>
	<td><div class="form-check text-center font-size-16"><input type="checkbox" name="users[]" value="<?php echo $Listbrand["page_id"]; ?>" /><label class="form-check-label" for="ordercheck1"></label></div></td>
	<td><a href="javascript: void(0);" class="text-dark fw-bold"><?php echo $Listbrand['title'];?></a> </td>
	<td>
		<?php			  
$brnadSQL2="select * from prod_verient where product_id='$productId'"; 
 $ResultSQL2=mysqli_query($link,$brnadSQL2); 
 while($Listbrand2=mysqli_fetch_array($ResultSQL2)) {
	 echo $Listbrand2['prodsize'].", ";	 
 }?></td>
    <td><?php			  
$brnadSQL2="select * from prod_verient where product_id='$productId'"; 
 $ResultSQL2=mysqli_query($link,$brnadSQL2); 
 while($Listbrand2=mysqli_fetch_array($ResultSQL2)) {
	 echo $Listbrand2['product_price'].", ";	 
 }?><br> </td>
	
	<td>
    	<a href="product-verient-form.php?cms=<?php echo $Listbrand['verient_id'];?>" class="px-3 text-primary"><i class="fa bx bx-edit-alt font-size-18"></i></a>
        
        <a href="product-verient-manage.php?del=<?php echo $Listbrand['verient_id']; ?>" class="px-3 text-danger" onClick="return confirm('Do you really want to remove it?')"><i class="bx bx-trash font-size-18"></i></a>
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
