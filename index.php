<?php include_once('include/configuration.php');?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from big-skins.com/frontend/EMR/html/index-layout-6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Mar 2023 07:02:11 GMT -->
<?php include_once('include/head.php');?>

<body class="fullwidth open-panel">
	<!-- Loader -->
	<div id="loader-wrapper">
		<div class="cube-wrapper">
			<div class="cube-folding">
				<span class="leaf1"></span>
				<span class="leaf2"></span>
				<span class="leaf3"></span>
				<span class="leaf4"></span>
			</div>
		</div>
	</div>
	<!-- /Loader -->
	
	<div id="wrapper">

		<!-- Page -->
		<div class="page-wrapper">
	<?php include_once('include/navigation.php');?>
			<!-- Page Content -->
			<main class="page-main">
				<div class="block fullwidth full-nopad bot-null">
					<div class="container">
						<!-- Main Slider -->
						<div class="mainSlider" data-thumb="true" data-thumb-width="230" data-thumb-height="100">
							<div class="sliderLoader">Loading...</div>
							<!-- Slider main container -->
							<div class="swiper-container">
								<div class="swiper-wrapper">
									<!-- Slides -->
									
									<div class="swiper-slide">
										<!-- _blank or _self ( _self is default )-->
										<div class="wrapper">
											<figure><img src="images/slider/slide-02.jpg" alt=""></figure>
											<div class="text2-1 animate" data-animate="flipInY" data-delay="0"> EMR</div>
											<div class="text2-2 animate" data-animate="bounceIn" data-delay="500"> Season sale </div>
											<div class="text2-3 animate" data-animate="bounceIn" data-delay="1000"> popular brands </div>
											<div class="text2-4 animate" data-animate="rubberBand" data-delay="1500"> 20% </div>
											<div class="text2-5 animate" data-animate="hinge" data-delay="2000"> OFF </div>
										</div>
									</div>
									<div class="swiper-slide">
										<div class="wrapper">
											<figure><img src="images/slider/slide-01.jpg" alt=""></figure>
											<div class="caption animate" data-animate="fadeIn">
												<div class="text1 animate" data-animate="flipInY" data-delay="0"> EMR </div>
												<div class="text2 animate" data-animate="bounceInLeft" data-delay="500"> <strong>New</strong> collection </div>
												<div class="text3 animate" data-animate="bounceInLeft" data-delay="1500"> WOMEN'S <strong>FASHION</strong> </div>
												<div class="animate" data-animate="fadeIn" data-delay="2000">
													<!-- coolbutton -->
													<a href="#" class="cool-btn" style="-webkit-clip-path: url(#coolButton); clip-path: url(#coolButton);"> <span>MORE</span> </a>
													<svg class="clip-svg">
														<defs>
															<clipPath id="coolButton" clipPathUnits="objectBoundingBox">
																<polygon points="0 .18, .99 .15, .91 .85, .07 .8" />
															</clipPath>
														</defs>
													</svg>
													<!-- // coolbutton -->
												</div>
											</div>
										</div>
									</div>
									<div class="swiper-slide">
										<div class="wrapper">
											<figure><img src="images/slider/slide-03.jpg" alt=""></figure>
											<div class="text3-1 animate" data-animate="bounceInDown" data-delay="0"> Street </div>
											<div class="text3-2 animate" data-animate="bounceInDown" data-delay="500"> Fashion </div>
											<div class="text3-3 animate" data-animate="bounceInDown" data-delay="1000"> And </div>
											<div class="text3-4 animate" data-animate="bounceIn" data-delay="1500"> Urban </div>
											<div class="text3-5 animate" data-animate="bounceIn" data-delay="2000"> Subcultures </div>
											<a href="#" class="text3-6 animate" data-animate="rubberBand" data-delay="2500"> SHOP NOW </a>
										</div>
									</div>
									<div class="swiper-slide">
										<div class="wrapper">
											<figure><img src="images/slider/slide-04.jpg" alt=""></figure>
											<div class="text4-1 animate" data-animate="bounceInLeft" data-delay="0">Winter</div>
											<div class="text4-2 animate chng" data-animate="bounceInDown" data-delay="500">very soon</div>
											<div class="text4-3 animate" data-animate="bounceInUp" data-delay="1000">Things to buy a swimsuit at a discount</div>
											<a href="#" class="text4-4 animate" data-animate="bounceInLeft" data-delay="1500">SHOP NOW</a>
										</div>
									</div>
									
								</div>
								<!-- pagination -->
								<div class="swiper-pagination"></div>
								<!-- pagination thumbs -->
								<div class="swiper-pagination-thumbs">
									<div class="thumbs-wrapper">
										<div class="thumbs"></div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Main Slider -->
					</div>
				</div>
				<div class="block top-negative">
					<div class="container">
						<div style="background: #0172fe; padding: 10px 10px 3px; color: #fff; font-size: 18px; margin: 56px 0; text-align: center; font-weight: bold;">
						<p>This is our shopping Site in which our products will be dresses, jeans, t-shirts, shoes and paint. Our own support is present for everything. There is no multivendor and chain system available in it.</p>
					</div>
						<div class="title">
							<h2 class="h-bg">Featured products</h2>
							<div class="carousel-arrows"></div>
						</div>
						<div class="products-grid products-carousel carousel-negative product-variant-2 featured-products">
							<?php 
							$sql_product_feature = mysqli_query($link,"select * from products where feature='on' and status='1' order by id DESC limit 10"); while($list_feature_product=mysqli_fetch_array($sql_product_feature)){
							?>
							<!-- Product Item -->
							<div class="product-item large">
								<div class="product-item-inside">
									<div class="product-item-info">
										<!-- Product Photo -->
										<div class="product-item-photo">
											<!-- product inside carousel -->
											<div class="carousel-inside slide" data-ride="carousel">
												<div class="carousel-inner" role="listbox">
													<div class="item active">
														<a href="<?php echo $list_feature_product['seo_keywords'];?>/"><img class="product-image-photo" src="<?php echo $product_paath.str_replace(" ", '%20', $list_feature_product['image2']); ?>" alt="<?php echo $list_feature_product['title']; ?>"></a>
													</div>
													
													
												</div>
												
											</div>
											<!-- /product inside carousel -->
											<!-- Product Actions -->
											<div class="product-item-actions">
												<div class="actions-primary">
													<?php if($list_feature_product['inventory'] >0){ ?>
													
													<?php } ?>
												</div>
												<div class="actions-secondary">
												
													<a href="quick_view.php?prod=<?php echo $list_feature_product['id']; ?>" class="quick-view-link btn btn-primary" title="Quick View">  <i class="icon icon-eye"></i> View </a>
													
<!--													<a href="include/wishlist.php?wish=<?php echo $list_feature_product['id']; ?>" title="Wish List" class="wishlist active"> <i class="icon icon-heart"></i> </a>-->
												</div>
												
											</div>
											<!-- /Product Actions -->
										</div>
										<!-- /Product Photo -->
										<!-- Product Details -->
										<div class="product-item-details">
											<div class="product-item-name"> <a title="Boyfriend Short" href="<?php echo $list_feature_product['seo_keywords'];?>/" class="product-item-link"><?php echo ucfirst($list_feature_product['title']);?></a> </div>
											<div class="product-item-description">
												<?php  echo substr($list_feature_product['description'], 0, 80)."...";?>
											</div>
											<div class="price-box">
												<?php if($list_feature_product['sprice']){?><del> Rs. <?php echo number_format($list_feature_product['price'],2, '.', ',');?> </del>

                <span class="price-container"> Rs. <span class="price-wrapper"><span class="special-price"><?php echo number_format($list_feature_product['sprice'],2, '.', ','); $mibprc = $list_feature_product['sprice'];?></span></span> </span><?php }else 

                {?> Rs. <span class="price-container"> <span class="price-wrapper"><span class="special-price"><?php echo number_format($list_feature_product['price'],2, '.', ','); $mibprc = $list_feature_product['price'];?> </span> </span>
												</span> <?php } ?>
											</div>
											<!-- Product Actions -->
											
											<!-- /Product Actions -->
										</div>
										<!-- /Product Details -->
									</div>
								</div>
							</div>
							<!-- /Product Item -->
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="block">
					<div class="container">
						<div class="row">
							<div class="col-sm-4 col-md-3 col-lg-3">
								<div class="banner style-1 autosize-text image-hover-scale" data-fontratio="4.2">
									<img src="images/banners/banner-1.jpg" alt="Banner">
									<div class="banner-caption vertb">
										<div class="vert-wrapper">
											<div class="vert">
												<div class="text-1"> New collection</div>
												<div class="text-2"> WOMEN'S FASHION</div>
												<div class="text-3"> SAVE UP TO 40% OF</div>
												<a href="#buttonlink" class="banner-btn-wrap">
													<div class="banner-btn text-hoverslide" data-hcolor="#f82e56"><span><span class="text">SHOP NOW</span><span class="hoverbg"></span></span>
													</div>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-8 col-md-9 col-lg-9">
								<!-- Sale Products -->
								<div class="title">
									<h2>Sale products</h2>
									<div class="carousel-arrows"></div>
								</div>
								<div class="products-grid products-carousel product-variant-1 sale-products">
									
									<?php $sql_product_feature = mysqli_query($link,"select * from products where best='on' and status='1' order by id DESC limit 10"); while($list_feature_product=mysqli_fetch_array($sql_product_feature)){
							?>
							<!-- Product Item -->
							<div class="product-item large">
								<div class="product-item-inside">
									<?php if($list_feature_product['new']=='on'){?>
									<div class="product-item-label label-new"><span>New</span></div>
									<?php } ?>
									<div class="product-item-info">
										<!-- Product Photo -->
										<div class="product-item-photo">
											<!-- product inside carousel -->
											<div class="carousel-inside slide" data-ride="carousel">
												<div class="carousel-inner" role="listbox">
													<div class="item active">
														<a href="<?php echo $list_feature_product['seo_keywords'];?>/"><img class="product-image-photo" src="<?php echo $product_paath.str_replace(" ", '%20', $list_feature_product['image2']); ?>" alt="<?php echo $list_feature_product['title']; ?>"></a>
													</div>
													
													
												</div>
												
											</div>
											<!-- /product inside carousel -->
											<!-- Product Actions -->
<!--
											<div class="product-item-actions">
												<div class="actions-primary">
													
													<button class="btn btn-sm btn-invert add-to-cart listcartadd" id="<?php echo $list_feature_product['id']; ?>"> <i class="icon icon-cart"></i><span>Add to Cart</span> </button>
												</div>
												<div class="actions-secondary">
												
													<a href="quick-view.html" class="quick-view-link" title="Quick View"> <i class="icon icon-eye"></i> </a>
													<a href="#" title="Wish List" class="wishlist active"> <i class="icon icon-heart"></i> </a>
												</div>
												
											</div>
-->
											<!-- /Product Actions -->
										</div>
										<!-- /Product Photo -->
										<!-- Product Details -->
										<div class="product-item-details">
											<div class="product-item-name"> <a title="Boyfriend Short" href="<?php echo $list_feature_product['seo_keywords'];?>/" class="product-item-link"><?php echo ucfirst($list_feature_product['title']);?></a> </div>
											<div class="product-item-description">
												<?php  echo substr($list_feature_product['description'], 0, 80)."...";?>
											</div>
											<div class="price-box">
												<?php if($list_feature_product['sprice']){?><del> Rs. <?php echo number_format($list_feature_product['price'],2, '.', ',');?> </del>

                <span class="price-container"> Rs. <span class="price-wrapper"><span class="special-price"><?php echo number_format($list_feature_product['sprice'],2, '.', ','); $mibprc = $list_feature_product['sprice'];?></span></span> </span><?php }else 

                {?> Rs. <span class="price-container"> <span class="price-wrapper"><span class="special-price"><?php echo number_format($list_feature_product['price'],2, '.', ','); $mibprc = $list_feature_product['price'];?> </span> </span>
												</span> <?php } ?>
												
												
											</div>
											<!-- Product Actions -->
											
											<div class="product-item-actions">
												<div class="actions-primary">
													<a href="quick_view.php?prod=<?php echo $list_feature_product['id']; ?>" class="quick-view-link btn btn-sm btn-invert" title="Quick View">  <i class="icon icon-eye"></i> View </a>
<!--													<button class="btn btn-sm btn-invert listcartadd" id="<?php echo $list_feature_product['id']; ?>"> <i class="icon icon-cart"></i><span>Add to Cart</span> </button>-->
												</div>
											</div>
											<!-- /Product Actions -->
										</div>
										<!-- /Product Details -->
									</div>
								</div>
							</div>
							<!-- /Product Item -->
							<?php } ?>
									
									
									
								</div>
								<!-- /Sale Products -->
							</div>
						</div>
					</div>
				</div>
				<div class="block">
					<div class="container">
						<div class="row">
							<div class=" col-md-4 col-lg-6">
								<div class="collapsed-mobile">
									<!-- Blog Carousel -->
									<div class="title">
										<h2>From Blog</h2>
										<div class="toggle-arrow"></div>
										<div class="carousel-arrows"></div>
									</div>
									<div class="collapsed-content">
										<!-- Blog Carousel Item -->
										<div class="blog-carousel">
											<?php
      $blg = 1;
      $query_blog = "SELECT * FROM blog WHERE status='1' order by date DESC LIMIT 3";
      $result_blog = mysqli_query( $link, $query_blog );
      while ( $row_spldate = mysqli_fetch_array( $result_blog ) ) {
        $blogid = $row_spldate[ 'id' ];
        $blgrt = $blg * 2;
        $famedate = date( "m-Y", $row_spldate[ 'date' ] );
      //  $sql_comment = "select * from comment WHERE blog_id='$blogid'";
       //  $result_comment = mysqli_query( $link, $sql_comment );

        ?>
											<div class="blog-item">
												<?php if($row_spldate['image'])	{?>
												<a href="blog/<?php echo $row_spldate['kewords'];?>/" class="blog-item-photo"> <img class="product-image-photo" src="uploads/<?php echo $row_spldate['image'];?>" alt="<?php echo $row_spldate['title'];?>"> </a>
												<?php } ?>
												<div class="blog-item-info">
													<a href="blog/<?php echo $row_spldate['kewords'];?>/" class="blog-item-title"><?php echo  $row_spldate['title'];?></a>
													<div class="blog-item-teaser"><?php echo $row_spldate['sort_ttile'];?></div>
													<div class="blog-item-links"> <span class="pull-left"> <span><a href="blog/<?php echo $row_spldate['kewords'];?>/" class="readmore">Read more</a></span> </span> <span class="pull-right">
													</div>
												</div>
											</div>
											<?php } ?>
											
										</div>
										<!-- /Blog Carousel -->
									</div>
								</div>
							</div>
							<div class="col-md-4 col-lg-4">
								<div class="collapsed-mobile">
									<!-- Testimonials Carousel -->
									<div class="title">
										<h2>Testimonials</h2>
										<div class="toggle-arrow"></div>
										<div class="carousel-arrows"></div>
									</div>
									<div class="collapsed-content">
										<div class="testimonials-carousel">
											<!-- Testimonials Carousel Item -->
											<div class="testimonials-item">
												<div class="testimonials-item-info">
													<a href="testimonials.html" class="testimonials-item-author-photo"> <img class="product-image-photo" src="images/testimonials/testimonial-author-1.jpg" alt="Testimonials Author"> </a>
													<div class="testimonials-item-details">
														<a href="testimonials.html" class="testimonials-item-author-name">Sarah Nodd</a>
														<div class="testimonials-item-date"> <span>14:21</span> <span>21.04.16</span> </div>
														<div class="testimonials-item-teaser">Lorem ipsum dolor sit amet, consectetur delectus consequuntur consectetur</div>
													</div>
												</div>
											</div>
											<!-- /Testimonials Carousel Item -->
											<!-- Testimonials Carousel Item -->
											<div class="testimonials-item">
												<div class="testimonials-item-info">
													<a href="testimonials.html" class="testimonials-item-author-photo"> <img class="product-image-photo" src="images/testimonials/testimonial-author-2.jpg" alt="Testimonials Author"> </a>
													<div class="testimonials-item-details">
														<a href="testimonials.html" class="testimonials-item-author-name">Tom Sollers</a>
														<div class="testimonials-item-date"> <span>17:36</span> <span>27.05.16</span> </div>
														<div class="testimonials-item-teaser">Aliquid culpa ea doloremque repellat delectus consequuntur consectetur</div>
													</div>
												</div>
											</div>
											<!-- /Testimonials Carousel Item -->
											<!-- Testimonials Carousel Item -->
											<div class="testimonials-item">
												<div class="testimonials-item-info">
													<a href="testimonials.html" class="testimonials-item-author-photo"> <img class="product-image-photo" src="images/testimonials/testimonial-author-3.jpg" alt="Testimonials Author"> </a>
													<div class="testimonials-item-details">
														<a href="testimonials.html" class="testimonials-item-author-name">Thomas Eringer</a>
														<div class="testimonials-item-date"> <span>18:45</span> <span>24.04.16</span> </div>
														<div class="testimonials-item-teaser">Libero delectus consequuntur consectetur culpa ea doloremque repellat </div>
													</div>
												</div>
											</div>
											<!-- /Testimonials Carousel Item -->
											<!-- Testimonials Carousel Item -->
											<div class="testimonials-item">
												<div class="testimonials-item-info">
													<a href="testimonials.html" class="testimonials-item-author-photo"> <img class="product-image-photo" src="images/testimonials/testimonial-author-4.jpg" alt="Testimonials Author"> </a>
													<div class="testimonials-item-details">
														<a href="testimonials.html" class="testimonials-item-author-name">Andrea Finter</a>
														<div class="testimonials-item-date"> <span>11:15</span> <span>27.04.16</span> </div>
														<div class="testimonials-item-teaser">Optio tempore architecto perferendis delectus consequuntur consectetur</div>
													</div>
												</div>
											</div>
											<!-- /Testimonials Carousel Item -->
										</div>
									</div>
									<!-- /Testimonials Carousel -->
								</div>
								<div class="newsletter variant1 collapsed-mobile">
									<div class="title">
										<h2>Newsletter</h2>
										<div class="toggle-arrow"></div>
									</div>
									<div class="collapsed-content">
										<!-- input-group -->
										<form action="#">
											<div class="input-group">
												<input type="text" class="form-control">
												<span class="input-group-btn">
													<button class="btn btn-default" type="submit"><i class="icon icon-close-envelope"></i></button>
													</span>
											</div>
										</form>
										<!-- /input-group -->
									</div>
								</div>
							</div>
							<div class=" col-md-4 col-lg-2">
								<div class="collapsed-mobile">
									<div class="title">
										<h2>Contact</h2>
										<div class="toggle-arrow"></div>
									</div>
									<div class="collapsed-content">
										<ul class="contact-list">
											<li>
												<h3><i class="icon icon-location-pin"></i>ADDRESS</h3>
												<div><strong>EMR Marketing LLC</strong><br>Shop No.2, Opp New Airport Authority of India Building, Sahar Road, Parsiwada, Andheri-East,Mumbai-400099</div>
											</li>
											<li>
												<h3><i class="icon icon-close-envelope"></i>Email</h3>
												<div><a href="#">support@emrmarketing.in</a></div>
												
											</li>
											<li>
												<h3><i class="icon icon-phone"></i>PHONE</h3>
												<div>Phone : +91 9867724488/9136663355
												</div>
											</li>
											
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
			<!-- /Page Content -->
<?php include('include/footer.php');?>
