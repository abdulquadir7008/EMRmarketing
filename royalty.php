<?php

set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once( 'config.php' );
include('include/other_function.php');

$message = "";

$url="";

$success = false;

$pasy2=mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(price) AS total_amount_last_month FROM orderproduct WHERE DATE_FORMAT(date, '%Y-%m') = DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH, '%Y-%m')"));
$pay_amt = $pasy2['total_amount_last_month']*1/100;

$bronze_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `membership` WHERE `rank` = 'Bronze'"));
if($bronze_count > 0){
    $bronze_pay = $pay_amt/$bronze_count;
    $sql1 = "SELECT * FROM `membership` WHERE `rank` = 'Bronze'";
    $q1 = mysqli_query($db,$sql1);
    $c1 = mysqli_num_rows($q1);
    if($c1>0){
        $k = $l= 0;
        while($r1 = mysqli_fetch_assoc($q1)){
            $uid = $r1['member_id'];
            $res = CheckCappingxs($db,$uid);
            if($res == 1){
                $pay2=mysqli_query($db,"INSERT INTO `royalty_income`(`uid`, `amount`, `date`) VALUES ('$uid','$bronze_pay',now())");
            }
        }
    }
}

$silver_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `membership` WHERE `rank` = 'Silver'"));
if($silver_count > 0){
    $bronze_pay = $pay_amt/$silver_count;
    $silver = "SELECT * FROM `membership` WHERE `rank` = 'Silver'";
    $silver1 = mysqli_query($db,$silver);
    $silver11 = mysqli_num_rows($silver1);
    if($silver11>0){
        while($silverr1 = mysqli_fetch_assoc($silver1)){
            $silver_uid = $silverr1['member_id'];
            $silver_res = CheckCappingxs($db,$silver_uid);
            if($silver_res == 1){
                $pay2=mysqli_query($db,"INSERT INTO `royalty_income`(`uid`, `amount`, `date`) VALUES ('$silver_uid','$bronze_pay',now())");
            }
        }
    }
}

$gold_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `membership` WHERE `rank` = 'Gold'"));
if($gold_count > 0){
    $bronze_pay = $pay_amt/$gold_count;
    $gold = "SELECT * FROM `membership` WHERE `rank` = 'Gold'";
    $gold1 = mysqli_query($db,$gold);
    $gold11 = mysqli_num_rows($gold1);
    if($gold11>0){
        while($goldr1 = mysqli_fetch_assoc($gold1)){
            $gold_uid = $goldr1['member_id'];
            $gold_res = CheckCappingxs($db,$gold_uid);
            if($gold_res == 1){
                $pay2=mysqli_query($db,"INSERT INTO `royalty_income`(`uid`, `amount`, `date`) VALUES ('$gold_uid','$bronze_pay',now())");
            }
        }
    }
}

$star_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `membership` WHERE `rank` = 'Star'"));
if($star_count > 0){
    $bronze_pay = $pay_amt/$star_count;
    $star = "SELECT * FROM `membership` WHERE `rank` = 'Star'";
    $star1 = mysqli_query($db,$star);
    $star11 = mysqli_num_rows($star1);
    if($star11>0){
        while($starr1 = mysqli_fetch_assoc($star1)){
            $star_uid = $starr1['member_id'];
            $star_res = CheckCappingxs($db,$star_uid);
            if($star_res == 1){
                $pay2=mysqli_query($db,"INSERT INTO `royalty_income`(`uid`, `amount`, `date`) VALUES ('$star_uid','$bronze_pay',now())");
            }
        }
    }
}

$titan_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `membership` WHERE `rank` = 'Titan'"));
if($titan_count > 0){
    $bronze_pay = $pay_amt/$titan_count;
    $titan = "SELECT * FROM `membership` WHERE `rank` = 'Titan'";
    $titan1 = mysqli_query($db,$titan);
    $titan11 = mysqli_num_rows($titan1);
    if($titan11>0){
        while($titanr1 = mysqli_fetch_assoc($titan1)){
            $titan_uid = $titanr1['member_id'];
            $titan_res = CheckCappingxs($db,$titan_uid);
            if($titan_res == 1){
                $pay2=mysqli_query($db,"INSERT INTO `royalty_income`(`uid`, `amount`, `date`) VALUES ('$titan_uid','$bronze_pay',now())");
            }
        }
    }
}

$ruby_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `membership` WHERE `rank` = 'Ruby'"));
if($ruby_count > 0){
    $bronze_pay = $pay_amt/$ruby_count;
    $ruby = "SELECT * FROM `membership` WHERE `rank` = 'Ruby'";
    $ruby1 = mysqli_query($db,$ruby);
    $ruby11 = mysqli_num_rows($ruby1);
    if($ruby11>0){
        while($rubyr1 = mysqli_fetch_assoc($ruby1)){
            $ruby_uid = $rubyr1['member_id'];
            $ruby_res = CheckCappingxs($db,$ruby_uid);
            if($ruby_res == 1){
                $pay2=mysqli_query($db,"INSERT INTO `royalty_income`(`uid`, `amount`, `date`) VALUES ('$ruby_uid','$bronze_pay',now())");
            }
        }
    }
}

$topaz_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `membership` WHERE `rank` = 'Topaz'"));
if($topaz_count > 0){
    $bronze_pay = $pay_amt/$topaz_count;
    $topaz = "SELECT * FROM `membership` WHERE `rank` = 'Topaz'";
    $topaz1 = mysqli_query($db,$topaz);
    $topaz11 = mysqli_num_rows($topaz1);
    if($topaz11>0){
        while($topazr1 = mysqli_fetch_assoc($topaz1)){
            $topaz_uid = $topazr1['member_id'];
            $topaz_res = CheckCappingxs($db,$topaz_uid);
            if($topaz_res == 1){
                $pay2=mysqli_query($db,"INSERT INTO `royalty_income`(`uid`, `amount`, `date`) VALUES ('$topaz_uid','$bronze_pay',now())");
            }
        }
    }
}

$baron_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `membership` WHERE `rank` = 'Baron'"));
if($baron_count > 0){
    $bronze_pay = $pay_amt/$baron_count;
    $baron = "SELECT * FROM `membership` WHERE `rank` = 'Baron'";
    $baron1 = mysqli_query($db,$baron);
    $baron11 = mysqli_num_rows($baron1);
    if($baron11>0){
        while($baronr1 = mysqli_fetch_assoc($baron1)){
            $baron_uid = $baronr1['member_id'];
            $baron_res = CheckCappingxs($db,$baron_uid);
            if($baron_res == 1){
                $pay2=mysqli_query($db,"INSERT INTO `royalty_income`(`uid`, `amount`, `date`) VALUES ('$baron_uid','$bronze_pay',now())");
            }
        }
    }
}

$crown_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `membership` WHERE `rank` = 'Crown'"));
if($crown_count > 0){
    $bronze_pay = $pay_amt/$crown_count;
    $crown = "SELECT * FROM `membership` WHERE `rank` = 'Crown'";
    $crown1 = mysqli_query($db,$crown);
    $crown11 = mysqli_num_rows($crown1);
    if($crown11>0){
        while($crownr1 = mysqli_fetch_assoc($crown1)){
            $crown_uid = $crownr1['member_id'];
            $crown_res = CheckCappingxs($db,$crown_uid);
            if($crown_res == 1){
                $pay2=mysqli_query($db,"INSERT INTO `royalty_income`(`uid`, `amount`, `date`) VALUES ('$crown_uid','$bronze_pay',now())");
            }
        }
    }
}

$q8d3 = mysqli_query($db,"INSERT INTO `check_cron`(`type`,`date`) VALUES ('Royalty',now())");

echo json_encode(array(

    "valid"=>$success,

    "message" => $message

));

function CheckCappingxs($db,$uid){
    if($uid != 85){
        $booster = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS booster_pay FROM `royalty_income` WHERE `uid`='$uid'  "));
        $royalty_income=isset($booster['booster_pay']) && $booster['booster_pay'] > 0?$booster['booster_pay']:0;

        $cdmwp = mysqli_fetch_assoc(mysqli_query($db,"SELECT `rank_capping` FROM `membership` WHERE `member_id` = $uid"));
        $rank_capping = $cdmwp['rank_capping'];
        $total_cal = ($royalty_income);
        if($rank_capping > $total_cal){
            $status = 1;
        }
        else {
            $status = 0;
        }
    }
    else {
        $status = 1;
    }
    return $status;
}

?>