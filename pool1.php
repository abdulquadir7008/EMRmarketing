
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
    // $res=GetUsersIDSelfPool($db,$id,'85','pairing_10');  
}
else {
    $icd = 0;
}

?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from big-skins.com/frontend/EMR/html/index-layout-6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Mar 2023 07:02:11 GMT -->
<?php include_once('include/head.php');?>

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
							<li>/<span>Pool 1 Team</span></li>
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
									<h1>Pool 1 Team</h1>
								</div>
							</div>
							<!-- /Page Title -->
							<!-- Categories Info -->
							<div class="info-block">
								<div class="dashboard-detail addres-book">
                                    <h4>Pool 1 Team</h4>
                                                  
                                    <div class="faq-content tab-content" id="top-tabContent">  
                                        <div class="tab-pane active" id="orders">
                                            <div class="widget-content widget-content-area">
                                                <form name="LevelFilter" action="" method="get" class="row row-cols-lg-auto align-items-center">
                                                    <div class="row form-row">
                                                        <div class="col-12 col-lg-9">
                                                            <label class="field-label">Select User</label>
                                                            <select class = "form-control form-select" name = "level" id = "level" required>
                                                            <?php
                                                                $sqvvl=mysqli_query($db,"select t1.* from membership t1 where t1.member_id='$customeid'");
                                                                $cffrt = mysqli_fetch_assoc($sqvvl);
                                                                $id = 1;
                                                                $sql=mysqli_query($db,"SELECT t1.*,t1.id as idd
                                                                FROM `child_counter_10` t1 where t1.uid LIKE '$customeid%' ");
                                                                while($row = mysqli_fetch_assoc($sql))
                                                                { 
                                                                ?>
                                                                <option value ="<?php echo $row['uid']; ?>" <?php if($icd === $row['uid']){echo "selected";} ?>><?php echo $cffrt['fname']." ".$cffrt['lname'];?> ( <?php echo $cffrt['userid'];?> ) <?php echo $id++; ?></option>
                                                            <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-lg-3">
                                                            <label for=""><br></label><br>
                                                            <input type="submit" class="btn btn-info" id="LevelFilter" data-form="LevelFilter" value="Filter"/>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card dashboard-table mt-0">
                                                        <div class="card-body table-responsive-sm" style="padding:0;">
                                                            
                                                            <table id="example" class="display nowrap" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Sr No</th>
                                                                        <th>Level</th>
                                                                        <th>Member</th>
                                                                        <th>Income</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                <?php
                                                            
                                                            ?>
                                                            <?php
                                                                $count = 0;
                                                                // $i = 1;
                                                                // $sql=mysqli_query($db,"select t1.*,t2.* from pairing_10 t1 join membership t2 on t2.member_id = t1.uid  where t1.uid='$customeid' and t1.pair_id != 1 ORDER BY t1.pair_id ASC");
                                                                // $row1 = mysqli_fetch_assoc($sql);
                                                                // $pair_id = $row1['pair_id'];
                                                                // if($pair_id != ''){
                                                                // $brnadSQL="select t1.*,t1.date as dt,t2.* from pairing_10 t1 join membership t2 on t2.member_id = t1.uid where t1.pair_id>'$pair_id'"; 
                                                                // $ResultSQL=mysqli_query($link,$brnadSQL); 
                                                                // while($Listbrand=mysqli_fetch_array($ResultSQL)) { 
                                                                if($icd != '0'){
                                                                for ($i=1; $i < 7; $i++) { 
                                                                    $sql=mysqli_query($db,"select t1.* from child_counter_10 t1 where t1.uid='$icd'");
                                                                    $row1 = mysqli_fetch_assoc($sql);
                                                                    $res=GetUsersIDPool($db,$i,$icd,'pairing_10'); 
                                                                    $count = count($res); 
                                                                    $decimalNumber = $icd;
                                                                    $integerPart = floor($decimalNumber);
                                                                ?>
                                                                    <tr>
                                                                        <th><?php echo $i;?> </th>
                                                                        <td><?php echo $i;?></td>
                                                                        <td><?php echo $count;?></td>
                                                                        <td><?php if($i == 1){echo $amt = "4";}elseif($i == 2){echo $amt = "8";}elseif($i == 3){echo $amt = "16";}elseif($i == 4){echo $amt = "16";}elseif($i == 5){echo $amt = "32";}elseif($i == 6){echo $amt = "128";}?> </td>
                                                                        <td><?php $slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `robotic_income` WHERE `uid`='$integerPart' and `fuid`='$row1[id]' and `amount` = '$amt'"));
                                                                        if(($slot_count) >0)
                                                                        { 
                                                                            echo "Completed";
                                                                        }
                                                                        else { echo "Not-Completed";
                                                                        }?></td>
                                                                    </tr>
                                                                    <?php } }?>
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
<?php include('include/footer.php');?>