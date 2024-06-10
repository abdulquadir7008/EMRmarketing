<?php include('includes/configset.php');

$page_name=$_REQUEST['page_name'];

$content=$_REQUEST['content'];
$page_id=$_REQUEST['page_id'];
$category=$_REQUEST['category'];
$sidebar=$_REQUEST['sidebar'];
$topbar=$_REQUEST['topbar'];
$footer=$_REQUEST['footer'];
$sortorder=$_REQUEST['sortorder'];
$seokeyword2=$_REQUEST['seo_keyword'];
$seokeyword = str_replace(' ','-',$page_name);
$seokeyword24=str_replace(' ','-',$seokeyword2);
$sekey=mb_strtolower($seokeyword24);
$sekey2=mb_strtolower($seokeyword);
$image=$_REQUEST['image'];
$meta_title=$_REQUEST['meta_title'];
$meta_description=$_REQUEST['meta_description'];
$meta_keywords=$_REQUEST['meta_keywords'];
$shortdescription=$_REQUEST['shortdescription'];
$status=$_REQUEST['status'];
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
$image="../$pathPage".$rand1.$_FILES["image"]["name"];
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

if($_FILES["image2"]["name"]!='')
{
if (($_FILES["image2"]["type"] == "image/gif")
|| ($_FILES["image2"]["type"] == "image/jpeg")
|| ($_FILES["image2"]["type"] == "image/pjpeg")
|| ($_FILES["image2"]["type"] == "image/X-PNG")
|| ($_FILES["image2"]["type"] == "image/PNG")
|| ($_FILES["image2"]["type"] == "image/png")
|| ($_FILES["image2"]["type"] == "image/x-png"))
{
$image2="../$path".$rand1.$_FILES["image2"]["name"];
$image01=$rand1.$_FILES["image2"]["name"];
move_uploaded_file($_FILES["image2"]["tmp_name"],$image2);
}
else
{
$image01='';
}
}

else
{
$image01=$_REQUEST['hiddenimage2'];
}

if(isset($_REQUEST['update']))
{


$query="update cms_pages SET page_name='$page_name',sortorder=$sortorder, seo_keyword='$sekey',content='$content', topbar='$topbar',footer='$footer',sidebar='$sidebar',category='$category' ,meta_title='$meta_title',meta_description='$meta_description',meta_keywords='$meta_keywords',image='$image0' WHERE page_id=$page_id";
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
$query="insert into cms_pages(page_name,sortorder,seo_keyword,content,category,sidebar,topbar,footer,meta_title,meta_description,meta_keywords,status,image) values('$page_name','$sortorder','$sekey2','$content','$category','$sidebar','$topbar','$footer','$meta_title','$meta_description','$meta_keywords','1','$image0')";
mysqli_query($link,$query);

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' Record Add successfully.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
}

else if(isset($_REQUEST['page_id']) || isset($_REQUEST['page_id1']))
{
if(isset($_REQUEST['page_id']))
{
$page_id=$_REQUEST['page_id'];
$status='0';
}
else if(isset($_REQUEST['page_id1']))
{
$page_id=$_REQUEST['page_id1'];	
$status='1';
}
else
{
$status='0';	
}
$query="update cms_pages SET status='$status' WHERE page_id='$page_id'";         
mysqli_query($link,$query);
}
else if(isset($_REQUEST['del']))
{
$id=$_REQUEST['del'];
$query="delete from cms_pages WHERE page_id=$id";
mysqli_query($link,$query);
}

?>
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Page | EMR Marketing</title>
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
                                    <h4 class="mb-0">Page</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                                            <li class="breadcrumb-item active">Page</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                        <div>
                                    <a href="page-form.php"><button type="button" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Add Page</button></a>
                                </div>
                        <?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
foreach($_SESSION['ERRMSG_ARR'] as $msg) {
echo "<div class='pad margin no-print'><div style='margin: 20px !important;' class='alert alert-success alert-dismissible fade show'><i class='fa fa-info'></i><b>Note:</b>" .$msg."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                                                
                                                </button></div></div>";  
}
unset($_SESSION['ERRMSG_ARR']); }?>
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
                                                <th>Product ID</th>
                                                <th>Page Title</th>
                                                <th>Seo Keywords</th>
                                               
                                               
                                                <th style="width: 120px;">Action</th>
                                            </tr>


                                        </thead>
                                        <tbody>
                                        <?php
				  
$brnadSQL="select * from cms_pages where category='' order by sortorder ASC"; 
 $ResultSQL=mysqli_query($link,$brnadSQL); 
 while($Listbrand=mysqli_fetch_array($ResultSQL)) { 
?>

<tr>
	<td><div class="form-check text-center font-size-16"><input type="checkbox" name="users[]" value="<?php echo $Listbrand["page_id"]; ?>" /><label class="form-check-label" for="ordercheck1"></label></div></td>
	<td><a href="javascript: void(0);" class="text-dark fw-bold"><?php echo $Listbrand['sortorder'];?></a> </td>
	<td><?php echo $Listbrand['page_name'];?><br> </td>
    <td><?php echo $Listbrand['seo_keyword'];?><br> </td>
	
	<td>
    	<a href="page-form.php?cms=<?php echo $Listbrand['page_id'];?>" class="px-3 text-primary"><i class="fa bx bx-edit-alt font-size-18"></i></a>
         <?php if($Listbrand['status']==1){ ?>
                        <span><a href="page-manage.php?page_id=<?php echo $Listbrand['page_id']; ?>" title="Active" class="px-3 text-success"><i class="bx bx-check-square"></i></a></span>
                        <?php } else { ?>
                        <span><a href="page-manage.php?page_id1=<?php echo $Listbrand['page_id']; ?>" title="Inactive" class="px-3 text-muted"><i class="fa fa-ban"></i></a></span>
                        <?php } ?>
        <a href="page-manage.php?del=<?php echo $Listbrand['page_id']; ?>" class="px-3 text-danger" onClick="return confirm('Do you really want to remove it?')"><i class="bx bx-trash font-size-18"></i></a>
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

    </body>
</html>
