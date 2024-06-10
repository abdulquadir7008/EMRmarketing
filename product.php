<?php
include_once( 'include/configuration.php' );
$ProductKeyword = mysqli_real_escape_string( $link, $_GET[ 'keyword2' ] );
$setpagename = mysqli_real_escape_string( $link, $_GET[ 'seo_keyword' ] );
$sql_cat = mysqli_query( $link, "select * from category WHERE maincat='$setpagename' and seo_keywords='$ProductKeyword'" );
$cat_details = mysqli_fetch_array( $sql_cat );
$cat_id = $cat_details[ 'category_id' ];
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
      <li><a href="index.php"><i class="icon icon-home"></i></a></li>
      <li>/<span><?php echo ucfirst($setpagename);?></span></li>
    </ul>
  </div>
</div>
<div class="container"> 
  <!-- Two columns -->
  <div class="row"> 
    <!-- Left column -->
    <div class="col-md-3 filter-col aside">
      <div class="fixed-wrapper">
        <div class="fixed-scroll">
          <div class="filter-col-header">
            <div class="title">Filters</div>
            <a href="#" class="filter-col-toggle"></a> </div>
          <div class="filter-col-content">
            <div class="sidebar-block-top">
              <h2>Shoping By</h2>
<!--
              <ul class="selected-filters">
                <li class="block-loading"> <a href="#"><span>Trousers</span><span class="remove"><i class="icon icon-close"></i></span></a>
                  <div class="bg-striped"></div>
                </li>
                <li> <a href="#"><span>Orange <img src="images/colorswatch/color-orange.png" alt=""></span><span class="remove"><i class="icon icon-close"></i></span></a>
                  <div class="bg-striped"></div>
                </li>
                <li> <a href="#"><span>Cavalli</span><span class="remove"><i class="icon icon-close"></i></span></a>
                  <div class="bg-striped"></div>
                </li>
                <li> <a href="#"><span>$10-30$</span><span class="remove"><i class="icon icon-close"></i></span></a>
                  <div class="bg-striped"></div>
                </li>
                <li> <a href="#"><span>Size 36</span><span class="remove"><i class="icon icon-close"></i></span></a>
                  <div class="bg-striped"></div>
                </li>
              </ul>
-->
            </div>
            <div class="sidebar-block collapsed <?php if($setpagename=='men'){?>open<?php } ?>">
              <div class="block-title"> <span>Men</span>
                <div class="toggle-arrow"></div>
              </div>
              <div class="block-content">
                <ul class="category-list">
              
                  <?php $men_cat_sql = mysqli_query( $link,"select * from category WHERE maincat='men' and status='1'"); while($list_men_cat = mysqli_fetch_array( $men_cat_sql )){
											?>
											<li <?php if($list_men_cat['seo_keywords']==$ProductKeyword){?>class="active"<?php } ?>> <a href="men/<?php echo $list_men_cat['seo_keywords'];?>/" ><?php echo $list_men_cat['title'];?></a> </li>
											<?php } ?>
                </ul>
                <div class="bg-striped"></div>
              </div>
            </div>
            <div class="sidebar-block collapsed <?php if($setpagename=='women'){?>open<?php } ?>">
              <div class="block-title"> <span>Women</span>
                <div class="toggle-arrow"></div>
              </div>
              <div class="block-content">
                <ul class="category-list">
                  
                  <?php $men_cat_sql = mysqli_query( $link,"select * from category WHERE maincat='women' and status='1'"); while($list_men_cat = mysqli_fetch_array( $men_cat_sql )){
											?>
											<li 
												<?php if($list_men_cat['seo_keywords']==$ProductKeyword){?>class="active"<?php } ?> > <a href="women/<?php echo $list_men_cat['seo_keywords'];?>/" title=""><?php echo $list_men_cat['title'];?></a> </li>
											<?php } ?>
                </ul>
                <div class="bg-striped"></div>
              </div>
            </div>
<!--
            <div class="sidebar-block collapsed">
              <div class="block-title"> <span>CHOOSE COLOR</span>
                <div class="toggle-arrow"></div>
              </div>
              <div class="block-content">
                <ul class="color-list">
                  <li class="active"><a href="#" data-tooltip="Very long some color name" title="Very long some color name"><span class="clear"></span><span class="value"><img src="images/colorswatch/color-red.png" alt=""></span></a></li>
                  <li><a href="#" data-tooltip="Pink" title="Pink"><span class="clear"></span><span class="value"><img src="images/colorswatch/color-pink.png" alt=""></span></a></li>
                  <li><a href="#" data-tooltip="Violet" title="Violet"><span class="clear"></span><span class="value"><img src="images/colorswatch/color-violet.png" alt=""></span></a></li>
                  <li><a href="#" data-tooltip="Blue" title="Blue"><span class="clear"></span><span class="value"><img src="images/colorswatch/color-blue.png" alt=""></span></a></li>
                  <li><a href="#" data-tooltip="Marine" title="Marine"><span class="clear"></span><span class="value"><img src="images/colorswatch/color-marine.png" alt=""></span></a></li>
                  <li><a href="#" data-tooltip="Orange" title="Orange"><span class="clear"></span><span class="value"><img src="images/colorswatch/color-orange.png" alt=""></span></a></li>
                  <li><a href="#" data-tooltip="Yellow" title="Yellow"><span class="clear"></span><span class="value"><img src="images/colorswatch/color-yellow.png" alt=""></span></a></li>
                  <li><a href="#" data-tooltip="Dark Yellow" title="Dark Yellow"><span class="clear"></span><span class="value"><img src="images/colorswatch/color-darkyellow.png" alt=""></span></a></li>
                  <li><a href="#" data-tooltip="Very long some color name" title="Very long some color name"><span class="clear"></span><span class="value"><img src="images/colorswatch/color-black.png" alt=""></span></a></li>
                  <li><a href="#" data-tooltip="White" title="White"><span class="clear"></span><span class="value"><img src="images/colorswatch/color-white.png" alt=""></span></a></li>
                </ul>
                <div class="bg-striped"></div>
              </div>
            </div>
            <div class="sidebar-block collapsed">
              <div class="block-title"> <span>Brands</span>
                <div class="toggle-arrow"></div>
              </div>
              <div class="block-content">
                <ul class="category-list">
                  <li><a href="#" class="value">Dresses</a> <a href="#" class="clear"></a> </li>
                  <li><a href="#">Jackets</a> <a href="#" class="clear"></a> </li>
                  <li class="active"><a href="#">Trousers</a> <a href="#" class="clear"></a> </li>
                  <li><a href="#">Jeans</a> <a href="#" class="clear"></a> </li>
                </ul>
                <div class="bg-striped"></div>
              </div>
            </div>
            <div class="sidebar-block collapsed">
              <div class="block-title"> <span>Price</span>
                <div class="toggle-arrow"></div>
              </div>
              <div class="block-content">
                <ul class="category-list">
                  <li><a href="#">$10-$30</a> <a href="#" class="clear"></a> </li>
                  <li class="active"><a href="#">$30-$60</a> <a href="#" class="clear"></a> </li>
                  <li><a href="#">$60-$120</a> <a href="#" class="clear"></a> </li>
                </ul>
                <div class="price-slider-wrapper">
                  <div class="price-values">
                    <div class="pull-left">$<span id="priceMin"></span></div>
                    <div class="pull-right">$<span id="priceMax"></span></div>
                  </div>
                  <div id="priceSlider" class="price-slider"></div>
                </div>
                <div class="bg-striped"></div>
              </div>
            </div>
            <div class="sidebar-block collapsed">
              <div class="block-title"> <span>Size</span>
                <div class="toggle-arrow"></div>
              </div>
              <div class="block-content">
                <ul class="size-list">
                  <li class="active"><a href="#"><span class="clear"></span><span class="value">38</span></a></li>
                  <li><a href="#"><span class="clear"></span><span class="value">38</span></a></li>
                  <li><a href="#"><span class="clear"></span><span class="value">40</span></a></li>
                  <li><a href="#"><span class="clear"></span><span class="value">42</span></a></li>
                </ul>
                <div class="bg-striped"></div>
              </div>
            </div>
            <div class="sidebar-block collapsed block-loading">
              <div class="block-title"> <span>Tags</span>
                <div class="toggle-arrow"></div>
              </div>
              <div class="block-content">
                <ul class="tags">
                  <li class="active"><a href="#"><span class="clear"></span><span class="value"><span>Dresses</span></span></a></li>
                  <li><a href="#"><span class="clear"></span><span class="value"><span>Outerwear</span></span></a></li>
                  <li><a href="#"><span class="clear"></span><span class="value"><span>Tops</span></span></a></li>
                  <li><a href="#"><span class="clear"></span><span class="value"><span>Sleeveless tops</span></span></a></li>
                  <li><a href="#"><span class="clear"></span><span class="value"><span>Sweaters</span></span></a></li>
                </ul>
                <div class="bg-striped"></div>
              </div>
            </div>
-->
          </div>
        </div>
      </div>
    </div>
    <!-- /Left column --> 
    <!-- Center column -->
    <div class="col-md-9 aside"> 
      <!-- Page Title -->
      <div class="page-title">
        <div class="title center">
          <h1><?php echo ucfirst($setpagename);?></h1>
        </div>
      </div>
      <!-- /Page Title --> 
      <!-- Banners -->
      <div class="row">
        <div class="col-sm-12"> <a href="#" class="banner-wrap">
          <div class="banner style-9 autosize-text image-hover-scale" data-fontratio="6.4" style="height: 100px;">
            <div class="banner-caption vertb">
              <div class="vert-wrapper">
                <div class="vert">
                  <div class="text-1 text-hoverslide" data-hcolor="#ffffff"><span><span class="text"><?php echo $cat_details['title'];?></span><span class="hoverbg"></span></span> </div>
                  <!--														<div class="text-2">Minus id quod maxime placeat facere possimus omnis voluptas assumenda</div>--> 
                </div>
              </div>
            </div>
          </div>
          </a> </div>
      </div>
      <!-- /Banners --> 
      <!-- Categories Info --> 
      <!--
							<div class="info-block">
								<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliqui.</p>
							</div>
--> 
      <!-- Categories Info --> 
      
      <!-- Filter Row -->
      <div class="filter-row">
        <div class="row">
          <div class="col-xs-8 col-sm-7 col-lg-5 col-left">
            <div class="filter-button"> <a href="#" class="btn filter-col-toggle"><i class="icon icon-filter"></i><span>FILTER</span></a> </div>
            <div class="form-label">Sort by:</div>
            <div class="select-wrapper-sm">
              <select class="form-control input-sm">
                <option value="featured">Featured</option>
                <option value="rating">Rating</option>
                <option value="price">Price</option>
              </select>
            </div>
            <!--div class="directions">
											<a href="#"><i class="icon icon-arrow-down"></i></a>
											<a href="#"><i class="icon icon-arrow-up"></i></a>
										</div--> 
          </div>
          <!--div class="col-sm-2 col-lg-2 hidden-xs">
										<div class="view-mode">
											<a href="#" class="grid-view"><i class="icon icon-th"></i></a>
											<a href="#" class="list-view"><i class="icon icon-th-list"></i></a>
										</div->
									</div>
									<div class="col-xs-4 col-sm-3 col-lg-5 col-right">
										<div class="form-label">Show:</div>
										<div class="select-wrapper-sm">
											<select class="form-control input-sm">
												<option value="featured">12</option>
												<option value="rating">36</option>
												<option value="price">100</option>
											</select>
										</div>
									</div>
								</div>
								<div class="bg-striped"></div>
							</div>
							<!-- /Filter Row --> 
          <!-- Total -->
          <div class="items-total">Items 1 to 15 of 28 total</div>
          <!-- /Total --> 
          <!-- Products Grid -->
          <div class="products-grid four-in-row product-variant-5">
            <?php
            //								$sql_product_feature = mysqli_query($link,"select * from products where best='on' and status='1' and maincat='$setpagename' and category_id='$cat_id' order by id DESC limit 10"); 
            //								if(mysqli_num_rows($sql_product_feature)){
            //								while($list_feature_product=mysqli_fetch_array($sql_product_feature)){
            $SQLSubcat = "select * from category where status='1' AND maincat='$setpagename' AND seo_keywords='$ProductKeyword'";

            $MySQLssubcat = mysqli_query( $link, $SQLSubcat );

            $Listsubcat = mysqli_fetch_array( $MySQLssubcat );

            $subcatID = $Listsubcat[ 'id' ];

            $SQLProducts = "select * from products where status='1'  order by sortorder ASC";

            $Mysqlresultproduct = mysqli_query( $link, $SQLProducts );

            while ( $ListProductrow = mysqli_fetch_array( $Mysqlresultproduct ) )

            {

              $datacard = $ListProductrow[ 'category_id' ];

              $splittedstring = explode( ",", $datacard );

              foreach ( $splittedstring as $value ) {

                $value;


                if ( $value == $subcatID ) {
                  ?>
            <div class="product-item  large" style="height: auto !important;">
              <div class="product-item-inside">
                <?php if($ListProductrow['new']=='on'){?>
                <div class="product-item-label label-new"><span>New</span></div>
                <?php } ?>
                <div class="product-item-info"> 
                  <!-- Product Photo -->
                  <div class="product-item-photo">
                    <div class="carousel-inside slide" data-ride="carousel">
                      <div class="carousel-inner" role="listbox">
                        <div class="item active"> <a href="<?php echo $ListProductrow['seo_keywords'];?>/"><img class="product-image-photo" src="<?php echo $product_paath.str_replace(" ", '%20', $ListProductrow['image2']); ?>" alt="<?php echo $ListProductrow['title']; ?>"></a> </div>
                      </div>
                    </div>
                    <!-- Product Actions --> 
                    <a href="#" title="Add to Wishlist" class="no_wishlist"> <i class="icon icon-heart"></i><span>Add to Wishlist</span> </a> 
                    
                    <!-- /Product Actions --> 
                  </div>
                  <!-- /Product Photo --> 
                  <!-- Product Details -->
                  <div class="product-item-details">
                    <div class="product-item-name"> <a title="Boyfriend Shorts Denim" href="product.html" class="product-item-link"><?php echo $ListProductrow['title']; ?></a> </div>
                    <div class="price-box">
												<?php if($ListProductrow['sprice']){?><del> Rs. <?php echo number_format($ListProductrow['price'],2, '.', ',');?> </del>

                <span class="price-container"> Rs. <span class="price-wrapper"><span class="special-price"><?php echo number_format($ListProductrow['sprice'],2, '.', ','); $mibprc = $ListProductrow['sprice'];?></span></span> </span><?php }else 

                {?> Rs. <span class="price-container"> <span class="price-wrapper"><span class="special-price"><?php echo number_format($ListProductrow['price'],2, '.', ','); $mibprc = $ListProductrow['price'];?> </span> </span>
												</span> <?php } ?>
												
												
											</div>
<!--                    <div class="product-item-rating"> <i class="icon icon-star-fill"></i><i class="icon icon-star-fill"></i><i class="icon icon-star-fill"></i><i class="icon icon-star-fill"></i><i class="icon icon-star-fill"></i></div>-->
                    <?php if($ListProductrow['inventory'] >0){ ?>
					  <a href="quick_view.php?prod=<?php echo $ListProductrow['id']; ?>" class="quick-view-link btn btn-sm btn-invert" title="Quick View">  <i class="icon icon-eye"></i> View </a>
<!--
                    <button class="btn add-to-cart listcartadd" id="<?php echo $ListProductrow['id']; ?>">
                    <i class="icon icon-cart" ></i><span>Add to Cart</span>
                    </button>
-->
                    <?php } ?>
                  </div>
                  <!-- /Product Details --> 
                </div>
              </div>
            </div>
            <!-- Product Item --> 
            
            <!-- /Product Item -->
            <?php }} }  ?>
<!--            <p style="text-align: center; font-size: 18px; margin-bottom: 30px">No Product</p>-->
            <?php ?>
          </div>
          <!-- /Products Grid --> 
          <!-- Filter Row -->
          <div class="filter-row">
            <div class="row">
              <div class="col-xs-8 col-sm-7 col-lg-5 col-left">
                <div class="filter-button"> <a href="#" class="btn filter-col-toggle"><i class="icon icon-filter"></i><span>FILTER</span></a> </div>
                <div class="form-label">Sort by:</div>
                <div class="select-wrapper-sm">
                  <select class="form-control input-sm">
                    <option value="featured">Featured</option>
                    <option value="rating">Rating</option>
                    <option value="price">Price</option>
                  </select>
                </div>
                <div class="directions"> <a href="#"><i class="icon icon-arrow-down"></i></a> <a href="#"><i class="icon icon-arrow-up"></i></a> </div>
              </div>
              <div class="col-sm-2 col-lg-2 hidden-xs">
                <div class="view-mode"> <a href="#" class="grid-view"><i class="icon icon-th"></i></a> <a href="#" class="list-view"><i class="icon icon-th-list"></i></a> </div>
              </div>
              <div class="col-xs-4 col-sm-3 col-lg-5 col-right">
                <div class="form-label">Show:</div>
                <div class="select-wrapper-sm">
                  <select class="form-control input-sm">
                    <option value="featured">12</option>
                    <option value="rating">36</option>
                    <option value="price">100</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- /Filter Row --> 
          <!-- Total -->
          <div class="items-total">Items 1 to 15 of 28 total</div>
          <!-- /Total --> 
          <!-- Categories We DO Last
							<div class="categories">
								<div class="row">
									<div class="col-xs-6 col-sm-3">
										<a href="#" class="category-block">
											<div class="category-image">
												<img src="images/category/category-img-01.jpg" alt="#">
											</div>
											<div class="category-title">
												Dresses
											</div>
										</a>
									</div>
									<div class="col-xs-6 col-sm-3">
										<a href="#" class="category-block">
											<div class="category-image">
												<img src="images/category/category-img-02.jpg" alt="#">
											</div>
											<div class="category-title">
												Jackets
											</div>
										</a>
									</div>
									<div class="col-xs-6 col-sm-3">
										<a href="#" class="category-block">
											<div class="category-image">
												<img src="images/category/category-img-03.jpg" alt="#">
											</div>
											<div class="category-title">
												Trousers
											</div>
										</a>
									</div>
									<div class="col-xs-6 col-sm-3">
										<a href="#" class="category-block">
											<div class="category-image">
												<img src="images/category/category-img-04.jpg" alt="#">
											</div>
											<div class="category-title">
												T-shirts
											</div>
										</a>
									</div>
								</div>
							</div>
							 /Categories --> 
        </div>
        <!-- /Center column --> 
      </div>
      <!-- /Two columns --> 
    </div>
    </main>
    <!-- /Page Content -->
    <?php include('include/footer.php');?>