<?php 
include('includes/configset.php');
if (isset($_REQUEST['cms'])){$id=$_REQUEST['cms'];}else{$id=0;}
$sql_cms="select * from membership WHERE member_id=$id"; 
$result_cms=mysqli_query($link,$sql_cms); 
$row_cms=mysqli_fetch_array($result_cms);
$cmsID = $row_cms['member_id'];
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
<title>Add Membership | EMR Marketing</title>
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
	$("#cityoutput").html( "" );
	 if (city_id.length > 0 ) { 
 
	 $.ajax({
			type: "POST",
			url: "categoryscript2.php",
			data: "city_id="+city_id,
			cache: false,
			beforeSend: function () { 
				$('#cityoutput').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {    
				$("#cityoutput").html( html );
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
              <h4 class="mb-0">Add Slider</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                  <li class="breadcrumb-item active">Add Slider</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- end page title -->
        
        <form action="userid-manage.php" name="cont" class="dropzone" id="myform"  method="post" enctype="multipart/form-data">
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
                        <h5 class="font-size-16 mb-1">Slider Info</h5>
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
                            <label class="form-label" for="manufacturerbrand">Choos Sponser</label>
                            <select class="form-control select2" name="spnoser_id">
                              <option>Select UserID</option>
                              <?php
 $ResultSQL=mysqli_query($link,"select * from membership order by member_id DESC"); 
 while($Listbrand=mysqli_fetch_array($ResultSQL)) { 
?>
                              <option <?php if($Listbrand['member_id']==$row_cms['spnoser_id']){?>selected<?php } ?> value="<?php echo $Listbrand['member_id'];?>"><?php echo $Listbrand['userid'];?></option>
							<?php } ?>	
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label" for="price">First Name</label>
                            <input id="sortorder" name="fname" type="text" class="form-control" value="<?php echo $row_cms['fname'];?>">
                          </div>
                        </div>
						  <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label" for="price">Last Name</label>
                            <input id="sortorder" name="lname" type="text" class="form-control" value="<?php echo $row_cms['lname'];?>">
                          </div>
                        </div>
						  <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label" for="price">phone</label>
                            <input id="sortorder" name="phone" type="text" class="form-control" value="<?php echo $row_cms['phone'];?>">
                          </div>
                        </div>
						  <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label" for="price">email</label>
                            <input id="sortorder" name="email" type="text" class="form-control" value="<?php echo $row_cms['email'];?>">
                          </div>
                        </div>
						  <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label" for="price">stree_address</label>
                            <input id="sortorder" name="stree_address" type="text" class="form-control" value="<?php echo $row_cms['stree_address'];?>">
                          </div>
                        </div>
						  <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label" for="price">state</label>
							  <select name="state" class="form-control select2" required onChange="showCity(this);">
					  <option>--Select State -- </option>
					  <?php
$stateSql = mysqli_query( $link, "select * from states order by name ASC" );
while($stateSqli = mysqli_fetch_array( $stateSql )){
	if($row_cms['state']==$stateSqli['id']){
		$selected = "selected";
	}
	else{
		$selected = "";
	}
	echo "<option value='".$stateSqli['id']."' ".$selected." >".$stateSqli['name']."</option>";
}
?>
					</select>
                            
                          </div>
                        </div>
						  <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label" for="price">city</label>
							   <select class="form-control select2" name="city" id="cityoutput" required>
											<?php
$stateSqlt = mysqli_query( $link, "select * from cities WHERE state_id='".$row_cms['state']."' order by city ASC" );
while($stateSqlit = mysqli_fetch_array( $stateSqlt )){
	if($row_cms['city']==$stateSqlit['id']){
		$selected = "selected";
	}
	else{
		$selected = "";
	}
	echo "<option value='".$stateSqlit['id']."' ".$selected." >".$stateSqlit['city']."</option>";
}
?>
					</select>
                            
                          </div>
                        </div>
						  
						   <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label" for="price">postalcode</label>
                            <input id="sortorder" name="postalcode" type="text" class="form-control" value="<?php echo $row_cms['postalcode'];?>">
                          </div>
                        </div>
						  <?php if(!$row_cms['password']){?>
						  <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label" for="price">Password</label>
                            <input id="sortorder" name="password" type="password" class="form-control" value="<?php echo md5($row_cms['password']);?>">
                          </div>
                        </div>
						  <?php } ?>
						  
						  <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label" for="price">Position</label><br>
							 
                            Left <input type="radio" name="binary_root" value="Left"  <?php if($row_cms['binary_root']=='Left'){?>checked<?php } ?> >
							 &nbsp;&nbsp;&nbsp; Right <input type="radio" name="binary_root" value="Right" <?php if($row_cms['binary_root']=='Right'){?>checked<?php } ?>>
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
            <div class="col text-end"> <a href="slider-manage.php" class="btn btn-danger"> <i class="fa fa-times me-1"></i> Cancel </a>
              <input type='hidden' name='id' id='id' maxlength="50"   size="30" value="<?php echo $row_cms['member_id']; ?>"/>
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
<script src="assets/js/tagger.js"></script> 
<script>
  var t1 = tagger(document.querySelector('[class="vlist form-control"]'), {
      allow_duplicates: false,
      allow_spaces: true,
      add_on_blur: true,
      tag_limit: 4,
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
