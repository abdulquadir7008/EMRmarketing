<?php
include( 'includes/configset.php' );
if ( isset( $_REQUEST[ 'cms' ] ) ) {
  $verient_id = $_REQUEST[ 'cms' ];
} else {
  $verient_id = 0;
}
$sql_cms = "select * from prod_verient WHERE verient_id=$verient_id";
$result_cms = mysqli_query( $link, $sql_cms );
$row_cms = mysqli_fetch_array( $result_cms );
$cmsID = $row_cms['product_id'];
?>
<?php
if ( isset( $_REQUEST[ 'cms' ] ) ) {
  $sub = "update";
  $sub2 = "Update";
} else {
  $sub = "add";
  $sub2 = "Save";
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Add Product Verient | EMR Marketing</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesbrand" name="author" />
<!-- App favicon -->
<link rel="icon" href="../favicon.png" sizes="32x32" />
<link rel="icon" href="../favicon.png" sizes="192x192" />
<link rel="apple-touch-icon" href="../favicon.png" />
<!-- select2 css -->
<link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

<!-- dropzone css -->
<link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

<!-- Bootstrap Css -->
<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<link href="assets/css/tagger.css" rel="stylesheet">
<script src="assets/libs/jquery/jquery.min.js"></script>
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
            <h4 class="mb-0">Add Verient</h4>
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                <li class="breadcrumb-item active">Add Verient</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- end page title -->
     
		  
		  
      <form action="product-verient-manage.php" name="conter" class="dropzone" id="myform2"  method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-12">
            <div id="addproduct-accordion" class="custom-accordion">
              <div class="card"> <a href="#addproduct-billinginfo-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
                <div class="p-4">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      <div class="avatar-xs">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary"> 01 </div>
                      </div>
                    </div>
                    <div class="flex-1 overflow-hidden">
                      <h5 class="font-size-16 mb-1">Verient Info</h5>
                      <p class="text-muted text-truncate mb-0">Fill all information below</p>
                    </div>
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                </div>
                </a>
                <div id="addproduct-billinginfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
                  <div class="p-4 border-top">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="mb-3">
                          <label class="form-label" for="manufacturerbrand">Select Product</label>
                          <select class="form-control select2" name="product_id">
                            <?php
                            $SQLprod = "select * from products where status='1' order by id DESC";
                            $ResultProd = mysqli_query( $link, $SQLprod );
                            while ( $ListProd = mysqli_fetch_array( $ResultProd ) ) {
                              ?>
                            <option value="<?php echo $ListProd['id'];?>" <?php if($ListProd['id'] == $row_cms['product_id']){?>selected<?php } ?> ><?php echo $ListProd['title'];?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>
					 
                    <div class="repeater" id="repgert">
                      <div data-repeater-list="group_a">
                        <h5>Product size</h5>
                        <?php
                        if ( isset( $_REQUEST[ 'cms' ] ) ) {
                          $invoicedel = "select * from prod_verient WHERE product_id='$cmsID'";
                          $myinvoicedel = mysqli_query( $link, $invoicedel );
                          while ( $listinvoice = mysqli_fetch_array( $myinvoicedel ) ) {
                            ?>
						  
                        <div data-repeater-item class="row">
							<input type="hidden" name="ider" value="<?php echo $listinvoice['verient_id'];?>">
                          <div  class="mb-3 col-lg-3">
                            <label class="form-label" for="name">Product Size</label>
                            <input type="text" id="prodsize" name="prodsize" value="<?php echo $listinvoice['prodsize'];?>" class="form-control"/>
                          </div>
                          <div class="col-md-7">
                            <div class="mb-3">
                              <label class="form-label">Product Price</label>
                              <input type="text" name="product_price" value="<?php echo $listinvoice['product_price'];?>"  class="form-control"/>
                            </div>
                          </div>
                          <div class="col-lg-2 align-self-center d-grid">
                            <input data-repeater-delete type="button" class="btn btn-primary btn-block" value="Delete"/>
                          </div>
                        </div>
                        <?php }} else { ?>
                        <div data-repeater-item class="row">
                          <div  class="mb-3 col-lg-3">
                            <label class="form-label" for="name">Product Size</label>
                            <input type="text" id="prodsize" name="prodsize" class="form-control"/>
                          </div>
                          <div class="col-md-7">
                            <div class="mb-3">
                              <label class="form-label">Product Price</label>
                              <input type="text" name="product_price"  class="form-control"/>
                            </div>
                          </div>
                          <div class="col-lg-2 align-self-center d-grid">
                            <input data-repeater-delete type="button" class="btn btn-primary btn-block" value="Delete"/>
                          </div>
                        </div>
						  <?php } ?>
                      </div>
                      <input data-repeater-create type="button" id="addbutton" class="btn btn-dark mt-3 mt-lg-0" value="Add"/>
                    </div>
                    
                    <div class="row mb-4">
                      <div class="col text-end"> <a href="product-verient-manage.php" class="btn btn-danger"> <i class="fa fa-times me-1"></i> Cancel </a>
                        <input type='hidden' name='verient_id' id='verient_id' maxlength="50"   size="30" value="<?php echo $row_cms['verient_id']; ?>"/>
                        <button type="submit"  name="<?php echo $sub ?>" class="btn btn-success"><i class="fa fa-file-alt me-1"></i> <?php echo $sub2 ?></button>
                      </div>
                      <!-- end col --> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
        <!-- end row --> 
        
        <!-- end row-->
      </form>
    </div>
    <!-- container-fluid --> 
  </div>
  <!-- End Page-content -->
  
  <?php include('includes/footer.php'); ?>
</div>
<!-- end main content-->

</div>

<!-- JAVASCRIPT --> 

<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script> 
<script src="assets/libs/metismenu/metisMenu.min.js"></script> 
<script src="assets/libs/simplebar/simplebar.min.js"></script> 
<script src="assets/libs/node-waves/waves.min.js"></script> 
<script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script> 
<script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script> 

<!-- select 2 plugin --> 
<script src="assets/libs/select2/js/select2.min.js"></script> 

<!-- dropzone plugin --> 
<!-- init js --> 

<script src="assets/js/pages/ecommerce-add-product.init.js"></script> 
<script src="assets/libs/jquery.repeater/jquery.repeater.min.js"></script> 
<script src="assets/js/pages/form-repeater.int.js"></script> 
<script src="assets/js/app.js"></script>
	
	<script>
	$('.extra-fields-customer').click(function() {
  $('.customer_records').clone().appendTo('.customer_records_dynamic');
  $('.customer_records_dynamic .customer_records').addClass('single remove');
  $('.single .extra-fields-customer').remove();
  $('.single').append('<a href="#" class="remove-field btn-remove-customer">Remove Fields</a>');
  $('.customer_records_dynamic > .single').attr("class", "remove");

  $('.customer_records_dynamic input').each(function() {
    var count = 0;
    var fieldname = $(this).attr("name");
    $(this).attr('name', fieldname + count);
    count++;
  });

});

$(document).on('click', '.remove-field', function(e) {
  $(this).parent('.remove').remove();
  e.preventDefault();
});
	
	</script>

</body>
</html>
