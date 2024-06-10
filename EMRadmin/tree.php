<link href="treeview.css" rel="stylesheet">
<?php
include('includes/configset.php');

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

if(isset($_REQUEST['update']))
{
$query="update membership SET fname='$fname',lname='$lname',phone='$phone',email='$email',stree_address='$stree_address',city='$city',postalcode='$postalcode',binary_root='$binary_root' WHERE member_id=$id";
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
$query="insert into membership(fname,lname,phone,email,stree_address,city,state,postalcode,status,date,spnoser_id,sponser_status,auto_pool_500,binary_root,password)values('$fname','$lname','$phone','$email','$stree_address','$city','$state','$postalcode','2',now(),'$spnoser_id','yes','Active','$binary_root','$password')"; 
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
} ?>
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Tree | EMR Marketing</title>
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
                                    <h4 class="mb-0">Tree</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                                            <li class="breadcrumb-item active">Tree</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                        <div>
                                    <!-- <a href="userid-form.php"><button type="button" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Add User</button></a> -->
                                </div>
                        <?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
foreach($_SESSION['ERRMSG_ARR'] as $msg) {
echo "<div class='pad margin no-print'><div style='margin: 20px !important;' class='alert alert-success alert-dismissible fade show'><i class='fa fa-info'></i><b>Note:</b>" .$msg."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                                                
                                                </button></div></div>";  
}
unset($_SESSION['ERRMSG_ARR']); }?>
                            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                  <div id="flHorizontalForm" class="col-lg-12 layout-spacing">
                      <div class="statbox widget box box-shadow">
                          <div class="widget-header">                                
                              <div class="row">
                                  <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                      <h4>Genealogy Tree</h4>
                                  </div>
                              </div>
                          </div>
                          <div class="widget-content widget-content-area">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                              <div class="pan-container">
                              <div id='treeview-pan' class='pan-wrap' >
                                    <div class="tree" id="genealogy_id">

                                        <?php
                                        $q1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT t1.binary_status,t1.date as dt,CONCAT(t1.fname,' ', t1.lname) cur_name,t1.member_id,t1.userid,t3.*,t3.`paid_direct_child`,t3.`total_direct_count`, t3.`total_left_count`, t3.`total_right_count` from membership t1  join child_counter t3 on t1.member_id = t3.uid where t1.member_id = 85"));
                                            $lq0 = mysqli_query($db,"SELECT * FROM `pairing` WHERE `uid` = 85 ");
                                            $lebel_0 = mysqli_num_rows($lq0);
                                            if ($lebel_0 > 0) {
                                                $cdmwp = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `pairing` WHERE `uid` = 85 "));
                                                if ($cdmwp["status"] == 0) {
                                                    $onclick = "";
                                                    $nofleft = $nofright = $nofcleg = 0;
                                                } else {
        
                                                }
                                            }
                                            else {
                                                $unpay = "class = ' alert-danger'";
                                                $style = "style='background:red;'";
                                            }
                                            if($q1['binary_status'] == 0){
                                                $stylex = "style='background:red;'";
                                            }
                                            elseif($q1['binary_status'] == 1){
                                                $stylex = "style='background:green;'";
                                            }
                                            elseif($q1['binary_status'] == 2){
                                                $stylex = "style='background:blue'";
                                            }
                                            else{
                                                $stylex = "style='background:red;'";
                                            }
                                        ?>
                                        <ul style='min-width:2000px;' >
                                            <li id="main_id"  data-id='<?php echo $cdmwp["paired"]; ?>'>
                                                <a href="javascript:void(0);" class="admin_tree " <?php echo $unpay; ?>>
                                                    <div >
                                                        
                                                    <?php
                                                        echo "<img src='male1.png' class='user-icon' $stylex";
                                                        ?>
                                                        <h3><?php echo $q1["userid"]; ?> <br>  <?php echo $q1["cur_name"] ; ?></h3>
                                                        <div class='mypopup mypopup<?php echo $q1["paired"]; ?>'>
                                                            <div class='col-md-12 plan-info'>
                                                                <div class='col-md-12 text-left'>
                                                                    Date of Joining : <?php echo modifyDate($q1["dt"],'d/m/Y'); ?><br>
                                                                    Left Team Count : <?php echo $q1["total_left_count"]; ?><br>
                                                                    Right Team Count : <?php echo $q1["total_right_count"]; ?><br>
                                                                    Total Left BV : <?php echo $q1["total_left_paid_bvcount"]; ?><br>
                                                                    Total Right BV : <?php echo $q1["total_right_paid_bvcount"]; ?><br>
                                                                    <!-- Total Current Left Business : <?php echo $q1["left_paid_bvcount"]; ?><br> -->
                                                                    <!-- Total Current Right Business : <?php echo $q1["right_paid_bvcount"]; ?><br> -->
                                                                </div>
                                                                <div class='clearfix'></div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </a>
                                                <?php
                                                $id = $cdmwp["paired"];
                                                $back_id = $q1["member_id"];
                                                $parent_id = $q1["member_id"];

                                                echo "<ul>";
                                                $lq1 = mysqli_query($db,
                                                    "SELECT t1.binary_status,t1.date as dt,CONCAT(t1.fname,' ', t1.lname) cur_name,t1.member_id,t1.userid,t4.status as sta,t3.*,t3.`paid_direct_child`,t3.`total_direct_count`, t3.`total_left_count`, t3.`total_right_count`,t4.position,CONCAT(t5.fname,' ', t5.lname,' (',t5.userid,')') as sp_name from membership t1 left join child_counter t3 on t1.member_id = t3.uid  join pairing t4 on t1.member_id=t4.uid left join membership t5 on t4.sponsor_id=t5.member_id where t4.parent_id = '$parent_id' and t1.member_id!=85");
                                                $label_2nd = mysqli_num_rows($lq1);
                                                if ($label_2nd > 0) {
                                                    $arr1 = array("L" => "", "R" => "");
                                                    //$arr1 = array();
                                                    while ($l1 = mysqli_fetch_assoc($lq1)) {
                                                        $arr1[$l1['position']] = $l1;
                                                    }
                                                    $i = 0;
                                                    foreach ($arr1 as $key => $l1) 
                                                    {
                                                        if (!empty($l1)) 
                                                        {
                                                            $puname = $l1['userid'];
                                                            $leftchild_id = $l1["sta"];
                                                            $npid = $l1["member_id"];
                                                            $status1 = $l1["status"];
                                                            if($l1['binary_status'] == 0){
                                                                $stylex1 = "style='background:red;'";
                                                            }
                                                            elseif($l1['binary_status'] == 1){
                                                                $stylex1 = "style='background:green;'";
                                                            }
                                                            elseif($l1['binary_status'] == 2){
                                                                $stylex1 = "style='background:blue'";
                                                            }
                                                            else{
                                                                $stylex1 = "style='background:red;'";
                                                            }
                                                            //     $lq10 = mysqli_query($db,"SELECT * FROM `topup_history` WHERE `uid` = $npid ORDER By `id` DESC limit 1");
                                                            //   $lebel_1 = mysqli_num_rows($lq10);
                                                            //   if ($lebel_1 > 0) {
                                                            //       $cdmwp0 = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `topup_history` WHERE `uid` = $npid ORDER By `id` DESC limit 1"));
                                                            //       $ats0 = $cdmwp0['amount'];
                                                            //       if($ats0 > 50){
                                                            //           $unpay = "class = ' alert-success'";
                                                            //           $style = "style='background:green;'";
                                                            //       }
                                                            //   }
                                                            //   else {
                                                                  $unpay = "class = ' alert-danger'";
                                                                  $style = "style='background:red;'";
                                                            //   }
                                                                if ($l1["sta"] == 0) {
                                                                    $onclick = "";
                                                                    $nofleft = $nofright = $nofcleg = 0;
                                                                    $onclick = "onclick= 'return get_child(\"" . $l1["member_id"] . "_" . $back_id . "\")' ";
                                                                } else {
                                                                    $onclick = "onclick= 'return get_child(\"" . $l1["member_id"] . "_" . $back_id . "\")' ";
                                                                }
                                                            echo "
                                                                <li data-id='" . $l1["sta"] . "' >
                                                                    <a href='javascript:void(0);' " . $onclick . " " . $unpay . ">
                                                                        <div class='tree-user'><div " . $unpay . ">
                                                                            ";
                                                                        // if ($l1["gender"] == "male") {
                                                                            echo "<img src='male1.png' class='user-icon' $stylex1";
                                                                        // } else if ($l1["gender"] == "female") {
                                                                        //     echo "<img src='" . FEMALEICON . "' class='user-icon'>";
                                                                        // }else{
                                                                        //     echo "<img src='" . OTHERICON . "' class='user-icon'>";
                                                                        // }
                                                                        echo "<h4>" . $l1["userid"] . " (" . $key . "-Leg)" . "<br>" . $l1["cur_name"] . "</h4></div>
                                                                            <div class='mypopup mypopup" . $l1["sta"] . "'>";
                                                                            echo $p2 = getTreePopUp($l1);

                                                                        echo "<div class = 'clearfix'></div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                ";
                                                            $lq = mysqli_query($db,
                                                                "SELECT t1.binary_status,t1.date as dt,CONCAT(t1.fname,' ', t1.lname) cur_name,t1.member_id,t1.userid,t4.status as sta,t3.*,t3.`paid_direct_child`,t3.`total_direct_count`, t3.`total_left_count`, t3.`total_right_count`,t4.position,CONCAT(t5.fname,' ', t5.lname,' (',t5.userid,')') as sp_name from membership t1 left join child_counter t3 on t1.member_id = t3.uid  join pairing t4 on t1.member_id=t4.uid left join membership t5 on t4.sponsor_id=t5.member_id where t4.parent_id = '$npid'");
                                                            $lebel_3rd = mysqli_num_rows($lq);
                                                            if ($lebel_3rd > 0) {
                                                                echo "<ul>";

                                                                if (!empty($npid)) 
                                                                {
                                                                    $arr2 = array("L" => "", "R" => "");
                                                                    //$arr1 = array();
                                                                    while ($l = mysqli_fetch_assoc($lq)) {
                                                                        $arr2[$l['position']] = $l;
                                                                    }
                                                                    $i = 0;
                                                                    foreach ($arr2 as $key1 => $l) 
                                                                    {
                                                                        if (!empty($l)) 
                                                                        {
                                                                            $npid1 = $l["userid"];
                                                                            $status2 = $l["sta"];
                                                                            if($l['binary_status'] == 0){
                                                                                $stylex2 = "style='background:red;'";
                                                                            }
                                                                            elseif($l['binary_status'] == 1){
                                                                                $stylex2 = "style='background:green;'";
                                                                            }
                                                                            elseif($l['binary_status'] == 2){
                                                                                $stylex2 = "style='background:blue'";
                                                                            }
                                                                            else{
                                                                                $stylex2 = "style='background:red;'";
                                                                            }
                                                                            // $lq2 = mysqli_query($db,"SELECT * FROM `topup_history` WHERE `uid` = $npid1 ORDER By `id` DESC limit 1");
                                                                            // $lebel_2 = mysqli_num_rows($lq2);
                                                                            // if ($lebel_2 > 0) {
                                                                            //     $cdmwp1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `topup_history` WHERE `uid` = $npid1 ORDER By `id` DESC limit 1"));
                                                                            //     $ats1 = $cdmwp1['amount'];
                                                                            //     if($ats1 > 50){
                                                                            //         $unpay = "class = ' alert-success'";
                                                                            //         $style = "style='background:green;'";
                                                                            //     }
                                                                            // }
                                                                            // else {
                                                                                $unpay = "class = ' alert-danger'";
                                                                                $style = "style='background:red;'";
                                                                            // }
                                                                            // if (empty($l["pin"])) {
                                                                            //     $unpay = "class = ' alert-danger'";
                                                                            //     $style = "style='color:red;'";
                                                                            // }  else {
                                                                            //     $unpay = "class = ' alert-success'";
                                                                            //     $style = "style='color:green;'";
                                                                            // }
                                                                            if ($l["sta"] == 0) {
                                                                                $onclick = "";
                                                                                $nofleft = $nofright = $nofcleg = 0;
                                                                                $onclick = "onclick= 'return get_child(\"" . $l["member_id"] . "_" . $back_id . "\")' ";
                                                                            } else {
                                                                                $onclick = "onclick= 'return get_child(\"" . $l["member_id"] . "_" . $back_id . "\")' ";
                                                                            }
                                                                            echo "
                                                                            <li data-id='" . $l["sta"] . "' >
                                                                                <a href='javascript:void(0);' " . $onclick . " " . $unpay . ">
                                                                                    <div class='tree-user'><div " . $unpay . ">";
                                                                                // if ($l["gender"] == "male") {
                                                                                    echo "<img src='male1.png' class='user-icon' $stylex2";
                                                                                // } else if ($l["gender"] == "female") {
                                                                                //     echo "<img src='" . FEMALEICON . "' class='user-icon'>";
                                                                                // }else{
                                                                                //     echo "<img src='" . OTHERICON . "' class='user-icon'>";
                                                                                // }
                                                                                echo "<h4>" . $l["userid"] . " (" . $key1 . "-Leg)" . "<br>" . $l["cur_name"]. "</h4></div>
                                                                                        <div class='mypopup mypopup" . $l["sta"] . "'>
                                                                                        ";
                                                                                        echo $p2 = getTreePopUp($l);
                                                                                echo "<div class = 'clearfix'></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            <div class = 'clearfix'></div></li>";
                                                                        }
                                                                        else{
                                                                            echo "<li data-id='' >
                                                                                <a href='#'>
                                                                                    <div class='tree-user'><div>
                                                                                        ";
                                                                                        echo "<img src='images.png' style='height: 40px;border: 2px solid #000000;border-radius: 50%;overflow: hidden;background-color: #fff;'>";
                                                                                    echo "<h4>VACCANT</h4></div>
                                                                                        <div class='mypopup mypopup'>

                                                                                        <div class='col-md-12 '>
                                                                                                    
                                                                                                    <div class='clearfix'></div>
                                                                                                </div>";


                                                                                    echo "<div class = 'clearfix'></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            ";
                                                                        }
                                                                    }
                                                                }
                                                                echo "</ul>";
                                                            }
                                                            echo '<div class="clearfix"></div> </li>';
                                                        }
                                                        else{
                                                            echo "<li data-id='' >
                                                                <a href='#'>
                                                                    <div class='tree-user'><div>
                                                                        ";
                                                                        echo "<img src='images.png' style='height: 40px;border: 2px solid #000000;border-radius: 50%;overflow: hidden;background-color: #fff;'>";
                                                                    echo "<h4>VACCANT</h4></div>
                                                                        <div class='mypopup mypopup'>

                                                                        <div class='col-md-12 '>
                                                                                    
                                                                                    <div class='clearfix'></div>
                                                                                </div>";


                                                                    echo "<div class = 'clearfix'></div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            ";
                                                        }
                                                        $i++;
                                                    }
                                                    echo "</ul>";
                                                }
                                                else{
                                                    echo "<li data-id='' style='margin-left: 50px;'>
                                                        <a href='#'>
                                                            <div class='tree-user'><div>
                                                                ";
                                                                echo "<img src='images.png' style='height: 40px;border: 2px solid #000000;border-radius: 50%;overflow: hidden;background-color: #fff;'>";
                                                            echo "<h4>VACCANT</h4></div>
                                                                <div class='mypopup mypopup'>

                                                                <div class='col-md-12 '>
                                                                            
                                                                            <div class='clearfix'></div>
                                                                        </div>";


                                                            echo "<div class = 'clearfix'></div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    ";
                                                    echo "<li data-id='' >
                                                        <a href='#'>
                                                            <div class='tree-user'><div>
                                                                ";
                                                                echo "<img src='images.png' style='height: 40px;border: 2px solid #000000;border-radius: 50%;overflow: hidden;background-color: #fff;'>";
                                                            echo "<h4>VACCANT</h4></div>
                                                                <div class='mypopup mypopup'>

                                                                <div class='col-md-12 '>
                                                                            
                                                                            <div class='clearfix'></div>
                                                                        </div>";


                                                            echo "<div class = 'clearfix'></div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    ";
                                                }
                                                ?>
                                            </li>
                                        </ul>



                                        <div class='clearfix'></div>
                                    </div>
                                    <div class='clearfix'></div>
                                </div>
                                <div class='clearfix'></div>
                              </div>
                              <div class='clearfix'></div>
                              <div id='tree-loading'>
                                  <h2 style="text-align: center;padding-top: 40px;">LOADING YOUR NETWORK TREE</h2>
                                  <div class='clearfix'></div>
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>
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
        <script src="jquery-2.1.4.min.js"></script>
    <script src="jquery.panzoom.js"></script>
    <script src="jquery.mousewheel.js"></script>
    <script src="treeview.js"></script>
<?php unset($_SESSION['member_id']); function modifyDate($date)
    {
        return date('m/d/Y',strtotime($date));
    }  function getTreePopUp($data){
        $popup = "<div class='col-md-12 plan-info'>
                    <div class='col-md-12 text-left'>                                                     
                        <br>";
            if(isset($data['sp_name'])){
                $popup .= "Sponsor : " . $data['sp_name'] . "<br>";
            }
        
            $popup .= "Date of Joining : " . modifyDate($data["dt"],'d/m/Y') . "<br>
                        
            Left Team Count :  " . $data["total_left_count"] . "<br>
            Right Team Count : " . $data['total_right_count'] . "<br>
            Total Left BV :  " . ($data['total_left_paid_bvcount']) . "<br>
            Total Right BV :  " . ($data['total_right_paid_bvcount']) . "
        </div>                                                                     
        <div class='clearfix'></div>
    </div>";
            return $popup;
    }?>
    </body>
</html>
