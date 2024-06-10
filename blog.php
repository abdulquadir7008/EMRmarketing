<?php
include_once( 'include/configuration.php' );

?>
<?php
$per_page_record = 9;
if ( isset( $_GET[ "page" ] ) ) {
  $page = $_GET[ "page" ];

} else {
  $page = 1;

}

$start_from = ( $page - 1 ) * $per_page_record;
if ( isset( $_GET[ "category" ] ) ) {
  $category = $_GET[ "category" ];
  $SQLblgcat = "select * from blog_category where seo_keyword='$category'";
  $SQLblgcat = mysqli_query( $link, $SQLblgcat );
  $listblgcat = mysqli_fetch_array( $SQLblgcat );
  $blog_cat_id = $listblgcat[ 'id' ];
  $query = "SELECT * FROM blog WHERE category_id='$blog_cat_id' order by date DESC LIMIT $start_from, $per_page_record";
  $rs_result = mysqli_query( $link, $query );
} else {
  $category = '';
  $query = "SELECT * FROM blog order by date DESC LIMIT $start_from, $per_page_record";
  $rs_result = mysqli_query( $link, $query );
}
if ( isset( $_REQUEST[ 'date' ] ) ) {
  $rocketdate = $_REQUEST[ 'date' ];
  $query = "SELECT * FROM blog order by date DESC";
  $rs_result = mysqli_query( $link, $query );
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

<main class="page-main">
				<div class="container">
					<!-- Page Title -->
					<div class="page-title">
						<div class="title center">
							<h1>BLOG</h1>
						</div>
						<div class="text-wrapper">
							<p class="text-center">We’re a team of creative and make amazing site in ecommerce from Unite States. We love colour pastel, highlight and
								<br/>simple, its make our design look so awesome</p>
						</div>
					</div>
					<!-- /Page Title -->
					<!-- Blog grid -->
					<div class="blog-grid-3">
						 <?php
        while ( $row_spldate = mysqli_fetch_array( $rs_result ) ) {
          $blogid = $row_spldate[ 'id' ];

          $famedate = date( "m-Y", $row_spldate[ 'date' ] );
//          $sql_comment = "select * from comment WHERE blog_id='$blogid'";
//          $result_comment = mysqli_query( $link, $sql_comment );
         
       
              ?>
						<div class="blog-post">
							<div class="blog-photo">
								<a href="blog/<?php echo $row_spldate['kewords'];?>/"><img src="uploads/<?php echo $row_spldate['image'];?>" alt="<?php echo $row_spldate['title'];?>"></a>
							</div>
							<div class="blog-content">
								<h2 class="blog-title"><a href="#"><?php echo $row_spldate['title'];?></a></h2>
								<div class="blog-meta">
<!--
									<div class="pull-left">
										<span>History of maryland</span>
										<span>May 9, 2016</span>
										<span>Adventures By <a href="#">Admin</a></span>
										<span class="last"><a href="#">7 Comment(s)</a></span>
									</div>
-->
									
								</div>
								<div class="blog-text">
									<p><?php echo $row_spldate['sort_ttile'];?></p>
								</div>
								<a href="blog/<?php echo $row_spldate['kewords'];?>/" class="btn">Read More</a>
							</div>
						</div>
						<?php }   ?>
					</div>
					<!-- /Blog grid -->
					<ul class="pagination pull-right">
						<li><a href="#"><i class="icon icon-angle-left"></i></a></li>
						<li class="active"><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#"><i class="icon icon-angle-right"></i></a></li>
					</ul>
				</div>
			</main>

<?php include('include/footer.php');?>