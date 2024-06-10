<?php
include_once( 'include/configuration.php' );
ob_start();
if ( isset( $_REQUEST[ 'sponser_process_submit' ] ) ) {
  if ( $_REQUEST[ 'spanser_plan' ] == 'ecommerce' ) {
    header( 'Location: https://www.emrmarketing.in/men/check-shirt/' );
    ob_end_flush();
  } else if ( $_REQUEST[ 'spanser_plan' ] == '2000_plan' ) {
    $sponser_pln = $_REQUEST[ 'spanser_plan' ];
    $product_chose = '2';
  } else if ( $_REQUEST[ 'spanser_plan' ] == '3000_plan' ) {
    $sponser_pln = $_REQUEST[ 'spanser_plan' ];
    $product_chose = '3';
  } else {
    $sponser_pln = '';
    $product_chose = '0';
  }
  if ( $_REQUEST[ 'binary_status' ] ) {
    $binary_status = $_REQUEST[ 'binary_status' ];
  } else {
    $binary_status = 'Left';
  }

}
$SQLproductDetails = "select * from products where status='1' AND seo_keywords='$productDetailsKey'";
$MySQLProductDetails = mysqli_query( $link, $SQLproductDetails );
$ListproductDetails = mysqli_fetch_array( $MySQLProductDetails );
$productDetID = $ListproductDetails[ 'id' ];
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
    
    <main class="page-main">
      <div class="block">
        <div class="container">
          <ul class="breadcrumbs">
            <li><a href="index.html"><i class="icon icon-home"></i></a></li>
            <li>/<span>Choose Plan</span></li>
          </ul>
        </div>
      </div>
      <div class="block" id="cart_table">
        <div class="container">
        <form action="sponser_cart_process.php">
          <h4>Product List</h4>
          <?php
          if ( $_SESSION[ 'member_id' ] ) {

            $Mysqlresultproduct = mysqli_query( $link, "select * from products where status='1' and sprice='1000'  order by sortorder ASC" );
            while ( $ListProductrow = mysqli_fetch_array( $Mysqlresultproduct ) ) {
			$prodId=$ListProductrow['id'];
			$resmibsql = mysqli_query( $link, "select * from product_varient where v_id='$prodId'" );
  			$listmibsql = mysqli_fetch_array( $resmibsql );
              ?>
          <input type="hidden" name="sponserplan" value="<?php echo $sponser_pln;?>">
          <input type="hidden" name="binary_status" value="<?php echo $binary_status;?>">
          <div class="sponser_choose_product">
            <div class="sponser_product_image"> <img class="product-image-photo" src="<?php echo $product_paath.str_replace(" ", '%20', $ListProductrow['image2']); ?>" alt="<?php echo $ListProductrow['title']; ?>"> </div>
            <div class="sponser_product_details">
              <h4><?php echo $ListProductrow['title']; ?>
                <input type="checkbox" name="product_id[]" value="<?php echo $ListProductrow['id']; ?>">
              </h4>
              <div class="sponser_product_price">
                <div class="price-box">
                  <?php if($ListProductrow['sprice']){?>
                  <del> Rs. <?php echo number_format($ListProductrow['price'],2, '.', ',');?> </del> <span class="price-container"> Rs. <span class="price-wrapper"><span class="special-price"><?php echo number_format($ListProductrow['sprice'],2, '.', ','); $mibprc = $ListProductrow['sprice'];?></span></span> </span>
                  <?php
                  } else

                  {
                    ?>
                  Rs. <span class="price-container"> <span class="price-wrapper"><span class="special-price"><?php echo number_format($ListProductrow['price'],2, '.', ','); $mibprc = $ListProductrow['price'];?> </span> </span> </span>
                  <?php } ?>
                </div>
              </div>
            </div>
            
            <!-- Start size -->
            
            <div class="radio__group">
				<?php
				$i=1;
                $tags001 = preg_replace( '/,+/', ',', $listmibsql[ 'vlist' ] );
                $split001 = explode( ",", $tags001 );
                foreach ( $split001 as $rowvalue ) {
                  if ( $rowvalue ) {
                    ?>
             
              <div class="radio__button">
                <input type="radio" id="type<?php echo $prodId.$i;?>" name="size<?php echo $prodId;?>[]" value="<?php echo $rowvalue;?>">
                <label data-icon="<?php echo $rowvalue;?>" for="type<?php echo $prodId.$i;?>"></label>
              </div>
				<?php } $i++;} ?>
          
            </div>
            
            <!-- End Size --> 
            
          </div>
          <?php } } else{?>
          <?php } ?>
          </div>
          <button type="submit" class="btn btn-info" disabled name="ordersubmit">Submit to Checkout</button>
        </form>
      </div>
    </main>
    <script>
  document.addEventListener('DOMContentLoaded', function() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var maxChecked = <?php echo $product_chose;?>;
    var submitButton = document.querySelector('button[name="ordersubmit"]');

    checkboxes.forEach(function(checkbox) {
      checkbox.addEventListener('change', function() {
        var checkedCount = document.querySelectorAll('input[type="checkbox"]:checked').length;

        if (checkedCount > maxChecked) {
          alert('You can only select up to ' + maxChecked + ' products.');
          this.checked = false; // Uncheck the current checkbox
        }

        // Enable/disable submit button based on the number of selected checkboxes
        submitButton.disabled = (checkedCount !== maxChecked);
      });
    });
  });
</script> 
    <!-- /Page Content -->
    <?php include('include/footer.php');?>
