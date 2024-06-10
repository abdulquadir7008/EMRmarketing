<?php
include_once( 'include/configuration.php' );
$keywords20 = mysqli_real_escape_string( $link, $_GET[ 'seo_keyword3' ] );
$SQLproductDetails = "select * from products where status='1' AND seo_keywords='$keywords20'";
$MySQLProductDetails = mysqli_query($link,$SQLproductDetails); 
$ListproductDetails = mysqli_fetch_array($MySQLProductDetails);
$productDetID = $ListproductDetails['id'];
$product_brandID = $ListproductDetails['brand_id'];	
  $SQLbrandProd="select * from brand where status='1' AND id='$product_brandID'";	
$MySqlBrandProd = mysqli_query($link,$SQLbrandProd); 
$ListBrandProd=mysqli_fetch_array($MySqlBrandProd);
$setpagename;
//$parentcat_keyword;


$SQL_Pages = "select * from cms_pages where status='1' AND seo_keyword='$productDetailsKey'";
$Result_pages = mysqli_query($link,$SQL_Pages); 
$ListPages = mysqli_fetch_array($Result_pages);
if(isset($_SESSION['size'])){
	$mib_size = $_SESSION['size'];
	$sqlmibsize = "select * from prod_verient where keyword='$mib_size'";
	$resmibsql = mysqli_query($link,$sqlmibsize); 
	$listmibsql = mysqli_fetch_array($resmibsql);
	$prod_price = $listmibsql['product_price'];
	$mibvert_size = $listmibsql['product_price'];
}
else
{	if($ListproductDetails['sprice']){
	$prod_price = $ListproductDetails['sprice'];
}
 else{
	 $prod_price = $ListproductDetails['price'];
 }
	
}

if(isset($_SESSION['color'])){
	$mib_color = $_SESSION['color'];
	$sqlmibcolor = "select * from prod_color where picker_id='$mib_color'";
	$resmibsqlcolor = mysqli_query($link,$sqlmibcolor); 
	$listcolor = mysqli_fetch_array($resmibsqlcolor);
	$prod_color = $listcolor['image'];
	$prod_color2 = $listcolor['image2'];
	
}
else{
	$prod_color = $ListproductDetails['image'];
	$prod_color2 = $ListproductDetails['image2'];
}

?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from big-skins.com/frontend/EMR/html/index-layout-6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Mar 2023 07:02:11 GMT -->
<?php include_once('include/head.php');?>

<body class="boxed">
<!-- Loader -->
<div id="loader-wrapper">
  <div class="cube-wrapper">
    <div class="cube-folding"> <span class="leaf1"></span> <span class="leaf2"></span> <span class="leaf3"></span> <span class="leaf4"></span> </div>
  </div>
</div>
<!-- /Loader -->

<div id="wrapper">

<!-- Page -->
<div class="page-wrapper">
<?php include_once('include/navigation.php');?>
<!-- Page Content -->
	<?php if($ListproductDetails!=''){?>
<main class="page-main">
				<div class="block">
					<div class="container">
						<ul class="breadcrumbs">
							<li><a href="index.html"><i class="icon icon-home"></i></a></li>
							<li>/<a href="#">Women</a></li>
							<li>/<span><?php echo $ListproductDetails['title'];?> </span></li>
<!--
							<li class="product-nav">
								<i class="icon icon-angle-left"></i><a href="#" class="product-nav-prev">prev product
									<span class="product-nav-preview">
										<span class="image"><img src="images/products/product-prev-preview.jpg" alt=""><span class="price">$280</span></span>
										<span class="name">Black swimsuit</span>
									</span></a>/
								<a href="#" class="product-nav-next">next product
									<span class="product-nav-preview">
										<span class="image"><img src="images/products/product-next-preview.jpg" alt=""><span class="price">$280</span></span>
										<span class="name">Black swimsuit</span>
									</span></a><i class="icon icon-angle-right"></i>
							</li>
-->
						</ul>
					</div>
				</div>
				<div class="block product-block">
					<div class="container">
						<div class="row">
							<div class="col-sm-6 col-md-4 col-lg-4">
								<!-- Product Gallery -->
								<div class="main-image">
									<img src="<?php echo $product_paath.str_replace(" ", '%20', $ListproductDetails['image2']); ?>" class="zoom" alt="" data-zoom-image="<?php echo $product_paath.str_replace(" ", '%20', $ListproductDetails['image2']); ?>" />
									<div class="dblclick-text"><span><?php echo $ListproductDetails['title'];?> </span></div>
										
									<a href="<?php echo $product_paath.str_replace(" ", '%20', $ListproductDetails['image2']); ?>" class="zoom-link"><i class="icon icon-zoomin"></i></a>
								</div>
								<div class="product-previews-wrapper">
									
									<div class="product-previews-carousel" id="previewsGallery">
										<?php if($prod_color){
								$tags = preg_replace('/,+/', ',', $prod_color);
	 $Splitexpo=explode(",",$tags);
foreach ($Splitexpo as  $rowvalue) {
	if($rowvalue){ 
								?>
										<a href="<?php echo $domain_url.$product_paath.$rowvalue;?>" data-image="<?php echo $domain_url.$product_paath.$rowvalue;?>" data-zoom-image="<?php echo $domain_url.$product_paath.$rowvalue;?>"><img src="<?php echo $domain_url.$product_paath.$rowvalue;?>" alt="<?php echo $ListproductDetails['title'];?>" /></a>
										<?php }} }?>
										

									</div>
								</div>
								<!-- /Product Gallery -->
							</div>
							<div class="col-sm-6 col-md-8 col-lg-5">
								<div class="product-info-block classic">
									<div class="product-info-top">
										<div class="product-sku">SKU: <span>Stock Keeping Unit</span></div>
<!--
										<div class="rating">
											<i class="icon icon-star fill"></i><i class="icon icon-star fill"></i><i class="icon icon-star fill"></i><i class="icon icon-star fill"></i><i class="icon icon-star"></i><span class="count">248 reviews</span>
										</div>
-->
									</div>
									<div class="product-name-wrapper">
										<h1 class="product-name"><?php echo $ListproductDetails['title'];?></h1>
										<div class="product-labels">
											<?php if($ListproductDetails['new']=='on'){?>
               <span class="product-label new">NEW</span>
                <?php } ?>
											<?php if($ListproductDetails['best']=='on'){?>
                <span class="product-label sale">SALE</span>
                <?php } ?>
											
										</div>
									</div>
									<div class="product-availability">Availability: <span><?php if($ListproductDetails['inventory'] >0){ ?>In stock<?php }else {?> Out Stock<?php }?></span></div>
									<div class="product-description">
										<?php echo $ListproductDetails['description'];?>
									</div>
<!--
									<div class="countdown-circle hidden-xs">
										<div class="countdown-wrapper">
											<div class="countdown" data-promoperiod="0"></div>
											<div class="countdown-text">
												<div class="text1">Discount 45% OFF</div>
												<div class="text2">Hurry, there are only <span>14</span> item(s) left!</div>
											</div>
										</div>
									</div>
-->
									
									<div class="product-actions">
										
										
										
										
										<div class="row">
											
											<div class="col-md-8">
												<div class="price">
<?php if($ListproductDetails['sprice']){?><span class="old-price"> Rs. <?php echo number_format($ListproductDetails['price'],2, '.', ',');?> </span>

                <br><span class="price-wrapper"> Rs. <span class="price-wrapper"><span class="special-price"><?php echo number_format($ListproductDetails['sprice'],2, '.', ','); $mibprc = $ListproductDetails['sprice'];?></span></span> </span><?php }else 

                {?> Rs. <span class="price-container"> <span class="price-wrapper"><span class="special-price"><?php echo number_format($ListproductDetails['price'],2, '.', ','); $mibprc = $ListproductDetails['price'];?> </span> </span>
												</span> <?php } ?>
												</div>
												<div class="actions">
													<?php if($ListproductDetails['inventory'] >0){ ?>
													
													<a href="quick_view.php?prod=<?php echo $ListproductDetails['id']; ?>" class="quick-view-link btn btn-lg " title="Quick View">  <i class="icon icon-cart"></i> Add to Cart </a>
													
													<?php } ?>
													
													
													
													<a href="#" class="btn btn-lg product-details"><i class="icon icon-external-link"></i></a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
<!--
							<div class="col-md-12 col-lg-3 hidden-quickview">
								<div class="box-icon-row">
									<div class="box-left-icon-bg">
										<div class="box-icon"><i class="icon icon-gift"></i></div>
										<div class="box-text">
											<div class="title">Special offer: 1+2=4</div>
											Get a gift!
										</div>
									</div>
									<div class="box-left-icon-bg">
										<div class="box-icon"><i class="icon icon-dollar-bills"></i></div>
										<div class="box-text">
											<div class="title">Free Reward Card</div>
											Worth $10, $50, $100
										</div>
									</div>
									<div class="box-left-icon-bg">
										<div class="box-icon"><i class="icon icon-undo"></i></div>
										<div class="box-text">
											<div class="title">Order return</div>
											Returns within 5 days
										</div>
									</div>
								</div>
							</div>
-->
						</div>
					</div>
				</div>
			<!--	<div class="block">
					<div class="tabaccordion">
						<div class="container">
							<!-- Nav tabs -->
							<!--ul class="nav-tabs product-tab" role="tablist">
								<li><a href="#Tab1" role="tab" data-toggle="tab">Description</a></li>
								<li><a href="#Tab2" role="tab" data-toggle="tab">Custom tab</a></li>
								<li><a href="#Tab3" role="tab" data-toggle="tab">Sizing Guide</a></li>
								<li><a href="#Tab4" role="tab" data-toggle="tab">Tags</a></li>
								<li><a href="#Tab5" role="tab" data-toggle="tab">Reviews</a></li>
							</ul-->
							<!-- Tab panes -->
							<!--<div class="tab-content">
								<div role="tabpanel" class="tab-pane" id="Tab1">
									<p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful</p>
									<div class="table-responsive">
										<table class="table table-bordered table-striped">
											<tbody>
												<tr>
													<td><strong>PROOF</strong></td>
													<td>PDF Proof</td>
												</tr>
												<tr>
													<td><strong>SAMPLES</strong></td>
													<td>Digital, Printed</td>
												</tr>
												<tr>
													<td><strong>WRAPPING</strong></td>
													<td>Yes, No</td>
												</tr>
												<tr>
													<td><strong>UV GLOSS COATING</strong></td>
													<td>Yes</td>
												</tr>
												<tr>
													<td><strong>SHRINK WRAPPING</strong></td>
													<td>No Shrink Wrapping, Shrink in 25s, Shrink in 50s, Shrink in 100s</td>
												</tr>
												<tr>
													<td><strong>WEIGHT</strong></td>
													<td>0.05, 0.06, 0.07ess cards</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane" id="Tab2">
									<h3 class="custom-color">Take a trivial example which of us ever undertakes</h3>
									<p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure </p>
									<ul class="marker-simple-list two-columns">
										<li>Nam liberempore</li>
										<li>Cumsoluta nobisest</li>
										<li>Eligendptio cumque</li>
										<li>Nam liberempore</li>
										<li>Cumsoluta nobisest</li>
										<li>Eligendptio cumque</li>
									</ul>
								</div>
								<div role="tabpanel" class="tab-pane" id="Tab3">
									<h3>Single Size Conversion</h3>
									<div class="table-responsive">
										<table class="table table-bordered">
											<tbody>
												<tr>
													<td><strong>UK</strong></td>
													<td>
														<ul class="params-row">
															<li>18</li>
															<li>20</li>
															<li>22</li>
															<li>24</li>
															<li>26</li>
														</ul>
													</td>
												</tr>
												<tr>
													<td><strong>European</strong></td>
													<td>
														<ul class="params-row">
															<li>46</li>
															<li>48</li>
															<li>50</li>
															<li>52</li>
															<li>54</li>
														</ul>
													</td>
												</tr>
												<tr>
													<td><strong>US</strong></td>
													<td>
														<ul class="params-row">
															<li>14</li>
															<li>16</li>
															<li>18</li>
															<li>20</li>
															<li>22</li>
														</ul>
													</td>
												</tr>
												<tr>
													<td><strong>Australia</strong></td>
													<td>
														<ul class="params-row">
															<li>8</li>
															<li>10</li>
															<li>12</li>
															<li>14</li>
															<li>16</li>
														</ul>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane" id="Tab4">
									<ul class="tags">
										<li><a href="#"><span class="value"><span>Dresses</span></span></a></li>
										<li><a href="#"><span class="value"><span>Outerwear</span></span></a></li>
										<li><a href="#"><span class="value"><span>Tops</span></span></a></li>
										<li><a href="#"><span class="value"><span>Sleeveless tops</span></span></a></li>
										<li><a href="#"><span class="value"><span>Sweaters</span></span></a></li>
									</ul>
									<div class="divider"></div>
									<h3>Add your tag</h3>
									<form class="contact-form white" action="#">
										<label>Tag<span class="required">*</span></label>
										<input class="form-control input-lg">
										<div>
											<button class="btn btn-lg">Submit Tag</button>
										</div>
										<div class="required-text">* Required Fields</div>
									</form>
								</div>
								<div role="tabpanel" class="tab-pane" id="Tab5">
									<div class="table-responsive">
										<table class="table table-bordered table-striped">
											<thead>
												<tr>
													<td></td>
													<td class="text-center">1 star</td>
													<td class="text-center">2 star</td>
													<td class="text-center">3 star</td>
													<td class="text-center">4 star</td>
													<td class="text-center">5 star</td>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><strong>Price</strong></td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-price1" type="radio" name="vote-price" value="1"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-price2" type="radio" name="vote-price" value="2"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-price3" type="radio" name="vote-price" value="3"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-price4" type="radio" name="vote-price" value="4"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-price5" type="radio" name="vote-price" value="5"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
												</tr>
												<tr>
													<td><strong>Value</strong></td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-value1" type="radio" name="vote-value" value="1"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-value2" type="radio" name="vote-value" value="2"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-value3" type="radio" name="vote-value" value="3"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-value4" type="radio" name="vote-value" value="4"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-value5" type="radio" name="vote-value" value="5"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
												</tr>
												<tr>
													<td><strong>Quality</strong></td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-quality1" type="radio" name="vote-quality" value="1"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-quality2" type="radio" name="vote-quality" value="2"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-quality3" type="radio" name="vote-quality" value="3"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-quality4" type="radio" name="vote-quality" value="4"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-quality5" type="radio" name="vote-quality" value="5"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<h3>Add new review</h3>
									<form class="contact-form white" action="#">
										<label>Review<span class="required">*</span></label>
										<textarea class="form-control input-lg"></textarea>
										<div>
											<button class="btn btn-lg">Submit Review</button>
										</div>
										<div class="required-text">* Required Fields</div>
									</form>
								</div>
							</div> -->
						</div>
					</div>
				</div>
				
			</main>
	<?php } ?>
    <!-- /Page Content -->
    <?php include('include/footer.php');?>