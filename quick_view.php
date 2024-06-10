<?php
include_once( 'include/configuration.php' );
if ( isset( $_REQUEST[ 'prod' ] ) ) {
  $prodId = $_REQUEST[ 'prod' ];
  $MySQLProductDetails = mysqli_query( $link, "select * from products where id='$prodId'" );
  $ListproductDetails = mysqli_fetch_array( $MySQLProductDetails );
  $resmibsql = mysqli_query( $link, "select * from product_varient where v_id='$prodId'" );
  $listmibsql = mysqli_fetch_array( $resmibsql );
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from big-skins.com/frontend/seiko/html/quick-view.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Mar 2023 07:13:34 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome to EMR Marketing</title>
<meta name="author" content="SEIKO">
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="favicon.ico">

<!-- Vendor -->
<link href="js/vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
<link href="js/vendor/slick/slick.css" rel="stylesheet">
<link href="js/vendor/magnificpopup/dist/magnific-popup.css" rel="stylesheet">
<link href="js/vendor/darktooltip/dist/darktooltip.css" rel="stylesheet">
<link href="css/animate.css" rel="stylesheet">

<!-- Custom -->
<link href="css/style.css" rel="stylesheet">
<link href="css/animate.css" rel="stylesheet">

<!-- Icon Font -->
<link href="fonts/icomoon-reg/style.css" rel="stylesheet">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700|Raleway:100,100i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','../../../../www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-88345127-1', 'auto');
  ga('send', 'pageview');

</script>
	
	
</head>

<body class="quickview">
	
<div class="container-fluid">
  <div class="row">
    
    
		<?php
if( isset($_SESSION['ADDTO_CART_MESSAGE']) && is_array($_SESSION['ADDTO_CART_MESSAGE']) && count($_SESSION['ADDTO_CART_MESSAGE']) >0 ) {
foreach($_SESSION['ADDTO_CART_MESSAGE'] as $msg) {
echo $msg; 
	?>
	  <a data-dismiss="modal" aria-label="Close" class="close btn btn-alt">Close popup</a>  | 
	  <a href="cart/" target="_blank" class="btn quick-view-btn">Go to Cart</a>

</script>
<?php }
unset($_SESSION['ADDTO_CART_MESSAGE']); }else{ ?>
	  <div class="col-sm-5"> 
      <!-- Product Gallery -->
      <div class="main-image"> <img src="<?php echo $product_paath.str_replace(" ", '%20', $ListproductDetails['image2']); ?>" class="zoom" alt="" data-zoom-image="<?php echo $product_paath.str_replace(" ", '%20', $ListproductDetails['image2']); ?>" />
        <div class="dblclick-text"><span>Double click for enlarge</span></div>
      </div>
      <div class="product-previews-wrapper">
        <div class="product-previews-carousel" id="previewsGallery">
          <?php
          if ( $ListproductDetails[ 'image' ] ) {
            $tags = preg_replace( '/,+/', ',', $ListproductDetails[ 'image' ] );
            $Splitexpo = explode( ",", $tags );
            foreach ( $Splitexpo as $rowvalue ) {
              if ( $rowvalue ) {
                ?>
          <a href="#" data-image="<?php echo $domain_url.$product_paath.$rowvalue;?>"><img src="<?php echo $domain_url.$product_paath.$rowvalue;?>" alt="" /></a>
          <?php } } } ?>
        </div>
      </div>
      <!-- /Product Gallery --> 
    </div>
	  <div class="col-sm-7">
		<form method="post" action="cart-add2.php">
      <div class="product-info-block classic"> 
        <!--div class="product-info-top">
						<div class="product-sku">SKU: <span>Stock Keeping Unit</span></div>
						<div class="rating">
							<i class="icon icon-star fill"></i><i class="icon icon-star fill"></i><i class="icon icon-star fill"></i><i class="icon icon-star fill"></i><i class="icon icon-star"></i><span class="count">248 reviews</span>
						</div>
					</div-->
        <div class="product-name-wrapper">
          <h1 class="product-name"><?php echo $ListproductDetails['title'];?></h1>
        </div>
        <div class="product-availability">Availability:
          <?php if($ListproductDetails['inventory'] >0){ ?>
          <span>In stock</span>
          <?php }else {?>
          Out Stock
          <?php }?>
        </div>
        <div class="product-description"> <?php echo $ListproductDetails['description'];?> </div>
        <div class="product-options">
          <?php if($listmibsql['vlist']){?>
          <div class="product-size swatches"> <span class="option-label"><?php echo $listmibsql['vname'];?>:</span>
            <div class="select-wrapper-sm">
              <select class="form-control input-sm size-variants" name="size">
                <?php
                $tags001 = preg_replace( '/,+/', ',', $listmibsql[ 'vlist' ] );
                $split001 = explode( ",", $tags001 );
                foreach ( $split001 as $rowvalue ) {
                  if ( $rowvalue ) {
                    ?>
                <option value="<?php echo $rowvalue;?>"><?php echo $rowvalue;?></option>
                <?php } } ?>
              </select>
            </div>
            <ul class="size-list">
              <?php
              foreach ( $split001 as $rowvalue ) {
                if ( $rowvalue ) {
                  ?>
              <li><a href="#" data-value='<?php echo $rowvalue;?>'><span class="value"><?php echo $rowvalue;?></span></a></li>
              <?php } }?>
            </ul>
          </div>
          <?php }else{ echo "<input type='hidden' name='size'>";} ?>
			<?php if($ListproductDetails['colour']){?>
          <div class="product-color swatches"> <span class="option-label">Color:</span>
            <div class="select-wrapper-sm">
              <select class="form-control input-sm" name="color">
                <option value="<?php echo $ListproductDetails['colour'];?>"><?php echo $ListproductDetails['colour'];?></option>
                
              </select>
            </div>
            <ul class="color-list">
              <li><a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $ListproductDetails['colour'];?>" data-value="<?php echo $ListproductDetails['colour'];?>"><span class="value" style="width: 25px; height: 25px;background: <?php echo $ListproductDetails['colour'];?>; "></span></a></li>
            </ul>
          </div>
			<?php } else{ echo "<input type='hidden' name='color'>";}?>
          <div class="product-qty"> <span class="option-label">Qty:</span>
            <div class="qty qty-changer">
              <fieldset>
                <input type="button" value="&#8210;" class="decrease">
                <input type="text" name="qty" class="qty-input" value="1" data-min="0">
                <input type="button" value="+" class="increase">
              </fieldset>
            </div>
          </div>
        </div>
        <div class="product-actions">
          <div class="row">
            <div class="col-md-6">
              <div class="product-meta"> <span><a href="include/wishlist.php?wish=<?php echo $ListproductDetails['id']; ?>"><i class="icon icon-heart"></i> Add to wishlist</a></span> </div>
            </div>
            <div class="col-md-6">
				
				
              <div class="price"> 
				<?php if($ListproductDetails['sprice']){?><span class="old-price"> Rs. <?php echo number_format($ListproductDetails['price'],2, '.', ',');?> </span>

                <br><span class="price-wrapper"> Rs. <span class="price-wrapper"><span class="special-price"><?php echo number_format($ListproductDetails['sprice'],2, '.', ','); $mibprc = $ListproductDetails['sprice'];?></span></span> </span><?php }else 

                {?> Rs. <span class="price-container"> <span class="price-wrapper"><span class="special-price"><?php echo number_format($ListproductDetails['price'],2, '.', ','); $mibprc = $ListproductDetails['price'];?> </span> </span>
												</span> <?php } ?>
				</div>
              <div class="actions">
				  <input type="hidden" name="prod_id" value="<?php echo $ListproductDetails['id']; ?>">
                <button data-loading-text='<i class="icon icon-spinner spin"></i><span>Add to cart</span>' class="btn btn-lg btn-loading listcartadd" name="cart_submit" type="submit" id="addToCartBtn"><i class="icon icon-cart"></i><span>Add to cart</span></button>
                <a href="<?php echo $ListproductDetails['seo_keywords'];?>/" class="btn btn-lg product-details" target="_blank"><i class="icon icon-external-link"></i></a> </div>
            </div>
          </div>
        </div>
      </div>
			</form>
		  </div>
		<?php } ?>
    
  </div>
</div>
</body>
<script src="js/vendor/jquery/jquery.js"></script>
<script src="js/vendor/bootstrap/bootstrap.min.js"></script>
<script src="js/vendor/slick/slick.min.js"></script>
<script src="js/vendor/magnificpopup/dist/jquery.magnific-popup.js"></script>
<script src="js/vendor/countdown/jquery.countdown.min.js"></script>
<script src="js/vendor/ez-plus/jquery.ez-plus.js"></script>
<script src="js/vendor/tocca/tocca.min.js"></script>
<script src="js/vendor/darktooltip/dist/jquery.darktooltip.js"></script>
<script src="js/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="js/megamenu.html"></script>
<script src="js/app.js"></script>

</body>

<!-- Mirrored from big-skins.com/frontend/seiko/html/quick-view.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Mar 2023 07:13:34 GMT -->
</html>