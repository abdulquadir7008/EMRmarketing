<?php
include_once( 'include/configuration.php' );
ob_start();
$SQLproductDetails = "select * from products where status='1' AND seo_keywords='$productDetailsKey'";
$MySQLProductDetails = mysqli_query($link,$SQLproductDetails); 
$ListproductDetails = mysqli_fetch_array($MySQLProductDetails);
$productDetID = $ListproductDetails['id'];
$setpagename;
$parentcat_keyword;

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
	<?php 
$sql_check1="select * from wishlist WHERE userid='$customeid' order by date DESC";
$res_check1=mysqli_query($link,$sql_check1);
if(mysqli_num_rows($res_check1)>0){?>
<main class="page-main">
				<div class="block">
					<div class="container">
						<ul class="breadcrumbs">
							<li><a href="index.html"><i class="icon icon-home"></i></a></li>
							<li>/<span>WISHLIST</span></li>
						</ul>
					</div>
				</div>
				<div class="block" id="cart_table">
					<div class="container">
						<div class="cart-table">
							<div class="table-header">
								<div class="photo">
									Product Image
								</div>
								<div class="name">
									Product Name
								</div>
								<div class="price">
									Unit Price
								</div>
								
								<div class="remove">
									<span class="hidden-sm hidden-xs">Remove</span>
								</div>
							</div>
							
							<?php 
                        $wishtop=mysqli_query($link,$sql_wishcount);
                        while($listwishlist=mysqli_fetch_array($wishtop)){
						$product_id = $listwishlist['product_id'];
						$SQLProducts="select * from products where id='$product_id'";	
						$Mysqlresultproduct = mysqli_query($link,$SQLProducts); 
							$List_product_cart=mysqli_fetch_array($Mysqlresultproduct);						
	
						?>
							<div class="table-row">
								<div class="photo">
									<a href="product.html"><img src="<?php echo $domain_url.$product_paath.$List_product_cart['image2']; ?>" alt=""></a>
								</div>
								<div class="name">
									<a href=""><?php echo $List_product_cart['title'];?></a>
									<div class="road-list-crupm">
										<?php
												$tags = preg_replace('/,+/', ',', $$List_product_cart['varient_names']);
													 $splittedstring=explode(",",$tags);
														foreach ($splittedstring as  $value) {
															echo "<div>".$value." : </div>";
														}
										?>
										</div>
										<div class="col-md-5" style="float:left; width:auto;">
										<?php
													$tags2 = preg_replace('/,+/', ',', $List_product_cart['verientlist']);
	 														$splittedstring2=explode(",",$tags2);
														foreach ($splittedstring2 as  $value2) {
															echo "<div>".$value2."</div>";
														}
										?>
										</div>
								</div>
								<div class="price">
									<?php  
    echo number_format($List_product_cart['price'] ,2, '.', ',');?>
								</div>
								
								
								<div class="remove">
									<a href="include/wishlist.php?close=<?php echo $listwishlist['wishlist_id']; ?>" class="icon icon-close-2"></a>
								</div>
							</div>
							
							<?php 
	  } ?>
<!--
							<div class="table-footer">
								<button class="btn btn-alt">CONTINUE SHOPPING</button>
								<button class="btn btn-alt pull-right"><i class="icon icon-bin"></i><span>Clear Shopping Cart</span></button>
								<button class="btn btn-alt pull-right"><i class="icon icon-sync"></i><span>UPDATE</span></button>
							</div>
-->
						</div>
											</div>
				</div>
			</main>
	<?php }else { ?>
	<main class="page-main">
				<div class="block fullheight empty-cart">
					<div class="container">
						<div class="image-empty-cart">
							<img src="images/empty-basket.png" alt="">
							<div class="text-empty-cart-1">Wishlist IS</div>
							<div class="text-empty-cart-2">EMPTY</div>
						</div>
						<div><a href="index.php" class="btn">back to previous page</a></div>
					</div>
				</div>
			</main>
	<?php }?>
    <!-- /Page Content -->
    <?php include('include/footer.php');?>