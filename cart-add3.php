<?php
include( "config.php" );
//  $priceid = $listprod[ "price" ];
  if ($_SESSION[ 'member_id' ] ) {

    $sql_check1 = "select * from cart WHERE userid='$customerchechlogin_id'";
    $res_check1 = mysqli_query( $link, $sql_check1 );
    $cartcount = mysqli_num_rows( $res_check1 );
  } else {
	
    $sql_check1 = "select * from cart WHERE sess='$sess'";
    $res_check1 = mysqli_query( $link, $sql_check1 );
   $cartcount = mysqli_num_rows( $res_check1 );
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