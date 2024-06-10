<?php 
include('includes/configset.php');
if (isset($_REQUEST['cms'])){$id=$_REQUEST['cms'];}else{$id=0;}
$sql_cms="select * from invoice WHERE invoice_id=$id"; 
$result_cms=mysqli_query($link,$sql_cms); 
$row_cms=mysqli_fetch_array($result_cms);
$cmsID = $row_cms['invoice_id'];
?>
<?php if(isset($_REQUEST['cms'])) { 
$sub="update";
$sub2="Update";
 } 
 else { 
 $sub="add";
 $sub2="Save";
 } ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Add Invoice | EMR Marketing</title>
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
<script>
function showCity(sel) {
	var city_id = sel.options[sel.selectedIndex].value;  
	$("#output").html( "" );
	 if (city_id.length > 0 ) { 
 
	 $.ajax({
			type: "POST",
			url: "category-script.php",
			data: "city_id="+city_id,
			cache: false,
			beforeSend: function () { 
				$('#output').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {    
				$("#output").html( html );
			}
		});
	} 
}
</script>
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
              <h4 class="mb-0">Add Invoice</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                  <li class="breadcrumb-item active">Add Invoice</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- end page title -->
        
        <form action="invoice-manage.php" name="cont" class="dropzone" id="myform"  method="post" enctype="multipart/form-data">
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
                        <h5 class="font-size-16 mb-1">Invoice Info</h5>
                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                      </div>
                      <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                  </div>
                  </a>
                  <div id="addproduct-billinginfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
                    <div class="p-4 border-top">
                    <div class="row">
						<div class="col-md-3">
							<fieldset>Invoice Details<legend></legend>
							<div class="mb-3">
								<label class="form-label" for="productname">Invoice No <code>*</code></label>
								<input id="invoice_no" name="invoice_no" type="text" class="form-control" value="<?php echo $row_cms['invoice_no'];?>" required>
						   </div>
							<div class="mb-3">
								<label class="form-label" for="productname">date <code>*</code></label>
								<input id="date" name="date" type="date" class="form-control" value="<?php echo $row_cms['date'];?>" required>
						   </div>
							
							<div class="mb-3">
								<label class="form-label" for="productname">Place Supply <code>*</code></label>
								<input id="place_supply" name="place_supply" type="text" class="form-control" value="<?php echo $row_cms['place_supply'];?>">
						   </div>
							<div class="mb-3">
								<label>Reverse Charge <code>*</code></label>
								<input id="reverse_charge" name="reverse_charge" type="text" class="form-control" value="<?php echo $row_cms['reverse_charge'];?>" >
						   </div>
							<div class="mb-3">
								<label>Transport <code>*</code></label>
								<input id="transport" name="transport" type="text" class="form-control" value="<?php echo $row_cms['transport'];?>">
						   </div>
							<div class="mb-3">
								<label>Vehicle No <code>*</code></label>
								<input id="transport" name="vehicle_no" type="text" class="form-control" value="<?php echo $row_cms['vehicle_no'];?>">
						   </div>
								</fieldset>
						</div>
						
						
						<div class="col-md-3">
							<fieldset>Bill Details<legend></legend>
							<div class="mb-3">
								<label>Station <code>*</code></label>
								<input id="station" name="station" type="text" class="form-control" value="<?php echo $row_cms['station'];?>">
						   </div>
							<div class="mb-3">
								<label>E way bill no <code>*</code></label>
								<input id="text" name="e_way_bill_no" type="text" class="form-control" value="<?php echo $row_cms['e_way_bill_no'];?>">
						   </div>
							
							<div class="mb-3">
								<label>Order by <code>*</code></label>
								<input id="order_by" name="order_by" type="text" class="form-control" value="<?php echo $row_cms['order_by'];?>">
						   </div>
							<div class="mb-3">
								<label>Brand name <code>*</code></label>
								<input id="brand_name" name="brand_name" type="text" class="form-control" value="<?php echo $row_cms['brand_name'];?>" >
						   </div>
							<div class="mb-3">
								<label>payment_terms <code>*</code></label>
								<input id="payment_terms" name="payment_terms" type="text" class="form-control" value="<?php echo $row_cms['payment_terms'];?>">
						   </div>
								<div class="mb-3">
								<label>UTR No <code>*</code></label>
								<input id="utr_num" name="utr_num" type="text" class="form-control" value="<?php echo $row_cms['utr_num'];?>">
						   </div>
							</fieldset>
						</div>
						
						<div class="col-md-3">
							<fieldset>Bill To<legend></legend>
							<div class="mb-3">
								<label>Biller Name <code>*</code></label>
								<input id="biller_name" name="biller_name" type="text" class="form-control" value="<?php echo $row_cms['biller_name'];?>">
						   </div>
							<div class="mb-3">
								<label>address <code>*</code></label>
								<textarea name="address" class="form-control"><?php echo $row_cms['address'];?></textarea>
						   </div>
							
							<div class="mb-3">
								<label>Party Mobile No <code>*</code></label>
								<input id="party_mobile_no" name="party_mobile_no" type="text" class="form-control" value="<?php echo $row_cms['party_mobile_no'];?>">
						   </div>
							<div class="mb-3">
								<label>GSSTN Unit <code>*</code></label>
								<input id="gstn_unit" name="gstn_unit" type="text" class="form-control" value="<?php echo $row_cms['gstn_unit'];?>" >
						   </div>
							
							</fieldset>
						</div>
						
						<div class="col-md-3">
							<fieldset>Shipped To<legend></legend>
							<div class="mb-3">
								<label>name <code>*</code></label>
								<input id="name" name="name" type="text" class="form-control" value="<?php echo $row_cms['name'];?>">
						   </div>
							<div class="mb-3">
								<label>address <code>*</code></label>
								<textarea name="shipp_address" class="form-control"><?php echo $row_cms['shipp_address'];?></textarea>
						   </div>
							
							
							
							</fieldset>
						</div>
						
						
						
						</div>
                      
						
						
						
                    
                      <div class="row">
                     

						  <div class="verient-class">
                        <h5>Add Verient</h5>
                        <div class="repeater" id="repgert">
                          <div data-repeater-list="group_a">
                         
                          <?php if(isset($_REQUEST['cms'])){ 
					$invoicedel="select * from invoice_item WHERE invoice_id='$cmsID'";
$myinvoicedel = mysqli_query($link,$invoicedel);
while($listinvoice = mysqli_fetch_array($myinvoicedel)){
				?>
							  
				<div data-repeater-item class="row">
                              <div  class="mb-3 col-lg-2">
                                <label class="form-label" for="name">Description of Goods</label>
                                <input type="text" name="vname" class="form-control" value="<?php echo $listinvoice['vname'];?>"/>
                              </div>
                              <div class="col-lg-1">
                                <div class="mb-3">
                                  <label class="form-label">HSN/SAC Code</label>
                                  <input type="text" name="hsn_sac_code"  class="form-control" value="<?php echo $listinvoice['hsn_sac_code'];?>"/>
                                </div>
                              </div>
								<div class="col-lg-1">
                                <div class="mb-3">
                                  <label class="form-label">qty</label>
                                  <input type="text" name="qty"  class="form-control" value="<?php echo $listinvoice['qty'];?>"/>
                                </div>
                              </div>
								<div class="col-lg-1">
                                <div class="mb-3">
                                  <label class="form-label">unit</label>
                                  <input type="text" name="unit"  class="form-control" value="<?php echo $listinvoice['unit'];?>"/>
                                </div>
                              </div>
								<div class="col-lg-2">
                                <div class="mb-3">
                                  <label class="form-label">MRP</label>
                                  <input type="text" name="mrp"  class="form-control" value="<?php echo $listinvoice['mrp'];?>"/>
                                </div>
                              </div>
								<div class="col-lg-2">
                                <div class="mb-3">
                                  <label class="form-label">Price</label>
                                  <input type="text" name="price"  class="form-control" value="<?php echo $listinvoice['price'];?>"/>
                                </div>
                              </div>
								<div class="col-lg-1">
                                <div class="mb-3">
                                  <label class="form-label">GST (like 5%)</label>
                                  <input type="text" name="gst"  class="form-control" value="<?php echo $listinvoice['gst'];?>"/>
                                </div>
                              </div>
					<input type="hidden" name="item_id" value="<?php echo $listinvoice['item_id'];?>">
                              <div class="col-lg-2 align-self-center d-grid">
                               
								  <a href="dele_item_invoice.php?del=<?php echo $listinvoice['item_id'];?>" class="btn btn-primary btn-block">Delete</a>
                              </div>
                              </div>			  
							  
                
                <?php }} else { ?>
                            <div data-repeater-item class="row">
                              <div  class="mb-3 col-lg-2">
                                <label class="form-label" for="name">Description of Goods</label>
                                <input type="text" id="name" name="vname" class="form-control"/>
                              </div>
                              <div class="col-lg-1">
                                <div class="mb-3">
                                  <label class="form-label">HSN/SAC Code</label>
                                  <input type="text" name="hsn_sac_code"  class="form-control"/>
                                </div>
                              </div>
								<div class="col-lg-1">
                                <div class="mb-3">
                                  <label class="form-label">qty</label>
                                  <input type="text" name="qty"  class="form-control"/>
                                </div>
                              </div>
								<div class="col-lg-1">
                                <div class="mb-3">
                                  <label class="form-label">unit</label>
                                  <input type="text" name="unit"  class="form-control"/>
                                </div>
                              </div>
								<div class="col-lg-2">
                                <div class="mb-3">
                                  <label class="form-label">MRP</label>
                                  <input type="text" name="mrp"  class="form-control"/>
                                </div>
                              </div>
								<div class="col-lg-2">
                                <div class="mb-3">
                                  <label class="form-label">Price</label>
                                  <input type="text" name="price"  class="form-control"/>
                                </div>
                              </div>
								<div class="col-lg-1">
                                <div class="mb-3">
                                  <label class="form-label">GST (like 5%)</label>
                                  <input type="text" name="gst"  class="form-control"/>
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
                      </div>
 
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label" for="price">Additional</label>
                            <textarea name="additional" id="classic-editor2" rows="4" class="form-control"><?php echo $row_cms['additional'];?></textarea>
                          </div>
                        </div>
						  
                        
						  
						  
                      </div>
						
						
						
                      
                      
                    </div>
                  </div>
                </div>
                
                
              </div>
            </div>
          </div>
          <!-- end row -->
          
          <div class="row mb-4">
            <div class="col text-end"> <a href="product-manage.php" class="btn btn-danger"> <i class="fa fa-times me-1"></i> Cancel </a>
              <input type='hidden' name='invoice_id' id='invoice_id' maxlength="50"   size="30" value="<?php echo $row_cms['invoice_id']; ?>"/>
              <button type="submit"  name="<?php echo $sub ?>" class="btn btn-success"><i class="fa fa-file-alt me-1"></i> <?php echo $sub2 ?></button>
            </div>
            <!-- end col --> 
          </div>
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
<script src="assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script> 
<!-- init js --> 

<script src="assets/js/pages/ecommerce-add-product.init.js"></script> 
<script src="assets/libs/jquery.repeater/jquery.repeater.min.js"></script> 
<script src="assets/js/pages/form-repeater.int.js"></script> 
<script src="assets/js/app.js"></script> 

 
<script>
        ClassicEditor
        .create( document.querySelector( '#classic-editor' ) )
        .catch( error => {
            console.error( error );
        } );
	ClassicEditor
        .create( document.querySelector( '#classic-editor2' ) )
        .catch( error => {
            console.error( error );
        } );
	
	ClassicEditor
        .create( document.querySelector( '#classic-editor3' ) )
        .catch( error => {
            console.error( error );
        } );
        </script> 

</body>
</html>
