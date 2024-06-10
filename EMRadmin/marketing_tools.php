<?php
include('includes/configset.php');

if(isset($_REQUEST['Searchbtn'])){
	if ( !empty( $_REQUEST[ 'state_serach' ] ) && !empty( $_REQUEST[ 'city_search' ] ) && !empty( $_REQUEST[ 'pincode' ] ) ) {
		$state_serach = $_REQUEST[ 'state_serach' ];
		$city_serach = $_REQUEST[ 'city_search' ];
		$pin_serach = $_REQUEST[ 'pincode' ];
		$search_sec = "WHERE state='$state_serach' AND city='$city_serach' AND postalcode='$pin_serach'";
	}
	else if ( !empty( $_REQUEST[ 'state_serach' ] ) && !empty( $_REQUEST[ 'city_search' ] ) ) {
		$state_serach = $_REQUEST[ 'state_serach' ];
		$city_serach = $_REQUEST[ 'city_search' ];
		$search_sec = "WHERE state='$state_serach' AND city='$city_serach'";
	}
	else if ( !empty( $_REQUEST[ 'state_serach' ] ) ) {
	$state_serach = $_REQUEST[ 'state_serach' ];
		$search_sec = "WHERE state='$state_serach'";
	}
	else if ( !empty( $_REQUEST[ 'pincode' ] ) ) {
	$state_serach = $_REQUEST[ 'pincode' ];
		$search_sec = "WHERE postalcode='$state_serach'";
	}
} else {
  	$state_serach = '';
	$city_serach='';
	$pin_serach='';
}

?>
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Membership | EMR Marketing</title>
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
<style>
	.stateCl{
		width: auto;
		display: inline-block;
		background: #fff;
		margin: 10px 10px 30px 10px;
		border: 2px solid #333;
		font-size: 18px;
		position: relative;
	}
	.stateCl span {
    position: absolute;
    background: #333;
    color: #fff;
    padding: 5px;
    font-size: 11px;
    top: -21px;
    right: -2px;
    height: 19px;
    /* width: 40px; */
    text-align: right;
    line-height: 1;
}
	.stateCl a{
		color: #333;
		display: block;
		padding: 5px 10px;
		
	}
	.stateCl a:hover, .stateCl:hover, .stateCl.active, .stateCl.active a{
		color: #fff;
		background: #333;
		position: relative;
		z-index: 10
		
	}
	.cityCl{
		display: inline-block;
		padding: 10px;
		position: relative;
		
		
	}
	.cityCl span{
		position: absolute;
    background: #333;
    color: #fff;
    padding: 5px;
    font-size: 11px;
    top: -2px;
    right: 6px;
    height: 19px;
    /* width: 40px; */
    text-align: right;
    line-height: 1;
    border-radius: 100%;

	}
	.cityCl a{
		color: #333;
		font-size: 18px;
		text-decoration: underline !important;
	}
	.cityCl a:hover{
		color: #333;
		text-decoration: none !important;
	}
	.cityCl.active a{
		font-weight: bold;
		text-decoration: none !important;
	}
	.pincId{
	background: #333;
    display: inline-block;
    color: #fff;
    padding: 10px;
    border-radius: 10px;
	margin: 15px;
	font-size: 17px;
	}
	.pincId a
	{
		color: #fff;
		font-weight: bold;
	}
	.pincId span{
		color: yellow;
	}
	.stateCl span{
		
	}
		</style>
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
                                    <h4 class="mb-0">State</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                                            <li class="breadcrumb-item active">Marketing Report</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
<div class="state_list">
<?php

$StateSql=mysqli_query($link,"select * from states order by name ASC"); 
while($state_list=mysqli_fetch_array($StateSql)) {
	if($_REQUEST['state']==$state_list['id']){
		$stId = "active";
	}
	else{
		$stId= '';
	}
$memberSql2=mysqli_query($link,"SELECT state from membership WHERE state='".$state_list['id']."' AND status='2'");
	if(mysqli_num_rows($memberSql2) > 0){
		$mysqlnumrow = "<span> ".mysqli_num_rows($memberSql2)."</span>";
	}
	else{
		$mysqlnumrow = '';
	}
	echo "<div class='stateCl ".$stId." '><a href='?state=".$state_list['id']." '>".$state_list['name']."</a>".$mysqlnumrow."</div>";
}
?>
</div>
							
<div class="state_list">
	
<?php

$citySql=mysqli_query($link,"select * from cities WHERE state_id='".$_REQUEST['state']."' order by city ASC"); 
if(mysqli_num_rows($citySql)>0){
	echo "<h4 class='mb-0' style='margin: 30px 0px 30px;'>District</h4>";
}

	while($listSQL=mysqli_fetch_array($citySql)) {
	if($_REQUEST['city']==$listSQL['id']){
		$stId = "active";
	}
	else{
		$stId= '';
	}
$memberSql2=mysqli_query($link,"SELECT state from membership WHERE state='".$_REQUEST['state']."' AND city='".$listSQL['id']."' AND status='2'");
	if(mysqli_num_rows($memberSql2) > 0){
		$mysqlnumrow = "<span> ".mysqli_num_rows($memberSql2)."</span>";
	}
	else{
		$mysqlnumrow = '';
	}	
	echo "<div class='cityCl ".$stId." '><a href='?state=".$_REQUEST['state']."&&city=".$listSQL['id']." '>".$listSQL['city']."</a>".$mysqlnumrow."</div>";
}
?>
</div>
<div class="state_list">
<?php

$memberSql=mysqli_query($link,"SELECT postalcode from membership WHERE  state='".$_REQUEST['state']."' AND city='".$_REQUEST['city']."' GROUP BY postalcode");
if(mysqli_num_rows($memberSql)>0){
	echo "<h4 class='mb-0' style='margin: 30px 0px 30px;'>Postal Code</h4>";
}

while($member_list=mysqli_fetch_array($memberSql)) {
$memberSql2=mysqli_query($link,"SELECT postalcode from membership WHERE postalcode='".$member_list['postalcode']."' AND state='".$_REQUEST['state']."' AND city='".$_REQUEST['city']."' AND status='2'");
	echo "<div class='pincId'><a href=''>".$member_list['postalcode']."</a><br><span>UID ".mysqli_num_rows($memberSql2)."</span></div>";
}
?>
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
<?php unset($_SESSION['member_id']);?>
    </body>
</html>
