<?php include('includes/configset.php');
?>
<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Dashboard | EMR</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
		<link rel="icon" href="../favicon.png" sizes="32x32" />
		<link rel="icon" href="../favicon.png" sizes="192x192" />
		<link rel="apple-touch-icon" href="../favicon.png" />
        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/css2.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link href="assets/css/line.css" id="app-style" rel="stylesheet" type="text/css" />

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
                                    <h4 class="mb-0">Dashboard</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Minible</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="total-revenue-chart"></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span class='mibaed'></span><span>
                                                <?php
                                                $SqlDateLogx = "select * from binary_income where uid ='85'";	
                                                $ResuDatLoge = mysqli_query($link,$SqlDateLogx); 
                                                    $Listdatlogd = mysqli_fetch_array($ResuDatLoge);
                                                    
                                                        
                                                       
                                                    //echo $total;
                                                    echo number_format($Listdatlogd['total_left_paid_bvcount'],2, '.', ',');
                                                ?>
                                            </span></h4>
                                            <p class="text-muted mb-0">Binary</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> 

                            <!-- <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="total-revenue-chart"></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span class='mibaed'></span><span>
                                                <?php
                                                $SqlDateLogx = "select * from child_counter where uid ='85'";	
                                                $ResuDatLoge = mysqli_query($link,$SqlDateLogx); 
                                                    $Listdatlogd = mysqli_fetch_array($ResuDatLoge);
                                                    
                                                        
                                                       
                                                    //echo $total;
                                                    echo number_format($Listdatlogd['total_right_paid_bvcount'],2, '.', ',');
                                                ?>
                                            </span></h4>
                                            <p class="text-muted mb-0">Total Right BV</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>  -->

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="total-revenue-chart"></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span class='mibaed'>INR</span><span>
                                                <?php
                                                $SqlDateLog = "select * from datalogs where ship_details!=''";	
                                                $ResuDatLog = mysqli_query($link,$SqlDateLog); 
                                                    while($Listdatlogs = mysqli_fetch_array($ResuDatLog))
                                                    {
                                                        $logID = $Listdatlogs['dil_id'];
                                                    $SQLOrderRevenue = "select * from orderproduct where datalogid='$logID'";	
                                                        $ResultOrderRevenue = mysqli_query($link,$SQLOrderRevenue); 
                                                            while($ListRevenue = mysqli_fetch_array($ResultOrderRevenue))
                                                            {
                                                                $revenuprice .= $ListRevenue['price']."<br>";
                                                                $total = ($total + $revenuprice);
                                                                
                                                            }
                                                            $ordercount = mysqli_num_rows($ResultOrderRevenue);
                                                            $total123 = ($total123 + $ordercount);              
                                                        }
                                                        
                                                       
                                                    //echo $total;
                                                    echo number_format($total,2, '.', ',');
                                                ?>
                                            </span></h4>
                                            <p class="text-muted mb-0">Total Revenue</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">
                                                <?php echo $total123;?>
                                            </span></h4>
                                            <p class="text-muted mb-0">Orders</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="customers-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">
                                                <?php $SQLMemRev = "select * from membership where status='2'";	
                                                        $ResMemlow = mysqli_query($link,$SQLMemRev); 
                                                           echo mysqli_num_rows($ResMemlow);
                                                        ?>

                                            </span></h4>
                                            <p class="text-muted mb-0">Customers</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-6 col-xl-3">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="growth-chart"></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span>
                                                <?php if($total){echo number_format((1 - 500000 / $total) * 100,2, '.', ',');} ?>
                                            
                                            </span>%</h4>
                                            <p class="text-muted mb-0">Growth</p>
                                        </div>
                                        
                                    </div>
                                   
                                                            
                                </div>
                            </div> 

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="">
                                                <?php 
                                                $mwfe = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS main_wallet FROM `code_wallet` WHERE status='0' "));
                                                $add_fe = $mwfe['main_wallet'];
                                                echo number_format($add_fe,2);?>
                                            </span></h4>
                                            <p class="text-muted mb-0">Code Wallet</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> 
							
							<div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="">
                                                <?php 
                                                echo $chs = mysqli_num_rows($db->query("SELECT t2.* FROM `membership` t2 WHERE t2.member_id != '85' "));?>
                                            </span></h4>
                                            <p class="text-muted mb-0">Total Joining</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="">
                                                <?php 
                                                echo $cchs = mysqli_num_rows($db->query("SELECT * FROM `membership`  WHERE member_id != '85' AND (`binary_status` = '1' OR `binary_status` = '2') "));?>
                                            </span></h4>
                                            <p class="text-muted mb-0">Total Activity ID Option</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> 

<?php
                            $tds = $admin = 0;
                            $brnadSQL="select t1.*,t1.status as st,t1.mdate as sdat,t2.* from up_trans_history111 t1 join membership t2 on t2.member_id = t1.uid where t1.status = 1 order by t1.id DESC"; 
                            $ResultSQL=mysqli_query($link,$brnadSQL); 
                            while($Listbrand=mysqli_fetch_assoc($ResultSQL)) { 
                            ?>
                            <?php $at = $Listbrand['amount'];?>
                            <?php $tds += number_format($at*(5.25)/100,2);?>
                            <?php $admin += number_format($at*(10)/100,2);?> 
                            <?php } ?>
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="">
                                                <?php 
                                                echo $tds;
                                                ?> 
                                            </span></h4>
                                            <p class="text-muted mb-0">Total TDS</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="">
                                                <?php 
                                                    echo $admin;
                                                ?> 
                                            </span></h4>
                                            <p class="text-muted mb-0">Total Admin Charges </p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="">
                                                <?php 
                                                echo $chs = mysqli_num_rows($db->query("SELECT t2.* FROM `pairing_10` t2 WHERE t2.uid != '85.1' "));?>
                                            </span></h4>
                                            <p class="text-muted mb-0">Robotic Count </p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> 
							
							<div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="">
                                                <?php  
                    $Mysqlmembership = mysqli_query( $link, "SELECT sum(amount) as total_main_wallet FROM `main_wallet` WHERE status=0" );
                   $listMembers = mysqli_fetch_array( $Mysqlmembership );
					echo number_format($listMembers['total_main_wallet'],2, '.', ',');
												?>
                                            </span></h4>
                                            <p class="text-muted mb-0">Total Main Wallet
												
												<a href="total_main_wallet.php" class="btn btn-primary" style="float: right">View</a>
											</p>
											
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> 
							
							
							<div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="">
                                                <?php  
                    $Mysqlmembership = mysqli_query( $link, "SELECT sum(amount) as total_main_wallet FROM `main_wallet` WHERE status=1" );
                   $listMembers = mysqli_fetch_array( $Mysqlmembership );
					echo number_format($listMembers['total_main_wallet'],2, '.', ',');
												?>
                                            </span></h4>
                                            <p class="text-muted mb-0">Total Withdraw to Main Wallet  <a href="total_withdraw_wallet.php" class="btn btn-primary" style="float: right">View</a></p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> 
							
							
                            <div class="col-md-6 col-xl-3">

                                
                                    <a href="../capping.php" target="_blank" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">Run Capping</a> <br><br>
                                    <a href="../binary.php" target="_blank" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">Run Binary</a>  
                        </div> <!-- end row-->


                        <div class="col-md-6 col-xl-3">
                            <a href="../transfer_daily.php" target="_blank" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">Transfer to Daily Wallet</a><br><br>
                            <a href="../transfer_main.php" target="_blank" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">Transfer to Main Wallet</a> 
                            <?php
                                date_default_timezone_set('Asia/Kolkata'); 
                                $query=mysqli_query($db,"SELECT * FROM `code`  WHERE `status`='0' ORDER BY id DESC");
                                if(mysqli_num_rows($query)>0){
                                    $Listbrand=mysqli_fetch_assoc($query);
                                    $code = $Listbrand['code'];
                                    $f_time = $Listbrand['f_time'];
                                    $t_time = $Listbrand['t_time'];
                                    $date = $Listbrand['date'];
                                    $fromTime = strtotime($Listbrand['f_time']); // Convert from string to timestamp
                                    $toTime = strtotime($Listbrand['t_time']); // Convert from string to timestamp
                                    // Get the current time
                                    $currentTime = time();
                                    $tod = date('Y-m-d');
                                    if ($tod == $date && $currentTime >= $fromTime && $currentTime <= $toTime) {
                                        // echo "Active";
                                    }
                                    elseif ($tod == $date && $currentTime < $fromTime) {
                                        // echo "Pending";
                                    }
                                    elseif ($tod == $date) { ?>
                                        <br><br>
                                        <a href="../transfer_code.php" target="_blank" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">Generate Code Income</a>
                                    <?php }
                                }
                            ?>
                        </div> <!-- end row-->

 <div class="col-md-6 col-xl-3">

                                
                                    <a href="../robotic.php" target="_blank" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">Run Robotic 1</a> <br><br>
                                    <a href="../check_robotic.php" target="_blank" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">Run Robotic 2</a>  
                        </div> <!-- end row-->



                      <div class="row">
                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton5"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <span class="fw-semibold">Sort By:</span> <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton5">
                                                    <a class="dropdown-item" href="#">Monthly</a>
                                                    <a class="dropdown-item" href="#">Yearly</a>
                                                    <a class="dropdown-item" href="#">Weekly</a>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">Sales Analytics</h4>

                                        <div class="mt-1">
                                            <ul class="list-inline main-chart mb-0">
                                                <li class="list-inline-item chart-border-left me-0 border-0">
                                                    <h3 class="text-primary"><span class='mibINR'>INR</span><span data-plugin="counterup">2,371</span><span class="text-muted d-inline-block font-size-15 ms-3">Income</span></h3>
                                                </li>
                                                <li class="list-inline-item chart-border-left me-0">
                                                    <h3><span data-plugin="counterup">258</span><span class="text-muted d-inline-block font-size-15 ms-3">Sales</span>
                                                    </h3>
                                                </li>
                                                <li class="list-inline-item chart-border-left me-0">
                                                    <h3><span data-plugin="counterup">3.6</span>%<span class="text-muted d-inline-block font-size-15 ms-3">Conversation Ratio</span></h3>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="mt-3">
                                            <div id="sales-analytics-chart" class="apex-charts" dir="ltr"></div>
                                        </div>
                                    </div> 
                                </div> 
                            </div> 

                             <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="dropdown">
                                                <a class=" dropdown-toggle" href="#" id="dropdownMenuButton2"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted">All Members<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                                    <a class="dropdown-item" href="#">Locations</a>
                                                    <a class="dropdown-item" href="#">Revenue</a>
                                                    <a class="dropdown-item" href="#">Join Date</a>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">Top Users</h4>

                                        <div data-simplebar style="max-height: 336px;">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-centered table-nowrap">
                                                    <tbody>
														<?php
                    $SQlmembship = "select * from membership where status='2' order by date DESC limit 5";
                    $Mysqlmembership = mysqli_query( $link, $SQlmembship );
                    while ( $listMembers = mysqli_fetch_array( $Mysqlmembership ) ) {
						$customID = $listMembers['email'];
                      ?>
                                                        <tr>
                                                            
                                                            <td>
                                                                <h6 class="font-size-15 mb-1 fw-normal"><?php echo $listMembers['fname']." ". $listMembers['lname'];?></h6>
                                                                <p class="text-muted font-size-13 mb-0"><i class="mdi mdi-map-marker"></i> <?php echo $listMembers['city'];?></p>
                                                            </td>
                                                            <td></td>
                                                            <td class="text-muted fw-semibold text-end"><i class="icon-xs icon me-2 text-success" data-feather="trending-up"></i>
																<?php
                    $SQlmembship1 = "select * from orderproduct where customer_email='$customID'";
                    $Mysqlmembership1 = mysqli_query( $link, $SQlmembship1 );
                    while ( $listMembers1 = mysqli_fetch_array( $Mysqlmembership1 ) ) {
						$subt_user_purchased = ($subt_user_purchased + $listMembers1['price']);
					}
                      ?>
																<?php echo "<span class='mibINR'>INR</span> ".$subt_user_purchased;?>
															
															</td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div> 
                                        </div> 
                                    </div>
                                </div> 
                            </div>
                        </div>
						
						

                        <div class="row">
                            

                            

                            
                        </div>
						
						
						
						
                        <!-- end row -->
<?php if($profile_row['admin_id'] == '1'){ ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Latest Transaction</h4>
                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th style="width: 20px;">
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                                            </div>
                                                        </th>
                                                        <th>Order ID</th>
                                                        <th>Billing Name</th>
                                                        <th>Date</th>
                                                        <th>Total</th>
                                                        <th>Payment Status</th>
                                                        <th>Payment Method</th>
                                                        <th>View Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
													
													<?php
                $ordersql="select * from datalogs LEFT JOIN membership ON datalogs.member_id=membership.member_id order by dil_id DESC limit 8"; 
                $Resultsql=mysqli_query($link,$ordersql); 
                while($Listlog=mysqli_fetch_array($Resultsql)) {
                
                                                
                   
            ?>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td><a href="javascript: void(0);" class="text-body fw-bold">#MI0<?php echo $Listlog['dil_id'];?></a> </td>
                                                        <td><?php echo $Listlog['fname']." ".$Listlog['lname'];?></td>
                                                        <td>
                                                            <?php echo date('d M, Y', strtotime($Listlog['indate']));?>
                                                        </td>
                                                        <td>
                                                            <?php echo "<span class='mibINR'>INR</span> ".number_format($Listlog['total'] / 100,2, '.', ',');?>
                                                        </td>
                                                        <td>
                                                            <?php if($Listlog['success_code']=='PAYMENT_SUCCESS' && $Listlog['payup']=='2'){?>
                                                    <div class="badge bg-pill bg-soft-success font-size-12">Paid</div>
                                                    <?php } else if($Listlog['success_code']=='cashed' && $Listlog['payup']=='2'){?>
                                                    <div class="badge bg-pill bg-soft-success font-size-12">Paid</div>
                                                    <?php } else if($Listlog['success_code']=='bank' && $Listlog['payup']=='3'){?>
                                                    <div class="badge bg-pill bg-soft-success font-size-12">Paid</div>
                                                    <?php }else{ ?>
                                                        <div class="badge bg-pill bg-soft-warning font-size-12">unpaid</div>
                                                        <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if($Listlog['success_code']=='cashed' && $Listlog['payup']=='2')
                                                { echo $Listlog['oder_pending'];}
                                                else if($Listlog['success_code']=='bank' && $Listlog['payup']=='3')
                                                { echo $Listlog['oder_pending'];}
                                                
                                                else if($Listlog['success_code']=='Failed' && $Listlog['payup'] >'0') {
                                                    echo "<span class='text-danger'>".$Listlog['success_code']."</span>";
                                                }
                                                else if($Listlog['success_code'])
                                                {
                                                    echo $Listlog['success_code'];
                                                }
                                                else{echo $Listlog['oder_pending'];}?>
                                                        </td>
                                                        <td>
                                                            <!-- Button trigger modal -->
															<a href="order-details.php?id=<?php echo $Listlog['dil_id'];?>" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">View Details</a>
                                                            
                                                        </td>
                                                    </tr>

                                                 <?php } ?>   

                                                    
                                                    
                                                    
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                </div>
                            </div>
                        </div>
						<?php } ?>
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

        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

        <script src="assets/js/pages/dashboard.init.js"></script>

        <script src="assets/js/app.js"></script>

    </body>

</html>