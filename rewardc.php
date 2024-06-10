
<?php
include_once( 'include/configuration.php' );
ob_start();
$SQLproductDetails = "select * from products where status='1' AND seo_keywords='$productDetailsKey'";
$MySQLProductDetails = mysqli_query($link,$SQLproductDetails); 
$ListproductDetails = mysqli_fetch_array($MySQLProductDetails);
$productDetID = $ListproductDetails['id'];
$setpagename;
$parentcat_keyword;
if(isset($_REQUEST['Uplace'])){
$fname=$_REQUEST['fname'];
$lname=$_REQUEST['lname'];
$phone=$_REQUEST['phone'];
$email=$_REQUEST['email'];
$country=$_REQUEST['country'];
$stree_address=$_REQUEST['stree_address'];
$city=$_REQUEST['city'];
$state=$_REQUEST['state'];
$postalcode=$_REQUEST['postalcode'];
	$password=md5($_REQUEST['password']);
	$queryatleast="update membership SET fname='$fname',lname='$lname', date=now(),email='$email',country='$country',stree_address='$stree_address',city='$city', state='$state',postalcode='$postalcode',password='$password' WHERE member_id=$customeid";
	mysqli_query($link,$queryatleast);
	$errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for profile Update.</div>';
$errflag = true;
$_SESSION['ordererror'] = $errmsg_arr;
session_write_close();
header('Location: ' . $domain_url.'profile/');	
ob_end_flush();
}
if(isset($_GET['level']) && !empty($_GET['level']))
{
    $icd = $_GET['level'];
    // $res=GetUsersIDSelfPool($db,$id,'85','pairing_1');  
}
else {
    $icd = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from big-skins.com/frontend/EMR/html/index-layout-6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Mar 2023 07:02:11 GMT -->
<?php include_once('include/head.php');?>
<style>
    .css-button-shadow-border-sliding--sky {
        min-width: 100px;
        height: 30px;
        color: #fff;
        padding: 5px 10px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        display: inline-block;
        outline: none;
        border-radius: 5px;
        border: none;
        box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5), 7px 7px 20px 0px rgba(0,0,0,.1), 4px 4px 5px 0px rgba(0,0,0,.1);
        background: #4433ff;
        z-index: 1;
    }
    .css-button-shadow-border-sliding--sky:hover:after {
        width: 100%;
        left: 0;
    }
    .css-button-shadow-border-sliding--sky:after {
        border-radius: 5px;
        position: absolute;
        content: "";
        width: 0;
        height: 100%;
        top: 0;
        z-index: -1;
        box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5), 7px 7px 20px 0px rgba(0,0,0,.1), 4px 4px 5px 0px rgba(0,0,0,.1);
        transition: all 0.3s ease;
        background-color: #3a86ff;
        right: 0;
    }
    .css-button-shadow-border-sliding--sky:active {
        top: 2px;
    }
    .css-button-shadow-border-sliding--red {
        min-width: 100px;
        height: 30px;
        color: #fff;
        padding: 5px 10px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        display: inline-block;
        outline: none;
        border-radius: 5px;
        border: none;
        box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5), 7px 7px 20px 0px rgba(0,0,0,.1), 4px 4px 5px 0px rgba(0,0,0,.1);
        background: #d90429;
        z-index: 1;
    }
    .css-button-shadow-border-sliding--red:hover:after {
        width: 100%;
        left: 0;
    }
    .css-button-shadow-border-sliding--red:after {
        border-radius: 5px;
        position: absolute;
        content: "";
        width: 0;
        height: 100%;
        top: 0;
        z-index: -1;
        box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5), 7px 7px 20px 0px rgba(0,0,0,.1), 4px 4px 5px 0px rgba(0,0,0,.1);
        transition: all 0.3s ease;
        background-color: #ef233c;
        right: 0;
    }
    .css-button-shadow-border-sliding--red:active {
        top: 2px;
    }
    .modal-dialog .btn, .modal-dialog input {
        margin-bottom: 0px;
    }
</style>
<body class="boxed">
<!-- Loader -->
<div id="loader-wrapper">
  <div class="cube-wrapper">
    <div class="cube-folding"> <span class="leaf1"></span> <span class="leaf2"></span> <span class="leaf3"></span> <span class="leaf4"></span> </div>
  </div>
</div>
<!-- /Loader -->

<div id="wrapper">

<!-- Page -->
<div class="page-wrapper">
<?php include_once('include/navigation.php');?>
			<main class="page-main">
				<div class="block">
					<div class="container">
						<ul class="breadcrumbs">
							<li><a href="index.html"><i class="icon icon-home"></i></a></li>
							<li>/<span>Rewards</span></li>
						</ul>
					</div>
				</div>
				<div class="container">
					<!-- Two columns -->
					<div class="row row-table">
						<!-- Left column -->
						<div class="col-md-3 filter-col fixed aside">
							<div class="filter-container">
								<div class="fstart"></div>
								<div class="fixed-wrapper">
									<div class="fixed-scroll">
										<div class="filter-col-header">
											<div class="title">Filters</div>
											<a href="#" class="filter-col-toggle"></a>
										</div>
										<div class="filter-col-content">
											<div class="sidebar-block-top">
												<h2>My Account</h2>
												
											</div>
											<div class="sidebar-block collapsed open">
												<div class="block-title">
													<span>My Account</span>
													<div class="toggle-arrow"></div>
												</div>
												<?php include('side.php'); ?>
											</div>
										</div>
									</div>
								</div>
								<div class="fend"></div>
							</div>
						</div>
						<!-- /Left column -->
						<!-- Center column -->
						<div class="col-md-9 aside">
							<!-- Page Title -->
							<div class="page-title">
								<div class="title center">
									<h1>Rewards</h1>
								</div>
							</div>
							<!-- /Page Title -->
							<!-- Categories Info -->
							<div class="info-block">
								<div class="dashboard-detail addres-book">
                                    <h4>Rewards</h4>
                                    <div class="faq-content tab-content" id="top-tabContent">
                                        <div class="tab-pane active" id="orders">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card dashboard-table mt-0">
                                                        <div class="card-body table-responsive-sm" style="padding:0;">
                                                            <table id="example" class="display nowrap" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Sr No</th>
                                                                        <th>Reward Name</th>
                                                                        <th>Unit</th>
                                                                        <th>Pair</th>
                                                                        <th>Cash Price / Other Price</th>
                                                                        <th>Status</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                <?php
                                                            ?>
                                                            <?php
                                                                $i = 1;
                                                                $brnadSQL="select t1.*,t2.status as stt,t2.id as dtt from rewards t1 left join reward_pay t2 on t2.reward_id = t1.id"; 
                                                                $ResultSQL=mysqli_query($link,$brnadSQL); 
                                                                while($Listbrand=mysqli_fetch_array($ResultSQL)) { 
                                                                ?>
                                                                    <tr>
                                                                        <th><?php echo $i++;?> </th>
                                                                        <td><?php echo $Listbrand['reward_name'];?> </td>
                                                                        <td><?php echo $Listbrand['unit'];?> </td>
                                                                        <td><?php echo $Listbrand['pair'];?> </td>
                                                                        <td><?php echo $Listbrand['cash']." / ".$Listbrand['type'];?> </td>
                                                                        <?php
                                                                        if($Listbrand['stt'] == 1){ ?>
                                                                            <td>Completed</td>
                                                                            <td>Paid</td>
                                                                        <?php }
                                                                        else{
                                                                            $dxd52 = mysqli_query($db, "SELECT * FROM `reward_pay` WHERE `reward_id` = '$Listbrand[id]'");
                                                                            $jve15 = $dxd52->num_rows;
                                                                            if($jve15>0)
                                                                            { 
                                                                                $userc04=mysqli_num_rows(mysqli_query($db,"select `uid` from `reward_request` where uid='$customeid' and `reward_id` = '$Listbrand[id]' and `status` = 0"));
                                                                                if($userc04 > 0){ ?>
                                                                                    <td>Completed</td>
                                                                                    <td>Already Requested!</td>
                                                                                <?php }
                                                                                else {
                                                                                ?>
                                                                                <td>Completed</td>
                                                                                <td>
                                                                                    <button class="css-button css-button-shadow-border-sliding css-button-shadow-border-sliding--sky ApplyReward" data-pay="<?php echo $Listbrand['dtt']; ?>" data-uid="<?php echo $customeid; ?>" data-id="<?php echo $Listbrand['id'];?>" data-status="<?php echo $Listbrand['cash'];?>"> Cash </button>
                                                                                    <button class="css-button css-button-shadow-border-sliding css-button-shadow-border-sliding--red ApplyReward" data-uid="<?php echo $customeid; ?>" data-pay="<?php echo $Listbrand['dtt']; ?>" data-id="<?php echo $Listbrand['id'];?>" data-status="<?php echo $Listbrand['type'];?>"> <?php echo $Listbrand['type']; ?> </button>
                                                                                </td>
                                                                            <?php }}
                                                                            else{ ?>
                                                                                <td>Not Completed</td>
                                                                                <td>NA</td>
                                                                            <?php }}
                                                                        ?>
                                                                        
                                                                    </tr>
                                                                <?php } ?>
                                                                </tfoot>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        
                                    </div>
                                    <h4>Rewards History</h4>
                                    <div class="faq-content tab-content" id="top-tabContent">
                                        <div class="tab-pane active" id="orders">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card dashboard-table mt-0">
                                                        <div class="card-body table-responsive-sm" style="padding:0;">
                                                            
                                                            <table id="example" class="display nowrap" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Sr No</th>
                                                                        <th>UserID</th>
                                                                        <th>Reward Name</th>
                                                                        <th>Applied For</th>
                                                                        <th>Date</th>
                                                                        <th>Updated Date</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                <?php
                                                            ?>
                                                            <?php
                                                                $i = 1;
                                                                $brnadSQL="select t1.*,t1.status as st,t1.date as sdat,t2.* from reward_request t1 join membership t2 on t2.member_id = t1.uid where t1.uid='$customeid' order by t1.id DESC"; 
                                                                $ResultSQL=mysqli_query($link,$brnadSQL); 
                                                                while($Listbrand=mysqli_fetch_array($ResultSQL)) { 
                                                                    $tr=mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `rewards` WHERE `id`='$Listbrand[reward_id]' "));
                                                                ?>
                                                                    <tr>
                                                                        <th><?php echo $i++;?> </th>
                                                                        <td><?php echo $Listbrand['userid'];?> (<?php echo $Listbrand['fname']." ".$Listbrand['lname'];?>)</td>
                                                                        <td><?php echo $tr['reward_name'];?> </td>
                                                                        <td><?php echo $Listbrand['reward_type'];?> </td>
                                                                        <td><?php echo $Listbrand['sdat'];?></td>
                                                                        <td><?php echo $Listbrand['mdate'];?></td>
                                                                        <td><?php if($Listbrand['st']=='0'){echo "Pending";}elseif($Listbrand['st']=='2'){echo "Rejected";}else{echo "Approved";}?></td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tfoot>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
							</div>
						</div>
						<!-- /Center column -->
					</div>
					<div class="ymax"></div>
					<!-- /Two columns -->
				</div>
			</main>
			
	
<?php include('include/footer.php');?>
<script>
    $("body").on('click', '.ApplyReward', function()
    {
        $elm=$(this);
        bootbox.confirm({
            message: "Warning: You are about to Apply for Reward. Continue to Apply for Reward?",
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
                    var pay = $elm.attr("data-pay");
                    var uid = $elm.attr("data-uid");
                    var id = $elm.attr("data-id");
                    var status = $elm.attr("data-status");
                    $elm = $(this);
                    $elm.hide();
                    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
                    $.ajax({
                        type : 'POST',
                        url : "EMRadmin/afunction.php",
                        data :  {
                            id : id,
                            uid : uid,
                            pay : pay,
                            status: status,
                            type : "ApplyReward"
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