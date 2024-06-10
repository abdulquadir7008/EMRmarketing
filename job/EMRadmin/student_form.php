<?php
session_start();
include( '../config.php' );
include( 'configset.php' );
if ( isset( $_REQUEST[ 'cms' ] ) ) {
  $id = $_REQUEST[ 'cms' ];
} else {
  $id = 0;
}
$sql_cms = "select * from career WHERE id=$id";
$result_cms = mysqli_query( $link, $sql_cms );
$row_cms = mysqli_fetch_array( $result_cms );
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
<title>Add Student | EMR Education</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="CMS Banner FLoorNation" name="description" />
<meta content="FloorNation" name="Quadir" />
<link rel="icon" href="<?php echo $domain_url;?>uploads/<?php echo $profile_row['favicon']; ?>" sizes="32x32" />
<link rel="icon" href="<?php echo $domain_url;?>uploads/<?php echo $profile_row['favicon']; ?>" sizes="192x192" />
<link rel="apple-touch-icon" href="<?php echo $domain_url;?>uploads/<?php echo $profile_row['favicon']; ?>" />
<link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<link href="assets/css/tagger.css" rel="stylesheet">
<script src="assets/libs/jquery/jquery.min.js"></script>
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
            <h4 class="mb-0">
              <?php
              if ( isset( $_REQUEST[ 'cms' ] ) ) {
                echo "Modify Student Change- " . $row_cms[ 'fname' ];
              } else {
                echo "Add Student Content";
              }
              ?>
            </h4>
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                <li class="breadcrumb-item active">
                  <?php
                  if ( isset( $_REQUEST[ 'cms' ] ) ) {
                    echo "Modify Student- " . $row_cms[ 'fname' ];
                  } else {
                    echo "Add Student";
                  }
                  ?>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <form action="student_detail.php" name="cont" class="dropzone" id="myform"  method="post" enctype="multipart/form-data">
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
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label" for="price">First Name</label>
                          <input id="heading" name="fname" type="text" class="form-control" value="<?php if($id){ echo $row_cms['fname'];}?>">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label" for="price">Last Name</label>
                          <input id="title" name="lname" type="text" class="form-control" value="<?php if($id){ echo $row_cms['lname'];}?>">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label" for="price">Email</label>
                          <input id="textlink" name="email" type="text" class="form-control" value="<?php if($id){ echo $row_cms['email'];} ?>">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label" for="price">Phone</label>
                          <input id="textbutton" name="phone" type="text" class="form-control" value="<?php if($id){ echo $row_cms['phone'];}?>">
                        </div>
                      </div>
                     
                     
                    </div>
                    <div class="row">
                     <div class="input-file">
										<?php 
										
										if($row_cms['resume']) {
											$allowedExts = array("pdf");
											$allowedExts2 = array("doc","docx");
											$loadimg =$row_cms["resume"];
											$extension = explode(".",$loadimg);
											$extension = end($extension);
										if(in_array($extension, $allowedExts)){
										?>
													<img id="file_upload" src="../images/pdf.jpg" alt="your image" class="upload-img" width="50" />
										<?php } else if(in_array($extension, $allowedExts2)){?>
										<img id="file_upload" src="../images/word.jpg" alt="your image" class="upload-img"  width="50"  />
										<?php } } ?>
													<div class="input-file-upload">
														<span class="upload-label">Upload Resume <i>Docx and PDF</i></span>
														<input type='file' name="resume" />
														<input type="hidden" name="hiddenimage" id="image" value="<?php if($id){ echo $row_cms['resume'];}?>" />
													</div>
												</div>
              
                    </div>
                  </div>
                  <div class="mb-0">
                    <label class="form-label" for="productdesc">Full Content</label>
                    <textarea class="form-control" name="message" id="classic-editor" rows="4"><?php if($id){ echo $row_cms['message'];}?></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
        <div class="row mb-4">
          <div class="col text-end"> <a href="homepage-manage.php" class="btn btn-danger"> <i class="fa fa-times me-1"></i> Cancel </a>
            <input type='hidden' name='id' id='id' maxlength="50"   size="30" value="<?php echo $row_cms['id']; ?>"/>
            <button type="submit"  name="<?php echo $sub ?>" class="btn btn-success"><i class="fa fa-file-alt me-1"></i> <?php echo $sub2 ?></button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php include('includes/footer.php'); ?>
</div>
</div>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script> 
<script src="assets/libs/metismenu/metisMenu.min.js"></script> 
<script src="assets/libs/simplebar/simplebar.min.js"></script> 
<script src="assets/libs/node-waves/waves.min.js"></script> 
<script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script> 
<script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script> 
<script src="assets/libs/select2/js/select2.min.js"></script> 
<script src="assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script> 
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