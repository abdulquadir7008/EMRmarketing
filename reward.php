<?php

set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once( 'config.php' );

$message = "";

$url="";

$success = false;

$sql1 = "SELECT t1.left_ccount,t1.self_buss,t1.right_ccount,t1.uid,t1.left_paid_count,t1.right_paid_count,t1.total_left_paid_bvcount,t1.total_right_paid_bvcount FROM `child_counter` t1 join membership t4 on t1.uid=t4.member_id  where total_left_paid_bvcount>0 and total_right_paid_bvcount>0  and t1.uid != '85'";
$q1 = mysqli_query($db,$sql1);
$c1 = mysqli_num_rows($q1);
if($c1>0){
    $k = $l= 0;
    while($r1 = mysqli_fetch_assoc($q1)){
        $uid = $r1['uid'];
        $leftcount = $r1["total_left_paid_bvcount"]/200;
        $rightcount = $r1['total_right_paid_bvcount']/200;
        if($leftcount >= '7230600' && $rightcount >= '7230600'){
            $dxd52 = mysqli_query($db, "SELECT * FROM `reward_pay` WHERE `uid` = '$uid' and `reward_id` = '10'");
            $jve15 = $dxd52->num_rows;
            if($jve15>0)
            {
            }
            else{
                $q83 = mysqli_query($db,"INSERT INTO `reward_pay`(`uid`,`reward_id`,`date`) VALUES ($uid,'10',now())");
            }
        }
        elseif(($leftcount >= '2230600' && $leftcount < '7230600') && ($rightcount >= '2230600' && $rightcount < '7230600')){
            $dxd52 = mysqli_query($db, "SELECT * FROM `reward_pay` WHERE `uid` = '$uid' and `reward_id` = '9'");
            $jve15 = $dxd52->num_rows;
            if($jve15>0)
            {
            }
            else{
                $q83 = mysqli_query($db,"INSERT INTO `reward_pay`(`uid`,`reward_id`,`date`) VALUES ($uid,'9',now())");
            }
        }
        elseif(($leftcount >= '730600' && $leftcount < '2230600') && ($rightcount >= '730600' && $rightcount < '2230600')){
            $dxd52 = mysqli_query($db, "SELECT * FROM `reward_pay` WHERE `uid` = '$uid' and `reward_id` = '8'");
            $jve15 = $dxd52->num_rows;
            if($jve15>0)
            {
            }
            else{
                $q83 = mysqli_query($db,"INSERT INTO `reward_pay`(`uid`,`reward_id`,`date`) VALUES ($uid,'8',now())");
            }
        }
        elseif(($leftcount >= '230600' && $leftcount < '730600') && ($rightcount >= '230600' && $rightcount < '730600')){
            $dxd52 = mysqli_query($db, "SELECT * FROM `reward_pay` WHERE `uid` = '$uid' and `reward_id` = '7'");
            $jve15 = $dxd52->num_rows;
            if($jve15>0)
            {
            }
            else{
                $q83 = mysqli_query($db,"INSERT INTO `reward_pay`(`uid`,`reward_id`,`date`) VALUES ($uid,'7',now())");
            }
        }
        elseif(($leftcount >= '80600' && $leftcount < '230600') && ($rightcount >= '80600' && $rightcount < '230600')){
            $dxd52 = mysqli_query($db, "SELECT * FROM `reward_pay` WHERE `uid` = '$uid' and `reward_id` = '6'");
            $jve15 = $dxd52->num_rows;
            if($jve15>0)
            {
            }
            else{
                $q83 = mysqli_query($db,"INSERT INTO `reward_pay`(`uid`,`reward_id`,`date`) VALUES ($uid,'6',now())");
            }
        }
        elseif(($leftcount >= '26600' && $leftcount < '80600') && ($rightcount >= '26600' && $rightcount < '80600')){
            $dxd52 = mysqli_query($db, "SELECT * FROM `reward_pay` WHERE `uid` = '$uid' and `reward_id` = '5'");
            $jve15 = $dxd52->num_rows;
            if($jve15>0)
            {
            }
            else{
                $q83 = mysqli_query($db,"INSERT INTO `reward_pay`(`uid`,`reward_id`,`date`) VALUES ($uid,'5',now())");
            }
        }
        elseif(($leftcount >= '8600' && $leftcount < '26600') && ($rightcount >= '8600' && $rightcount < '26600')){
            $dxd52 = mysqli_query($db, "SELECT * FROM `reward_pay` WHERE `uid` = '$uid' and `reward_id` = '4'");
            $jve15 = $dxd52->num_rows;
            if($jve15>0)
            {
            }
            else{
                $q83 = mysqli_query($db,"INSERT INTO `reward_pay`(`uid`,`reward_id`,`date`) VALUES ($uid,'4',now())");
            }
        }
        elseif(($leftcount >= '2600' && $leftcount < '8600') && ($rightcount >= '2600' && $rightcount < '8600')){
            $dxd52 = mysqli_query($db, "SELECT * FROM `reward_pay` WHERE `uid` = '$uid' and `reward_id` = '3'");
            $jve15 = $dxd52->num_rows;
            if($jve15>0)
            {
            }
            else{
                $q83 = mysqli_query($db,"INSERT INTO `reward_pay`(`uid`,`reward_id`,`date`) VALUES ($uid,'3',now())");
            }
        }
        elseif(($leftcount >= '600' && $leftcount < '2600') && ($rightcount >= '600' && $rightcount < '2600')){
            $dxd52 = mysqli_query($db, "SELECT * FROM `reward_pay` WHERE `uid` = '$uid' and `reward_id` = '2'");
            $jve15 = $dxd52->num_rows;
            if($jve15>0)
            {
            }
            else{
                $q83 = mysqli_query($db,"INSERT INTO `reward_pay`(`uid`,`reward_id`,`date`) VALUES ($uid,'2',now())");
            }
        }
        elseif(($leftcount >= '100' && $leftcount < '600') && ($rightcount >= '100' && $rightcount < '600')){
            $dxd52 = mysqli_query($db, "SELECT * FROM `reward_pay` WHERE `uid` = '$uid' and `reward_id` = '1'");
            $jve15 = $dxd52->num_rows;
            if($jve15>0)
            {
            }
            else{
                $q83 = mysqli_query($db,"INSERT INTO `reward_pay`(`uid`,`reward_id`,`date`) VALUES ($uid,'1',now())");
            }
        }
    }
}

$q8d3 = mysqli_query($db,"INSERT INTO `check_cron`(`type`,`date`) VALUES ('Rewards',now())");

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

echo json_encode(array(

    "valid"=>$success,

    "message" => $message

));

?>