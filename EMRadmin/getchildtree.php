<?php
session_start();
$mlmid = 85;
include('includes/configset.php');


list( $id, $parentid ) = explode("_", $_POST["id"]);

//$q1=mysqli_fetch_assoc(mysqli_query($db,"SELECT t1.*,t2.* from user_id t1 join user_detail t2 on t1.uid = t2.uid and t1.paired = $id"));
$q1 = mysqli_fetch_assoc(mysqli_query($db,
"SELECT t1.binary_status,t1.date as dt,CONCAT(t1.fname,' ', t1.lname) cur_name,t1.member_id,t1.userid,t4.status as sta,t3.*,t3.`paid_direct_child`,t3.`total_direct_count`, t3.`total_left_count`, t3.`total_right_count`,t4.position,CONCAT(t5.fname,' ', t5.lname,' (',t5.userid,')') as sp_name from membership t1 left join child_counter t3 on t1.member_id = t3.uid  join pairing t4 on t1.member_id=t4.uid left join membership t5 on t4.sponsor_id=t5.member_id where t4.uid = '$id'"));
    // "SELECT t1.uid,t1.uname,t1.register_date,t1.paired,t1.status,t1.pin,CONCAT(t2.first_name,' ', t2.last_name) cur_name,t2.gender,t3.*,t3.`paid_direct_child`,t3.`total_direct_count`, t3.`total_left_count`, t3.`total_right_count`,t4.position,CONCAT(t6.first_name,' ', t6.last_name,' (',t5.uname,')') as sp_name from user_id t1 join user_detail t2 on t1.uid = t2.uid left join child_counter t3 on t1.uid = t3.uid  join pairing t4 on t1.uid=t4.uid left join user_id t5 on t4.sponsor_id=t5.uid left join user_detail t6 on t4.sponsor_id=t6.uid where t4.uid = '$id'"));

///mlm parent id paired id
$query1 = mysqli_query($db, "SELECT * FROM pairing WHERE uid = $parentid");
if (mysqli_num_rows($query1) > 0) {
    $r1 = mysqli_fetch_assoc($query1);
    $mlmpair_id = $r1['pair_id']; //mlm parent pair_id
    $q5 = mysqli_fetch_assoc(mysqli_query($db,
        "SELECT * from pairing where uid = $mlmid"));
    $endbacktree = $q5["status"];
} else {
    $q5 = mysqli_fetch_assoc(mysqli_query($db,
        "SELECT * from pairing where uid = $mlmid"));
    $endbacktree = $q5["status"];
    $mlmpair_id = 0;
}

//End of parent pared id

$query = mysqli_query($db,"SELECT t1.*,t3.* from membership t1 left join pairing t3 on t1.member_id=t3.uid WHERE t1.member_id = $parentid");
//echo "SELECT * FROM pairing WHERE pair_id = $parentid";
if (mysqli_num_rows($query) > 0) {
    $r1 = mysqli_fetch_assoc($query);
    $back_id = $r1['member_id'];
    $parent_id = $r1["parent_id"];
    //$query1 = mysqli_query( $db, "SELECT * FROM pairing WHERE uid = $parent_id" );
    //echo "SELECT t1.*,t3.* from membership t1 left join pairing t3 on t1.uid=t3.uid WHERE t1.uid = $parent_id";
    //echo "SELECT t1.*,t3.* from membership t1 left join pairing t3 on t1.uid=t3.uid WHERE t1.uid = $parent_id";
    $query1 = mysqli_query($db,
        "SELECT t1.*,t3.* from membership t1 left join pairing t3 on t1.member_id=t3.uid WHERE t1.member_id = $parent_id");
    if (mysqli_num_rows($query1) > 0) {
        $r2 = mysqli_fetch_assoc($query1);
        $back_id = $r2['member_id'];
        $parent_id = $r2["parent_id"];
    } else {
        $parent_id = $mlmid;
        $back_id = $mlmid;
    }
} else {
    $parent_id = $mlmid;
    $back_id = $mlmid;
}

//echo "MLMID".$mlmid." parent:".$parent_id." Back_id:".$back_id." mypairid:".$mlmpair_id." id:".$id." End tree:".$endbacktree;
?>
<?php
if ($mlmid == $q1['member_id']) {

} else {
    ?>
    <a href="" class=""  onclick= 'return get_child("<?php echo $parentid . "_" . $back_id; ?>")'> <i class="fa fa-arrow-left fa-3x"></i> </a>
<?php }
?>
<?php
$status= 1;
// $lq0 = mysqli_query($db,"SELECT * FROM `topup_history` WHERE `uid` = $id ORDER By `id` DESC limit 1");
// $lebel_0 = mysqli_num_rows($lq0);
// if ($lebel_0 > 0) {
//     $cdmwp = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `topup_history` WHERE `uid` = $id ORDER By `id` DESC limit 1"));
//     $ats = $cdmwp['amount'];
//     if($ats == 10){
//         $unpay = "class = ' alert-success'";
//         $style = "style='background:green;'";
//     }
//     elseif($ats > 50){
//         $unpay = "class = ' alert-success'";
//         $style = "style='background:brown;'";
//     }
//     elseif($ats == 100){
//         $unpay = "class = ' alert-success'";
//         $style = "style='background:yellow;'";
//     }
//     elseif($ats > 500){
//         $unpay = "class = ' alert-success'";
//         $style = "style='background:darkgoldenrod;'";
//     }
//     elseif($ats == 1000){
//         $unpay = "class = ' alert-success'";
//         $style = "style='background:purple;'";
//     }
// }
// else {
    $unpay = "class = ' alert-danger'";
    $style = "style='background:red;'";
// }
// if (empty($q1["pin"])) {
//     $unpay = "class = ' alert-danger'";
//     $style = "style='color:red;'";
// }else {
//     $unpay = "class = ' alert-success'";
//     $style = "style='color:green;'";
// }
if ($q1["sta"] == 0) {
    $onclick = "";
    $nofleft = $nofright = $nofcleg = 0;
} else {

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

$back_id = $id;
$onclick = "";

?>


<ul style='min-width:2000px;' >
    <li id="main_id"  data-id='<?php echo $q1["sta"]; ?>'>
        <a href="javascript:void(0);" class="admin_tree " <?php echo $unpay; ?>>
            <div >
            <?php
                                                        echo "<img src='male1.png' class='user-icon' $stylex>";
                                                        ?>
                <h3><?php echo $q1["userid"]; ?> <br>  <?php echo $q1["cur_name"] ; ?></h3>
                <div class='mypopup mypopup<?php echo $q1["sta"]; ?>'>
                    <div class='col-md-12 plan-info'>
                        <div class='col-md-12 text-left'>
                            Date of Joining : <?php echo modifyDate($q1["dt"],'d/m/Y'); ?><br>
                            Left Team Count : <?php echo $q1["total_left_count"]; ?><br>
                            Right Team Count : <?php echo $q1["total_right_count"]; ?><br>
                            Total Left Business : <?php echo $q1["total_left_paid_bvcount"]; ?><br>
                            Total Right Business : <?php echo $q1["total_right_paid_bvcount"]; ?><br>
                            <!-- Total Current Left Business : <?php echo $q1["left_paid_bvcount"]; ?><br> -->
                            <!-- Total Current Right Business : <?php echo $q1["right_paid_bvcount"]; ?><br> -->
                        </div>
                        <div class='clearfix'></div>
                    </div>

                </div>
            </div>
        </a>
        <?php
        $id = $q1["sta"];
        $back_id = $q1["member_id"];
        $parent_id = $q1["member_id"];

        echo "<ul>";
        $lq1 = mysqli_query($db,
        "SELECT t1.binary_status,t1.date as dt,CONCAT(t1.fname,' ', t1.lname) cur_name,t1.member_id,t1.userid,t4.status as sta,t3.*,t3.`paid_direct_child`,t3.`total_direct_count`, t3.`total_left_count`, t3.`total_right_count`,t4.position,CONCAT(t5.fname,' ', t5.lname,' (',t5.userid,')') as sp_name from membership t1 left join child_counter t3 on t1.member_id = t3.uid  join pairing t4 on t1.member_id=t4.uid left join membership t5 on t4.sponsor_id=t5.member_id where t4.parent_id = '$parent_id' and t1.member_id!=85");
            // "SELECT t1.uid,t1.uname,t1.register_date,t1.paired,t1.pin,t1.status,CONCAT(t2.first_name,' ', t2.last_name) cur_name,t2.gender,t3.*,t3.`paid_direct_child`,t3.`total_direct_count`, t3.`total_left_count`, t3.`total_right_count`,t4.position,CONCAT(t6.first_name,' ', t6.last_name,' (',t5.uname,')') as sp_name from user_id t1 join user_detail t2 on t1.uid = t2.uid left join child_counter t3 on t1.uid = t3.uid  join pairing t4 on t1.uid=t4.uid left join user_id t5 on t4.sponsor_id=t5.uid left join user_detail t6 on t4.sponsor_id=t6.uid where t4.parent_id = '$parent_id' and t1.uid!=1");
        $label_2nd = mysqli_num_rows($lq1);
        if ($label_2nd > 0) {
            $arr1 = array("L" => "", "R" => "");
            //$arr1 = array();
            while ($l1 = mysqli_fetch_assoc($lq1)) {
                $arr1[$l1['position']] = $l1;
            }
            $i = 0;
            foreach ($arr1 as $key => $l1) {
                if (!empty($l1)) {
                    $puname = $l1['userid'];
                    $leftchild_id = $l1["sta"];
                    $npid = $l1["member_id"];
                    // $lq10 = mysqli_query($db,"SELECT * FROM `topup_history` WHERE `uid` = $npid ORDER By `id` DESC limit 1");
                    // $lebel_1 = mysqli_num_rows($lq10);
                    // if ($lebel_1 > 0) {
                    //     $cdmwp1 = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `topup_history` WHERE `uid` = $npid ORDER By `id` DESC limit 1"));
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
                    // if (empty($l1["pin"])) {
                    //     $unpay = "class = ' alert-danger'";
                    //     $style = "style='color:red;'";
                    // } else {
                    //     $unpay = "class = ' alert-success'";
                    //     $style = "style='color:green;'";
                    // }
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
                    if ($l1["sta"] == 0) {
                        $onclick = "";
                        $nofleft = $nofright = $nofcleg = 0;
                        $onclick = "onclick= 'return get_child(\"" . $l1["member_id"] . "_" . $back_id . "\")' ";
                    } else {
                        $onclick = "onclick= 'return get_child(\"" . $l1["member_id"] . "_" . $back_id . "\")' ";
                    }
                    echo "
		                            <li data-id='" . $l1["paired"] . "' >
		                                <a href='javascript:void(0);' " . $onclick . " " . $unpay . ">
		                                    <div class='tree-user'><div " . $unpay . ">
		                                        ";
                                                echo "<img src='male1.png' class='user-icon' $stylex1>";
                    echo "<h4>" . $l1["userid"] . " (" . $key . "-Leg)" . "<br>" . $l1["cur_name"] . "</h4></div>
		                                        <div class='mypopup mypopup" . $l1["paired"] . "'>

		                                        ";
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

                        if (!empty($npid)) {
                            $arr2 = array("L" => "", "R" => "");
                            //$arr1 = array();
                            while ($l = mysqli_fetch_assoc($lq)) {
                                $arr2[$l['position']] = $l;
                            }
                            $i = 0;
                            foreach ($arr2 as $key1 => $l) {
                                if (!empty($l)) {
                                    // if (empty($l["pin"])) {
                                    //     $unpay = "class = ' alert-danger'";
                                    //     $style = "style='color:red;'";
                                    // }  else {
                                    //     $unpay = "class = ' alert-success'";
                                    //     $style = "style='color:green;'";
                                    // }
                                    $npid1 = $l["userid"];
                                    // $lq12 = mysqli_query($db,"SELECT * FROM `topup_history` WHERE `uid` = $npid1 ORDER By `id` DESC limit 1");
                                    // $lebel_2 = mysqli_num_rows($lq12);
                                    // if ($lebel_2 > 0) {
                                    //     $cdmwp2 = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `topup_history` WHERE `uid` = $npid1 ORDER By `id` DESC limit 1"));
                                    //     $ats2 = $cdmwp2['amount'];
                                    //     if($ats2 > 50){
                                    //         $unpay = "class = ' alert-success'";
                                    //         $style = "style='background:green;'";
                                    //     }
                                    // }
                                    // else {
                                        $unpay = "class = ' alert-danger'";
                                        $style = "style='background:red;'";
                                    // }
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
                                    if ($l["sta"] == 0) {
                                        $onclick = "";
                                        $nofleft = $nofright = $nofcleg = 0;
                                        $onclick = "onclick= 'return get_child(\"" . $l["member_id"] . "_" . $back_id . "\")' ";
                                    } else {
                                        $onclick = "onclick= 'return get_child(\"" . $l["member_id"] . "_" . $back_id . "\")' ";
                                    }
                                    echo "
			                                            <li data-id='" . $l["paired"] . "' >
			                                                <a href='javascript:void(0);' " . $onclick . " " . $unpay . ">
			                                                    <div class='tree-user'><div " . $unpay . ">";
                                                                echo "<img src='male1.png' class='user-icon' $stylex2>";
                                    echo "<h4>" . $l["userid"] . " (" . $key1 . "-Leg)" . "<br>" . $l["cur_name"]. "</h4></div>
			                                                        <div class='mypopup mypopup" . $l["paired"] . "'>
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
}
?>