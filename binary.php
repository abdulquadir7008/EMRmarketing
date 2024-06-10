<?php

set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once( 'config.php' );

$message = "";

$url="";

$success = false;

$sql1 = "SELECT t1.left_ccount,t1.self_buss,t1.right_ccount,t1.uid,t1.left_paid_count,t1.right_paid_count,t1.left_paid_bvcount,t1.right_paid_bvcount FROM `child_counter` t1 join membership t4 on t1.uid=t4.member_id  where left_paid_bvcount>0 and right_paid_bvcount>0  and t1.uid != '85'";
$q1 = mysqli_query($db,$sql1);
$c1 = mysqli_num_rows($q1);

if($c1>0){
    $k = $l= 0;
    while($r1 = mysqli_fetch_assoc($q1)){
        $uid = $r1['uid'];
        $isfirstpayout = checkisFirst($db,$uid);
        //echo "<br><br>____________________________________________________<br>";var_dump($isfirstpayout);
        if($isfirstpayout){
            $set_1 = 1;
            $set_2 = 0;
        }else{
            $set_1 = 0;
            $set_2 = 0;
        }
        //$amount = round(((500*$r1["commission"])/100),2);
        /*$left_paid_count = $r1["left_paid_count"];
        $right_paid_count = $r1['right_paid_count'];*/
        $left_paid_count = $r1["left_paid_count"];
        $right_paid_count = $r1['right_paid_count'];
        /*$left_ccount = $r1["left_ccount"];
        $right_ccount = $r1['right_ccount'];*/

        $left_users = GetUserByPos($db,$uid,'L');
        $right_users = GetUserByPos($db,$uid,'R');
        $lc = getGreenId1($db,$left_users);
        $rc = getGreenId1($db,$right_users);
        // print_r($rc);

        $leftcount = $r1["left_paid_bvcount"];
        $rightcount = $r1['right_paid_bvcount'];
        // echo "<br><br><br>".$left_paid_count."_____".$lc."_____".$set_1."________".$right_paid_count."______".$rc."________".$set_2;
        // var_dump(($lc>$set_1 && $rc>$set_2 && $left_paid_count>0 && $right_paid_count>0) || ($lc>$set_2 && $rc>$set_1 && $left_paid_count>0 && $right_paid_count>0));
        if(($lc>$set_1 && $rc>$set_2 ) || ($lc>$set_2 && $rc>$set_1 ))
        // if(($leftcountdd>$set_1 && $rightcount>$set_2) || ($leftcount>$set_2 && $rightcount>$set_1))
        {
            echo ("No of Binary Record Found : $c1");
            $cappingbv = $r1["self_buss"];
            //$capping = round($r1['capping']/BASEBV);
            // $capping = round($r1['capping']);
            if($leftcount >= $rightcount)
            {

                if($set_1==1 && $leftcount==$rightcount){
                    $msg = "Both are equal";
                    /*$lcount = $set_1;
                    $rcount = $set_2;
                    $count = $leftcount-$set_1;*/
                    $lcount = $leftcount-$leftcount;
                    $rcount = $rightcount-$rightcount;
                    $count = $leftcount;

                }else{
                    $msg = "Left is greater";
                    
                    $count =  $rightcount;
                    $lcount = $leftcount - $count;
                    $rcount = $rightcount - $count;
                    //echo $count."______left____".$lcount."______leftcount___".$leftcount;
                }
                //$amountbv = BASEBV*$count;
                $amountbv = $count;
                //$amount = round((($amountbv*$r1["commission"])/100),2);
                $amount = round($amountbv,2);
                //echo "Stage 1 :  LEFT : $lcount RIGHT $rcount Count $count <br>";
                if($amount>$cappingbv){
                    // $count = $capping;
                    $amount = $cappingbv;
                }
                $earn_amount = $amount;
            }
            else
            {
                $msg = "Right is greater";
                $count =  $leftcount;
                $lcount = $leftcount - $count;
                $rcount = $rightcount - $count;
                
                //$amountbv = BASEBV*$count;
                $amountbv = $count;
                //$amount = round((($amountbv*$r1["commission"])/100),2);
                $amount = round($amountbv,2);
                if($amount>$cappingbv){
                    // $count = $capping;
                    $amount = $cappingbv;
                }
                $earn_amount = $amount;
            }
            $add_charge=0;
            $re_charge=0;

            // $earn_amount = ($earn_amount*10)/100;

            $q83 = mysqli_query($db,"INSERT INTO `binary_income`(`uid`,`amount`,`date`) VALUES ($uid,'$earn_amount',now())");

            $sql3 = "UPDATE `child_counter` SET `left_paid_bvcount`= $lcount,`right_paid_bvcount`= $rcount WHERE `uid` = $uid";

            mysqli_query($db,$sql3);



        }else{
            $l++;
        }
    }
}

$q8d3 = mysqli_query($db,"INSERT INTO `check_cron`(`type`,`date`) VALUES ('Binary',now())");

function checkisFirst($db,$uid){
    $q1 = mysqli_num_rows($db->query("SELECT * FROM `binary_income` WHERE `uid`='$uid'"));
    if($q1 > 0){
        $auto = mysqli_fetch_assoc(mysqli_query($db,"SELECT SUM(amount) AS auto_pay FROM `binary_income` WHERE `uid`='$uid' "));
        $auto_pay=isset($auto['auto_pay']) && $auto['auto_pay'] > 0?$auto['auto_pay']:0;
        if($auto_pay>0){
            return false;
        }else{
            return true;
        }
    }
    else{
        return true;
    }
}



function GetUserByPos($db,$sponsor_id,$position)
{
    global $all_user1;
    $all_user1=array();
    $sql=$db->query("select t1.uid from pairing t1 left join membership t2 on t1.parent_id=t2.member_id where t2.member_id='$sponsor_id' and t1.position='$position'");
    if($no=mysqli_num_rows($sql) > 0)
    {
        $r1=mysqli_fetch_assoc($sql);
        $uid=$r1['uid'];
        //$res=GetAllUserPos($db,$uid,$position);
        $res1 = array($uid);
        $res=GetUids($db,$uid);
        if(count($res) > 0)
        {
            $res2=array();
            $res2=getLevelid($db,$res);
            $res1=array_merge($res1,$res2);
        }
        return $res1;
    }
    else
    {
        $new_array = array();
        return $new_array;
    }

}

function getGreenId1($db,$uid_array = array())
{
    global $db;
    $greenid = 0;
    if(!empty($uid_array)){
        if(!empty($uid_array[0])){
            $uids = "'".implode("','",$uid_array)."'";
            $sql1 = "SELECT count(`member_id`) as ucount FROM `membership` WHERE `member_id` IN($uids) AND (`binary_status` = '1' OR `binary_status` = '2')";
            $query1 = $db->query($sql1) or die(mysqli_error($db));
            $row1 = mysqli_fetch_assoc($query1);
            $greenid = $row1['ucount'];
        }
    }
    return $greenid;
}

// function getChildIds($db,$paired,$parent_id)
// {
//     $user_ids=array();
//     $qry1=mysqli_query($db,"select * from user_id where paired=$paired");
//     while ($r1=mysqli_fetch_assoc($qry1))
//     {
//         $user_ids[]=$r1['uid'];
//     }
//     $uids=implode(',', $user_ids);
//     $sql="SELECT t1.*,t2.* from pairing t1 join user_id t2 on t1.uid=t2.uid where t1.parent_id=$parent_id and t1.uid in ($uids)";
//     $qry2=mysqli_query($db,"select * from pairing where parent_id=$parent_id and uid in ($uids)");
// }

$all_user1=array();
function getLevelid($db,$res)
{
    global $all_user1;
    $all_user1=array_merge($all_user1,$res);
    $res1=array();
    //echo "<pre>";print_r($res);
    foreach ($res as $key => $value) {
        //$all_user1[]=$value;
        $res1=GetUids($db,$value);
        if(count($res1) > 0)
        {
            //$all_user1=array_merge($all_user1,$res1);
            getLevelid($db,$res1);
        }
    }
    /*if(!empty($res1))
    {
        getLevelid($db,$res1);
    }*/
    return $all_user1;
}

function GetUids($db,$uid)
{
    $uids=array();
    //echo "\n select * from pairing where parent_id = '$uid'";
    $q1 = mysqli_query($db,"select * from pairing where parent_id = '$uid'");
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
function getLevel2($db,$res)
{
    $res2=array();
    //echo "<pre>";print_r($res);
    foreach ($res as $key => $value) {
        $res1=GetUids($db,$value);
        if(count($res1) > 0)
        {
            $res2=array_merge($res2,$res1);
        }
    }
    return $res2;
}
function getLevel3($db,$res_arr)
{
    $res3=array();
    $res1=getLevel2($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        // print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel4($db,$res_arr)
{
    $res3=array();
    $res1=getLevel3($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel5($db,$res_arr)
{
    $res3=array();
    $res1=getLevel4($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel6($db,$res_arr)
{
    $res3=array();
    $res1=getLevel5($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel7($db,$res_arr)
{
    $res3=array();
    $res1=getLevel6($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel8($db,$res_arr)
{
    $res3=array();
    $res1=getLevel7($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel9($db,$res_arr)
{
    $res3=array();
    $res1=getLevel8($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel10($db,$res_arr)
{
    $res3=array();
    $res1=getLevel9($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel11($db,$res_arr)
{
    $res3=array();
    $res1=getLevel10($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel12($db,$res_arr)
{
    $res3=array();
    $res1=getLevel11($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel13($db,$res_arr)
{
    $res3=array();
    $res1=getLevel12($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel14($db,$res_arr)
{
    $res3=array();
    $res1=getLevel13($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel15($db,$res_arr)
{
    $res3=array();
    $res1=getLevel14($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel16($db,$res_arr)
{
    $res3=array();
    $res1=getLevel15($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel17($db,$res_arr)
{
    $res3=array();
    $res1=getLevel16($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel18($db,$res_arr)
{
    $res3=array();
    $res1=getLevel17($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel19($db,$res_arr)
{
    $res3=array();
    $res1=getLevel18($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function getLevel20($db,$res_arr)
{
    $res3=array();
    $res1=getLevel19($db,$res_arr);
    //echo "<pre>";print_r($res1);
    foreach($res1 as $key => $value)
    { 
        $res2=GetUids($db,$value);
        //print_r($res2);
        if(count($res2) > 0 && !empty($res2[0]))
        {
            $res3=array_merge($res2,$res3);
            //echo "<pre>";print_r($res3);
        }
    }
    return array_unique($res3);
}
function GetUsersID($db,$level,$mlmid)
{
    $res1=GetUids($db,$mlmid);
    if($level==1)
    {
        $res=$res1;
    }
    if($level==2)
    {
        $res=getLevel2($db,$res1);
    }
    if($level==3)
    {
        $res=getLevel3($db,$res1);
    }
    if($level==4)
    {
        $res=getLevel4($db,$res1);
    }
    if($level==5)
    {
        $res=getLevel5($db,$res1);
    }
    if($level==6)
    {
        $res=getLevel6($db,$res1);
    }
    if($level==7)
    {
        $res=getLevel7($db,$res1);
    }
    if($level==8)
    {
        $res=getLevel8($db,$res1);
    }
    if($level==9)
    {
        $res=getLevel9($db,$res1);
    }
    if($level==10)
    {
        $res=getLevel10($db,$res1);
    }
    if($level==11)
    {
        $res=getLevel11($db,$res1);
    }
    if($level==12)
    {
        $res=getLevel12($db,$res1);
    }
    if($level==13)
    {
        $res=getLevel13($db,$res1);
    }
    if($level==14)
    {
        $res=getLevel14($db,$res1);
    }
    if($level==15)
    {
        $res=getLevel15($db,$res1);
    }
    return $res;
}




// $pay2=mysqli_query($db,"INSERT INTO `cron_level`( `date`) VALUES (now())");

echo json_encode(array(

    "valid"=>$success,

    "message" => $message

));

?>