<?php
include( 'includes/configset.php' );
if ( isset( $_REQUEST[ 'cms' ] ) ) {
  $verient_id = $_REQUEST[ 'cms' ];
} else {
  $verient_id = 0;
}
$sql_cms = "select * from prod_color WHERE picker_id=$verient_id";
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
            <h4 class="mb-0">Add Product Color</h4>
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                <li class="breadcrumb-item active">Add Product Color</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- end page title -->
     
		  
		  
      <form action="product-color-manage.php" name="conter" class="dropzone" id="myform2"  method="post" enctype="multipart/form-data">
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
                      <h5 class="font-size-16 mb-1">Product Color Info</h5>
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
					 
                    
                    <div class="repeater" id="repgert" style="margin-top: 50px;">
                      <h5>Products color OR Pattern </h5>
                      <div data-repeater-list="group_b" class="row">
                        <?php
                        if ( isset( $_REQUEST[ 'cms' ] ) ) {
                          $invoicedel = "select * from product_varient WHERE v_id='$cmsID'";
                          $myinvoicedel = mysqli_query( $link, $invoicedel );
                          while ( $listinvoice = mysqli_fetch_array( $myinvoicedel ) ) {
                            ?>
                        <?php }} ?>
                    <!--    <div data-repeater-item class="col-md-3">
                          <div class="mb-3">
                            <label for="example-color-input" class="col-md-12 col-form-label">Color picker</label>
                            <div class="col-md-10">
                              <input type="color" name="color_picker" class="form-control form-control-color" id="exampleColorInput"  title="Choose your color">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">Product Choose color Gallery</label>
								<input type="file" name="image">
								
                              
                            </div>
                          </div>
                          <div class="col-md-2" style="margin: auto; text-align: left"> <span class="fa fa-trash-alt"  data-repeater-delete class="btn btn-primary btn-block"></span> </div>
                        </div>  -->
						  
						  
						  
						  <div class="row">
  <div class="customer_records">
	  <div class="row">
     <div class="mb-3 col-lg-3">
                            <label for="example-color-input" class="col-md-12 col-form-label">Color picker</label>
                            <div class="col-md-10">
                              <input type="color" name="color_picker" class="form-control form-control-color" id="exampleColorInput"  title="Choose your color" value="<?php echo $row_cms['color_picker']; ?>">
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
	  
                          <div class="col-md-12">
							  <div class="box-fileupload col-md-3">
                          <input type="file" id="fileId" class="file-upload-input" name="image2">
                          <label for="fileId" class="file-upload-btn fa fa-cloud-upload-alt"></label>
                          <input type="hidden" name="hiddenimage2" id="image2" value="<?php echo $row_cms['image2']; ?>" />
                          <p class="box-fileupload__lable">Upload here Product Main Image</p>
                          <?php if($row_cms['image2']!='') { image_size(); ?>
                          <img src="<?php echo "../".$product_paath.$row_cms['image2'];?>" width="<?php echo $width; ?>100" height="<?php echo $height; ?>" class="alignLeft" />
                          <?php } ?>
                        </div>
							  
							  
							  
                            <div class="mb-3 row">
								
								<div class="col-md-3">
                              <label class="form-label">Multiple Image Upload</label>
								<input type="file" name="image[]" class="form-control" multiple>
									<input type="hidden" name="hiddenimage" value="<?php echo $row_cms['image']; ?>" />
								</div>
								<div class="col-md-12" style="margin: 20px 0 0 0">
								<?php if($row_cms['image']){
		
	$datacard = preg_replace('/,+/', ',', $row_cms['image']);
	 $splittedstring=explode(",",$datacard);
foreach ($splittedstring as  $value) {
if($value){  
		  ?>
                        <img src="<?php echo "../".$product_paath.$value;?>" class="img-preview-thumb" style="width:100px">
                        <?php } }}?>
								
								</div>		
								
								
								
                              
                            </div>
                          </div>

    
  </div>

  <div class="customer_records_dynamic"></div>

</div>
						  
						  
						  
                      </div>
                     
                    </div>
					<div class="row mb-4">
						<label class="form-label" for="manufacturerbrand">Leather <span>(If leather is match to color)</span></label>
						<input type="text" id="tag-input1" class="form-control" name="leather" value="<?php echo $row_cms['leather']; ?>">
						
						<?php
						$k =1;
						$splittedstring=explode(",",$row_cms['leather']);
foreach ($splittedstring as  $value) {
	if($k ==1){$jack = "";}else{$jack = ",";}
	$rcrat .= $jack."'".$value. "'";

$k++;}
			
						?>
					  </div>
                    <div class="row mb-4">
                      <div class="col text-end"> <a href="product-color-manage.php" class="btn btn-danger"> <i class="fa fa-times me-1"></i> Cancel </a>
                        <input type='hidden' name='picker_id' id='picker_id' maxlength="50"   size="30" value="<?php echo $row_cms['picker_id']; ?>"/>
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
    
		
	</script>

</body>
</html>
