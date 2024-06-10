<?php
include_once( 'include/configuration.php' );

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

<main class="page-main">
				<div class="block">
					<div class="container">
						<ul class="breadcrumbs">
							<li><a href="index.html"><i class="icon icon-home"></i></a></li>
							<li>/<span>Gallery</span></li>
						</ul>
					</div>
				</div>
				<div class="block fullwidth full-nopad">
					<div class="container">
						<div class="title center">
							<h1 class="size-lg">Gallery</h1>
						</div>
<!--
						<ul class="filters filters-gallery">
							<li><a href="#" class="filter-label">All</a><span>/</span></li>
							<li><a href="#" class="filter-label" data-filter=".category1">Men</a><span>/</span></li>
							<li><a href="#" class="filter-label" data-filter=".category2">Women</a><span>/</span></li>
							<li><a href="#" class="filter-label" data-filter=".category3">Kids</a><span>/</span></li>
						</ul>
-->
						<div class="row">
							<div class="gallery-wrapper">
								<div class="gallery isotope">
									<div class="col-xs-4 gallery-item effect category3">
										<div class="image"><img class="img-responsive" src="images/award/award.jpg" alt=" Award Ceremonies"></div>
									</div>
									
									<div class="col-xs-4 gallery-item effect category3">
										<div class="image"><img class="img-responsive" src="images/award/award3.jpg" alt=" Award Ceremonies"></div>
									</div>
									<div class="col-xs-4 gallery-item effect category3">
										<div class="image"><img class="img-responsive" src="images/award/award4.jpg" alt=" Award Ceremonies"></div>
									</div>
									<div class="col-xs-4 gallery-item effect category3">
										<div class="image"><img class="img-responsive" src="images/award/award5.jpg" alt=" Award Ceremonies"></div>
									</div>
									<div class="col-xs-4 gallery-item effect category3">
										<div class="image"><img class="img-responsive" src="images/award/award6.jpg" alt=" Award Ceremonies"></div>
									</div>
									<div class="col-xs-4 gallery-item effect category3">
										<div class="image"><img class="img-responsive" src="images/award/award7.jpg" alt=" Award Ceremonies"></div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>

<?php include('include/footer.php');?>