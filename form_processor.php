<?php
include( "config.php" );
ob_start();
// EDIT THE 2 LINES BELOW AS REQUIRED


if ( isset( $_POST[ 'requestquote' ] ) ) {
  $email_to = "abquadir@gmail.com";
  $fullname = $_POST[ 'fullname' ]; // required
  $email = $_POST[ 'email' ]; // required
  $phone = $_POST[ 'phone' ]; // requiredskype
  $skype = $_POST[ 'skype' ]; // required
  $subject = $_POST[ 'subject' ]; // required
  $service = $_POST[ 'service' ]; // required
  $message = $_POST[ 'message' ]; // required
  $email_subject = "Client Apply Quote - $service";
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
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'><strong> Full name:</strong></td>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'>$fullname</td>
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
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'><strong> Subject:</strong></td>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'>$subject</td>
              </tr>
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
  $headers .= "From: www.emrmarketing.in" . "<abquadir@gmail.com>\r\n";
  mail( $email_to, $email_subject, $email_massage, $headers );
  //@mail($email, $email_subject,$email_massage2 , $headers); 
  $errmsg_arr = array();
  $errflag = false;


  $errmsg_arr[] = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Success!</strong> Thank you for submitting to Quote,</strong> we will get back with the best proposal.</div>';
  $errflag = true;
  $_SESSION[ 'verifysuccfully' ] = $errmsg_arr;
  header( 'Location: contact/' );
  ob_end_flush();
} else if ( isset( $_POST[ 'contact_btn' ] ) ) {
  session_start();
  $email_to = "abquadir@gmail.com";
  $fullname = $_POST[ 'fname' ] . " " . $_POST[ 'lname' ]; // required
  $email = $_POST[ 'email' ]; // required
  $phone = $_POST[ 'phone' ]; // required
  $subject = $_POST[ 'subject' ]; // required
  $message = $_POST[ 'message' ]; // required
  $email_subject = "Contact us Inquery - $subject";

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
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'><strong> Name:</strong></td>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'>$fullname</td>
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
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'><strong>Subject</strong></td>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'>$subject</td>
              </tr>
            
			<tr>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'><strong> Client Message:</strong></td>
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
  $headers .= "From: www.kamit.ae" . "<a.elian@kamit.ae>\r\n";
  mail( $email_to, $email_subject, $email_massage, $headers );
  //@mail($email, $email_subject,$email_massage2 , $headers); 
  $inquery_error = array();
  $errflag2 = false;
  $inquery_error[] = '<div class="success-message">
		  <img src="assets/images/success-form.jpg">
	  <h4>Congratulations !</h4>
		  <p><strong>Thank you for submitting your inquiry</strong>, we will get back with the best proposal.</p>
	  </div>';
  $errflag2 = true;
  $_SESSION[ 'inquery_error' ] = $inquery_error;
  header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );
  ob_end_flush();
} else if ( isset( $_POST[ 'careersubmit' ] ) ) {
  //$email_to = "info@maluankar.com";
  $email_to = "info@splendid.ae";
  $fullname = $_POST[ 'name' ]; // required
  $email = $_POST[ 'email' ]; // required
  $phone = $_POST[ 'phone' ]; // required
  $jopost = $_POST[ 'jopost' ]; // required
  $service = $_POST[ 'service' ]; // required
  $message = $_POST[ 'message' ]; // required
  $email_subject = "Apply for job - $jopost";


  if ( $_FILES[ "image" ][ "name" ] != '' ) {
    if ( ( $_FILES[ "image" ][ "type" ] == "application/pdf" ) ||
      ( $_FILES[ "image" ][ "type" ] == "application/docx" ) ||
      ( $_FILES[ "image" ][ "type" ] == "image/svg+xml" ) ||
      ( $_FILES[ "image" ][ "type" ] == "image/X-PNG" ) ||
      ( $_FILES[ "image" ][ "type" ] == "image/PNG" ) ||
      ( $_FILES[ "image" ][ "type" ] == "image/png" ) ||
      ( $_FILES[ "image" ][ "type" ] == "image/x-png" ) ) {
      $image = "$path/resume/" . $rand1 . $_FILES[ "image" ][ "name" ];
      $image0 = $rand1 . $_FILES[ "image" ][ "name" ];
      move_uploaded_file( $_FILES[ "image" ][ "tmp_name" ], $image );
    } else {
      $image0 = '';
    }
  } else {
    $image0 = $_REQUEST[ 'hiddenimage' ];
  }


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
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'><strong> Full name:</strong></td>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'>$fullname</td>
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
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'><strong> Apply for Position:</strong></td>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'>$jopost</td>
              </tr>
			<tr>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'><strong> Message:</strong></td>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'>$message</td>
              </tr>
			  <tr>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'><strong> Attachment:</strong></td>
              <td style='border-left:1px solid  #6CF; border-top:1px solid #6CF;'><a href='https://hostsplendid.com/slpendid_new/uploads/resume/$image0'>$image0</a></td>
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
  $headers .= "From: www.kamit.ae" . "<support@kamit.ae>\r\n";
  mail( $email_to, $email_subject, $email_massage, $headers );
  //@mail($email, $email_subject,$email_massage2 , $headers); 
  $errmsg_arr = array();
  $errflag = false;


  $errmsg_arr[] = '<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Congratulations !</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p><strong>Thank you for submitting to Quote</strong>, we will get back with the best proposal.</p>
            </div>
        </div>
    </div>
</div>';
  $errflag = true;
  $_SESSION[ 'verifysuccfully' ] = $errmsg_arr;
  header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );
  ob_end_flush();
} else if ( isset( $_POST[ 'blog_cm_sub' ] ) ) {
  $name = $_POST[ 'name' ];
  $email = $_POST[ 'email' ];
  $website = $_POST[ 'website' ];
  $comment = $_POST[ 'comment' ];
  $blog_id = $_POST[ 'blog_id' ];
  $query = "insert into comment (name,email,website,comment,date,blog_id,status) values('$name','$email','$website','$comment',now(),'$blog_id','0')";
  mysqli_query( $link, $query );
  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = '<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Success !</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p align="center"><strong>Your Comment is Successfuly.</strong> We Will be verified by our admin then we will activate.</p>
            </div>
        </div>
    </div>
</div>';
  $errflag = true;
  $_SESSION[ 'blogmessage' ] = $errmsg_arr;
  header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );
  ob_end_flush();
} else {
  echo "error";
}
?>
