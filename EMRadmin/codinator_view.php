<?php
include( 'includes/configset.php' );
if ( isset( $_REQUEST[ 'cms' ] ) ) {
	$id = $_REQUEST[ 'cms' ];
                $SqlCodeView = mysqli_query( $link, "select * from cordinator_activation WHERE codin_id='$id'" );
                $listCodeView = mysqli_fetch_array( $SqlCodeView ) ;
	$sponser_id = $listCodeView['userid'];
	$spqmem = mysqli_query( $link, "select * from membership WHERE userid='$sponser_id'" );
                $spemlist = mysqli_fetch_array( $spqmem ) ;
                $ResultSQL12 = mysqli_query( $link, "select sum(commission) as comm from codinator_history WHERE sponser_id='$id' and status=0 order by id DESC" );
	$spemlist123 = mysqli_fetch_array( $ResultSQL12 ) ;
}
if(isset($_REQUEST['withdraw'])){
	$spId = $_REQUEST['spId'];
	$query="update codinator_history SET status='1',withdrawDate=now() WHERE sponser_id='$spId'";
	mysqli_query($link,$query);
	$query1="update cordinator_activation SET commission='0' WHERE codin_id='$spId'";
	mysqli_query($link,$query1);
	$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' Commission Withdraw successfully.';
$errflag = true;
$_SESSION['COMMERR'] = $errmsg_arr;
session_write_close();
	header('Location: ' . $_SERVER['HTTP_REFERER']);
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
        
       
       
        
		  <div class="row mt-4">
			  <div class="sponser">
			  	<h4><?php echo $spemlist['fname']." ".$spemlist['lname'];?></h4>
				  <p><strong>UserID :</strong> <?php echo $spemlist['userid'];?></p>
				  <h5>Total Commission :
					  <form id="withdrawForm" action="codinator_view.php" method="post">
					  <input type="text" style="height: 37px; padding: 5px;" readonly value="<?php if(empty($spemlist123['comm'])){?>0<?php } else{ echo $spemlist123['comm'];}?>">
						  <input type="hidden" name="spId" value="<?php echo $id;?>">
						  <button type="submit" <?php if(empty($spemlist123['comm'])){?>disabled<?php } ?> class="btn btn-primary" name="withdraw" >Withdraw</button>
					  </form>
					  </h5>
				  
				  <?php
if( isset($_SESSION['COMMERR']) && is_array($_SESSION['COMMERR']) && count($_SESSION['COMMERR']) >0 ) {
foreach($_SESSION['COMMERR'] as $msg) {
echo "<div class='pad margin no-print'><div style='margin: 20px !important;' class='alert alert-success alert-dismissible fade show'><i class='fa fa-info'></i><b>Note:</b>" .$msg."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                                                
                                                </button></div></div>";  
}
unset($_SESSION['COMMERR']); }?>
				  
			  </div>
        <div class="col-lg-8">
          <div class="mb-4">
            <table class="table " style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
              <thead>
                <tr class="bg-transparent">
                  
                 
                  <th>UserID</th>
				  <th>Username</th>	
                  <th>City</th>
                  <th>State</th>
                  <th>coordinator</th>
                  <th>Commission</th>
					<th>Status</th>
                 
                </tr>
              </thead>
              <tbody>
                <?php

                $brnadSQL = "select * from codinator_history WHERE sponser_id='$id' order by id DESC";
                $ResultSQL = mysqli_query( $link, $brnadSQL );
                while ( $Listbrand = mysqli_fetch_array( $ResultSQL ) ) {

                  $result_cms2 = mysqli_query( $link, "SELECT * FROM membership 
	INNER JOIN cities ON membership.city = cities.id 
	INNER JOIN states ON membership.state = states.id
	WHERE userid= 'emr00" . $Listbrand[ 'userId' ] . "'" );
                  $row_cms2 = mysqli_fetch_array( $result_cms2 );

                  $result_cms21 = mysqli_query( $link, "SELECT * FROM states 
	INNER JOIN region ON states.region_id = region.region_id 
	WHERE name= '" . $row_cms2[ 'name' ] . "'" );
                  $row_cms21 = mysqli_fetch_array( $result_cms21 );
                  ?>
                <tr>
                  
					 
                  <td><?php echo $Listbrand['userId'];?><br></td>
                  <td><?php echo $row_cms2['fname']." ".$row_cms2['lname'];?></td>
                  <td><?php echo $row_cms2['city'];?></td>
                  <td><?php echo $row_cms2['name'];?></td>
                  <td><?php echo $Listbrand['codigntor'];?></td>
                  <td><?php echo $Listbrand['commission'];?></td>
					<td><?php if($Listbrand['status']==1){
					  echo "<div class='badge bg-pill bg-soft-success font-size-12'>Withdraw</div>";
				  }else{
					  echo "<div class='badge bg-pill bg-soft-warning font-size-12'>Unpaid</div>";
				  }
						?></td>
					

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
