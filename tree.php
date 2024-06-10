<link href="EMRadmin/treeview.css" rel="stylesheet">
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
    $id = $_GET['level'];
    $res=GetUsersIDPool($db,$id,$customeid,'pairing_1'); 
}
?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from big-skins.com/frontend/EMR/html/index-layout-6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Mar 2023 07:02:11 GMT -->
<?php include_once('include/head.php');?>
<style>
    .pan-container {
        display: block !important;
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
							<li>/<span>Tree</span></li>
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
									<h1>Tree</h1>
								</div>
							</div>
							<!-- /Page Title -->
							<!-- Categories Info -->
							<div class="info-block">
								<div class="dashboard-detail addres-book">
                                    <h4>Tree</h4>
                                                  
                                    <div class="faq-content tab-content" id="top-tabContent">  
                                        <div class="tab-pane active" id="orders">
                                            <div class="widget-content widget-content-area">
                                                <div class="pan-container">
                                                    <div id='treeview-pan' class='pan-wrap' >
                                                        <div class="tree" id="genealogy_id">

                                                            <?php
                                                            $q1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT t1.binary_status,t1.date as dt,CONCAT(t1.fname,' ', t1.lname) cur_name,t1.member_id,t1.userid,t3.*,t3.`paid_direct_child`,t3.`total_direct_count`, t3.`total_left_count`, t3.`total_right_count` from membership t1  join child_counter t3 on t1.member_id = t3.uid where t1.member_id = $customeid"));
                                                                $lq0 = mysqli_query($db,"SELECT * FROM `pairing` WHERE `uid` = $customeid ");
                                                                $lebel_0 = mysqli_num_rows($lq0);
                                                                if ($lebel_0 > 0) {
                                                                    $cdmwp = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `pairing` WHERE `uid` = $customeid "));
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
                                                                <li id="main_id"  data-id='<?php echo $cdmwp["status"]; ?>'>
                                                                    <a href="javascript:void(0);" class="admin_tree " >
                                                                        <div >
                                                                            
                                                                        <?php
                                                                            echo "<img src='male1.png' class='user-icon' $stylex>";
                                                                            ?>
                                                                            <h3><?php echo $q1["userid"]; ?> <br>  <?php echo $q1["cur_name"] ; ?></h3>
                                                                            <div class='mypopup mypopup<?php echo $q1["status"]; ?>'>
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
                                                                    $id = $cdmwp["status"];
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
                                                                                // $status1 = $l1["status"];
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
                                                                                                echo "<img src='male1.png' class='user-icon' $stylex1>";
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
                                                                                                        echo "<img src='male1.png' class='user-icon' $stylex2>";
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
                                                                                                            echo "<img src='EMRadmin/images.png' style='height: 40px;border: 2px solid #000000;border-radius: 50%;overflow: hidden;background-color: #fff;'>";
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
                                                                                            echo "<img src='EMRadmin/images.png' style='height: 40px;border: 2px solid #000000;border-radius: 50%;overflow: hidden;background-color: #fff;'>";
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
                                                                                    echo "<img src='EMRadmin/images.png' style='height: 40px;border: 2px solid #000000;border-radius: 50%;overflow: hidden;background-color: #fff;'>";
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
                                                                                    echo "<img src='EMRadmin/images.png' style='height: 40px;border: 2px solid #000000;border-radius: 50%;overflow: hidden;background-color: #fff;'>";
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
			
	
            <script src="EMRadmin/jquery-2.1.4.min.js"></script>
            <script src="EMRadmin/jquery.panzoom.js"></script>
            <script src="EMRadmin/jquery.mousewheel.js"></script>
            <script src="treeview.js"></script>
<?php include('include/footer.php');?>
<?php 
 function modifyDate($date)
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