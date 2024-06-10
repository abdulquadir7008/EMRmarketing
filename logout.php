<?PHP include("config.php");
$sess=session_id();
if($_SESSION['member_id']) {
$customerchechlogin_id=$_SESSION['member_id'];
} else {
$customerchechlogin_id="0";	
	 }
session_start();
session_unset();
unset($_SESSION['member_id']);
unset($sess);
session_regenerate_id(true);
   $_SESSION['FBID'] = NULL;
   $_SESSION['fb_name'] = NULL;

session_destroy();
if (isset($_COOKIE['userid'])) {
    unset($_COOKIE['userid']);
    setcookie('userid', '', time() - 3600, '/');
}
header('Location: ' . $domain_url.'index.php');
exit();
?>
