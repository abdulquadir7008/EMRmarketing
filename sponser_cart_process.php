<?php
include( "config.php" );
if ( isset( $_REQUEST[ 'ordersubmit' ] ) ) {
	mysqli_query($link,"delete from cart WHERE userid='$customerchechlogin_id'");
  	$product_array = $_REQUEST[ 'product_id' ];
	$sponser_pln =  $_REQUEST['sponserplan'];
	$binary_status = $_REQUEST['binary_status'];
	$_SESSION['sponserplan'] = $_REQUEST['sponserplan'];
  $_SESSION['plan'] = $_REQUEST['sponserplan'];
  foreach ( $product_array as $product_id ) {
    $sess = session_id();
    $prodsql = "select * from products WHERE id=$product_id";
    $mysqlprod = mysqli_query( $link, $prodsql );
    $listprod = mysqli_fetch_array( $mysqlprod );
	  $sizeR = "size".$product_id;
	  if($_REQUEST[$sizeR]){
		  $req001 = $_REQUEST[$sizeR];
		  foreach ( $req001 as $size_value ) {
			  
		  }
	  }
	  else{
		 $size_value =''; 
	  }
    if ( $listprod[ 'sprice' ] ) {
      $priceid = $listprod[ "sprice" ];
    } else {
      $priceid = $listprod[ "price" ];
    }
	  if($listprod['colour']){
		  $colour = $listprod['colour'];
	  }
	  else{
		   $colour = '';
	  }
    //  $priceid = $listprod[ "price" ];
    if ( $_SESSION[ 'member_id' ] ) {
      $customerchechlogin_id = $_SESSION[ 'member_id' ];
      $qty_record = '';
      $cartupdate = "select * from cart WHERE product_id='$product_id'";
      $cartsqlupdate = mysqli_query( $link, $cartupdate );
      $cartsqlist = mysqli_fetch_array( $cartsqlupdate );
      $qty_record = 1;
	  $sponser_status = "active";
      if ( $cartsqlist[ 'product_id' ] == $product_id && $cartsqlist[ 'userid' ] == $customerchechlogin_id ) {
        $queryatleast = "update cart SET qty='$qty_record',sponser_status='$sponser_status',sponserplan='$sponser_pln',binary_status='$binary_status',varient_names='$size_value',verientlist='$colour' WHERE product_id=$product_id and userid='$customerchechlogin_id'";
        mysqli_query( $link, $queryatleast );
      } else {
      $query = "insert into cart(price,sess,qty,product_id,date,userid,sponser_status,sponserplan,binary_status,varient_names,verientlist)values('$priceid','$sess','1','$product_id',now(),'$customerchechlogin_id','$sponser_status','$sponser_pln','$binary_status','$size_value','$colour')";
        mysqli_query( $link, $query );
      }
      $sql_check1 = "select * from cart WHERE userid='$customerchechlogin_id'";
      $res_check1 = mysqli_query( $link, $sql_check1 );
      $cartcount = mysqli_num_rows( $res_check1 );

    }
  }

}
	header( 'Location: checkout/' );
    ob_end_flush();

?>