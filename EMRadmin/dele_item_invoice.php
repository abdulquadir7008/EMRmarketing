<?php
include('includes/configset.php');
ob_start();
if ( isset( $_REQUEST['del'] ) ) {
  $id = $_REQUEST['del'];
  mysqli_query( $link, "delete from invoice_item WHERE item_id=$id" );
}

session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
ob_end_flush();
?>
 