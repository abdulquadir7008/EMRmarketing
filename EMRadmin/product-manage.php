<?php
 
include('includes/configset.php');

$title=$_REQUEST['title'];
$sortorder=$_REQUEST['sortorder'];
$id=$_REQUEST['id'];
$date=$_REQUEST['date'];
$status=$_REQUEST['status'];
$brand_id=$_REQUEST['brand_id'];
$seokeyword = str_replace(str_split('&\\/:*?"<>| ()'), '-', $title);
$sekey2=mb_strtolower($seokeyword);
$update_keywords=$_REQUEST['seo_keywords'];
$upkeyword = str_replace(str_split('&\\/:*?"<>| ()'), '-', $update_keywords);
$sekeyup=mb_strtolower($upkeyword);

$qry="SELECT * FROM products WHERE seo_keywords='$sekey2'";
$result=mysqli_query($link,$qry);
if(mysqli_num_rows($result) == 1) {
$sekey2=mb_strtolower($seokeyword."-".$rand1);
}

$price=$_REQUEST['price'];
$sprice=$_REQUEST['sprice'];
$inventory=$_REQUEST['inventory'];
$product_SKU=$_REQUEST['product_SKU'];
$color=$_REQUEST['color'];
$meterial=$_REQUEST['meterial'];
$description=$_REQUEST['description'];
$meta_title=$_REQUEST['meta_title'];
$meta_keywords=$_REQUEST['meta_keywords'];
$meta_description=$_REQUEST['meta_description'];

$topcollection=$_REQUEST['topcollection'];
$new=$_REQUEST['new'];
$feature=$_REQUEST['feature'];
$best=$_REQUEST['best'];
$maincat=$_REQUEST['maincat'];
$colour=$_REQUEST['colour'];

$weight=$_REQUEST['weight'];
$length=$_REQUEST['length'];
$width=$_REQUEST['width'];
$height=$_REQUEST['height'];
$cubicweight=$_REQUEST['cubicweight'];

$addnoteraj=$_REQUEST['addnote'];
$addnote = preg_replace("/'/",'&#39;',$addnoteraj);
$leather = $_REQUEST['leather'];
$product_size=$_REQUEST['product_size'];
$additional=$_REQUEST['additional'];
if(isset($_POST['category_id']))
$category_id=implode(',',$_POST['category_id']);
$group_a = $_POST['group_a'];



$uploads_dir = '../uploads/product/';

$images_name2 ="";
    foreach ($_FILES["image"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["image"]["tmp_name"][$key];
            $name2 = $rand1.$_FILES["image"]["name"][$key];
			$name = $rand1.$_FILES["image"]["name"][$key];
			$images_name21 = str_replace(str_split('&\\/:*?"<>| ()'), '', $name);
            move_uploaded_file($tmp_name, "$uploads_dir/$images_name21");
            $images_name =$images_name.$name.",";
			$images_name2 = str_replace(str_split('&\\/:*?"<>| ()'), '', $images_name);
        }
		else
		{$images_name2=$_REQUEST['hiddenimage'];}
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
$imgey =$rand1.$_FILES["image2"]["name"];
$imgpath = str_replace(str_split('&\\/:*?"<>| ()'), '', $imgey);
$image2="../$product_paath".$imgpath;
$image01=$imgpath;
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



if($_FILES["image3"]["name"]!='')
{
if (($_FILES["image3"]["type"] == "image/gif")
|| ($_FILES["image3"]["type"] == "image/jpeg")
|| ($_FILES["image3"]["type"] == "image/pjpeg")
|| ($_FILES["image3"]["type"] == "image/X-PNG")
|| ($_FILES["image3"]["type"] == "image/PNG")
|| ($_FILES["image3"]["type"] == "image/png")
|| ($_FILES["image3"]["type"] == "image/x-png"))
{
$imgey1 =$rand1.$_FILES["image3"]["name"];
$imgpath1 = str_replace(str_split('&\\/:*?"<>| ()'), '', $imgey1);
$image3="../$product_paath".$imgpath1;
$image03=$imgpath1;
move_uploaded_file($_FILES["image3"]["tmp_name"],$image3);
}
else
{
$image03='';
}
}

else
{
$image03=$_REQUEST['hiddenimage3'];
}



if($_FILES["pattern"]["name"]!='')
{
if (($_FILES["pattern"]["type"] == "image/gif")
|| ($_FILES["pattern"]["type"] == "image/jpeg")
|| ($_FILES["pattern"]["type"] == "image/pjpeg")
|| ($_FILES["pattern"]["type"] == "image/X-PNG")
|| ($_FILES["pattern"]["type"] == "image/PNG")
|| ($_FILES["pattern"]["type"] == "image/png")
|| ($_FILES["pattern"]["type"] == "image/x-png"))
{
$pattern="../$product_paath".$rand1.$_FILES["pattern"]["name"];
$pattern1=$rand1.$_FILES["pattern"]["name"];
move_uploaded_file($_FILES["pattern"]["tmp_name"],$pattern);
}
else
{
$pattern1='';
}
}

else
{
$pattern1=$_REQUEST['hiddenpattern'];
}

if(isset($_REQUEST['update']))
{	
    
$query="update products SET title='$title',seo_keywords='$sekeyup', date=now(),brand_id='$brand_id',category_id='$category_id',price='$price',inventory='$inventory',product_SKU='$product_SKU',sortorder='$sortorder',color='$color',meterial='$meterial',description='$description',meta_title='$meta_title',meta_keywords='$meta_keywords',meta_description='$meta_description',image='$images_name2',image2='$image01',topcollection='$topcollection',new='$new',feature='$feature',best='$best',maincat='$maincat',product_size='$product_size',additional='$additional',sprice='$sprice',weight='$weight',length='$length',width='$width',height='$height',cubicweight='$cubicweight',pattern='$pattern1',addnote='$addnote',leather='$leather',image3='$image03',colour='$colour' WHERE id=$id";
mysqli_query($link,$query);

foreach($_POST['vname'] as $index => $postValues) {
	$vlist = $_POST['vlist'][$index];
	$ider = $_POST['ider'][$index];
$query100="update product_varient SET vname='$postValues',vlist='$vlist' WHERE id=$ider";
 mysqli_query($link,$query100);
}

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' Record modified successfully.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	

}

else if(isset($_REQUEST['add']))
{
$query="insert into products(title,seo_keywords,date,sortorder,status,brand_id,category_id,price,inventory,product_SKU,color,meterial,description,meta_title,meta_keywords,meta_description,image,image2,topcollection,new,feature,best,maincat,product_size,additional,sprice,weight,length,width,height,cubicweight,pattern,addnote,leather,image3,colour) values('$title','$sekey2',now(),'$sortorder','1','$brand_id','$category_id','$price','$inventory','$product_SKU','$color','$meterial','$description','$meta_title','$meta_keywords','$meta_description','$images_name2','$image01','$topcollection','$new','$feature','$best','$maincat','$product_size','$additional','$sprice','$weight','$length','$width','$height','$cubicweight','$pattern1','$addnote','$leather','$image03','$colour')";
mysqli_query($link,$query);

$last_id = mysqli_insert_id($link);
foreach($_POST['group_a'] as $index => $postValues) {
	$vname = $postValues['vname'];
	$vlist = $postValues['vlist'];
  	$query100 = "INSERT INTO product_varient(vname,vlist,v_id) values ('$vname','$vlist','$last_id')";
  mysqli_query($link,$query100);
}

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
$query="update products SET status='$status' WHERE id='$id'";         
mysqli_query($link,$query);
}
else if(isset($_REQUEST['del']))
{
$id=$_REQUEST['del'];
$query="delete from products WHERE id=$id";
mysqli_query($link,$query);
}
mysqli_query($link,"delete from product_varient WHERE v_id='0' or vname=''");
?>
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Product | EMR Marketing</title>
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
                                    <h4 class="mb-0">Product</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                            <li class="breadcrumb-item active">Product</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                        <div>
                        <?php
						if(isset($_POST['category_id']))
							$category_id=implode(',',$_POST['category_id']);
						?>
                        
                                    <a href="product-form.php"><button type="button" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Add Product</button></a>
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
                                                <th>Product Name</th>
                                                <th>Main Category</th>
                                                <th>Sub Category</th>
                                                <th>Brand</th>
                                                <th>Image</th>
                                                <th>Price</th>
                                                <th>Keywords</th>
                                               
                                                <th style="width: 120px;">Action</th>
                                            </tr>


                                        </thead>
                                        <tbody>
                                        <?php
				  
$brnadSQL="select * from products order by id DESC"; 
 $ResultSQL=mysqli_query($link,$brnadSQL); 
 while($Listbrand=mysqli_fetch_array($ResultSQL)) { 
?>

<tr>
	<td><div class="form-check text-center font-size-16"><input type="checkbox" name="users[]" value="<?php echo $row_cms["id"]; ?>" /><label class="form-check-label" for="ordercheck1"></label></div></td>
	<td><a href="javascript: void(0);" class="text-dark fw-bold"><?php echo $Listbrand['sortorder'];?></a> </td>
	<td><?php echo $Listbrand['title'];?><br> 
    <?php if($Listbrand['topcollection'] == 'on'){?><span class="badge rounded-pill bg-danger">Top</span><?php } ?>
    <?php if($Listbrand['new'] == 'on'){?><span class="badge rounded-pill bg-primary">New</span><?php } ?>
    <?php if($Listbrand['feature'] == 'on'){?><span class="badge rounded-pill bg-success">Feature</span><?php } ?>
    <?php if($Listbrand['best'] == 'on'){?><span class="badge rounded-pill bg-info">Sale</span><?php } ?>
    </td>
    <td><?php echo $Listbrand['maincat'];?></td>
    
    <td><?php $CatID = $Listbrand['category_id'];
	 $splittedstring=explode(",",$CatID);
	
	foreach ($splittedstring as  $value) {
		
		$ProdCatSql="select * from category where id='$value'"; 
 $CatResultMysql = mysqli_query($link,$ProdCatSql); 
 $ListCatDet=mysqli_fetch_array($CatResultMysql);
 echo $ListCatDet['title']." ,";
	}

 ?></td>
 
    <td><?php $productID = $Listbrand['brand_id'];
		$ProdBrand="select * from brand where id='$productID'"; 
 $ResBrand=mysqli_query($link,$ProdBrand); 
 while($RowBrand=mysqli_fetch_array($ResBrand)) { echo $RowBrand['brandname'];} ?></td>
 
	<td><?php if($Listbrand['image2']){?><img src="<?php echo "../".$product_paath.$Listbrand['image2'];?>" width="40"> <?php } ?></td>
	<td><?php echo $Listbrand['price'];?></td>
    <td><?php echo $Listbrand['seo_keywords'];?></td>
	<td>
    	<a href="product-form.php?cms=<?php echo $Listbrand['id'];?>" class="px-3 text-primary"><i class="fa bx bx-edit-alt font-size-18"></i></a>
         <?php if($Listbrand['status']==1){ ?>
                        <span><a href="product-manage.php?id=<?php echo $Listbrand['id']; ?>" title="Active" class="px-3 text-success"><i class="bx bx-check-square"></i></a></span>
                        <?php } else { ?>
                        <span><a href="product-manage.php?id1=<?php echo $Listbrand['id']; ?>" title="Inactive" class="px-3 text-muted"><i class="fa fa-ban"></i></a></span>
                        <?php } ?>
        <a href="product-manage.php?del=<?php echo $Listbrand['id']; ?>" class="px-3 text-danger" onClick="return confirm('Do you really want to remove it?')"><i class="bx bx-trash font-size-18"></i></a>
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
