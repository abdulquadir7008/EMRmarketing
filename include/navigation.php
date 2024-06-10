		<!-- Header -->
			<header class="page-header fullboxed sticky smart" >
				<div class="navbar">
					<div class="container">
						<!-- Menu Toggle -->
						<div class="menu-toggle"><a href="#" class="mobilemenu-toggle"><i class="icon icon-menu"></i></a></div>
						<!-- /Menu Toggle -->
						<!-- Header Cart -->
						<div class="header-link dropdown-link header-cart variant-1" id="countcart2">
							<a href="cart/"> <i class="icon icon-cart"></i> <span class="badge"><?php
								
								echo mysqli_num_rows($res_check1);?></span> </a>
							<!-- minicart wrapper -->
							<div class="dropdown-container right">
								<!-- minicart content -->
								<div class="block block-minicart">
									<div class="minicart-content-wrapper">
										<div class="block-title">
											<span>Recently added item(k)</span>
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

          $totalcart =$totalcart + $subtotal;

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
						</div>
						<!-- /Header Cart -->
						<!-- Header Links -->
						<div class="header-links">
							<!-- Header Language -->
<!--
							<div class="header-link header-select dropdown-link header-language">
								<a href="#"><img src="images/flags/eng.png" alt /></a>
								<ul class="dropdown-container">
									<li class="active">
										<a href="#"><img src="images/flags/eng.png" alt />English</a>
									</li>
									
								</ul>
							</div>
-->
							<!-- /Header Language -->
							<!-- Header Currency -->
<!--
							<div class="header-link header-select dropdown-link header-currency">
								<a href="#">INR</a>
								<ul class="dropdown-container">
									<li><a href="#"><span class="symbol">₹</span>INR</a></li>
									<li class="active"><a href="#"><span class="symbol">$</span>USD</a></li>
									
								</ul>
							</div>
-->
							<!-- /Header Currency -->
							<!-- Header Account -->
							<div class="header-link dropdown-link header-account">
								<?php if($customerchechlogin_id!=0 && $customerchechlogin_row['member_id']!='') {?>
								<a href="logout.php"><a href="#"><i class="icon icon-user"></i></a> Welcome to <?php echo $customerchechlogin_row['lname'];?>
								<div class="dropdown-container right">
									<div class="profile-link"><a href="profile/" <?php if($setpagename == 'profile'){?>class="active"<?php } ?>>Dashboard</a></div>
									<div class="profile-link"><a href="wishlist.php">Wish List</a></div>
									<div class="profile-link"><a href="order.php">Order</a></div>
									<div class="profile-link"><a href="logout.php">Logout</a></div>
								</div>
								<?php }else { ?>
								<a href="#"><i class="icon icon-user"></i></a>
								<div class="dropdown-container right">
									<div class="title">Registered Customers</div>
									<div class="top-text">If you have an account with us, please log in.</div>
									<!-- form -->
									<form action="<?php echo $domain_url ?>/emrscript/login_proccess.php" method="post">
										<input type="text" name="email" class="form-control" placeholder="E-mail or User ID*" required>
										<input type="password" name="password" class="form-control" placeholder="Password*">
										<button type="submit" class="btn">Sign in</button>
									</form>
									
									<!-- /form -->
									<div class="title">OR</div>
									<div class="popup-fblogin clearfix">
	  <div><a href = "faceconfig.php"><img src="images/facbookicon.jpg"></a></div>
      <div><a href = "#"><?php echo $login_button_popup;?></a></div>
										
	  </div>
									<p align="center"><a href="reset.php" style="color: #000; text-decoration: underline;">Forgot password</a></p>
									<div class="bottom-text">Create a <a href="register/">New Account</a></div>
								</div>
								<?php } ?>
							</div>
							<!-- /Header Account -->
						</div>
						<!-- /Header Links -->
						<!-- Header Search -->
						<div class="header-link header-search header-search">
							<div class="exp-search">
								<form>
									<input class="exp-search-input " placeholder="Search here ..." type="text" value="">
									<input class="exp-search-submit" type="submit" value="">
									<span class="exp-icon-search"><i class="icon icon-magnify"></i></span>
									<span class="exp-search-close"><i class="icon icon-close"></i></span>
								</form>
							</div>
						</div>
						<!-- /Header Search -->
						<!-- Logo -->
						<div class="header-logo">
							<a href="index.php" title="Logo">
								<img src="images/logo.jpg">							</a>
						</div>
						<!-- /Logo -->
						<!-- Mobile Menu -->
						<div class="mobilemenu dblclick">
							<div class="mobilemenu-header">
								<div class="title">MENU</div>
								<a href="#" class="mobilemenu-toggle"></a>
							</div>
							<div class="mobilemenu-content">
								<ul class="nav">
									<li><a href="index.php">HOME</a><span class="arrow"></span>
										
									</li>
									<li> <a href="aboutUs/" title="">About us</a><span class="arrow"></span>
										
									</li>
									<li class="simple-dropdown"><a href="#">Men</a><span class="arrow"></span>
									<div class="sub-menu">
										<ul class="category-links">
											<?php $men_cat_sql = mysqli_query( $link,"select * from category WHERE maincat='men' and status='1'"); while($list_men_cat = mysqli_fetch_array( $men_cat_sql )){
											?>
											<li> <a href="men/<?php echo $list_men_cat['seo_keywords'];?>/" title=""><?php echo $list_men_cat['title'];?></a> </li>
											<?php } ?>
											
										</ul>
									</div>
									</li>
									<li class="simple-dropdown"><a href="#">Women</a><span class="arrow"></span>
									<div class="sub-menu">
										<ul class="category-links">
											<?php $men_cat_sql = mysqli_query( $link,"select * from category WHERE maincat='women' and status='1'"); while($list_men_cat = mysqli_fetch_array( $men_cat_sql )){
											?>
											<li> <a href="women/<?php echo $list_men_cat['seo_keywords'];?>/" title=""><?php echo $list_men_cat['title'];?></a> </li>
											<?php } ?>
										</ul>
									</div>
									
									</li>
									
								</ul>
							</div>
						</div>
						<!-- Mobile Menu -->						<!-- Mega Menu -->
						<div class="megamenu fadein blackout">							<ul class="nav">
                            	<li><a href="index.php" title=""><i class="icon icon-home"></i></a></li>
								
								<li class="simple-dropdown">
									<a href="aboutUs/" title="">About Us</a>
									
								</li>
								<li class="simple-dropdown">
									<a href="#">Men</a>
									<div class="sub-menu">
										<ul class="category-links">
											<?php $men_cat_sql = mysqli_query( $link,"select * from category WHERE maincat='men' and status='1'"); while($list_men_cat = mysqli_fetch_array( $men_cat_sql )){
											?>
											<li> <a href="men/<?php echo $list_men_cat['seo_keywords'];?>/" title=""><?php echo $list_men_cat['title'];?></a> </li>
											<?php } ?>
											
										</ul>
									</div>
								</li>
								<li class="simple-dropdown">
									<a href="#">Women</a>
									<div class="sub-menu">
										<ul class="category-links">
											<?php $men_cat_sql = mysqli_query( $link,"select * from category WHERE maincat='women' and status='1'"); while($list_men_cat = mysqli_fetch_array( $men_cat_sql )){
											?>
											<li> <a href="women/<?php echo $list_men_cat['seo_keywords'];?>/" title=""><?php echo $list_men_cat['title'];?></a> </li>
											<?php } ?>
										</ul>
									</div>
								</li>
							
							<li class="simple-dropdown">
									<a href="#">Kids</a>
									<div class="sub-menu">
										<ul class="category-links">
											<?php $men_cat_sql = mysqli_query( $link,"select * from category WHERE maincat='kids' and status='1'"); while($list_men_cat = mysqli_fetch_array( $men_cat_sql )){
											?>
											<li> <a href="kids/<?php echo $list_men_cat['seo_keywords'];?>/" title=""><?php echo $list_men_cat['title'];?></a> </li>
											<?php } ?>
										</ul>
									</div>
								</li>
							
								
								<li class="simple-dropdown">
									<a href="blog/" title="">Blog</a>
									
								</li>
							</ul>
						</div>
						<!-- /Mega Menu -->
</div>
				</div>
			</header>
			<!-- /Header -->
			<!-- Sidebar -->
			<div class="sidebar-wrapper">
				<div class="sidebar-top"><a href="#" class="slidepanel-toggle"><i class="icon icon-left-arrow-circular"></i></a></div>
				<ul class="sidebar-nav">
					<li> <a href="index.php">HOME</a> </li>
					<li> <a href="gallery/">GALLERY</a> </li>
					<li> <a href="blog/">BLOG</a> </li>
					<li> <a href="faq/">FAQ</a> </li>
					<li> <a href="contact/">CONTACT</a> </li>
				</ul>
				<div class="sidebar-bot">
					<div class="share-button toTop">
						<span class="toggle"></span>
						<ul class="social-list">
							<li>
								<a href="#" class="icon icon-google google"></a>
							</li>
							<li>
								<a href="#" class="icon icon-fancy fancy"></a>
							</li>
							<li>
								<a href="#" class="icon icon-pinterest pinterest"></a>
							</li>
							<li>
								<a href="#" class="icon icon-twitter-logo twitter"></a>
							</li>
							<li>
								<a href="#" class="icon icon-facebook-logo facebook"></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /Sidebar -->