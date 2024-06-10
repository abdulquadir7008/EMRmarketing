<?php 
include('includes/configset.php');
$brandname=$_REQUEST['brandname'];
$shortorder=$_REQUEST['shortorder'];
$id=$_REQUEST['id'];
$date=$_REQUEST['date'];
$status=$_REQUEST['status'];
$bestseller=$_REQUEST['bestseller'];
$seokeyword = str_replace(' ','-',$brandname);
$sekey2=mb_strtolower($seokeyword);

if($_FILES["image"]["name"]!='')
{
if (($_FILES["image"]["type"] == "image/gif")
|| ($_FILES["image"]["type"] == "image/jpeg")
|| ($_FILES["image"]["type"] == "image/pjpeg")
|| ($_FILES["image"]["type"] == "image/X-PNG")
|| ($_FILES["image"]["type"] == "image/PNG")
|| ($_FILES["image"]["type"] == "image/png")
|| ($_FILES["image"]["type"] == "image/x-png"))
{
$image="../$brand_path".$rand1.$_FILES["image"]["name"];
$image0=$rand1.$_FILES["image"]["name"];
move_uploaded_file($_FILES["image"]["tmp_name"],$image);
}
else
{
$image0='';
}
}

else
{
$image0=$_REQUEST['hiddenimage'];
}
if(isset($_REQUEST['update']))
{


$query="update brand SET brandname='$brandname',seo_keyword='$sekey2', date=now(),shortorder='$shortorder',image='$image0',bestseller='$bestseller' WHERE id=$id";
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
$query="insert into brand(brandname,seo_keyword,date,shortorder,status,image,bestseller) values('$brandname','$sekey2',now(),'$shortorder','1','$image0','$bestseller')";
mysqli_query($link,$query);

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
$status='1';
}
else
{
$status='0';	
}
$query="update brand SET status='$status' WHERE id='$id'";         
mysqli_query($link,$query);
}
else if(isset($_REQUEST['del']))
{
$id=$_REQUEST['del'];
$query="delete from brand WHERE id=$id";
mysqli_query($link,$query);
}
?>
<?php 
if (isset($_REQUEST['cms'])){$id=$_REQUEST['cms'];}else{$id=0;}
$sql_cms="select * from brand WHERE id=$id"; 
$result_cms=mysqli_query($link,$sql_cms); 
$row_cms=mysqli_fetch_array($result_cms);
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
        <title>Brand | EMR Marketing</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
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

    <!-- <body data-layout="horizontal" data-topbar="colored"> -->

        <!-- Begin page -->
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
                                    <h4 class="mb-0">Brand</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                            <li class="breadcrumb-item active">Brand</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                        <div>
                                    <a href="brand.php"><button type="button" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Add Brand</button></a>
                                </div>
                        <div class="col-lg-4">
                                <div class="card">
                                
                                <?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
foreach($_SESSION['ERRMSG_ARR'] as $msg) {
echo "<div class='pad margin no-print'><div style='margin-bottom: 0!important;' class='alert alert-success'><i class='fa fa-info'></i><b>Note:</b>" .$msg."</div></div>";  
}
unset($_SESSION['ERRMSG_ARR']); }?>
                                    <div class="card-body">
        
                                        <h4 class="card-title">Add New Brand</h4>
                                        <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to each
                                            textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
        <form action="brand.php" name="cont"  id="myform"  method="post" enctype="multipart/form-data">
                                        
                                        
                                        
                                        
                                        <div class="mb-3 row">
                                            <div class="col-md-12">
                                            <label for="example-text-input" class="col-form-label">Brand Name <code>*</code></label>
                                                <input class="form-control" type="text" name="brandname" id="example-text-input"  value="<?php echo $row_cms['brandname']; ?>" required>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="mb-3 row">
                                           
                                            <div class="col-md-12">
                                            <label for="example-text-input" class="col-form-label">Sort Order</label>
                                                <input class="form-control" name="shortorder" type="number" id="example-number-input" value="<?php echo $row_cms['shortorder']; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                           
                                            <div class="col-md-12">
                                            <label for="example-text-input" class="col-form-label">Brand Image</label>
                                                <input type="file" name="image" id="image" />
                      <input type="hidden" name="hiddenimage" id="image" value="<?php echo $row_cms['image']; ?>" />
                      <?php if($row_cms['image']!='') { image_size(); ?>
                      <img src="../uploads/brand/<?php echo $row_cms['image'];?>" width="<?php echo $width; ?>100" height="<?php echo $height; ?>" class="alignLeft" />
                      <?php } ?>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-md-12">
                                            
                                                <?php if($row_cms['bestseller'] == 'on'){?>
                                                <input type="checkbox" name="bestseller" checked>
                                                <?php } else{ ?>
                                                <input type="checkbox" name="bestseller">
                                                <?php } ?>
                                                <label for="example-text-input" class="col-form-label">Choose The BestSeller Brand</label>
                                            </div>
                                        </div>
                                        <input type='hidden' name='id' id='id' maxlength="50"   size="30" value="<?php echo $row_cms['id']; ?>"/>
                                        <div class="mt-4"><button type="submit" name="<?php echo $sub ?>" class="btn btn-primary w-md"><?php echo $sub2 ?></button></div>
                                        </form>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            <div class="col-lg-8">
                               
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
                                                <th>Brand ID</th>
                                                <th>Brand Name</th>
                                                <th>Image</th>
                                                <th>Keywords</th>
                                               
                                                <th style="width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
				  
$brnadSQL="select * from brand order by shortorder ASC"; 
 $ResultSQL=mysqli_query($link,$brnadSQL); 
 while($Listbrand=mysqli_fetch_array($ResultSQL)) { 
?>

<tr>
	<td><div class="form-check text-center font-size-16"><input type="checkbox" name="users[]" value="<?php echo $row_cms["id"]; ?>" /><label class="form-check-label" for="ordercheck1"></label></div></td>
	<td><a href="javascript: void(0);" class="text-dark fw-bold"><?php echo $Listbrand['shortorder'];?></a> </td>
	<td><?php echo $Listbrand['brandname'];?><?php if($Listbrand['bestseller'] == 'on'){?> <span class="badge rounded-pill bg-danger">Bestseller</span><?php }?></td>
	<td><?php if($Listbrand['image']){?><img src="../uploads/brand/<?php echo $Listbrand['image'];?>" width="40"> <?php } ?></td>
	<td><?php echo $Listbrand['seo_keyword'];?></td>
	<td>
    	<a href="brand.php?cms=<?php echo $Listbrand['id'];?>" class="px-3 text-primary"><i class="fa bx bx-edit-alt font-size-18"></i></a>
         <?php if($Listbrand['status']==1){ ?>
                        <span><a href="brand.php?id=<?php echo $Listbrand['id']; ?>" title="Active" class="px-3 text-success"><i class="bx bx-check-square"></i></a></span>
                        <?php } else { ?>
                        <span><a href="brand.php?id1=<?php echo $Listbrand['id']; ?>" title="Inactive" class="px-3 text-muted"><i class="fa fa-ban"></i></a></span>
                        <?php } ?>
        <a href="brand.php?del=<?php echo $Listbrand['id']; ?>" class="px-3 text-danger" onClick="return confirm('Do you really want to remove it?')"><i class="bx bx-trash font-size-18"></i></a>
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
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        
        <!-- /Right-bar -->

        <!-- Right bar overlay-->

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

    </body>
</html>
