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
	<?php if(mysqli_num_rows($res_check1)>0){?>
<main class="page-main">
				<div class="block">
					<div class="container">
						<ul class="breadcrumbs">
							<li><a href="index.html"><i class="icon icon-home"></i></a></li>
							<li>/<span>Shopping Cart</span></li>
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
								<div class="qty">
									Qty
								</div>
								<div class="subtotal">
									Subtotal
								</div>
								<div class="remove">
									<span class="hidden-sm hidden-xs">Remove</span>
								</div>
							</div>
							
							<?php $res_check2=mysqli_query($link,$sql_check1); while($cart_list = mysqli_fetch_array($res_check2)){
			  			$cart_prod_id = $cart_list['product_id'];
							$product_cart = "select * from products where id='$cart_prod_id'";	
								$result_product_cart = mysqli_query($link,$product_cart); 
 									$List_product_cart = mysqli_fetch_array($result_product_cart);
			  						?>
							<div class="table-row">
								<div class="photo">
									<a><img src="<?php echo $domain_url.$product_paath.$List_product_cart['image2']; ?>" alt=""></a>
								</div>
								<div class="name">
									<a><?php echo $List_product_cart['title'];?></a>
									<div class="road-list-crupm" style="position: relative">
										<?php
	if($cart_list['varient_names']){
		echo "<strong>Size: </strong>".$cart_list['varient_names'];
	}
	if($cart_list['verientlist']){
		echo ", <strong>Color: </strong><span style='width:15px;position: absolute;margin-top: 4px; margin-left:5px; border-radius: 100%; height:15px; background:".$cart_list['verientlist']."'></span>";
	}
//												$tags = preg_replace('/,+/', ',', $cart_list['varient_names']);
//													 $splittedstring=explode(",",$tags);
//														foreach ($splittedstring as  $value) {
//															echo "<div>".$value." : </div>";
//														}
										?>
										</div>
										<div class="col-md-5" style="float:left; width:auto;">
										<?php
//													$tags2 = preg_replace('/,+/', ',', $cart_list['verientlist']);
//	 														$splittedstring2=explode(",",$tags2);
//														foreach ($splittedstring2 as  $value2) {
//															echo "<div>".$value2."</div>";
//														}
										?>
										</div>
								</div>
								<div class="price">
									<?php  
    echo number_format($cart_list['price'] ,2, '.', ',');?>
								</div>
								<div class="qty qty-changer">
									<form id="frm<?php echo $cart_list['cart_id']; ?>">


                                        
                                        
                                        <input type="hidden" value="<?php echo $cart_list['cart_id']; ?>" name="cart_id" />
                                            <input type="number" name="qty" min="1" class="form-control input-number"
                                                value="<?php echo $cart_list['qty'];?>" 
                                                onchange="update(<?php echo $cart_list['cart_id']; ?>)"
                                                onkeyup="update(<?php echo $cart_list['cart_id']; ?>)">
                                                </form>
<!--
									<fieldset>
										<input type="button" value="&#8210;" class="decrease">
										<input type="text" class="qty-input" value="2" data-min="0" data-max="5">
										<input type="button" value="+" class="increase">
									</fieldset>
-->
								</div>
								<div class="subtotal">
									<?php $cartqytprice = str_replace(',','',$cart_list['price'])*str_replace(',','',$cart_list['qty']); 
    echo number_format($cartqytprice ,2, '.', ',');?>
								</div>
								<div class="remove">
									<a href="include/delete_f.php?cart_id=<?php echo $cart_list['cart_id']; ?>" class="icon icon-close-2"></a>
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
						<div class="row">
							<div class="col-md-3 total-wrapper">
								<table class="total-price">
<!--
									<tr>
										<td>Subtotal</td>
										<td><?php echo number_format($subtotal,2, '.', ',');?></td>
									</tr>
-->
									
									<tr class="total">
										<td>Grand Total</td>
										<td><?php echo number_format($subtotal,2, '.', ',');?></td>
									</tr>
								</table>
								<div class="cart-action">
									<div>
										<a href="checkout/" class="btn">Proceed To Checkout</a>
									</div>
<!--									<a href="#">Checkout with Multiple Addresses</a>-->
								</div>
							</div>
							
							
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
							<div class="text-empty-cart-1">SHOPPING CART IS</div>
							<div class="text-empty-cart-2">EMPTY</div>
						</div>
						<div><a href="index.php" class="btn">back to previous page</a></div>
					</div>
				</div>
			</main>
	<?php }?>
    <!-- /Page Content -->
    <?php include('include/footer.php');?>