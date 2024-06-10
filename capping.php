<?php

set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once( 'config.php' );

$message = "";

$url="";

$success = false;

$sql1 = "select t1.* from membership t1 where t1.member_id !='85' and (t1.binary_status = 1 OR t1.binary_status = 2  )";
$q1 = mysqli_query($db,$sql1);
$c1 = mysqli_num_rows($q1);
if($c1>0){
    $k = $l= 0;
    while($r1 = mysqli_fetch_assoc($q1)){
        $uid = $r1['member_id'];
        $rs = GetUids($db,$uid);
        $uidss = implode("','",$rs);
        $tr=mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `child_counter` WHERE `uid`='$uid' "));
        $cur = $tr['self_buss'];
        if($cur == '10000'){

        }
        elseif($cur == '5000'){
            // echo "SELECT * FROM `child_counter` WHERE `uid` IN ('$uidss') and `self_buss` = '1000'";
            $slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `child_counter` WHERE `uid` IN ('$uidss') and `self_buss` = '5000'"));
            if(($slot_count) > 2)
            { 
                // echo $uid;
                // echo "<br>";
                $uq = mysqli_query($db,"UPDATE `child_counter` SET `self_buss`= '10000' where `uid` = '$uid' ");
            }
        }
        elseif($cur == '2500'){
            // echo "SELECT * FROM `child_counter` WHERE `uid` IN ('$uidss') and `self_buss` = '1000'";
            $slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `child_counter` WHERE `uid` IN ('$uidss') and `self_buss` = '2500'"));
            if(($slot_count) > 2)
            { 
                // echo $uid;
                // echo "<br>";
                $uq = mysqli_query($db,"UPDATE `child_counter` SET `self_buss`= '5000' where `uid` = '$uid' ");
            }
        }
        elseif($cur == '1000'){
            // echo "SELECT * FROM `child_counter` WHERE `uid` IN ('$uidss') and `self_buss` = '1000'";
            $slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `child_counter` WHERE `uid` IN ('$uidss') and `self_buss` = '1000'"));
            if(($slot_count) > 2)
            { 
                // echo $uid;
                // echo "<br>";
                $uq = mysqli_query($db,"UPDATE `child_counter` SET `self_buss`= '2500' where `uid` = '$uid' ");
            }
        }
    }
}
$q8d3 = mysqli_query($db,"INSERT INTO `check_cron`(`type`,`date`) VALUES ('Capping',now())");

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
    //echo "\n select * from pairing where sponsor_id = '$uid'";
    $q1 = mysqli_query($db,"select * from pairing where sponsor_id = '$uid'");
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