<?php include("../../config.php");
ob_start();
$usen=$_SESSION['SESS_ADMIN_USER'];
$profile_sett="select * from admin_login where username='$usen'"; 
$result_profile=mysqli_query($link,$profile_sett); 
$profile_row=mysqli_fetch_array($result_profile);
 
$admin_id=$profile_row['admin_id']; 

$username=$_REQUEST['username'];
$email_address=$_REQUEST['email_address'];
$url=$_REQUEST['url'];
$image=$_REQUEST['image'];
$firstname=$_REQUEST['firstname'];
$lastname=$_REQUEST['lastname'];
$fblink=$_REQUEST['fblink'];
$yulink=$_REQUEST['yulink'];
$twlink=$_REQUEST['twlink'];
$lilink=$_REQUEST['lilink'];
$copyright=$_REQUEST['copyright'];
$metatitle=$_REQUEST['metatitle'];
$metakeywords=$_REQUEST['metakeywords'];
$metadescription=$_REQUEST['metadescription'];
$gplus=$_REQUEST['gplus'];

$fbchk=$_REQUEST['fbchk'];
$twchk=$_REQUEST['twchk'];
$lichk=$_REQUEST['lichk'];
$gpchk=$_REQUEST['gpchk'];
$yuchk=$_REQUEST['yuchk'];

$address=$_REQUEST['address'];
$phone=$_REQUEST['phone'];
$time=$_REQUEST['time'];

$altemail=$_REQUEST['altemail'];
$altphone=$_REQUEST['altphone'];

$footer_description=$_REQUEST['footer_description'];

$password=md5($_REQUEST['password']);

if($_FILES["image"]["name"]!='')
{
if (($_FILES["image"]["type"] == "image/gif")
|| ($_FILES["image"]["type"] == "image/jpeg")
|| ($_FILES["image"]["type"] == "image/pjpeg")
|| ($_FILES["image"]["type"] == "image/X-PNG")
|| ($_FILES["image"]["type"] == "image/PNG")
|| ($_FILES["image"]["type"] == "image/png")
|| ($_FILES["image"]["type"] == "image/x-png"))
{
$image="../../$path".$rand1.$_FILES["image"]["name"];
$image0=$rand1.$_FILES["image"]["name"];
move_uploaded_file($_FILES["image"]["tmp_name"],$image);
}
else
{
$image0='';
}
}

else
{
$image0=$_REQUEST['hiddenimage'];
}


if(isset($_REQUEST['socialnetwork']))
{
$query="update admin_login SET  fblink='$fblink', yulink='$yulink', twlink='$twlink', lilink='$lilink', gplus='$gplus', fbchk='$fbchk', twchk='$twchk', lichk='$lichk', gpchk='$gpchk', yuchk='$yuchk'  WHERE admin_id=$admin_id";
mysqli_query($link,$query);
header('location:../setting.php');

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = '<div class="label_error">Record modified successfully.</div>';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);	

}
else if(isset($_REQUEST['searchengine']))
{
$query="update admin_login SET metatitle='$metatitle', metakeywords='$metakeywords', metadescription='$metadescription'  WHERE admin_id=$admin_id";
mysqli_query($link,$query);
header('location:../setting.php');

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = '<div class="label_error">Record modified successfully.</div>';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);	

}
else if(isset($_REQUEST['generalsetting']))
{
$query="update admin_login SET url='$url', firstname='$firstname', lastname='$lastname',copyright='$copyright',address='$address',phone='$phone',time='$time',footer_description='$footer_description',altemail='$altemail',altphone='$altphone'  WHERE admin_id='$admin_id'";
mysqli_query($link,$query);
header('location:../setting.php');

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = '<div class="label_error">Record modified successfully.</div>';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);	

}
else if(isset($_REQUEST['adminupdate']))
{
$query="update admin_login SET username='$username',email_address='$email_address',image='$image0'  WHERE admin_id='$admin_id'";
mysqli_query($link,$query);
header('location:../setting.php');

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = '<div class="label_error">Record modified successfully.</div>';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);	

}

else if(isset($_REQUEST['add']))
{
$query="insert into admin_login(password,username,image,metatitle,metakeyword,metadescription,copyright,other1,other2) values('$password','$username','$image0','$metatitle','$metakeyword','$metadescription','$copyright','$other1','$other2')";
mysqli_query($link,$query);

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = '<div class="label_error">Record Add successfully.</div>';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
}

else if(isset($_REQUEST['admin_id']) || isset($_REQUEST['admin_id1']))
{
if(isset($_REQUEST['admin_id']))
{
$admin_id=$_REQUEST['admin_id'];
$status='0';
}
else if(isset($_REQUEST['admin_id1']))
{
$admin_id=$_REQUEST['admin_id1'];	
$status='1';
}
else
{
$status='0';	
}
$query="update admin_login SET status='$status' WHERE admin_id='$admin_id'";         
mysqli_query($link,$query);
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['del']))
{
$id=$_REQUEST['del'];
$query="delete from admin_login WHERE admin_id=$id";
mysqli_query($link,$query);
}
else if(isset($_REQUEST['currancy_add']))
{
$currency_name=$_REQUEST['currency_name'];
$currancy_value=$_REQUEST['currancy_value'];
$seokeyword24=str_replace(' ','-',$currency_name);
$sekey=mb_strtolower($seokeyword24);
$query="insert into currancy(currency_name,currancy_value,status,keywords) values('$currency_name','$currancy_value','1','$sekey')";
mysqli_query($link,$query);

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = '<div class="label_error">Currancy Add successfully.</div>';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
ob_end_flush();
}
else if(isset($_REQUEST['Curdel']))
{
$Curdel=$_REQUEST['Curdel'];
$query="delete from currancy WHERE currancy_id=$Curdel";
mysqli_query($link,$query);

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = '<div class="label_error">Currancy Delete successfully.</div>';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
ob_end_flush();
?>
