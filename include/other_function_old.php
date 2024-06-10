<?php



    function AddTopCount($db,$uid,$amount){
        $plan_bv=$amount;
        $r1=mysqli_fetch_assoc(mysqli_query($db,"SELECT `parent_id` FROM pairing  WHERE uid='$uid'"));
        $parent_id=$r1['parent_id'];
        $query=mysqli_query($db,"SELECT * FROM pairing  WHERE uid='$uid'");
        if(mysqli_num_rows($query)>0){
            $row=mysqli_fetch_assoc($query);
            if($row['position']=="L")
            {
                mysqli_query($db,"UPDATE child_counter SET left_paid_bvcount=left_paid_bvcount+$plan_bv,total_left_paid_bvcount=total_left_paid_bvcount+$plan_bv,rewards_left_bvtotal=rewards_left_bvtotal+$plan_bv WHERE uid='$parent_id'");
            }
            else if($row['position']=="R")
            {
                mysqli_query($db,"UPDATE child_counter SET right_paid_bvcount=right_paid_bvcount+$plan_bv,total_right_paid_bvcount=total_right_paid_bvcount+$plan_bv,rewards_right_bvtotal=rewards_right_bvtotal+$plan_bv WHERE uid='$parent_id'");
            }
            if($parent_id!=85){
                AddTopCount($db,$parent_id,$amount);
            }
        }
        return true;
    }

    function CheckGoldBoost($db){
        $level123 = mysqli_query($db,"SELECT `uid` FROM `child_counter_2` where `uid` != 85");
        while($row = mysqli_fetch_assoc($level123)){
            $uid = $row['uid'];
            CheckGoldBoostIDs ($db,$uid);
        }
    }

    function CheckGoldBoostIDs ($db,$uid){
        $maxPower = 1;
        for ($i = 1; $i <= $maxPower; $i++) {
            $currentTerm = pow(3, $i);
            $res=GetUsersIDPool($db,$i,$uid,'pairing_2'); 
            $count = count($res);
            if ($count === 0) {
                // echo "Count is 0. Breaking out of the loop.";
                break; // Break out of the loop if count is 0
            }
            if($count == $currentTerm){
                $amount = 0;
                if($i == 1){
                    $amount = 1500;
                }
                $slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `goldboost_income` WHERE `uid`='$uid' and `amount` = '$amount'"));
                if(($slot_count) >0)
                { 
                }
                else {
                    $pay2=mysqli_query($db,"INSERT INTO `goldboost_income`(`uid`, `amount`, `date`) VALUES ('$uid','$amount',now())");
                }
            }
            unset($count);
            unset($res);
        }
    }

    function CheckDiaBoost($db){
        $level123 = mysqli_query($db,"SELECT `uid` FROM `child_counter_3` where `uid` != 85");
        while($row = mysqli_fetch_assoc($level123)){
            $uid = $row['uid'];
            CheckDiaBoostIDs ($db,$uid);
        }
    }

    function CheckDiaBoostIDs ($db,$uid){
        $maxPower = 1;
        for ($i = 1; $i <= $maxPower; $i++) {
            $currentTerm = pow(3, $i);
            $res=GetUsersIDPool($db,$i,$uid,'pairing_3'); 
            $count = count($res);
            if ($count === 0) {
                // echo "Count is 0. Breaking out of the loop.";
                break; // Break out of the loop if count is 0
            }
            if($count == $currentTerm){
                $amount = 0;
                if($i == 1){
                    $amount = 3000;
                }
                $slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `diaboost_income` WHERE `uid`='$uid' and `amount` = '$amount'"));
                if(($slot_count) >0)
                { 
                }
                else {
                    $pay2=mysqli_query($db,"INSERT INTO `diaboost_income`(`uid`, `amount`, `date`) VALUES ('$uid','$amount',now())");
                }
            }
            unset($count);
            unset($res);
        }
    }

    function CheckBoost1($db,$child,$pair,$cyc){
        $level123 = mysqli_query($db,"SELECT * FROM `$child` where `uid` != 85 and `count` = 5 and `ac` = 0");
        while($row = mysqli_fetch_assoc($level123)){
            $uid = $row['uid'];
            $id = $row['id'];
            $query = $db->query("update `$child` set `ac` = '1' where `id` = '$id'");
            CheckBoost1IDs ($db,$uid,$child,$pair,$cyc);
        }
    }

    function CheckBoost1IDs ($db,$uid,$child,$pair,$cyc){
        $maxPower = 1;
        for ($i = 1; $i <= $maxPower; $i++) {
            $currentTerm = pow(5, $i);
            $res=GetUsersIDPool($db,$i,$uid,$pair); 
            $count = count($res);
            if ($count === 0) {
                break; // Break out of the loop if count is 0
            }
            if($count == $currentTerm){
                $amount = 0;
                if($i == 1){
                    if($cyc == 4){
                        $amount = 400;
                        $amt = $amount/2;
                    }
                    elseif($cyc == 5){
                        $amount = 800;
                        $amt = $amount/2;
                    }
                    elseif($cyc == 6){
                        $amount = 1600;
                        $amt = $amount/2;
                    }
                    elseif($cyc == 7){
                        $amount = 3200;
                        $amt = $amount/2;
                    }
                    elseif($cyc == 8){
                        $amount = 6400;
                        $amt = $amount/2;
                    }
                    elseif($cyc == 9){
                        $amount = 12800;
                        $amt = $amount;
                    }
                    $pay2=mysqli_query($db,"INSERT INTO `boost1_income`(`uid`, `amount`, `date`) VALUES ('$uid','$amt',now())");
                    $type=$cyc+1;
                    $cds = BoostIncome($db,$uid,$type,10,5);
                    $ncyc = $cyc+1;
                    $child = 'child_counter_'.$ncyc;
                    $pair = 'pairing_'.$ncyc;
                    $ts = CheckBoost1($db,$child,$pair,$ncyc);
                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select `sponsor_id` from pairing where uid='$uid'"));
                    $nnparent_id = $nparent_idd['sponsor_id'];
                    $llevel_cycle = 1;
                    SetLevelBoost1($db,$amt,$llevel_cycle,$nnparent_id,$uid);
                }
            }
            unset($count);
            unset($res);
        }
    }

    // function CheckBoost1Pool($db){
    //     $level123 = mysqli_query($db,"SELECT `uid` FROM `child_counter_4` where `uid` != 85 and `count` = 5 and `ac` = 0");
    //     while($row = mysqli_fetch_assoc($level123)){
    //         $uid = $row['uid'];
    //         $query = $db->query("update child_counter_4 set ac = '1' where uid = '$uid'");
    //         CheckBoost1IDs ($db,$uid);
    //     }
    // }

    // function CheckBoost1IDs ($db,$uid){
    //     $maxPower = 1;
    //     // for ($i = 1; $i <= $maxPower; $i++) {
    //         $currentTerm = pow(5, 1);
    //         $res=GetUsersIDPool($db,1,$uid,'pairing_4'); 
    //         $count = count($res);
    //         if($count == $currentTerm){
    //             $amount = 0;
    //             if(1 == 1){
    //                 $amount = 50;
    //                 echo $amount;
    //                 echo $uid;
    //             }
    //             // $slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `selfpool_income` WHERE `uid`='$uid' and `amount` = '$amount'"));
    //             // if(($slot_count) >0)
    //             // { 
    //             // }
    //             // else {
    //             //     $pay2=mysqli_query($db,"INSERT INTO `selfpool_income`(`uid`, `amount`, `date`) VALUES ('$uid','$amount',now())");
                    
    //             //     $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select parent_id from pairing_1 where uid='$uid'"));
    //             //     $nnparent_id = $nparent_idd['parent_id'];
    //             //     $llevel_cycle = 1;
    //             //     SetLevelPayout2($db,$amount,$llevel_cycle,$nnparent_id);
    //             // }
    //         }
    //         unset($count);
    //         unset($res);
    //     // }
    // }

    function CheckSelfPool($db){
        $level123 = mysqli_query($db,"SELECT `uid` FROM `child_counter_1` where `uid` != 85");
        while($row = mysqli_fetch_assoc($level123)){
            $uid = $row['uid'];
            CheckIDs ($db,$uid);
        }
    }

    function CheckIDs ($db,$uid){
        $maxPower = 11;
        for ($i = 1; $i <= $maxPower; $i++) {
            $currentTerm = pow(2, $i);
            $res=GetUsersIDPool($db,$i,$uid,'pairing_1'); 
            $count = count($res);
            if ($count === 0) {
                // echo "Count is 0. Breaking out of the loop.";
                break; // Break out of the loop if count is 0
            }
            if($count == $currentTerm){
                $amount = 0;
                if($i == 1){
                    $amount = 50;
                }
                elseif($i == 2){
                    $amount = 100;
                }
                elseif($i == 3){
                    $amount = 200;
                }
                elseif($i == 4){
                    $amount = 400;
                }
                elseif($i == 5){
                    $amount = 800;
                }
                elseif($i == 6){
                    $amount = 825;
                    $type=1;
                    $cds = BoostIncome($db,$uid,$type,$amount,2);
                }
                elseif($i == 7){
                    $amount = 1275;
                    for ($is=0; $is < 4; $is++) { 
                        $type=1;
                        $cds = BoostIncome($db,$uid,$type,$amount,2);
                    }
                }
                elseif($i == 8){
                    $amount = 2550;
                    for ($is=0; $is < 7; $is++) { 
                        $type=1;
                        $cds = BoostIncome($db,$uid,$type,$amount,2);
                    }
                }
                elseif($i == 9){
                    $amount = 5100;
                    for ($is=0; $is < 13; $is++) { 
                        $type=1;
                        $cds = BoostIncome($db,$uid,$type,$amount,2);
                    }
                }
                elseif($i == 10){
                    $amount = 9025;
                    for ($is=0; $is < 26; $is++) { 
                        $type=1;
                        $cds = BoostIncome($db,$uid,$type,$amount,2);
                    }
                }
                elseif($i == 11){
                    $amount = 19275;
                    for ($is=0; $is < 53; $is++) { 
                        $type=1;
                        $cds = BoostIncome($db,$uid,$type,$amount,2);
                    }
                }
                $slot_count=mysqli_num_rows(mysqli_query($db,"SELECT * FROM `selfpool_income` WHERE `uid`='$uid' and `amount` = '$amount'"));
                if(($slot_count) >0)
                { 
                }
                else {
                    $pay2=mysqli_query($db,"INSERT INTO `selfpool_income`(`uid`, `amount`, `date`) VALUES ('$uid','$amount',now())");
                    
                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select parent_id from pairing_1 where uid='$uid'"));
                    $nnparent_id = $nparent_idd['parent_id'];
                    $llevel_cycle = 1;
                    SetLevelPayout2($db,$amount,$llevel_cycle,$nnparent_id,$uid);
                }
            }
            unset($count);
            unset($res);
        }
    }
    
    function checkSelfChildBo($db,$parent_id,$child_counter,$cgid,$cou){

        //$cgid = array_search ($parent_id, $clist);

        $s1 = "SELECT `lc_count`,`id`,`status` FROM `$child_counter` WHERE `uid` = '$parent_id' and id='$cgid'";

        $q1 = mysqli_query($db,$s1);

        $r1 = mysqli_fetch_assoc($q1);

            $pcount = $r1['lc_count'];

            $cid = $r1['id'];

            $status = $r1['status'];

            //var_dump($r1);die;

            //var_dump($cgid."_____".$cid);

            if($pcount<$cou && $status==0){

                //update parent count

                $ncount = $pcount+1;

                $uq = mysqli_query($db,"UPDATE `$child_counter` SET `count`=`count`+1,`lc_count` = '$ncount' where uid = '$parent_id' and id='$cid' ");

                

                return $parent_id;

            }

        return false;

    }

    function getChildListUIDBo($db,$parent_id,$pairing,$child_counter,$cgid){



        /*$r=mysqli_fetch_assoc(mysqli_query($db,"SELECT `cgid`,`pcgid`,`status` FROM `$pairing` WHERE `uid` = '$parent_id'"));

        $cgid=$r['cgid'];*/

        //$pcgid=$r['pcgid'];



        $s2 = "SELECT uid,cgid FROM `$pairing` WHERE `parent_id` = '$parent_id' and  pcgid='$cgid' ";

        $q2 = mysqli_query($db,$s2);

        $clist = array();

        while($r2 = mysqli_fetch_assoc($q2)){

            $clist[$r2['cgid']] = $r2['uid']; 

        }

        return $clist;

    }



    function getLevelPoolParentIdBo($db,$master_list1,$child_counter,$pairing,$cou){



        $parent_id = array_values($master_list1)[0];

        $cgid = array_search ($parent_id, $master_list1);



        //var_dump($master_list1);
        // print_r($cgid);die;

        $check = checkSelfChildBo($db,$parent_id,$child_counter,$cgid,$cou);

        if($check){

            return $parent_id;

        }else{

            unset($master_list1[$cgid]);

            $clist = getChildListUIDBo($db,$parent_id,$pairing,$child_counter,$cgid);

            //var_dump($clist);

            /*var_dump($master_list1);

            var_dump($clist);*/

            if(count($master_list1) > 0)

            {

                //$master_list1 = array_merge($master_list1,$clist);

                //$master_list1 = $master_list1+$clist;

                foreach ($clist as $k => $v) 

                {

                    if(array_key_exists($k, $master_list1))

                    {}

                    else

                    {

                        $master_list1[$k]=$v;

                    }

                    //$master_list1[$k]=$v;



                }

                

            }

            else

            {

                $master_list1=$clist;

            }

            //echo "__________after merge_________";var_dump($master_list1);

            return getLevelPoolParentIdBo($db,$master_list1,$child_counter,$pairing,$cou);

        }

    }



    function BoostIncome($db,$uid,$type,$amt,$cou)

    {

        $sponsor_id1=85;

        $clist=array('1'=>'85');

        $q0 = mysqli_query($db,"select child_counter,pairing from `cg_circle` where id = '$type' and `level` = 2");



        if(mysqli_num_rows($q0)>0)

        {

            $r0 = mysqli_fetch_assoc($q0);

            $child_counter = $r0["child_counter"];

            $pairing = $r0["pairing"];

            

            $nparent_id = getLevelPoolParentIdBo($db,$clist,$child_counter,$pairing,$cou);

            //var_dump($nparent_id);die();

            $usercpos=0;

            //echo "select cgid from `$pairing` where uid = '$nparent_id' and status=0";

            $ppq1 = mysqli_query($db,"select cgid from `$pairing` where uid = '$nparent_id' and status=0");

            

            $ppr=mysqli_fetch_assoc($ppq1);

            $pcgid=$ppr['cgid'];

            //echo "select cgid from `$pairing` where parent_id = '$nparent_id' and status=0";

            $pp1 = mysqli_query($db,"select cgid from `$pairing` where parent_id = '$nparent_id' and status=0");

            $usercpos = mysqli_num_rows($pp1);

            

            $position = $usercpos +1;



            $res2=UserPairingBo($db,$uid,$nparent_id,$pcgid,$sponsor_id1,$position,$type,$amt);

            // if(isset($nparent_id) && ($nparent_id>1 || $pcgid >1))

            // {

            //     $res1=AddcFirstBo($db,$uid,$nparent_id,$type);

            // }

        }

        return;

    }



    function UserPairingBo($db,$uid,$parent_id,$pcgid,$sponsor_id,$position,$type,$amt)

    {

        $q0 = mysqli_query($db,"select * from `cg_circle` where id = '$type' and `level` = 2");


        if(mysqli_num_rows($q0)>0)

        {

            $r0 = mysqli_fetch_assoc($q0);

            $no_team = 2;

            $level_cycle = 1;

            $child_counter = $r0["child_counter"];

            $pairing = $r0["pairing"]; 

            $amount = ""; 

            $q6 = mysqli_query($db,"INSERT INTO `$child_counter`(`uid`) VALUES ($uid)");

            $cgid=mysqli_insert_id($db);

            $pair=mysqli_query($db,"INSERT INTO `$pairing`(`uid`,`cgid`,`pcgid`, `parent_id`, `sponsor_id`, `position`, `date`) VALUES ('$uid','$cgid','$pcgid','$parent_id','$sponsor_id','$position',now())") or die(mysqli_error($db));

            // echo "UPDATE `$child_counter` SET `count`=`count`+1,`lc_count`=`lc_count`+1 WHERE uid='$parent_id' and id='$pcgid'";
            // $q7 = mysqli_query($db,"UPDATE `$child_counter` SET `count`=`count`+1,`lc_count`=`lc_count`+1 WHERE uid='$parent_id' and id='$pcgid'");
            
            // $s1 = "SELECT `lc_count`,`id`,`status` FROM `$child_counter` WHERE `uid` = '$parent_id' and id='$pcgid'";

            // $q1 = mysqli_query($db,$s1);

            // $r1 = mysqli_fetch_assoc($q1);

            // $pcount = $r1['lc_count'];

            // if($pcount == 3){
            //     $q7 = mysqli_query($db,"UPDATE `$child_counter` SET `status`=1 WHERE uid='$parent_id' and id='$pcgid'");
            // }


            // if($pairing == "pairing_1"){

            //     SetLevelPayout2($db,$amt,$level_cycle,$parent_id);

            // }

            // elseif($pairing == "pairing_1"){

            //     SetLevelPayout2($db,'100',$level_cycle,$parent_id);

            // }

            child_counterBo($db,$parent_id,$child_counter,$pairing,$pcgid);

        }

        else

        {

            return false;

        }



        return;

    }




    function child_counterBo($db,$sponser,$child_counter,$pairing,$cgid)

    {

        global $LevelPercentNo;

        //echo "select * from `$child_counter` where uid = '$sponser' and status=0 and id='$cgid' ";

        $q1 = mysqli_query($db,"select * from `$child_counter` where uid = '$sponser' and status=0 and id='$cgid' ");



        if(mysqli_num_rows($q1)>0)

        {

            $q4 = mysqli_fetch_assoc($q1);

            $sponser = $q4["uid"];

            $cid = $q4["id"];



            //update child_counter_star table

            $totalcount = $q4['totalcount'] + 1;



            $q6 = mysqli_fetch_assoc(mysqli_query($db,"SELECT parent_id,pcgid FROM `$pairing` where uid= '$sponser' and cgid='$cgid'"));



            $pid= $q6['parent_id'];

            $pcgid= $q6['pcgid'];

            $q11 = mysqli_query($db,"UPDATE `$child_counter` SET totalcount = '$totalcount' where uid = $sponser and id=$cid");

            if($sponser==1)

            {

                return false;

            }

            else

            {

                child_counterBo($db,$pid,$child_counter,$pairing,$pcgid);

            }

        }

    }








    function GetUsersIDPool($db,$level,$mlmid,$type)

    {

        $res1=GetUidsPool($db,$mlmid,$type);

        if($level==1)

        {

            $res=$res1;

        }

        if($level==2)

        {

            $res=getLevelPool2($db,$res1,$type);

        }

        if($level==3)

        {

            $res=getLevelPool3($db,$res1,$type);

        }

        if($level==4)

        {

            $res=getLevelPool4($db,$res1,$type);

        }

        if($level==5)

        {

            $res=getLevelPool5($db,$res1,$type);

        }

        if($level==6)

        {

            $res=getLevelPool6($db,$res1,$type);

        }

        if($level==7)

        {

            $res=getLevelPool7($db,$res1,$type);

        }

        if($level==8)

        {

            $res=getLevelPool8($db,$res1,$type);

        }

        if($level==9)

        {

            $res=getLevelPool9($db,$res1,$type);

        }

        if($level==10)

        {

            $res=getLevelPool10($db,$res1,$type);

        }

        return $res;

    }


    function GetUidsPool($db,$uid,$type)

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

    function getLevelPool2($db,$res,$type)

    {

        $res2=array();

        //echo "<pre>";print_r($res);

        foreach ($res as $key => $value) {

            $res1=GetUidsPool($db,$value,$type);

            if(count($res1) > 0)

            {

                $res2=array_merge($res2,$res1);

            }

        }

        return $res2;

    }

    function getLevelPool3($db,$res_arr,$type)

    {

        $res3=array();

        $res1=getLevelPool2($db,$res_arr,$type);

        //echo "<pre>";print_r($res1);

        foreach($res1 as $key => $value)

        { 

            $res2=GetUidsPool($db,$value,$type);

            // print_r($res2);

            if(count($res2) > 0 && !empty($res2[0]))

            {

                $res3=array_merge($res2,$res3);

                //echo "<pre>";print_r($res3);

            }

        }

        return array_unique($res3);

    }

    function getLevelPool4($db,$res_arr,$type)

    {

        $res3=array();

        $res1=getLevelPool3($db,$res_arr,$type);

        //echo "<pre>";print_r($res1);

        foreach($res1 as $key => $value)

        { 

            $res2=GetUidsPool($db,$value,$type);

            //print_r($res2);

            if(count($res2) > 0 && !empty($res2[0]))

            {

                $res3=array_merge($res2,$res3);

                //echo "<pre>";print_r($res3);

            }

        }

        return array_unique($res3);

    }

    function getLevelPool5($db,$res_arr,$type)

    {

        $res3=array();

        $res1=getLevelPool4($db,$res_arr,$type);

        //echo "<pre>";print_r($res1);

        foreach($res1 as $key => $value)

        { 

            $res2=GetUidsPool($db,$value,$type);

            //print_r($res2);

            if(count($res2) > 0 && !empty($res2[0]))

            {

                $res3=array_merge($res2,$res3);

                //echo "<pre>";print_r($res3);

            }

        }

        return array_unique($res3);

    }

    function getLevelPool6($db,$res_arr,$type)

    {

        $res3=array();

        $res1=getLevelPool5($db,$res_arr,$type);

        //echo "<pre>";print_r($res1);

        foreach($res1 as $key => $value)

        { 

            $res2=GetUidsPool($db,$value,$type);

            //print_r($res2);

            if(count($res2) > 0 && !empty($res2[0]))

            {

                $res3=array_merge($res2,$res3);

                //echo "<pre>";print_r($res3);

            }

        }

        return array_unique($res3);

    }

    function getLevelPool7($db,$res_arr,$type)

    {

        $res3=array();

        $res1=getLevelPool6($db,$res_arr,$type);

        //echo "<pre>";print_r($res1);

        foreach($res1 as $key => $value)

        { 

            $res2=GetUidsPool($db,$value,$type);

            //print_r($res2);

            if(count($res2) > 0 && !empty($res2[0]))

            {

                $res3=array_merge($res2,$res3);

                //echo "<pre>";print_r($res3);

            }

        }

        return array_unique($res3);

    }

    function getLevelPool8($db,$res_arr,$type)

    {

        $res3=array();

        $res1=getLevelPool7($db,$res_arr,$type);

        //echo "<pre>";print_r($res1);

        foreach($res1 as $key => $value)

        { 

            $res2=GetUidsPool($db,$value,$type);

            //print_r($res2);

            if(count($res2) > 0 && !empty($res2[0]))

            {

                $res3=array_merge($res2,$res3);

                //echo "<pre>";print_r($res3);

            }

        }

        return array_unique($res3);

    }

    function getLevelPool9($db,$res_arr,$type)

    {

        $res3=array();

        $res1=getLevelPool8($db,$res_arr,$type);

        //echo "<pre>";print_r($res1);

        foreach($res1 as $key => $value)

        { 

            $res2=GetUidsPool($db,$value,$type);

            //print_r($res2);

            if(count($res2) > 0 && !empty($res2[0]))

            {

                $res3=array_merge($res2,$res3);

                //echo "<pre>";print_r($res3);

            }

        }

        return array_unique($res3);

    }

    function getLevelPool10($db,$res_arr,$type)

    {

        $res3=array();

        $res1=getLevelPool9($db,$res_arr,$type);

        //echo "<pre>";print_r($res1);

        foreach($res1 as $key => $value)

        { 

            $res2=GetUidsPool($db,$value,$type);

            //print_r($res2);

            if(count($res2) > 0 && !empty($res2[0]))

            {

                $res3=array_merge($res2,$res3);

                //echo "<pre>";print_r($res3);

            }

        }

        return array_unique($res3);

    }


    function SetLevelPayout2($db,$package,$level_cycle,$nparent_id,$uid)

    {

        if($level_cycle == 11){

        }

        else {

            if($nparent_id == 0){

            }

            else {

                if($level_cycle == 1){
                    $namt = ($package*1)/100;
                    // $qx1 = mysqli_query($db,"select * from `user_id` where `level_status` = '1' and `uid` = $nparent_id");

                    // if(mysqli_num_rows($qx1)>0)

                    // {
                        $q83 = mysqli_query($db,"INSERT INTO `autopool_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nparent_id,'$uid','$namt',now())");
                    // }

                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select parent_id from pairing_1 where uid='$nparent_id'"));

                    $nnparent_id = $nparent_idd['parent_id'];

                    $llevel_cycle = $level_cycle+1;

                    SetLevelPayout2($db,$package,$llevel_cycle,$nnparent_id,$nparent_id);

                }

                elseif($level_cycle == 2){

                    $namt = ($package*1)/100;
                    // $qx1 = mysqli_query($db,"select * from `user_id` where `level_status` = '1' and `uid` = $nparent_id");

                    // if(mysqli_num_rows($qx1)>0)

                    // {
                        $q83 = mysqli_query($db,"INSERT INTO `autopool_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nparent_id,'$uid','$namt',now())");
                    // }

                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select parent_id from pairing_1 where uid='$nparent_id'"));

                    $nnparent_id = $nparent_idd['parent_id'];

                    $llevel_cycle = $level_cycle+1;

                    SetLevelPayout2($db,$package,$llevel_cycle,$nnparent_id,$nparent_id);

                }

                elseif($level_cycle == 3){

                    $namt = ($package*1)/100;
                    // $qx1 = mysqli_query($db,"select * from `user_id` where `level_status` = '1' and `uid` = $nparent_id");

                    // if(mysqli_num_rows($qx1)>0)

                    // {
                        $q83 = mysqli_query($db,"INSERT INTO `autopool_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nparent_id,'$uid','$namt',now())");
                    // }

                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select parent_id from pairing_1 where uid='$nparent_id'"));

                    $nnparent_id = $nparent_idd['parent_id'];

                    $llevel_cycle = $level_cycle+1;

                    SetLevelPayout2($db,$package,$llevel_cycle,$nnparent_id,$nparent_id);

                }

                elseif($level_cycle == 4){

                    $namt = ($package*1)/100;
                    // $qx1 = mysqli_query($db,"select * from `user_id` where `level_status` = '1' and `uid` = $nparent_id");

                    // if(mysqli_num_rows($qx1)>0)

                    // {
                        $q83 = mysqli_query($db,"INSERT INTO `autopool_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nparent_id,'$uid','$namt',now())");
                    // }

                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select parent_id from pairing_1 where uid='$nparent_id'"));

                    $nnparent_id = $nparent_idd['parent_id'];

                    $llevel_cycle = $level_cycle+1;

                    SetLevelPayout2($db,$package,$llevel_cycle,$nnparent_id,$nparent_id);

                }

                elseif($level_cycle == 5){

                    $namt = ($package*1)/100;
                    // $qx1 = mysqli_query($db,"select * from `user_id` where `level_status` = '1' and `uid` = $nparent_id");

                    // if(mysqli_num_rows($qx1)>0)

                    // {
                        $q83 = mysqli_query($db,"INSERT INTO `autopool_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nparent_id,'$uid','$namt',now())");
                    // }

                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select parent_id from pairing_1 where uid='$nparent_id'"));

                    $nnparent_id = $nparent_idd['parent_id'];

                    $llevel_cycle = $level_cycle+1;

                    SetLevelPayout2($db,$package,$llevel_cycle,$nnparent_id,$nparent_id);

                }

                elseif($level_cycle == 6){

                    $namt = ($package*1)/100;
                    // $qx1 = mysqli_query($db,"select * from `user_id` where `level_status` = '1' and `uid` = $nparent_id");

                    // if(mysqli_num_rows($qx1)>0)

                    // {
                        $q83 = mysqli_query($db,"INSERT INTO `autopool_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nparent_id,'$uid','$namt',now())");
                    // }

                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select parent_id from pairing_1 where uid='$nparent_id'"));

                    $nnparent_id = $nparent_idd['parent_id'];

                    $llevel_cycle = $level_cycle+1;

                    SetLevelPayout2($db,$package,$llevel_cycle,$nnparent_id,$nparent_id);

                }

                elseif($level_cycle == 7){

                    $namt = ($package*1)/100;
                    // $qx1 = mysqli_query($db,"select * from `user_id` where `level_status` = '1' and `uid` = $nparent_id");

                    // if(mysqli_num_rows($qx1)>0)

                    // {
                        $q83 = mysqli_query($db,"INSERT INTO `autopool_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nparent_id,'$uid','$namt',now())");
                    // }

                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select parent_id from pairing_1 where uid='$nparent_id'"));

                    $nnparent_id = $nparent_idd['parent_id'];

                    $llevel_cycle = $level_cycle+1;

                    SetLevelPayout2($db,$package,$llevel_cycle,$nnparent_id,$nparent_id);

                }

                elseif($level_cycle == 8){

                    $namt = ($package*1)/100;
                    // $qx1 = mysqli_query($db,"select * from `user_id` where `level_status` = '1' and `uid` = $nparent_id");

                    // if(mysqli_num_rows($qx1)>0)

                    // {
                        $q83 = mysqli_query($db,"INSERT INTO `autopool_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nparent_id,'$uid','$namt',now())");
                    // }

                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select parent_id from pairing_1 where uid='$nparent_id'"));

                    $nnparent_id = $nparent_idd['parent_id'];

                    $llevel_cycle = $level_cycle+1;

                    SetLevelPayout2($db,$package,$llevel_cycle,$nnparent_id,$nparent_id);

                }

                elseif($level_cycle == 9){

                    $namt = ($package*1)/100;
                    // $qx1 = mysqli_query($db,"select * from `user_id` where `level_status` = '1' and `uid` = $nparent_id");

                    // if(mysqli_num_rows($qx1)>0)

                    // {
                        $q83 = mysqli_query($db,"INSERT INTO `autopool_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nparent_id,'$uid','$namt',now())");
                    // }

                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select parent_id from pairing_1 where uid='$nparent_id'"));

                    $nnparent_id = $nparent_idd['parent_id'];

                    $llevel_cycle = $level_cycle+1;

                    SetLevelPayout2($db,$package,$llevel_cycle,$nnparent_id,$nparent_id);

                }

                elseif($level_cycle == 10){

                    $namt = ($package*1)/100;
                    // $qx1 = mysqli_query($db,"select * from `user_id` where `level_status` = '1' and `uid` = $nparent_id");

                    // if(mysqli_num_rows($qx1)>0)

                    // {
                        $q83 = mysqli_query($db,"INSERT INTO `autopool_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nparent_id,'$uid','$namt',now())");
                    // }

                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select parent_id from pairing_1 where uid='$nparent_id'"));

                    $nnparent_id = $nparent_idd['parent_id'];

                    $llevel_cycle = $level_cycle+1;

                    SetLevelPayout2($db,$package,$llevel_cycle,$nnparent_id,$nparent_id);

                }

            }

        }

    }


    function SetLevelBoost1($db,$package,$level_cycle,$nparent_id,$uid)

    {

        if($level_cycle == 11){

        }

        else {

            if($nparent_id == 85){

            }

            else {

                if($level_cycle == 1){
                    $namt = ($package*1)/100;
                    // $qx1 = mysqli_query($db,"select * from `user_id` where `level_status` = '1' and `uid` = $nparent_id");

                    // if(mysqli_num_rows($qx1)>0)

                    // {
                        $q83 = mysqli_query($db,"INSERT INTO `boost1_level_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nparent_id,$uid,'$namt',now())");
                    // }

                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select sponsor_id from `pairing` where uid='$nparent_id'"));

                    $nnparent_id = $nparent_idd['sponsor_id'];

                    $llevel_cycle = $level_cycle+1;

                    SetLevelBoost1($db,$package,$llevel_cycle,$nnparent_id,$nparent_id);

                }

                elseif($level_cycle == 2){

                    $namt = ($package*1)/100;
                    // $qx1 = mysqli_query($db,"select * from `user_id` where `level_status` = '1' and `uid` = $nparent_id");

                    // if(mysqli_num_rows($qx1)>0)

                    // {
                        $q83 = mysqli_query($db,"INSERT INTO `boost1_level_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nparent_id,$uid,'$namt',now())");
                    // }

                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select sponsor_id from `pairing` where uid='$nparent_id'"));

                    $nnparent_id = $nparent_idd['sponsor_id'];

                    $llevel_cycle = $level_cycle+1;

                    SetLevelBoost1($db,$package,$llevel_cycle,$nnparent_id,$nparent_id);

                }

                elseif($level_cycle == 3){

                    $namt = ($package*1)/100;
                    // $qx1 = mysqli_query($db,"select * from `user_id` where `level_status` = '1' and `uid` = $nparent_id");

                    // if(mysqli_num_rows($qx1)>0)

                    // {
                        $q83 = mysqli_query($db,"INSERT INTO `boost1_level_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nparent_id,$uid,'$namt',now())");
                    // }

                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select sponsor_id from `pairing` where uid='$nparent_id'"));

                    $nnparent_id = $nparent_idd['sponsor_id'];

                    $llevel_cycle = $level_cycle+1;

                    SetLevelBoost1($db,$package,$llevel_cycle,$nnparent_id,$nparent_id);

                }

                elseif($level_cycle == 4){

                    $namt = ($package*1)/100;
                    // $qx1 = mysqli_query($db,"select * from `user_id` where `level_status` = '1' and `uid` = $nparent_id");

                    // if(mysqli_num_rows($qx1)>0)

                    // {
                        $q83 = mysqli_query($db,"INSERT INTO `boost1_level_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nparent_id,$uid,'$namt',now())");
                    // }

                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select sponsor_id from `pairing` where uid='$nparent_id'"));

                    $nnparent_id = $nparent_idd['sponsor_id'];

                    $llevel_cycle = $level_cycle+1;

                    SetLevelBoost1($db,$package,$llevel_cycle,$nnparent_id,$nparent_id);

                }

                elseif($level_cycle == 5){

                    $namt = ($package*1)/100;
                    // $qx1 = mysqli_query($db,"select * from `user_id` where `level_status` = '1' and `uid` = $nparent_id");

                    // if(mysqli_num_rows($qx1)>0)

                    // {
                        $q83 = mysqli_query($db,"INSERT INTO `boost1_level_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nparent_id,$uid,'$namt',now())");
                    // }

                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select sponsor_id from `pairing` where uid='$nparent_id'"));

                    $nnparent_id = $nparent_idd['sponsor_id'];

                    $llevel_cycle = $level_cycle+1;

                    SetLevelBoost1($db,$package,$llevel_cycle,$nnparent_id,$nparent_id);

                }

                elseif($level_cycle == 6){

                    $namt = ($package*1)/100;
                    // $qx1 = mysqli_query($db,"select * from `user_id` where `level_status` = '1' and `uid` = $nparent_id");

                    // if(mysqli_num_rows($qx1)>0)

                    // {
                        $q83 = mysqli_query($db,"INSERT INTO `boost1_level_income`(`uid`,`fuid`,`amount`,`date`) VALUES ($nparent_id,$uid,'$namt',now())");
                    // }

                    $nparent_idd = mysqli_fetch_assoc(mysqli_query($db,"select sponsor_id from `pairing` where uid='$nparent_id'"));

                    $nnparent_id = $nparent_idd['sponsor_id'];

                    $llevel_cycle = $level_cycle+1;

                    SetLevelBoost1($db,$package,$llevel_cycle,$nnparent_id,$nparent_id);

                }

            }

        }

    }

    function isMultipleOf500($number) {
        return $number % 500 === 0;
    }

    function isMultipleOf100($number) {
        return $number % 100 === 0;
    }

    function isMultipleOf1000($number) {
        return $number % 1000 === 0;
    }




    function GetValidParentId($db,$sponsor_id,$position)
	{
		$parent_name='';
		$res=GetUserCountPos($db,$sponsor_id,$position);
		$parent_id=end($res);
		$sp1=mysqli_query($db,"select member_id from membership where member_id='$parent_id'");
		$spno=mysqli_num_rows($sp1);
		if($spno > 0)
		{
			$userid=mysqli_fetch_assoc($sp1);
			$parent_id=$userid['member_id'];
			$check_position1 = mysqli_query($db,"SELECT uid FROM pairing WHERE parent_id='$parent_id' AND position='$position'") or die(mysqli_error($db));
			$chkqry21 = mysqli_num_rows($check_position1);
			if($chkqry21>0){
				//echo 2;
				GetValidParentId($db,$parent_id,$position);
			}
		}
		else
		{
			//echo 3;
			GetValidParentId($db,$parent_id,$position);
		}
		return $parent_id;
	}

	$all_user=array();
	function GetUserCountPos($db,$sponsor_id,$position)
	{
		global $all_user;
		$all_user=array();
		$sql = "select t1.uid from pairing t1 left join membership t2 on t1.parent_id=t2.member_id where t2.member_id='$sponsor_id' and t1.position='$position'";
		//echo "SQL1 : $sql <br>";
		$sql=mysqli_query($db,$sql);
		if($no=mysqli_num_rows($sql) > 0)
		{
			$r1=mysqli_fetch_assoc($sql);
			$uid=$r1['uid'];
			if($position=='C'){$position='L';}
			$res= GetAllUserCountPos($db,$uid,$position);
			return $res;
		}
		else
		{
			$r1=mysqli_fetch_assoc(mysqli_query($db,"select member_id from membership where member_id='$sponsor_id'"));
			$new_array = array($r1['member_id']);
			return $new_array;
		}

	}

	function GetAllUserCountPos($db,$uid,$position)
	{
		global $all_user;
		$all_user[]=$uid;
		$sql2 = "select * from pairing t1 where t1.parent_id='$uid' and t1.position='$position'";
		//echo "SQL2 : $sql2 <br>";
		$sql=mysqli_query($db,$sql2);
		if($no=mysqli_num_rows($sql) > 0)
		{
			$r1=mysqli_fetch_assoc($sql);
			$uid1=$r1['uid'];
			GetAllUserCountPos($db,$uid1,$position);
		}
		return $all_user;
	}
	
	function UserPairing($db,$uid,$parent_id,$sponsor_id,$position=null,$act_pos=null,$paired)
	{
		// echo "INSERT INTO `pairing`(`uid`, `parent_id`, `sponsor_id`,`position`,`act_pos`, `date`) VALUES ('$uid','$parent_id','$sponsor_id','$position','$act_pos',now())";
		$sql = "INSERT INTO `pairing`(`uid`, `parent_id`, `sponsor_id`,`position`,`act_pos`, `date`,`status`) VALUES ('$uid','$parent_id','$sponsor_id','$position','$act_pos',now(),'$paired')";
		$pair=mysqli_query($db,$sql);
		$q6 = mysqli_query($db,"INSERT INTO `child_counter`(`uid`) VALUES ($uid)");
		$q7 = mysqli_query($db,"UPDATE `child_counter` SET `count`=`count`+1 WHERE uid='$parent_id'");
		ChildAddedBinaryCount($db,$uid);
		$q7 = mysqli_query($db,"UPDATE `child_counter` SET `total_direct_count`=`total_direct_count`+1 WHERE uid='$sponsor_id'");

		return;
	}

	
	function ChildAddedBinaryCount($db,$uid){
		$plan_binary_count=1;
		$r1=mysqli_fetch_assoc(mysqli_query($db,"SELECT `parent_id` FROM pairing  WHERE uid='$uid'"));
		$parent_id=$r1['parent_id'];
		$query=mysqli_query($db,"SELECT * FROM pairing  WHERE uid='$uid'");
		if(mysqli_num_rows($query)>0){
			$row=mysqli_fetch_assoc($query);
			if($row['position']=="L")
			{
				mysqli_query($db,"UPDATE child_counter SET total_left_count=total_left_count+$plan_binary_count WHERE uid='$parent_id'");
			}
			else if($row['position']=="R")
			{
				mysqli_query($db,"UPDATE child_counter SET total_right_count=total_right_count+$plan_binary_count WHERE uid='$parent_id'");
			}
			if($parent_id==85){}
			else
			{
				ChildAddedBinaryCount($db,$parent_id);
			}
		}
		return true;
	}

    

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
                $sql1 = "SELECT count(`member_id`) as ucount FROM datalogs WHERE `member_id` IN($uids) and success_code = 'Success'";
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



?>