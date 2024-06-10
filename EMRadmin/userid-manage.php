<?php
include('includes/configset.php');
require '../vendor_email/autoload.php';
$emailtrick = new \SendGrid\Mail\Mail();
$spnoser_id=$_REQUEST['spnoser_id'];
$fname=$_REQUEST['fname'];
$id=$_REQUEST['id'];
$lname=$_REQUEST['lname'];
$phone=$_REQUEST['phone'];
$email=$_REQUEST['email'];
$stree_address=$_REQUEST['stree_address'];
$city=$_REQUEST['city'];
$state=$_REQUEST['state'];
$postalcode=$_REQUEST['postalcode'];
$binary_root = $_REQUEST['binary_root'];
$password=md5($_REQUEST['password']);

if($_REQUEST['binary_root']){
	$str_s = '2';
}
else{
	$str_s = 0;
}

if(isset($_REQUEST['update']))
{
$query="update membership SET fname='$fname',lname='$lname',phone='$phone',email='$email',stree_address='$stree_address',city='$city',postalcode='$postalcode',binary_root='$binary_root',state='$state',status='$str_s' WHERE member_id=$id";
mysqli_query($link,$query);
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' Record modified successfully.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	
}
else if(isset($_REQUEST['add']))
{
$query="insert into membership(fname,lname,phone,email,stree_address,city,state,postalcode,status,date,spnoser_id,sponser_status,auto_pool_500,binary_root,password)values('$fname','$lname','$phone','$email','$stree_address','$city','$state','$postalcode','$str_s',now(),'$spnoser_id','yes','Active','$binary_root','$password')"; 
	mysqli_query($link,$query);
	$user_id=$_SESSION['member_id']=mysqli_insert_id($link);
	$emrUser = 'emr00'.$user_id;
	mysqli_query($link,"update membership SET userid='$emrUser' WHERE member_id=$user_id");
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' Record Add successfully.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
}

else if(isset($_REQUEST['id']) || isset($_REQUEST['id1']))
{
if(isset($_REQUEST['id']))
{
$id=$_REQUEST['id'];
$status='0';
}
else if(isset($_REQUEST['id1']))
{
$id=$_REQUEST['id1'];	
$status='2';
}
else
{
$status='0';	
}
$query="update membership SET status='$status' WHERE member_id='$id'";         
mysqli_query($link,$query);
}
else if(isset($_REQUEST['del']))
{
$id=$_REQUEST['del'];
$query="delete from membership WHERE member_id=$id";
mysqli_query($link,$query);
}
else if(isset($_REQUEST['store']))
{	
	unset($_SESSION['member_id']);
	$adminProp = $_REQUEST['store'];
	session_write_close();
	header('Location:../profile.php?strmb='.$adminProp);
}
if(isset($_REQUEST['password_reset'])){
	$pass_id = $_REQUEST['password_reset'];
	$rs_search = mysqli_query($link,"select * from membership where member_id='$pass_id' and status='2'");
	$user_count = mysqli_num_rows($rs_search);
	$user_count2 = mysqli_fetch_array($rs_search);
if ($user_count != 0)
{
  $kd_uniq = uniqid();
mysqli_query($link,"UPDATE membership set uniqid='$kd_uniq' where member_id='$pass_id' and status='2'");

$msg ="<table width='700' border='0' cellpadding='0' cellspacing='0' style='background:#f3f3f3; line-height:21px; border:1px solid #ccc;  font-family:Arial, Helvetica, sans-serif; font-size:13px; color:
#333;' align='center'>
<tr>
	<td width='171'><div align='left'><img src='$domain_url/images/emr-cover.jpg' border='0'  /></div></td>
	<td width='527' style='background:#000; font-size:23px; text-align:center; color:#fff; text-shadow:0 0 2px #000; font-weight:bold;'><p>Reset The Password</p></td>
</tr>
<tr>
    <td colspan='2' style='padding:10px;'>
<p>Welcome to EMR, </p>
Please go through the below link RESET your Password.</p>
<p>$domain_url/password.php?reset=$kd_uniq</p>
<P>USER ID: ".$user_count2['userid']."</p>
<p><strong>If you did not send this request, you can safely ignore this email.</strong></p>
<br/>
<p>Thank you. This is an automated response. PLEASE DO NOT REPLY.</p>

 
<p><b>Regards</b></p>
    <p align='left'><strong style='color:#1d81c2;'><strong >EMR Marketing LLC</strong>.</strong></p>
	<p align='left'><strong style='color:#1d81c2;'><a href='https://www.emrmarkteing.in/'>Go to EMR Website</a></strong></p>
</td>
  </tr>
</table>";
$emailtrick->setFrom("quadir@emrmarketing.in", "EMR Marketing");
$emailtrick->setSubject("Password Reset");
$emailtrick->addTo($user_count2['email'], "Password Reset");
//$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$emailtrick->addContent(
    "text/html", $msg
);
$sendgrid = new \SendGrid('xxxxx-xxxxx-xxxxx-xxxxx');
try {
    $response = $sendgrid->send($emailtrick);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
//    echo 'Caught exception: '. $e->getMessage() ."\n";
}		

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' <strong>Success!</strong> Password reset link Send Succussfully in register email ID. Please inform to User.';
$errflag = true;
$_SESSION['resetarror'] = $errmsg_arr;
session_write_close();
header('Location:userid-manage.php');	
}
	else{
		$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' <strong>Warning!</strong> This email ID is not active.';
$errflag = true;
$_SESSION['resetarror'] = $errmsg_arr;
session_write_close();
	}
	
}
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
                                    <h4 class="mb-0">Membership</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                                            <li class="breadcrumb-item active">Membership</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                        <div class="searching_form">
                               <form action="userid-manage.php" method="get">
									<div class="row">
								   		 
                            <h4>Search</h4>
							  <select name="state_serach" onChange="showCity(this);">
					  <option value="">--Select State -- </option>
					  <?php
$stateSql = mysqli_query( $link, "select * from states order by name ASC" );
while($stateSqli = mysqli_fetch_array( $stateSql )){
	if($_REQUEST['state_serach']==$stateSqli['id']){
		$selected = "selected";
	}
	else{
		$selected = "";
	}
	echo "<option value='".$stateSqli['id']."' ".$selected." >".$stateSqli['name']."</option>";
}
?>
					</select>
                            <select name="city_search" id="cityoutput">
								   <option value="">--Select city -- </option>
											<?php
$stateSqlt = mysqli_query( $link, "select * from cities WHERE state_id='".$_REQUEST['state_serach']."' order by city ASC" );
while($stateSqlit = mysqli_fetch_array( $stateSqlt )){
	if($_REQUEST[ 'city_search' ]==$stateSqlit['id']){
		$selected = "selected";
	}
	else{
		$selected = "";
	}
	echo "<option value='".$stateSqlit['id']."' ".$selected." >".$stateSqlit['city']."</option>";
}
?>
					</select>
							  <input type="number" name="pincode" placeholder="Pincode" value="<?php echo $pin_serach;?>">
                          
						  <button type="submit" class="btn btn-primary btnargu" name="Searchbtn">Search</button>
								<?php if(!empty($_REQUEST['pincode']) || !empty($_REQUEST['city_search']) || !empty($_REQUEST['state_serach'])){?>
                  <a href="userid-manage.php" class="btn btn-dark btnargu">RESET</a>
                  <?php } ?>		
										
								   </div>
								</form>
									</div>
                                    <a href="userid-form.php" style="float: right; width: auto"><button type="button" class="btn btn-success waves-effect waves-light mb-3 rubalink"><i class="mdi mdi-plus me-1"></i> Add User</button></a>
                               
							
							
							
							
                        <?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
foreach($_SESSION['ERRMSG_ARR'] as $msg) {
echo "<div class='pad margin no-print'><div style='margin: 20px !important;' class='alert alert-success alert-dismissible fade show'><i class='fa fa-info'></i><b>Note:</b>" .$msg."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                                                
                                                </button></div></div>";  
}
unset($_SESSION['resetarror']); }?>
							
						<?php
if( isset($_SESSION['resetarror']) && is_array($_SESSION['resetarror']) && count($_SESSION['resetarror']) >0 ) {
foreach($_SESSION['resetarror'] as $msg) {
echo "<div class='pad margin no-print'><div style='margin: 20px !important;' class='alert alert-success alert-dismissible fade show'><i class='fa fa-info'></i><b>Note:</b>" .$msg."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                                                
                                                </button></div></div>";  
}
unset($_SESSION['resetarror']); }?>	
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
                                                
                                                <th>UserID</th>
												<th>Fullname</th>
                                                <th>Email</th>
												<th>Sponser ID</th>
												<th>state</th>
												<th>District</th>
												<th>Pincode</th>
                                                <th>Position</th>
                                               
                                                <th style="width: 120px;">Action</th>
                                            </tr>


                                        </thead>
                                        <tbody>
                                        <?php
				  
$brnadSQL="select * from membership $search_sec order by member_id DESC"; 
 $ResultSQL=mysqli_query($link,$brnadSQL); 
 while($Listbrand=mysqli_fetch_array($ResultSQL)) {
     $q6x0 = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `pairing` where `uid`= '$Listbrand[member_id]'"));
    $position = $q6x0['position'];
	 $sql_st2004 = mysqli_query( $link, "select * from states where id='".$Listbrand['state']."'" );
$stateSqli2004 = mysqli_fetch_array( $sql_st2004 );
$sql_city2004 = mysqli_query( $link, "select * from cities where id='".$Listbrand['city']."'" );
$citySqli2004 = mysqli_fetch_array( $sql_city2004 );
?>

<tr>
	<td><div class="form-check text-center font-size-16"><input type="checkbox" name="users[]" value="<?php echo $row_cms["id"]; ?>" /><label class="form-check-label" for="ordercheck1"></label></div></td>
	
	<td><?php echo $Listbrand['userid'];?></td>
	<td><?php echo $Listbrand['fname']." ".$Listbrand['lname'];?> </td>
    <td><?php echo $Listbrand['email'];?> </td>
	<td><?php if($Listbrand['spnoser_id']){echo "emr00".$Listbrand['spnoser_id'];}?> </td>
	
	<td><?php echo $stateSqli2004['name'];?></td>
	<td><?php echo $citySqli2004['city'];?></td>
	<td><?php echo $Listbrand['postalcode'];?></td>
	<td><?php echo $position;?></td>
	<td>
		<a href="userid-manage.php?password_reset=<?php echo $Listbrand['member_id']; ?>" class="px-3 text-secondary" title="Send Password change Request"><i class="fa fa-eye font-size-18"></i></a>
    	<a href="userid-form.php?cms=<?php echo $Listbrand['member_id'];?>" class="px-3 text-primary"><i class="fa bx bx-edit-alt font-size-18"></i></a>
         <?php if($Listbrand['status']==2){ ?>
                        <span><a href="userid-manage.php?id=<?php echo $Listbrand['member_id']; ?>" title="Active" class="px-3 text-success"><i class="bx bx-check-square"></i></a></span>
                        <?php } else { ?>
                        <span><a href="userid-manage.php?id1=<?php echo $Listbrand['member_id']; ?>" title="Inactive" class="px-3 text-muted"><i class="fa fa-ban"></i></a></span>
                        <?php } ?>
        <a href="userid-manage.php?del=<?php echo $Listbrand['member_id']; ?>" class="px-3 text-danger" onClick="return confirm('Do you really want to remove it?')"><i class="bx bx-trash font-size-18"></i></a>
		<a href="userid-manage.php?store=<?php echo $Listbrand['member_id']; ?>" class="px-3 text-danger" target="_blank"><img src="assets/images/download.png" width="15" ></a>
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
