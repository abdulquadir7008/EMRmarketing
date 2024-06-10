<?php
include('includes/configset.php');
if(isset($_REQUEST['id']) || isset($_REQUEST['id1']))
{
if(isset($_REQUEST['id']))
{
$id=$_REQUEST['id'];
$status='1';
}
else if(isset($_REQUEST['id1']))
{
$id=$_REQUEST['id1'];	
$status='2';
}
else
{
$status='1';	
}
$query="update kyc SET astatus='$status' WHERE kycId='$id'";         
mysqli_query($link,$query);
}
else if(isset($_REQUEST['del']))
{
$id=$_REQUEST['del'];
$query="delete from kyc WHERE kycId=$id";
mysqli_query($link,$query);
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
                                    <h4 class="mb-0">KYC</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                                            <li class="breadcrumb-item active">KYC</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                        
                                   
                               
							
							
							
							
                       
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
                                                <th>UserId</th>
                                                <th>BenifcyName</th>
												<th>AccountNumber</th>
                                                <th>IFSCCode</th>
												<th>BankName</th>
												<th>Branch</th>
												<th>AdharUpload</th>
												<th>Pancard</th>
                                                <th>Cheque</th>
                                                <th>Status</th>
                                                <th style="width: 120px;">Action</th>
                                            </tr>


                                        </thead>
                                        <tbody>
                                        <?php
				  
$brnadSQL="select * from kyc INNER JOIN membership ON kyc.userId = membership.member_id"; 
 $ResultSQL=mysqli_query($link,$brnadSQL); 
 while($Listbrand=mysqli_fetch_array($ResultSQL)) {

?>

<tr>
	<td><div class="form-check text-center font-size-16"><input type="checkbox" name="users[]" value="<?php echo $Listbrand["id"]; ?>" /><label class="form-check-label" for="ordercheck1"></label></div></td>
	
	<td><?php echo $Listbrand["userid"]; ?></td>
                                                <td><?php echo $Listbrand["benifcyName"]; ?></td>
												<td><?php echo $Listbrand["accountNumber"]; ?></td>
                                                <td><?php echo $Listbrand["ifscCode"]; ?></td>
												<td><?php echo $Listbrand["bankName"]; ?></td>
												<td><?php echo $Listbrand["branch"]; ?></td>
												<td><?php if($Listbrand["adharUpload"]){?><a href="../uploads/kyc/<?php echo $Listbrand["adharUpload"];?>" target="_blank"><img src="../uploads/kyc/<?php echo $Listbrand["adharUpload"];?>" width="40"></a><?php }?>
	</td>
												<td><?php if($Listbrand["pancard"]){?><a href="../uploads/kyc/<?php echo $Listbrand["pancard"];?>" target="_blank"><img src="../uploads/kyc/<?php echo $Listbrand["pancard"];?>" width="40"></a><?php }?></td>
	
                                                <td><?php if($Listbrand["cheque"]){?><a href="../uploads/kyc/<?php echo $Listbrand["cheque"];?>" target="_blank"><img src="../uploads/kyc/<?php echo $Listbrand["cheque"];?>" width="40"></a><?php }?></td>
	
                                                <td><?php if($Listbrand['astatus']==0){echo "<span style='color:#cfaa00'>Pending</span>";} else if($Listbrand['astatus']==1){echo "<span style='color:#068e06'>Aproved</span>";}else{echo "<span style='color:#ff0a49'>Reject</span>";} ?></td>
                                                
	<td style="width: 120px;">
                        <span><a href="kyc_manage.php?id=<?php echo $Listbrand['kycId']; ?>" title="Active" class="px-3 text-success"><i class="bx bx-check-square"></i></a></span>
                       
                        <span><a href="kyc_manage.php?id1=<?php echo $Listbrand['kycId']; ?>" title="Inactive" class="px-3 text-muted"><i class="fa fa-ban"></i></a></span>
                       
        <a href="kyc_manage.php?del=<?php echo $Listbrand['kycId']; ?>" class="px-3 text-danger" onClick="return confirm('Do you really want to remove it?')"><i class="bx bx-trash font-size-18"></i></a></td>
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
<?php //unset($_SESSION['member_id']);?>
    </body>
</html>
