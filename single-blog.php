<?php include_once( 'include/configuration.php' );
$keywords20 = mysqli_real_escape_string( $link, $_GET[ 'type' ] );
$sql_spldate = "select * from blog WHERE kewords='$keywords20'";
$result_date = mysqli_query( $link, $sql_spldate );
$row_spldate = mysqli_fetch_array( $result_date );
$category_id = $row_spldate[ 'category_id' ];
$sql_CatBlog = "select * from blog_category where id='$category_id'";
$result_Catbl = mysqli_query( $link, $sql_CatBlog );
$row_Catbl = mysqli_fetch_array( $result_Catbl );
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
					<!-- Two columns -->
					<div class="row">
						<!-- Center column -->
						<div class="col-md-12">
							<div class="blog-post">
								<div class="blog-photo">
									<img src="uploads/<?php echo $row_spldate['image'];?>" alt="<?php echo $row_spldate['title'];?>">
								</div>
								<div class="blog-content">
									<h2 class="blog-title"><?php echo $row_spldate['title'];?></h2>
									<div class="blog-meta">
										<div class="pull-left">
											<span><?php echo $row_spldate['post_name'];?></span>
											<span><?php echo date("d M, Y",$row_spldate['date']);?></span>
											
											
										</div>
										
									</div>
									<div class="blog-text">
										<?php echo $row_spldate['description'];?>
									</div>
<!--
									<div class="blog-tags">
										<div class="pull-left">
											<span>TAGS</span>
											<ul class="tags">
												<li><a href="#"><span class="value"><span>Dresses</span></span></a></li>
												<li><a href="#"><span class="value"><span>Outerwear</span></span></a></li>
												<li><a href="#"><span class="value"><span>Tops</span></span></a></li>
											</ul>
										</div>
									</div>
-->
<!--
									<div class="blog-comments">
										<h3>POST COMMENTS</h3>
										<div class="comment">
											<div class="user-photo">
												<img class="img-responsive" src="images/blog/user-pic.png" alt="User">
											</div>
											<div class="comment-details">
												<a href="#" class="author">Admin</a>
												<div class="date">March 9, 2015 at 8:57 am</div>
												<div class="text">These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. </div>
											</div>
										</div>
										<h4>3 COMMENTS</h4>
										<div class="comment reply">
											<a href="#" class="replylink"><i class="icon icon-undo-1"></i></a>
											<div class="user-photo">
												<img class="img-responsive" src="images/blog/user-pic.png" alt="User">
											</div>
											<div class="comment-details">
												<a href="#" class="author">Mary Ann</a>
												<div class="date">March 9, 2015 at 8:57 am</div>
												<div class="text">You’re doing a great job so far! Keep up the good work.</div>
											</div>
											<div class="comment reply">
												<a href="#" class="replylink"><i class="icon icon-undo-1"></i></a>
												<div class="user-photo">
													<img class="img-responsive" src="images/blog/user-pic.png" alt="User">
												</div>
												<div class="comment-details">
													<a href="#" class="author">Dana Reala</a>
													<div class="date">March 9, 2015 at 8:57 am</div>
													<div class="text">You’re doing a great job so far! Keep up the good work.</div>
												</div>
											</div>
										</div>
										<div class="comment reply">
											<a href="#" class="replylink"><i class="icon icon-undo-1"></i></a>
											<div class="user-photo">
												<img class="img-responsive" src="images/blog/user-pic.png" alt="User">
											</div>
											<div class="comment-details">
												<a href="#" class="author">Thomas Arche</a>
												<div class="date">March 9, 2015 at 8:57 am</div>
												<div class="text">You’re doing a great job so far! Keep up the good work.</div>
											</div>
										</div>
										<h3>POST A COMMENTS</h3>
										<form action="#" class="post-comment">
											<input type="text" class="form-control" placeholder="Your full name">
											<input type="text" class="form-control" placeholder="E-mail">
											<input type="text" class="form-control" placeholder="Website">
											<textarea class="form-control" placeholder="Write your comment here"></textarea>
											<div>
												<button class="btn">Submit</button>
											</div>
										</form>
									</div>
-->
								</div>
							</div>
						</div>
						<!-- /Center column -->
						<!-- Right column -->
<!--
						<div class="col-md-4">
							<div class="sideblock half">
								<h2>Meta</h2>
								<ul class="simple-list">
									<li><a href="#">Log in</a></li>
									<li><a href="#">Entries RSS</a></li>
									<li><a href="#">Comments RSS</a></li>
									<li><a href="#">WordPress.org</a></li>
								</ul>
							</div>
							<div class="sideblock half">
								<h2>Archives</h2>
								<ul class="simple-list">
									<li><a href="#">February 2015</a></li>
									<li><a href="#">April 2016</a></li>
									<li><a href="#">May 2016</a></li>
									<li><a href="#">Juny 2016</a></li>
								</ul>
							</div>
							<div class="sideblock half">
								<h2>Tags</h2>
								<ul class="tags">
									<li><a href="#"><span class="value"><span>Dresses</span></span></a></li>
									<li><a href="#"><span class="value"><span>Outerwear</span></span></a></li>
									<li><a href="#"><span class="value"><span>Tops</span></span></a></li>
									<li><a href="#"><span class="value"><span>Sleeveless tops</span></span></a></li>
									<li><a href="#"><span class="value"><span>Sweaters</span></span></a></li>
								</ul>
							</div>
							<div class="sideblock half">
								<h2>Blog</h2>
								<ul class="simple-list">
									<li><a href="#">Blog 1</a></li>
									<li><a href="#">Blog 2</a></li>
									<li><a href="#">Blog 3</a></li>
								</ul>
							</div>
							<div class="sideblock">
								<h2>Instagramm</h2>
								<div class="instagramm-feed">
									<a href="#"><img src="images/blog/instagram-01.jpg" alt="" /></a>
									<a href="#"><img src="images/blog/instagram-02.jpg" alt="" /></a>
									<a href="#"><img src="images/blog/instagram-03.jpg" alt="" /></a>
									<a href="#"><img src="images/blog/instagram-04.jpg" alt="" /></a>
									<a href="#"><img src="images/blog/instagram-05.jpg" alt="" /></a>
									<a href="#"><img src="images/blog/instagram-06.jpg" alt="" /></a>
									<a href="#"><img src="images/blog/instagram-07.jpg" alt="" /></a>
									<a href="#"><img src="images/blog/instagram-08.jpg" alt="" /></a>
									<a href="#"><img src="images/blog/instagram-09.jpg" alt="" /></a>
									<a href="#"><img src="images/blog/instagram-10.jpg" alt="" /></a>
									<a href="#"><img src="images/blog/instagram-11.jpg" alt="" /></a>
									<a href="#"><img src="images/blog/instagram-12.jpg" alt="" /></a>
								</div>
							</div>

						</div>
-->
						<!-- /Right column -->
					</div>
					<!-- /Two columns -->
				</div>
			</main>

<?php include('include/footer.php');?>