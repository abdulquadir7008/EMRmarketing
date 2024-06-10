<?php
include( 'includes/configset.php' );
if ( isset( $_REQUEST[ 'cms' ] ) ) {
  $id = $_REQUEST[ 'cms' ];
} else {
  $id = 0;
}
$sql_cms = "select * from products WHERE id=$id";
$result_cms = mysqli_query( $link, $sql_cms );
$row_cms = mysqli_fetch_array( $result_cms );
$cmsID = $row_cms[ 'id' ];
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
<title>Add Product | EMR Marketing</title>
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
              <h4 class="mb-0">Add Product</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                  <li class="breadcrumb-item active">Add Product</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- end page title -->
        
        <form action="product-manage.php" name="cont" class="dropzone" id="myform"  method="post" enctype="multipart/form-data">
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
                        <h5 class="font-size-16 mb-1">Product Info</h5>
                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                      </div>
                      <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                  </div>
                  </a>
                  <div id="addproduct-billinginfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
                    <div class="p-4 border-top">
                      <div class="row">
                        <div class="col-lg-5">
                          <div class="mt-4 mt-lg-0">
                            <h5 class="font-size-14 mb-3">Top Collection</h5>
                            <div class="d-flex">
                              <div class="square-switch">
                                <input type="checkbox" id="square-switch1" name="topcollection" switch="danger" value="on" <?php if($row_cms['topcollection']=='on'){?>checked<?php } ?>/>
                                <label for="square-switch1" data-on-label="On"
                                                                    data-off-label="Off"></label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-5">
                          <h5 class="font-size-14 mb-3">Special Product</h5>
                          <div>
                            <input type="checkbox" id="switch6" name="new" switch="none" value="on" <?php if($row_cms['new']=='on'){?>checked<?php } ?>/>
                            <label for="switch6" data-on-label="New"
                                                            data-off-label="Off"></label>
                            <input type="checkbox" id="switch4" name="feature" switch="success" value="on" <?php if($row_cms['feature']=='on'){?>checked<?php } ?>/>
                            <label for="switch4" data-on-label="Feature"
                                                            data-off-label="Off"></label>
                            <input type="checkbox" id="switch8" name="best" switch="info" value="on" <?php if($row_cms['best']=='on'){?>checked<?php } ?>/>
                            <label for="switch8" data-on-label="Sale"
                                                            data-off-label="Off"></label>
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="productname">Product Name <code>*</code></label>
                        <input id="productname" name="title" type="text" class="form-control" value="<?php echo $row_cms['title'];?>" required>
                      </div>
                      <?php if($row_cms['seo_keywords']){?>
                      <div class="mb-3">
                        <label class="form-label" for="productname">Product Keyword <code>*</code></label>
                        <input id="productname" name="seo_keywords" type="text" class="form-control" value="<?php echo $row_cms['seo_keywords'];?>" required>
                      </div>
                      <?php } ?>
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="mb-3">
                            <label class="form-label" for="manufacturername">Brand <code>*</code></label>
                            <select class="form-control select2" name="brand_id" required>
                              <option>Select</option>
                              <?php
                              $SQLbrand = "select * from brand WHERE status='1'";
                              $Resbrand = mysqli_query( $link, $SQLbrand );
                              while ( $Listbrand = mysqli_fetch_array( $Resbrand ) ) {
                                ?>
                              <option value="<?php echo $Listbrand['id'];?>" <?php if($Listbrand['id'] == $row_cms['brand_id']){?>selected<?php } ?>><?php echo $Listbrand['brandname'];?></option>
                              <?php }?>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="mb-3">
                            <label class="form-label" for="manufacturerbrand">Main Category <code>*</code></label>
                            <select class="form-control select2" name="maincat" onChange="showCity(this);" required>
                              <option>Select</option>
                              <option value="women" <?php if($row_cms['maincat']=='women'){?>selected<?php } ?>>Women</option>
                              <option value="men" <?php if($row_cms['maincat']=='men'){?>selected<?php } ?>>men</option>
                              <option value="kids" <?php if($row_cms['maincat']=='kids'){?>selected<?php } ?>>Kid</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="mb-3">
                            <label class="form-label" for="manufacturerbrand">Category <code>*</code></label>
                            <select class="form-control select2" name="category_id[]" id="output" multiple="multiple" required>
                              <option>Select</option>
                              <?php
                              $SQLCat = "select * from category WHERE status='1'";
                              $ResCat = mysqli_query( $link, $SQLCat );
                              while ( $ListCat = mysqli_fetch_array( $ResCat ) ) {
                                $gretvalue = '';
                                $selct = $ListCat[ 'id' ];
                                $datsub = $row_cms[ 'category_id' ];
                                $splittedstring = explode( ",", $datsub );

                                foreach ( $splittedstring as $value ) {

                                  if ( $selct == $value ) {
                                    $gretvalue = $value;
                                  }
                                }

                                ?>
                              <option value="<?php echo $ListCat['id'];?>" <?php if($selct==$gretvalue){echo "selected";} ?>><?php echo $ListCat['title'];?></option>
                              <?php }?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label class="form-label" for="price">Regular Price <code>*</code></label>
                            <input id="price" name="price" type="text" class="form-control" value="<?php echo $row_cms['price'];?>" required>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label class="form-label" for="price">Special Price</label>
                            <input id="sprice" name="sprice" type="text" class="form-control" value="<?php echo $row_cms['sprice'];?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="mb-3">
                            <label class="form-label" for="price">InStock <code>*</code></label>
                            <input id="inventory" name="inventory" type="text" class="form-control" value="<?php echo $row_cms['inventory'];?>" required>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="mb-3">
                            <label class="form-label" for="price">Product SKU</label>
                            <input id="product_SKU" name="product_SKU" type="text" class="form-control" value="<?php echo $row_cms['product_SKU'];?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="mb-3">
                            <label class="form-label" for="price">Sort-Order</label>
                            <input id="sortorder" name="sortorder" type="text" class="form-control" value="<?php echo $row_cms['sortorder'];?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="mb-3">
                            <label class="form-label" for="price">Meterial</label>
                            <input id="meterial" name="meterial" type="text" class="form-control" value="<?php echo $row_cms['meterial'];?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="mb-3">
                            <label class="form-label" for="price">Product Size</label>
                            <input id="product_size" name="product_size" type="text" class="form-control" value="<?php echo $row_cms['product_size'];?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="mb-3">
                            <label class="form-label" for="price">Weight <code>*</code></label>
                            <input id="weight" name="weight" type="text" class="form-control" value="<?php echo $row_cms['weight'];?>" require>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="mb-3">
                            <label class="form-label" for="price">Length</label>
                            <input id="length" name="length" type="text" class="form-control" value="<?php echo $row_cms['length'];?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="mb-3">
                            <label class="form-label" for="price">Width</label>
                            <input id="width" name="width" type="text" class="form-control" value="<?php echo $row_cms['width'];?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="mb-3">
                            <label class="form-label" for="price">Height</label>
                            <input id="height" name="height" type="text" class="form-control" value="<?php echo $row_cms['height'];?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="mb-3">
                            <label class="form-label" for="price">CubicWeight</label>
                            <input id="cubicweight" name="cubicweight" type="text" class="form-control" value="<?php echo $row_cms['cubicweight'];?>">
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label class="form-label" for="manufacturerbrand">Choose Product Color <code>*</code></label>
                            <select class="form-control select2" name="colour" required>
                              <option value="">Select</option>
                              <option value="#0074d9" <?php if($row_cms['colour']=='#0074d9'){?>selected<?php }?> >Blue </option>
                              <option value="#3c4477"<?php if($row_cms['colour']=='#3c4477'){?>selected<?php }?>>Navy Blue</option>
                              <option value="#ffffff" <?php if($row_cms['colour']=='#ffffff'){?>selected<?php }?>>white </option>
                              <option value="#000000" <?php if($row_cms['colour']=='#000000'){?>selected<?php }?>>Black </option>
                              <option value="#d34b56" <?php if($row_cms['colour']=='#d34b56'){?>selected<?php }?>>Red </option>
                              <option value="#eadc32" <?php if($row_cms['colour']=='#eadc32'){?>selected<?php }?>>Yellow </option>
                              <option value="#5eb160" <?php if($row_cms['colour']=='#5eb160'){?>selected<?php }?>>Green </option>
                              <option value="#f1a9c4" <?php if($row_cms['colour']=='#f1a9c4'){?>selected<?php }?>>Pink </option>
                              <option value="#9fa8ab" <?php if($row_cms['colour']=='#9fa8ab'){?>selected<?php }?>>Grey </option>
                              <option value="#f28d20" <?php if($row_cms['colour']=='#f28d20'){?>selected<?php }?>>Orange</option>
                              <option value="#915039" <?php if($row_cms['colour']=='#915039'){?>selected<?php }?>>Brown</option>
                              <option value="#800080" <?php if($row_cms['colour']=='#800080'){?>selected<?php }?>>Purple</option>
                              <option value="#ede6b9" <?php if($row_cms['colour']=='#ede6b9'){?>selected<?php }?>>Cream</option>
                              <option value="#d2ae1a" <?php if($row_cms['colour']=='#d2ae1a'){?>selected<?php }?>>Gold</option>
                            </select>
                          </div>
                        </div>
                        <div class="verient-class">
                          <h5>Add Verient</h5>
                          <div class="repeater" id="repgert">
                            <div data-repeater-list="group_a">
                              <?php
                              if ( isset( $_REQUEST[ 'cms' ] ) ) {
                                $invoicedel = "select * from product_varient WHERE v_id='$cmsID'";
                                $myinvoicedel = mysqli_query( $link, $invoicedel );
                                while ( $listinvoice = mysqli_fetch_array( $myinvoicedel ) ) {
                                  ?>
                              <div class="row">
                                <div  class="mb-3 col-lg-3">
                                  <input type="hidden" name="ider[]" value="<?php echo $listinvoice['id'];?>">
                                  <label class="form-label" for="name">Varient Name</label>
                                  <input type="text" id="name" name="vname[]" class="form-control" value="<?php echo $listinvoice['vname'];?>"/>
                                </div>
                                <div class="col-md-7">
                                  <div class="mb-3">
                                    <label class="form-label">List</label>
                                    <input type="text" name="vlist[]"  class="form-control" value="<?php echo $listinvoice['vlist'];?>" />
                                  </div>
                                </div>
                                <div class="col-lg-2 align-self-center d-grid">
                                  <input data-repeater-delete type="button" class="btn btn-primary btn-block" value="Delete"/>
                                </div>
                              </div>
                              <?php }} ?>
                              <div data-repeater-item class="row">
                                <div  class="mb-3 col-lg-3">
                                  <label class="form-label" for="name">Varient Name</label>
                                  <input type="text" id="name" name="vname" class="form-control"/>
                                </div>
                                <div class="col-md-7">
                                  <div class="mb-3">
                                    <label class="form-label">List</label>
                                    <input type="text" name="vlist"  class="form-control"/>
                                  </div>
                                </div>
                                <div class="col-lg-2 align-self-center d-grid">
                                  <input data-repeater-delete type="button" class="btn btn-primary btn-block" value="Delete"/>
                                </div>
                              </div>
                            </div>
                            <input data-repeater-create type="button" id="addbutton" class="btn btn-dark mt-3 mt-lg-0" value="Add"/>
                          </div>
                        </div>
                        <div class="row mb-4">
                          <label class="form-label" for="manufacturerbrand">Leather <span>(If leather is match to color)</span></label>
                          <input type="text" id="tag-input1" class="form-control" name="leather" value="<?php echo $row_cms['leather']; ?>">
                          <?php
                          $k = 1;
                          $splittedstring = explode( ",", $row_cms[ 'leather' ] );
                          foreach ( $splittedstring as $value ) {
                            if ( $k == 1 ) {
                              $jack = "";
                            } else {
                              $jack = ",";
                            }
                            $rcrat .= $jack . "'" . $value . "'";

                            $k++;
                          }

                          ?>
                        </div>
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label" for="price">Short Description</label>
                            <textarea name="addnote" rows="2" id="classic-editor3" class="form-control"><?php echo $row_cms['addnote'];?></textarea>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label" for="price">Additional</label>
                            <textarea name="additional" id="classic-editor2" rows="4" class="form-control"><?php echo $row_cms['additional'];?></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="mb-3">
                              <label class="form-label" for="price">Color</label>
                              <input id="color" name="color" type="color" class="form-control form-control-color" value="<?php echo $row_cms['color'];?>">
                            </div>
                          </div>
                          <div class="mb-5 col-lg-3">
                            <label for="example-color-input" class="col-md-12 col-form-label">Product Color Pattern</label>
                            <input type="file" name="pattern">
                            <input type="hidden" name="hiddenpattern" id="image2" value="<?php echo $row_cms['pattern']; ?>" />
                            <?php if($row_cms['pattern']!='') { image_size(); ?>
                            <img src="<?php echo "../".$product_paath.$row_cms['pattern'];?>" width="<?php echo $width; ?>100" height="<?php echo $height; ?>" class="alignLeft" />
                            <?php } ?>
                          </div>
                        </div>
                        <div class="box-fileupload col-md-3">
                          <input type="file" id="fileId" class="file-upload-input" name="image2">
                          <label for="fileId" class="file-upload-btn fa fa-cloud-upload-alt"></label>
                          <input type="hidden" name="hiddenimage2" id="image2" value="<?php echo $row_cms['image2']; ?>" />
                          <p class="box-fileupload__lable">Product Thumbnail</p>
                          <?php if($row_cms['image2']!='') { image_size(); ?>
                          <img src="<?php echo "../".$product_paath.$row_cms['image2'];?>" width="<?php echo $width; ?>100" height="<?php echo $height; ?>" class="alignLeft" />
                          <?php } ?>
                        </div>
                        <div class="col-md-12">
                          <p class="box-fileupload__lable">Thumbnail Hover</p>
                          <input type="file" name="image3">
                          <input type="hidden" name="hiddenimage3" id="image3" value="<?php echo $row_cms['image3']; ?>" />
                          <?php if($row_cms['image3']!='') { image_size(); ?>
                          <img src="<?php echo "../".$product_paath.$row_cms['image3'];?>" width="<?php echo $width; ?>100" height="<?php echo $height; ?>" class="alignLeft" />
                          <?php } ?>
                        </div>
                      </div>
                      <div class="card"> <a href="#addproduct-img-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false" aria-haspopup="true" aria-controls="addproduct-img-collapse">
                        <div class="p-4">
                          <div class="d-flex align-items-center">
                            <div class="flex-1 overflow-hidden">
                              <h5 class="font-size-16 mb-1">Upload Product Gallery Images</h5>
                              <p class="text-muted text-truncate mb-0">Fill all information below</p>
                            </div>
                          </div>
                        </div>
                        </a>
                        <div>
                          <div class="p-4 border-top">
                            <div class="box-fileupload2">
                              <input class="show-for-sr file-upload-input2" type="file" id="upload_imgs" name="image[]" value="<?php echo $row_cms['image']; ?>" multiple/>
                              <input type="hidden" name="hiddenimage" value="<?php echo $row_cms['image']; ?>" />
                              <label for="fileId" class="file-upload-btn2"></label>
                              <p class="box-fileupload__lable"></p>
                            </div>
                            <p> </p>
                            <div class="quote-imgs-thumbs <?php if(empty($row_cms['image'])){?>quote-imgs-thumbs--hidden<?php } ?>" id="img_preview" aria-live="polite">
                              <?php
                              if ( $row_cms[ 'image' ] ) {
                                $datacard = $row_cms[ 'image' ];
                                $splittedstring = explode( ",", $datacard );
                                foreach ( $splittedstring as $value ) {
                                  $value;
                                  ?>
                              <img src="<?php echo "../".$product_paath.$value;?>" class="img-preview-thumb" style="width:80px">
                              <?php }}?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="mb-0">
                        <label class="form-label" for="productdesc">Product Description</label>
                        <textarea class="form-control" name="description" id="classic-editor" rows="4"><?php echo $row_cms['description'];?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card"> <a href="#addproduct-metadata-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false" aria-haspopup="true" aria-controls="addproduct-metadata-collapse">
                  <div class="p-4">
                    <div class="d-flex align-items-center">
                      <div class="me-3">
                        <div class="avatar-xs">
                          <div class="avatar-title rounded-circle bg-soft-primary text-primary"> 02 </div>
                        </div>
                      </div>
                      <div class="flex-1 overflow-hidden">
                        <h5 class="font-size-16 mb-1">Meta Data</h5>
                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                      </div>
                      <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                  </div>
                  </a>
                  <div id="addproduct-metadata-collapse" class="collapse" data-bs-parent="#addproduct-accordion">
                    <div class="p-4 border-top">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label" for="metatitle">Meta title</label>
                            <input id="meta_title" name="meta_title" type="text" class="form-control" value="<?php echo $row_cms['meta_title'];?>">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label" for="metakeywords">Meta Keywords</label>
                            <input id="meta_keywords" name="meta_keywords" type="text" class="form-control" value="<?php echo $row_cms['meta_keywords'];?>">
                          </div>
                        </div>
                      </div>
                      <div class="mb-0">
                        <label class="form-label" for="metadescription">Meta Description</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="4"><?php echo $row_cms['meta_description'];?></textarea>
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
              <input type='hidden' name='id' id='id' maxlength="50"   size="30" value="<?php echo $row_cms['id']; ?>"/>
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
	(function(){

    "use strict"

    
    // Plugin Constructor
    var TagsInput = function(opts){
        this.options = Object.assign(TagsInput.defaults , opts);
        this.init();
    }

    // Initialize the plugin
    TagsInput.prototype.init = function(opts){
        this.options = opts ? Object.assign(this.options, opts) : this.options;

        if(this.initialized)
            this.destroy();
            
        if(!(this.orignal_input = document.getElementById(this.options.selector)) ){
            console.error("tags-input couldn't find an element with the specified ID");
            return this;
        }

        this.arr = [];
        this.wrapper = document.createElement('div');
        this.input = document.createElement('input');
        init(this);
        initEvents(this);

        this.initialized =  true;
        return this;
    }

    // Add Tags
    TagsInput.prototype.addTag = function(string){

        if(this.anyErrors(string))
            return ;

        this.arr.push(string);
        var tagInput = this;

        var tag = document.createElement('span');
        tag.className = this.options.tagClass;
        tag.innerText = string;

        var closeIcon = document.createElement('a');
        closeIcon.innerHTML = '&times;';
        
        // delete the tag when icon is clicked
        closeIcon.addEventListener('click' , function(e){
            e.preventDefault();
            var tag = this.parentNode;

            for(var i =0 ;i < tagInput.wrapper.childNodes.length ; i++){
                if(tagInput.wrapper.childNodes[i] == tag)
                    tagInput.deleteTag(tag , i);
            }
        })


        tag.appendChild(closeIcon);
        this.wrapper.insertBefore(tag , this.input);
        this.orignal_input.value = this.arr.join(',');

        return this;
    }

    // Delete Tags
    TagsInput.prototype.deleteTag = function(tag , i){
        tag.remove();
        this.arr.splice( i , 1);
        this.orignal_input.value =  this.arr.join(',');
        return this;
    }

    // Make sure input string have no error with the plugin
    TagsInput.prototype.anyErrors = function(string){
        if( this.options.max != null && this.arr.length >= this.options.max ){
            console.log('max tags limit reached');
            return true;
        }
        
        if(!this.options.duplicate && this.arr.indexOf(string) != -1 ){
            console.log('duplicate found " '+string+' " ')
            return true;
        }

        return false;
    }

    // Add tags programmatically 
    TagsInput.prototype.addData = function(array){
        var plugin = this;
        
        array.forEach(function(string){
            plugin.addTag(string);
        })
        return this;
    }

    // Get the Input String
    TagsInput.prototype.getInputString = function(){
        return this.arr.join(',');
    }


    // destroy the plugin
    TagsInput.prototype.destroy = function(){
        this.orignal_input.removeAttribute('hidden');

        delete this.orignal_input;
        var self = this;
        
        Object.keys(this).forEach(function(key){
            if(self[key] instanceof HTMLElement)
                self[key].remove();
            
            if(key != 'options')
                delete self[key];
        });

        this.initialized = false;
    }

    // Private function to initialize the tag input plugin
    function init(tags){
        tags.wrapper.append(tags.input);
        tags.wrapper.classList.add(tags.options.wrapperClass);
        tags.orignal_input.setAttribute('hidden' , 'true');
        tags.orignal_input.parentNode.insertBefore(tags.wrapper , tags.orignal_input);
    }

    // initialize the Events
    function initEvents(tags){
        tags.wrapper.addEventListener('click' ,function(){
            tags.input.focus();           
        });
        

        tags.input.addEventListener('keydown' , function(e){
            var str = tags.input.value.trim(); 

            if( !!(~[9 , 13 , 188].indexOf( e.keyCode ))  )
            {
                e.preventDefault();
                tags.input.value = "";
                if(str != "")
                    tags.addTag(str);
            }

        });
    }


    // Set All the Default Values
    TagsInput.defaults = {
        selector : '',
        wrapperClass : 'tags-input-wrapper',
        tagClass : 'tag',
        max : null,
        duplicate: false
    }

    window.TagsInput = TagsInput;

})();

 var tagInput1 = new TagsInput({
            selector: 'tag-input1',
            duplicate : false,
            max : 10
        });
	<?php if( $row_cms['leather']){?>
        tagInput1.addData([<?php echo $rcrat;?>])
	<?php } ?>
  var t1 = tagger(document.querySelector('[class="vlist form-control"]'), {
      allow_duplicates: false,
      allow_spaces: true,
      add_on_blur: true,
      tag_limit: 10,
      completion: {list: ['foo', 'bar', 'baz']}
  });
  var t2 = tagger(document.querySelector('[name="tags2"]'), {
      allow_duplicates: false,
      allow_spaces: true,
      completion: {
          list: function() {
              return Promise.resolve(['foo', 'bar', 'baz', 'foo-baz']);
          }
      },
      link: function() { return false; }
  });
  var t3 = tagger(document.querySelectorAll('[name^="tags3"]'), {
      allow_duplicates: false,
      allow_spaces: true,
      link: function(name) {
          return `javascript:alert('${name}');`;
      }
  });
  
</script> 
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
<script>
var imgUpload = document.getElementById('upload_imgs')
  , imgPreview = document.getElementById('img_preview')
  , imgUploadForm = document.getElementById('img-upload-form')
  , totalFiles
  , previewTitle
  , previewTitleText
  , img;

imgUpload.addEventListener('change', previewImgs, false);
imgUploadForm.addEventListener('submit', function (e) {
  e.preventDefault();
  alert('Images Uploaded! (not really, but it would if this was on your website)');
}, false);

function previewImgs(event) {
  totalFiles = imgUpload.files.length;
  
  if(!!totalFiles) {
    imgPreview.classList.remove('quote-imgs-thumbs--hidden');
    previewTitle = document.createElement('p');
    previewTitle.style.fontWeight = 'bold';
    previewTitleText = document.createTextNode(totalFiles + ' Total Images Selected');
    previewTitle.appendChild(previewTitleText);
    imgPreview.appendChild(previewTitle);
  }
  
  for(var i = 0; i < totalFiles; i++) {
    img = document.createElement('img');
    img.src = URL.createObjectURL(event.target.files[i]);
    img.classList.add('img-preview-thumb');
    imgPreview.appendChild(img);
  }
}



</script>
</body>
</html>
