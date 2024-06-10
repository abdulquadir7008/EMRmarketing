<?php
include("config.php");
$sess=session_id();

$curr_rate = '';
if(isset($_SESSION['currency']))
{
$currencyID = $_SESSION['currency'];
$currSql="select * from currancy WHERE keywords='$currencyID'";
$ResCurr=mysqli_query($link,$currSql);
$ListCurr=mysqli_fetch_array($ResCurr);
$curr_rate = $ListCurr['currancy_value'];
}

if($_SESSION['member_id']) {
$customerchechlogin_id=$_SESSION['member_id'];
} else {
$customerchechlogin_id="0";	
	 }
$customerchechlogin_sql="select * from membership WHERE member_id=$customerchechlogin_id";
$customerchechlogin_resu=mysqli_query($link,$customerchechlogin_sql);
$customerchechlogin_row=mysqli_fetch_array($customerchechlogin_resu);
if($customerchechlogin_id!=0 && $customerchechlogin_row['member_id']!='') {
$customeid=$customerchechlogin_row['member_id'];
$Custemail=$customerchechlogin_row['email'];
$customerLoc=$customerchechlogin_row['state'];
$Cuscountry=$customerchechlogin_row['country'];
$City=$customerchechlogin_row['city'];	
	$placebtn = "Uplace";
  $sql_check1="select * from cart WHERE userid='$customeid'";
  $res_check1=mysqli_query($link,$sql_check1);
}
else{
	$placebtn = "order";
$sql_check1="select * from cart WHERE sess='$sess'";
$res_check1=mysqli_query($link,$sql_check1);
}
$cart_id=$_REQUEST['cart_id'];
	$qty=$_REQUEST['qty'];
$query100="update cart SET qty='$qty' WHERE cart_id=$cart_id";
 mysqli_query($link,$query100);
?>
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
	$subtotal = $subtotal + ( $cart_list[ 'price' ] * $cart_list[ 'qty' ] );
							$product_cart = "select * from products where id='$cart_prod_id'";	
								$result_product_cart = mysqli_query($link,$product_cart); 
 									$List_product_cart = mysqli_fetch_array($result_product_cart);
			  						?>
							<div class="table-row">
								<div class="photo">
									<a href="product.html"><img src="<?php echo $domain_url.$product_paath.$List_product_cart['image2']; ?>" alt=""></a>
								</div>
								<div class="name">
									<a href=""><?php echo $List_product_cart['title'];?></a>
									<div class="road-list-crupm">
										<?php
												$tags = preg_replace('/,+/', ',', $cart_list['varient_names']);
													 $splittedstring=explode(",",$tags);
														foreach ($splittedstring as  $value) {
															echo "<div>".$value." : </div>";
														}
										?>
										</div>
										<div class="col-md-5" style="float:left; width:auto;">
										<?php
													$tags2 = preg_replace('/,+/', ',', $cart_list['verientlist']);
	 														$splittedstring2=explode(",",$tags2);
														foreach ($splittedstring2 as  $value2) {
															echo "<div>".$value2."</div>";
														}
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
									<tr>
										<td>Subtotal</td>
										<td><?php echo number_format($subtotal,2, '.', ',');?></td>
									</tr>
									<tr>
										<td>Tax</td>
										<td>0</td>
									</tr>
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
           