<?php include('include/header.php');
ob_start();
$SQLproductDetails = "select * from products where status='1' AND seo_keywords='$productDetailsKey'";
$MySQLProductDetails = mysqli_query($link,$SQLproductDetails); 
$ListproductDetails = mysqli_fetch_array($MySQLProductDetails);
$productDetID = $ListproductDetails['id'];
$setpagename;
$parentcat_keyword;

?>
    <!-- breadcrumb start -->
    
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>Shop</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->


</div>

<?php if(mysqli_num_rows($res_check1)>0){?>
    <!-- section start -->
    <section class="cart-section section-b-space consec-mib">
        <div class="container">
        <span class="bagcart">Your Bag (<?php echo mysqli_num_rows($res_check2); ?>)</span>
        <span class="wishcart">Your Wishlist (<?php echo mysqli_num_rows($res_count);?>)</span>
        
			<!--form action="include/cartprocess.php" id="registerForm" name="cartform2" method="post" enctype="multipart/form-data"-->
            <div class="row" id="cart_table">
                
                <div class="col-sm-12 table-responsive-xs">
                    <table class="table cart-table">
                        <thead>
                            <tr class="table-head">
                                <th colspan="6">
                                <div class="row">
                                <div class="col-md-2">image</div>
                                <div class="col-md-3">product name</div>
                                <div class="col-md-2">price</div>
                                <div class="col-md-2">quantity</div>
                                <div class="col-md-1">action</div>
                                <div class="col-md-2">total</div>
                                </div>
                                </th>
                                
                            </tr>
                        </thead>
                        <?php $res_check2=mysqli_query($link,$sql_check1); while($cart_list = mysqli_fetch_array($res_check2)){
			  			$cart_prod_id = $cart_list['product_id'];
							$product_cart = "select * from products where id='$cart_prod_id'";	
								$result_product_cart = mysqli_query($link,$product_cart); 
 									$List_product_cart = mysqli_fetch_array($result_product_cart);
			  						?>
						 
						<tbody>
                            <tr>

                            <td colspan="6">
                                <div class="row">
                                    
                                <div class="col-md-2 cartimgmob"><a href="#"><img src="<?php echo $domain_url.$product_paath.$List_product_cart['image2']; ?>" alt=""></a></div>
                                <div class="col-md-3 cartkdtitle cartimgmob2">
                                <?php if($_SESSION['currency'] == 'dollar'){?>
              <h2 class="td-color mobileon">
    <?php $cartqytprice = str_replace(',','',$cart_list['price'])*str_replace(',','',$cart_list['qty']); 
    echo number_format($cartqytprice / $curr_rate,2, '.', ',');?> $ </h2>    
<?php } else { ?>
    <h2 class="td-color mobileon">
    <?php $cartqytprice = str_replace(',','',$cart_list['price'])*str_replace(',','',$cart_list['qty']); 
    echo number_format($cartqytprice,2, '.', ',');?> <span class='mibaed'>AED</span></h2>    
<?php } ?>

                                
                                
                                <a href="#" class="cart-title"><?php echo $List_product_cart['title'];?></a>
                                <div class="row verient_cart">
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
                                </div>
                                <div class="col-md-2 deskamount">
                                <?php if($_SESSION['currency'] == 'dollar'){?>
            
              <h2> $ <?php echo number_format($cart_list['price'] / $curr_rate,2, '.', ',');?></h2>  
<?php } else { ?>
    
    <h2><?php echo $cart_list['price'];?> <span class='mibaed'>AED</span></h2>  
<?php } ?>
                               
                                </div>
                                <div class="col-md-2 carttymob"><div class="qty-box">
                                        <div class="input-group">
                                        <form id="frm<?php echo $cart_list['cart_id']; ?>">


                                        
                                        
                                        <input type="hidden" value="<?php echo $cart_list['cart_id']; ?>" name="cart_id" />
                                            <input type="number" name="qty" min="1" class="form-control input-number"
                                                value="<?php echo $cart_list['qty'];?>" 
                                                onchange="update(<?php echo $cart_list['cart_id']; ?>)"
                                                onkeyup="update(<?php echo $cart_list['cart_id']; ?>)">
                                                </form>
                                        </div>
                                    </div></div>
                                <div class="col-md-1 cartclose">
                                <a href="include/delete_f.php?cart_id=<?php echo $cart_list['cart_id']; ?>" class="icon">
                                <i class="ti-trash"></i></a></div>
                                <div class="col-md-2 cartdkfin">
                                

                                <?php if($_SESSION['currency'] == 'dollar'){?>
          

               <h2 class="td-color"> $ 
                                <?php $cartqytprice = str_replace(',','',$cart_list['price'])*str_replace(',','',$cart_list['qty']); 
                                echo number_format($cartqytprice / $curr_rate,2, '.', ',');?></h2>   
<?php } else { ?>
    <h2 class="td-color">
                                <?php $cartqytprice = str_replace(',','',$cart_list['price'])*str_replace(',','',$cart_list['qty']); 
                                echo number_format($cartqytprice,2, '.', ',');?> <span class='mibaed'>AED</span></h2>  
<?php } ?>

                               
                                
                                </div>
                                </div>
                                </td>


                                
                               </div>
                            </tr>
                        </tbody>
                       
						<?php 
	  } ?>
                    </table>
                    <div class="table-responsive-md">
                        <table class="table cart-table ">
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td>
                                        <h2><span>total price :</span> 
                                        <?php if($_SESSION['currency'] == 'dollar'){?>
                                            $  <?php echo number_format($total  / $curr_rate,2, '.', ',');?>

          
<?php } else { ?>
    <?php echo number_format($total,2, '.', ',');?> <span class='mibaed'>AED</span>
<?php } ?>
                                        
                                   
                                        
                                        </h2>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row cart-buttons">
                <div class="col-6"><a href="<?php echo $setpagename."/"."all/";?>" class="btn btn-solid">continue shopping</a></div>
                <div class="col-6">
					<a href="checkout/"><button type="submit" name="qtyupdate" class="btn btn-solid">checkout</button></a>
				<!--p><strong>Note ! For now, we are just dealing with product reviews. <br>Checkout will be open very soon.</strong></p-->
				</div>
            </div>
<!--/form-->
        </div>
    </section>
<?php }else { ?>
<div class="container-fluid mt-100">
    <div class="row">
        <div class="col-md-12">
           
                
                <div class="card-body cart">
                    <div class="col-sm-12 empty-cart-cls text-center"> <img src="assets/images/cartemty.png" width="130" height="130" class="img-fluid mb-4 mr-3">
                        <h3><strong>Your Cart is Empty</strong></h3>
                        <h4>Add something to make me happy.</h4> 
                        <a href="wishlist/" class="btn btn-secondary cart-btn-transform m-3" data-abc="true">Add From Wishlist</a>
                        <a href="<?php echo $setpagename."/"."all/";?>" class="btn btn-secondary cart-btn-transform m-3" data-abc="true">continue shopping</a>
                    </div>
               
            </div>
        </div>
    </div>
</div>
<?php }

?>
    
    
    
<?php  include('include/footer.php');
?>
<script>
function update(id){
    $.ajax({
        url:'updcart.php',
        type:'POST',
        data:$("#frm" + id).serialize(),
        success:function(res){
            $("#cart_table").html(res);


        }

    });
}


jQuery(document).ready(function(){
    // This button will increment the value
    $('.qtyplus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
});

</script>
</body>

</html>