<?php
include( "config.php" );
ob_start();
if ( isset( $_POST[ "cart_submit" ] ) ) {
	$customerchechlogin_id='';	
  //$ip = $_SERVER['REMOTE_ADDR'];
  $product_id = $_POST[ "prod_id" ];
	$prodQty = $_REQUEST['qty'];
	$prodSize = $_REQUEST['size'];
	$prodColor =$_REQUEST['color'];
  //$priceid = $_POST["priceid"];
  $sess = session_id();
  $prodsql = "select * from products WHERE id=$product_id";
  $mysqlprod = mysqli_query( $link, $prodsql );
  $listprod = mysqli_fetch_array( $mysqlprod );
  if($listprod['sprice']){
  $priceid = $listprod["sprice"];
  }else{
    $priceid = $listprod["price"];  
  }
//  $priceid = $listprod[ "price" ];
  if ($_SESSION[ 'member_id' ] ) {
    $customerchechlogin_id = $_SESSION[ 'member_id' ];
	$qty_record ='';
    $cartupdate = "select * from cart WHERE product_id='$product_id'";
    $cartsqlupdate = mysqli_query( $link, $cartupdate );
    $cartsqlist = mysqli_fetch_array( $cartsqlupdate );
    $qty_record = $cartsqlist[ 'qty' ] + $prodQty;
    if ( $cartsqlist[ 'product_id' ] == $product_id && $cartsqlist[ 'userid' ] == $customerchechlogin_id ) {
      $queryatleast = "update cart SET qty='$qty_record',varient_names='$prodSize',verientlist='$prodColor' WHERE product_id=$product_id and userid='$customerchechlogin_id'";
      mysqli_query( $link, $queryatleast );
    } else {
      $query = "insert into cart(price,sess,qty,product_id,date,userid,varient_names,verientlist)values('$priceid','$sess','$prodQty','$product_id',now(),'$customerchechlogin_id','$prodSize','$prodColor')";
      mysqli_query( $link, $query );
    }
    $sql_check1 = "select * from cart WHERE userid='$customerchechlogin_id'";
    $res_check1 = mysqli_query( $link, $sql_check1 );
    $cartcount = mysqli_num_rows( $res_check1 );
  } else {
	$qty_record='';
    $cartupdate = "select * from cart WHERE product_id='$product_id' and sess='$sess'";
    $cartsqlupdate = mysqli_query( $link, $cartupdate );
    $cartsqlist = mysqli_fetch_array( $cartsqlupdate );
    $qty_record = $cartsqlist[ 'qty' ] + $prodQty;

    if ( $cartsqlist[ 'product_id' ] == $product_id && $cartsqlist[ 'sess' ] == $sess) {
      $queryatleast = "update cart SET qty='$qty_record',varient_names='$prodSize',verientlist='$prodColor' WHERE product_id='$product_id' and sess='$sess'";
      mysqli_query( $link, $queryatleast );
    } else {
      $query = "insert into cart(price,sess,qty,product_id,date,varient_names,verientlist)values('$priceid','$sess','$prodQty','$product_id',now(),'$prodSize','$prodColor')";
      mysqli_query( $link, $query );
    }
    $sql_check1 = "select * from cart WHERE sess='$sess'";
    $res_check1 = mysqli_query( $link, $sql_check1 );
   $cartcount = mysqli_num_rows( $res_check1 );
  }
$add_meesg[] = '<div class="alert alert-info alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong style="font-size:35px">Success!</strong><p style="font-size:25px">Product add to cart Successfully.</p></div>';
$errflag = true;
$_SESSION['ADDTO_CART_MESSAGE'] = $add_meesg;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);	
ob_end_flush();	

}


?>
<a href="cart/"> <i class="icon icon-cart"></i> <span class="badge"><?php echo $cartcount;?></span> </a>
							<!-- minicart wrapper -->
							<div class="dropdown-container right">
								<!-- minicart content -->
								<div class="block block-minicart">
									<div class="minicart-content-wrapper">
										<div class="block-title">
											<span>Recently added item(s)</span>
										</div>
										<a class="btn-minicart-close" title="Close">&#10060;</a>
										<div class="block-content">
											<div class="minicart-items-wrapper overflowed">
												<ol class="minicart-items">
													<?php
        $res_check2 = mysqli_query( $link, $sql_check1 );
        while ( $cart_list2 = mysqli_fetch_array( $res_check2 ) ) {

          $cart_prod_id = $cart_list2[ 'product_id' ];
          $subtotal = $subtotal + ( $cart_list2[ 'price' ] * $cart_list2[ 'qty' ] );
          $product_cart = "select * from products where id='$cart_prod_id'";

          $result_product_cart = mysqli_query( $link, $product_cart );

          $List_product_cart = mysqli_fetch_array( $result_product_cart );

          //$totalcart =$totalcart + $subtotal;

          ?>
													<li class="item product product-item">
														<div class="product">
															<a class="product-item-photo" href="#" title="Long sleeve overall">
																<span class="product-image-container">
																<span class="product-image-wrapper">
																<img class="product-image-photo" src="<?php echo $product_paath.str_replace(" ", '%20', $List_product_cart['image2']); ?>" alt="<?php echo $List_product_cart['title'];?>">
																</span>
																</span>
															</a>
															<div class="product-item-details">
																<div class="product-item-name">
																	<a href="#"><?php echo $List_product_cart['title'];?></a>
																</div>
																<div class="product-item-qty">
																	<label class="label">Qty</label>
																	<input class="item-qty cart-item-qty" maxlength="12" value="<?php echo $cart_list2['qty'];?>">
																	<button class="update-cart-item" style="display: none" title="Update">
																		<span>Update</span>
																	</button>
																</div>
																<div class="product-item-pricing">
																	<div class="price-container">
																		<span class="price-wrapper">
																			<span class="price-excluding-tax">
																			<span class="minicart-price">
																			<span class="price">Rs. <?php echo $cart_list2['price'] * $cart_list2['qty'];?></span> </span>
																		</span>
																		</span>
																	</div>
<!--
																	<div class="product actions">
																		<div class="secondary">
																			<a href="#" class="action delete" title="Remove item">
																				<span>Delete</span>
																			</a>
																		</div>
																		<div class="primary">
																			<a class="action edit" href="#" title="Edit item">
																				<span>Edit</span>
																			</a>
																		</div>
																	</div>
-->
																</div>
															</div>
														</div>
													</li>
													<?php }?>
												</ol>
											</div>
											<div class="subtotal">
												<span class="label">
													<span>Subtotal</span>
												</span>
												<div class="amount price-container">
													<span class="price-wrapper">Rs. <span class="price"><?php echo number_format($subtotal,2, '.', ',');?></span></span>
												</div>
											</div>
											<div class="actions">
												<div class="secondary">
													<a href="cart/" class="btn btn-alt">
														<i class="icon icon-cart"></i><span>View and edit cart</span>
													</a>
												</div>
												<div class="primary">
													<a class="btn" href="checkout/">
														<i class="icon icon-external-link"></i><span>Go to Checkout</span>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /minicart content -->
							</div>
							<!-- /minicart wrapper -->