<?php
if ( isset( $_SESSION[ 'username' ] ) ) {
  $usen = $_SESSION[ 'username' ];
  $profile_sett = "select * from admin_login where username='$usen'";
  $result_profile = mysqli_query( $link, $profile_sett );
  $profile_row = mysqli_fetch_array( $result_profile );
}
$kadirtest = $profile_row[ 'username' ];
if ( !isset( $_SESSION[ 'username' ] ) || ( trim( $_SESSION[ 'admin_id' ] ) == '' ) ) {

  $errmsg_arr[] = 'Please fill in username and password.';
  $errflag = true;
  if ( $errflag ) {
    $_SESSION[ 'ERRMSG_ARR' ] = $errmsg_arr;
    session_write_close();
    header( "location:login.php" );
    exit();
  }
}
$_SESSION[ 'username' ];
include( 'allfunction.php' );
?>
