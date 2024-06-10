<?php
include( "config.php" );
ob_start();
// EDIT THE 2 LINES BELOW AS REQUIRED


if ( isset( $_POST[ 'requestquote' ] ) ) {
  	$email_to = "support@emrmarketing.in";
	// $email_to2 = "shait@bluegrasshotels.com";
  	$fname = $_POST[ 'fname' ]; 
  	$lname = $_POST[ 'lname' ]; 
  	$email = $_POST[ 'email' ]; 
  	$phone = $_POST[ 'phone' ];
  	$message = $_POST[ 'message' ];
	$course = $_POST['course'];
	
	if ( $_FILES[ "resume" ][ "name" ] != '' ) {
	$allowedExts = array("pdf", "doc", "docx");
	$extension = end(explode(".", $_FILES["resume"]["name"]));
  if ( ( $_FILES[ "resume" ][ "type" ] == "application/pdf" ) || ( $_FILES[ "resume" ][ "type" ] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" ) || ( $_FILES[ "resume" ][ "type" ] == "application/msword" ) && ($_FILES["file"]["size"] < 20000000) && in_array($extension, $allowedExts)) 
  {
    $image = "$path" . $rand1 . $_FILES[ "resume" ][ "name" ];
    $image0 = $rand1 . $_FILES[ "resume" ][ "name" ];
    move_uploaded_file( $_FILES[ "resume" ][ "tmp_name" ], $image );
  } else {
    $image0 = '';
	$errmsg_arr[] = '<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Error!</strong> Upload only PDF and Docx File</div>';
	$errflag = true;
	$_SESSION['upload_error'] = $errmsg_arr;
	session_write_close();
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	ob_end_flush();  
  }
}
	$query = "insert into career(fname,lname,email,phone,message,date,resume,course) values('$fname','$lname','$email','$phone','$message',now(),'$image0','$course')";
  mysqli_query( $link, $query );
  	$email_subject = "Request For Course - $fname";
  $email_massage = "<table width='700' border='0' cellpadding='0' cellspacing='0' style='background:#f2f2f2; line-height:21px; border:1px solid #ccc;  font-family:Arial, Helvetica, sans-serif; font-size:12px; color:
#333;' align='center'>
<tr>
	<td><div align='left'>	  <h2 style='margin:20px 0 0 0; padding:0; color:#666a6a;'>Thank you for Enquery Details.</h2></td>
  </tr>
  <tr >
    <td style='padding:10px; color:#666a6a'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='32%' colspan='4'><h3></h3></td>
      </tr>
      <tr>
        <td colspan='4'>
          <table width='100%' border='0' cellpadding='5' cellspacing='0' style='border-right:1px solid #6CF; border-bottom:1px solid  #6CF;' >
             <tr>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'><strong> First Name:</strong></td>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'>$fname</td>
              </tr>
			  <tr>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'><strong> Last Name:</strong></td>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'>$lname</td>
              </tr>
			<tr>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'><strong>Email</strong></td>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'>$email</td>
              </tr>
            
            <tr>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'><strong>Phone</strong></td>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'>$phone</td>
              </tr>
			  <tr>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'><strong>Course</strong></td>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'>$course</td>
              </tr>
			  
			<tr>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'><strong> Message:</strong></td>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'>$message</td>
              </tr>
			  
		   
            </table>
          </td>
      </tr>
      <tr>
        <td colspan='4'>
          </td>
      </tr>
      <tr>
        <td colspan='4'></td>
      </tr>
      <tr>
        <td colspan='4'>
		</td>
      </tr>
    </table></td>
  </tr>
  
</table>";

  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
  $headers .= "From: www.emreducation.com" . "<support@emreducation.com>\r\n";
  mail( $email_to, $email_subject, $email_massage, $headers );
  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = '<div class="success-message"><p><span>Congratulations ! </span><strong>Thank you for submitting your Request</strong>, we will get back with the best proposal.</p></div>';
  $errflag = true;
  $_SESSION[ 'formsucss' ] = $errmsg_arr;
   header( 'Location: thank-you.html' );
  ob_end_flush();
} 
else {
  echo "error";
}
?>
