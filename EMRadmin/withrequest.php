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
        <title>Withdraw Request | EMR Marketing</title>
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
                                    <h4 class="mb-0">Withdraw Request </h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                                            <li class="breadcrumb-item active">Withdraw Request </li>
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
                                                <th>Action</th>
                                                <th>UserID</th>
                                                <th>Amount</th>
                                                <th>TDS (5.25%)</th>
                                                <th>Admin Charge (10%)</th>
                                                <th>Payable Amount</th>
                                                <th>Bank Details</th>
                                                <th>Date</th>
                                               
                                                <!-- <th style="width: 120px;">Action</th> -->
                                            </tr>


                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        $brnadSQL="select t1.*,t1.status as st,t1.date as sdat,t2.* from up_trans_history111 t1 join membership t2 on t2.member_id = t1.uid where t1.status = 0 order by t1.id DESC"; 
                                        $ResultSQL=mysqli_query($link,$brnadSQL); 
                                        while($Listbrand=mysqli_fetch_assoc($ResultSQL)) { 
                                            $brnadd="select t1.*,t1.status as st,t2.kyc_status as kst,t1.date as sdat,t2.* from up_trans_history11 t1 join membership t2 on t2.member_id = t1.uid where t1.uid = $Listbrand[uid] order by t1.id DESC"; 
                                            $Resultd=mysqli_query($link,$brnadd); 
                                            $Listbrad=mysqli_fetch_array($Resultd);
                                            $bank_detail=$Listbrad['acc_name'].", ".$Listbrad['bank']." (AC- ".$Listbrad['acc_num'].")"." (IFSC- ".$Listbrad['ifsc'].")"." (Branch - ".$Listbrad['branch'].")";
                                        ?>

                                        <tr>
                                            <td><div class="form-check text-center font-size-16"><input type="checkbox" name="users[]" value="<?php echo $row_cms["id"]; ?>" /><label class="form-check-label" for="ordercheck1"></label></div></td>
                                            <td><?php echo $i++;?> </td>
                                            <td>
                                                <?php 
                                                    if($Listbrand['st']=='0'){ ?>
                                                        <span class="badge btn btn-primary badge-success ApproveRejTopup11" data-id="<?php echo $Listbrand['id'];?>" data-status="1">Approve</span>
                                                        <a href="app.php?id=<?php echo $Listbrand['id'];?>" class="badge btn btn-primary badge-success"  data-status="1">Approve & Remark</a>
                                                        <span class="badge btn btn-primary badge-danger ApproveRejTopup11" data-id="<?php echo $Listbrand['id'];?>" data-status="2">Reject</span>
                                                    <?php }
                                                    else{echo "Approved";}
                                                ?>
                                            </td>
                                            <td><?php echo $Listbrand['userid'];?> (<?php echo $Listbrand['fname']." ".$Listbrand['lname'];?>)</td>
                                            <td><?php echo $at = $Listbrand['amount'];?> </td>
                                            <td><?php $tds = $at*(5.25)/100; echo number_format($at*(5.25)/100,2);?> </td>
                                            <td><?php $admin = $at*(10)/100; echo number_format($at*(10)/100,2);?> </td>
                                            <td><?php echo $fin = number_format($at-($tds+$admin),2);?> </td>
                                            <td><?php echo $bank_detail;?></td>
                                            <td><?php echo $Listbrand['sdat'];?></td>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="../js/bootstrap-notify-3.1.3/bootstrap-notify.min.js" type="text/javascript"></script>
        <script src="../bootbox.js" ></script>
        <script>
            $("body").on('click', '.ApproveRejTopup11', function()
            {
                $elm=$(this);
                bootbox.confirm({
                    message: "Warning: You are about to Approve/Reject. Continue to Approve/Reject?",
                    buttons: {
                        confirm: {
                            label: 'Yes',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-danger'
                        }
                    },
                    callback: function (result)
                    {
                        if(result == true)
                        {
                            $('.bootbox-confirm').modal('hide');
                            var id = $elm.attr("data-id");
                            var status = $elm.attr("data-status");
                            $elm = $(this);
                            $elm.hide();
                            $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
                            $.ajax({
                                type : 'POST',
                                url : "afunction.php",
                                data :  {
                                    id : id,
                                    status: status,
                                    type : "ApproveRejTopup11"
                                },
                                success : function(data)
                                {
                                    $(".submit-loading").remove();
                                    $elm.show();
                                    var data = jQuery.parseJSON(data);
                                    if(data.valid)
                                    {
                                        $.notify({
                                            message: data.message
                                        },{
                                            allow_dismiss: true,
                                            type: 'success',
                                            placement: {
                                                from: "bottom",
                                                align: "right"
                                            },
                                            offset: 20,
                                            spacing: 10,
                                            z_index: 1000000
                                        });
                                        setTimeout(function(){
                                            location.reload();
                                        }, 3000);
                                        return false;
                                    }
                                    else
                                    {
                                        $.notify({
                                            message: data.message
                                        },{
                                            allow_dismiss: true,
                                            type: 'info',
                                            placement: {
                                                from: "bottom",
                                                align: "right"
                                            },
                                            offset: 20,
                                            spacing: 10,
                                            z_index: 1000000
                                        });
                                        return false;
                                    }
                                    return false;
                                }
                            });
                        }
                    }
                });
            });
        </script>
<?php unset($_SESSION['member_id']);?>
    </body>
</html>
