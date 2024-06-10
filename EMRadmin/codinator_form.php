<?php
include( 'includes/configset.php' );
if ( isset( $_REQUEST[ 'update' ] ) ) {
  $userid = $_REQUEST[ 'userid' ];
  $cordinator = $_REQUEST[ 'cordinator' ];
  $id = $_REQUEST['id'];
$SqlMember2 = mysqli_query( $link, "select * from membership WHERE userid='$userid'" );
  $sqlmem30 = mysqli_fetch_array( $SqlMember2 );
  if($_REQUEST[ 'cordinator' ]=='district'){
	  $cordChange = $sqlmem30['city'];
  }
  else if($_REQUEST[ 'cordinator' ]=='state'){
	  $cordChange = $sqlmem30['state'];
  }
  else if($_REQUEST[ 'cordinator' ]=='regional'){
	  $cordChange12 = $sqlmem30['state'];
	  $sqlRegion = mysqli_query( $link, "select * from states WHERE id='$cordChange12'" );
  	  $listRegion = mysqli_fetch_array( $sqlRegion );
	  $cordChange = $listRegion['region_id'];
  }
  else if($_REQUEST[ 'cordinator' ]=='national'){
	  $cordChange = 'In';
  }	
  $query = "update cordinator_activation SET userid='$userid',cordinator='$cordinator',activation_Update=now(),cordinator_chane='$cordChange' WHERE codin_id=$id";
  mysqli_query( $link, $query );


  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = ' cordinator Activation modified successfully.';
  $errflag = true;
  $_SESSION[ 'ERRMSG_ARR' ] = $errmsg_arr;
  session_write_close();

} else if ( isset( $_REQUEST[ 'add' ] ) ) {
  $userid = $_REQUEST[ 'userid' ];
  $cordinator = $_REQUEST[ 'cordinator' ];
  $SqlMember2 = mysqli_query( $link, "select * from membership WHERE userid='$userid'" );
  $sqlmem30 = mysqli_fetch_array( $SqlMember2 );
  if($_REQUEST[ 'cordinator' ]=='district'){
	  $cordChange = $sqlmem30['city'];
  }
  else if($_REQUEST[ 'cordinator' ]=='state'){
	  $cordChange = $sqlmem30['state'];
  }
  else if($_REQUEST[ 'cordinator' ]=='regional'){
	  $cordChange12 = $sqlmem30['state'];
	  $sqlRegion = mysqli_query( $link, "select * from states WHERE id='$cordChange12'" );
  	  $listRegion = mysqli_fetch_array( $sqlRegion );
	  $cordChange = $listRegion['region_id'];
  }
  else if($_REQUEST[ 'cordinator' ]=='national'){
	  $cordChange = 'In';
  }
	
  $query = "insert into cordinator_activation(userid,cordinator,activation_date,cordinator_chane) values('$userid','$cordinator',now(),'$cordChange')";
  mysqli_query( $link, $query );
  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = ' cordinator Activation successfully.';
  $errflag = true;
  $_SESSION[ 'ERRMSG_ARR' ] = $errmsg_arr;
  session_write_close();
} else if ( isset( $_REQUEST[ 'del' ] ) ) {
  $id = $_REQUEST[ 'del' ];
  $query = "delete from cordinator_activation WHERE codin_id=$id";
  mysqli_query( $link, $query );
}


if ( isset( $_REQUEST[ 'cms' ] ) ) {
  $id = $_REQUEST[ 'cms' ];
} else {
  $id = 0;
}
$sql_cms = "select * from cordinator_activation WHERE codin_id=$id";
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
  $sub2 = "Active";
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Add Cordinator | EMR Marketing</title>
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

<link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />  

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<link href="assets/css/tagger.css" rel="stylesheet">
	<link href="assets/css/awesome/css/all.css" rel="stylesheet">
	 
<!-- Bootstrap Css -->
<script src="assets/libs/jquery/jquery.min.js"></script> 
<script>
function showCity(sel) {
	var city_id = sel.options[sel.selectedIndex].value;  
	$("#output").html( "" );
	 if (city_id.length > 0 ) { 
 
	 $.ajax({
			type: "POST",
			url: "memeber_cord_fetch.php",
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
              <h4 class="mb-0">Add Cordinator Activation</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                  <li class="breadcrumb-item active">Add Cordinator Activation</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- end page title -->
        <?php
        if ( isset( $_SESSION[ 'ERRMSG_ARR' ] ) && is_array( $_SESSION[ 'ERRMSG_ARR' ] ) && count( $_SESSION[ 'ERRMSG_ARR' ] ) > 0 ) {
          foreach ( $_SESSION[ 'ERRMSG_ARR' ] as $msg ) {
            echo "<div class='pad margin no-print'><div style='margin: 20px !important;' class='alert alert-success alert-dismissible fade show'><i class='fa fa-info'></i><b>Note:</b>" . $msg . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                                                
                                                </button></div></div>";
          }
          unset( $_SESSION[ 'ERRMSG_ARR' ] );
        }
        ?>
        <form action="codinator_form.php" name="cont" class="dropzone" id="myform"  method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="row">
              <div class="col-lg-4">
                <div class="mb-3">
                  <label class="form-label" for="manufacturerbrand">Select User ID</label>
                  <select class="form-control select2" name="userid" onChange="showCity(this);" required>
                    <option>Select</option>
                    <?php
                    $SqlMember = mysqli_query( $link, "select * from membership WHERE binary_status>0 and status=2" );
                    while ( $row_cms001 = mysqli_fetch_array( $SqlMember ) ) {
                      ?>
                    <option value="<?php echo $row_cms001['userid'];?>" <?php if ( isset( $_REQUEST[ 'cms' ] ) ){if($row_cms001['userid']==$row_cms['userid']){?>selected<?php }} ?> ><?php echo $row_cms001['userid'];?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-3">
                  <label class="form-label" for="manufacturerbrand">Commission Plan</label>
                  <select class="form-control select2" name="cordinator" required >
                    <option>Select</option>
                    <option value="district" <?php if ( isset( $_REQUEST[ 'cms' ] ) ){if($row_cms['cordinator']=='district'){?>selected<?php }} ?>>District Coordinator</option>
                    <option value="state" <?php if ( isset( $_REQUEST[ 'cms' ] ) ){if($row_cms['cordinator']=='state'){?>selected<?php }} ?>>State Coordinator</option>
                    <option value="regional" <?php if ( isset( $_REQUEST[ 'cms' ] ) ){if($row_cms['cordinator']=='regional'){?>selected<?php }} ?>>Regional Coordinator</option>
                    <option value="national" <?php if ( isset( $_REQUEST[ 'cms' ] ) ){if($row_cms['cordinator']=='national'){?>selected<?php }} ?>>National Coordinator</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-4 mt-4">
                <div class="col">
                  <input type='hidden' name='id' id='id' maxlength="50"   size="30" value="<?php echo $row_cms['codin_id']; ?>"/>
                  <button type="submit"  name="<?php echo $sub ?>" class="btn btn-success"><i class="fa fa-file-alt me-1"></i> <?php echo $sub2 ?></button>
                </div>
                <!-- end col --> 
              </div>
            </div>
            <div id="output"></div>
          </div>
          <!-- end row --> 
          
          <!-- end row-->
        </form>
		  <div class="row mt-4">
        <div class="col-lg-12">
          <div class="table-responsive mb-4">
            <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
              <thead>
                <tr class="bg-transparent">
                  <th style="width: 20px;"> <div class="form-check text-center font-size-16">
                      <input type="checkbox" class="form-check-input" id="ordercheck">
                      <label class="form-check-label" for="ordercheck"></label>
                    </div>
                  </th>
                  <th>UserID</th>
                  <th>User Name</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Commission Plan</th>
                  <th>Commission</th>
                  <th style="width: 120px;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $brnadSQL = "select * from cordinator_activation order by codin_id ASC";
                $ResultSQL = mysqli_query( $link, $brnadSQL );
                while ( $Listbrand = mysqli_fetch_array( $ResultSQL ) ) {

                  $result_cms2 = mysqli_query( $link, "SELECT * FROM membership 
	INNER JOIN cities ON membership.city = cities.id 
	INNER JOIN states ON membership.state = states.id
	WHERE userid= '" . $Listbrand[ 'userid' ] . "'" );
                  $row_cms2 = mysqli_fetch_array( $result_cms2 );

                  $result_cms21 = mysqli_query( $link, "SELECT * FROM states 
	INNER JOIN region ON states.region_id = region.region_id 
	WHERE name= '" . $row_cms2[ 'name' ] . "'" );
                  $row_cms21 = mysqli_fetch_array( $result_cms21 );
                  ?>
                <tr>
                  <td><div class="form-check text-center font-size-16">
                      <input type="checkbox" name="users[]" value="<?php echo $Listbrand["codin_id"]; ?>" />
                      <label class="form-check-label" for="ordercheck1"></label>
                    </div></td>
                  <td><?php echo $Listbrand['userid'];?><br></td>
                  <td><?php echo $row_cms2['fname']." ".$row_cms2['lname'];?></td>
                  <td><?php echo $row_cms2['city'];?></td>
                  <td><?php echo $row_cms2['name'];?></td>
                  <td><?php echo $Listbrand['cordinator'];?></td>
                  <td><?php echo $Listbrand['commission'];?></td>
                  <td>
					  <a href="codinator_view.php?cms=<?php echo $Listbrand['codin_id'];?>" class="px-3 text-primary" target="_blank"><i class="fa  fa-eye font-size-18"></i></a>
					  
					  <a href="codinator_form.php?cms=<?php echo $Listbrand['codin_id'];?>" class="px-3 text-primary"><i class="fa bx bx-edit-alt font-size-18"></i></a> <a href="codinator_form.php?del=<?php echo $Listbrand['codin_id']; ?>" class="px-3 text-danger" onClick="return confirm('Do you really want to remove it?')"><i class="bx bx-trash font-size-18"></i></a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- end table --> 
        </div>
			  </div>
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

	 <!-- Required datatable js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- init js -->
        <script src="assets/js/pages/ecommerce-datatables.init.js"></script>
	
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


</body>
</html>
