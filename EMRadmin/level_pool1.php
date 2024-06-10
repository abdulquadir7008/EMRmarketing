<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

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
} 

if((isset($_GET['level']) && !empty($_GET['level'])))
{
    $isd = $_GET['level'];
    $res=GetUsersIDPool($db,$id,'85.1','pairing_10'); 
    // $res=GetUsersIDPool($db,$ci,$icd,'pairing_10'); 
    // print_r($res);die;
}
else {
    $isd = 1;
    $res=GetUidsSelfPool($db,'85.1','pairing_10');
    // $res1=GetUidsSelfPool($db,$mlmid,$type);
    // print_r($res);die;
}
?>
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Level Wise Pool 1 Team | EMR Marketing</title>
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
                                    <h4 class="mb-0">Level Wise Pool 1 Team </h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                                            <li class="breadcrumb-item active">Level Wise Pool 1 Team </li>
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
                            <div class="col-lg-12">
                                
                                <div class="table-responsive mb-4">
                                    <div class="widget-content widget-content-area">
                                        <form name="LevelFilter" action="" method="get" class="row row-cols-lg-auto align-items-center">
                                            <!-- <div class="col-12 col-lg-4">
                                                <label class="visually-hidden" for="level">Member</label>
                                                <select class = "form-control form-select" name = "level" id = "level" required>
                                                <option value="">Select Member</option>
                                                <?php
                                                    // $id = 1;
                                                    // $sqvvl=mysqli_query($db,"select t1.* from membership t1 where t1.member_id !='85' and (t1.binary_status = 1 OR t1.binary_status = 2  )");
                                                    // while($cffrt = mysqli_fetch_assoc($sqvvl))
                                                    { 
                                                    ?>
                                                    <option value ="<?php echo $cffrt['member_id']; ?>" <?php if($bif === $cffrt['member_id']){echo "selected";} ?>><?php echo $cffrt['fname']." ".$cffrt['lname'];?> ( <?php echo $cffrt['userid'];?> ) </option>
                                                <?php } ?>
                                                </select>
                                            </div> -->
                                            <div class="col-12 col-lg-4">
                                                <label class="visually-hidden" for="level">Level</label>
                                                <select class = "form-control form-select" name = "level" id = "level" required>
                                                    <?php
                                                        for ($re=1; $re < 7; $re++) 
                                                        { 
                                                            $levell = $re;
                                                        ?>
                                                        <option value ="<?php echo $levell; ?>" <?php if($isd == $levell){echo "selected";} ?>><?php echo $levell; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <input type="submit" class="btn btn-info" id="LevelFilter" data-form="LevelFilter" value="Filter"/>
                                            </div>
                                        </form>
                                    </div>
                                    <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th style="width: 20px;">
                                                    <div class="form-check text-center font-size-16">
                                                        <input type="checkbox" class="form-check-input" id="ordercheck">
                                                        <label class="form-check-label" for="ordercheck"></label>
                                                    </div>
                                                </th>
                                                <th>Sr No</th>
                                                <th>UserID</th>
												<th>Level</th>
                                                <th>Member</th>
                                                <th>Income</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count = 0;
                                        // if($icd != '0'){
                                        // for ($ci=1; $ci < 7; $ci++) { 
                                        if((isset($_GET['level']) && !empty($_GET['level'])))
                                        {
                                            $id = $_GET['level'];
                                            $res=GetUsersIDPool($db,$id,'85.1','pairing_10'); 
                                        }
                                        else {
                                            $id = 1;
                                            $res=GetUidsSelfPool($db,'85.1','pairing_10');
                                        }
                                        foreach ($res as $key => $val) 
                                        { 
                                            // $sql=mysqli_query($db,"select t1.* from child_counter_10 t1 where t1.uid='$icd'");
                                            // $row1 = mysqli_fetch_assoc($sql);
                                            // $res=GetUsersIDPool($db,$ci,$icd,'pairing_10'); 
                                            $count = count($res); 
                                            $decimalNumber = $val;
                                            $integerPart = floor($decimalNumber);
                                            $tr=mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `membership` WHERE `member_id`='$integerPart' "));
                                        ?>
                                        
                                        <tr>
                                            <td><div class="form-check text-center font-size-16"><input type="checkbox" name="users[]" value="<?php echo $row_cms["id"]; ?>" /><label class="form-check-label" for="ordercheck1"></label></div></td>
                                            <td><?php echo $ci;?> </td>
                                            <td><?php echo $tr['userid'];?> ( <?php echo $tr['fname']." ".$tr['lname'];?> )</td>
                                            <td><?php echo $id;?></td>
                                            <td><?php echo $count;?></td>
                                            <td><?php if($id == 1){echo $amt = "4";}elseif($id == 2){echo $amt = "8";}elseif($id == 3){echo $amt = "16";}elseif($id == 4){echo $amt = "16";}elseif($id == 5){echo $amt = "32";}elseif($id == 6){echo $amt = "128";}?> </td>
                                            <td><?php $slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `robotic_income` WHERE `uid`='$integerPart' and `fuid`='$row1[id]' and `amount` = '$amt'"));
                                            if(($slot_count) >0)
                                            { 
                                                echo "Completed";
                                            }
                                            else { echo "Not-Completed";
                                            }?></td>
                                        </tr>
                                        <?php }
                                        //} ?>
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
<?php

                                                                    
    function GetUsersIDSelfPool($db,$level,$mlmid,$type)

    {

        $res1=GetUidsSelfPool($db,$mlmid,$type);

        if($level==1)

        {

            $res=$res1;

        }

        if($level==2)

        {

            $res=getSelfLevelPool2($db,$res1,$type);

        }

        if($level==3)

        {

            $res=getSelfLevelPool3($db,$res1,$type);

        }

        if($level==4)

        {

            $res=getSelfLevelPool4($db,$res1,$type);

        }

        if($level==5)

        {

            $res=getSelfLevelPool5($db,$res1,$type);

        }

        if($level==6)

        {

            $res=getSelfLevelPool6($db,$res1,$type);

        }

        if($level==7)

        {

            $res=getSelfLevelPool7($db,$res1,$type);

        }

        if($level==8)

        {

            $res=getSelfLevelPool8($db,$res1,$type);

        }

        if($level==9)

        {

            $res=getSelfLevelPool9($db,$res1,$type);

        }

        if($level==10)

        {

            $res=getSelfLevelPool10($db,$res1,$type);

        }

        return $res;

    }


    function GetUidsSelfPool($db,$uid,$type)

    {

        $uids=array();

        $q1 = mysqli_query($db,"select * from `$type` where parent_id = '$uid' and `status` = 0");

        if(mysqli_num_rows($q1)>0)

        {

            while ($q4 = mysqli_fetch_assoc($q1))

            {

                $uid=$q4['uid'];

                $uids[]= $uid;

            }

            return $uids;

            

        }

        else

        {  

            return $uids;

        }

    }

    function getSelfLevelPool2($db,$res,$type)

    {

        $res2=array();

        //echo "<pre>";print_r($res);

        foreach ($res as $key => $value) {

            $res1=GetUidsSelfPool($db,$value,$type);

            if(count($res1) > 0)

            {

                $res2=array_merge($res2,$res1);

            }

        }

        return $res2;

    }

    function getSelfLevelPool3($db,$res_arr,$type)

    {

        $res3=array();

        $res1=getSelfLevelPool2($db,$res_arr,$type);

        //echo "<pre>";print_r($res1);

        foreach($res1 as $key => $value)

        { 

            $res2=GetUidsSelfPool($db,$value,$type);

            // print_r($res2);

            if(count($res2) > 0 && !empty($res2[0]))

            {

                $res3=array_merge($res2,$res3);

                //echo "<pre>";print_r($res3);

            }

        }

        return ($res3);

    }

    function getSelfLevelPool4($db,$res_arr,$type)

    {

        $res3=array();

        $res1=getSelfLevelPool3($db,$res_arr,$type);

        //echo "<pre>";print_r($res1);

        foreach($res1 as $key => $value)

        { 

            $res2=GetUidsSelfPool($db,$value,$type);

            //print_r($res2);

            if(count($res2) > 0 && !empty($res2[0]))

            {

                $res3=array_merge($res2,$res3);

                //echo "<pre>";print_r($res3);

            }

        }

        return ($res3);

    }

    function getSelfLevelPool5($db,$res_arr,$type)

    {

        $res3=array();

        $res1=getSelfLevelPool4($db,$res_arr,$type);

        //echo "<pre>";print_r($res1);

        foreach($res1 as $key => $value)

        { 

            $res2=GetUidsSelfPool($db,$value,$type);

            //print_r($res2);

            if(count($res2) > 0 && !empty($res2[0]))

            {

                $res3=array_merge($res2,$res3);

                //echo "<pre>";print_r($res3);

            }

        }

        return ($res3);

    }

    function getSelfLevelPool6($db,$res_arr,$type)

    {

        $res3=array();

        $res1=getSelfLevelPool5($db,$res_arr,$type);

        //echo "<pre>";print_r($res1);

        foreach($res1 as $key => $value)

        { 

            $res2=GetUidsSelfPool($db,$value,$type);

            //print_r($res2);

            if(count($res2) > 0 && !empty($res2[0]))

            {

                $res3=array_merge($res2,$res3);

                //echo "<pre>";print_r($res3);

            }

        }

        return ($res3);

    }

    function getSelfLevelPool7($db,$res_arr,$type)

    {

        $res3=array();

        $res1=getSelfLevelPool6($db,$res_arr,$type);

        //echo "<pre>";print_r($res1);

        foreach($res1 as $key => $value)

        { 

            $res2=GetUidsSelfPool($db,$value,$type);

            //print_r($res2);

            if(count($res2) > 0 && !empty($res2[0]))

            {

                $res3=array_merge($res2,$res3);

                //echo "<pre>";print_r($res3);

            }

        }

        return ($res3);

    }

    function getSelfLevelPool8($db,$res_arr,$type)

    {

        $res3=array();

        $res1=getSelfLevelPool7($db,$res_arr,$type);

        //echo "<pre>";print_r($res1);

        foreach($res1 as $key => $value)

        { 

            $res2=GetUidsSelfPool($db,$value,$type);

            //print_r($res2);

            if(count($res2) > 0 && !empty($res2[0]))

            {

                $res3=array_merge($res2,$res3);

                //echo "<pre>";print_r($res3);

            }

        }

        return ($res3);

    }

    function getSelfLevelPool9($db,$res_arr,$type)

    {

        $res3=array();

        $res1=getSelfLevelPool8($db,$res_arr,$type);

        //echo "<pre>";print_r($res1);

        foreach($res1 as $key => $value)

        { 

            $res2=GetUidsSelfPool($db,$value,$type);

            //print_r($res2);

            if(count($res2) > 0 && !empty($res2[0]))

            {

                $res3=array_merge($res2,$res3);

                //echo "<pre>";print_r($res3);

            }

        }

        return ($res3);

    }

    function getSelfLevelPool10($db,$res_arr,$type)

    {

        $res3=array();

        $res1=getSelfLevelPool9($db,$res_arr,$type);

        //echo "<pre>";print_r($res1);

        foreach($res1 as $key => $value)

        { 

            $res2=GetUidsSelfPool($db,$value,$type);

            //print_r($res2);

            if(count($res2) > 0 && !empty($res2[0]))

            {

                $res3=array_merge($res2,$res3);

                //echo "<pre>";print_r($res3);

            }

        }

        return ($res3);

    }


?>        
<?php unset($_SESSION['member_id']);?>
    </body>
</html>
<script>
$(document).ready(function(){
    $('#level').change(function(){
        // alert("s");
        var countryId = $(this).val();
        if(countryId){
            $.ajax({
                type:'POST',
                url:'afunction.php', // PHP script to fetch states
                data:{country_id0: countryId},
                success:function(html){
                    $('#level1').html(html);
                }
            });
        }else{
            $('#level1').html('<option value="">Select</option>');
        }
    });
});
</script>
