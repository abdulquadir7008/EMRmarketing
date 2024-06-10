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
							<li>/<span>Contact</span></li>
						</ul>
					</div>
				</div>
				<div class="block">
					<div class="container">
						<div class="row">
							<div class="col-sm-5">
								<div class="text-wrapper">
									<h2>EMR Marketing LLP</h2>
									<div class="address-block">
										<h3>ADDRESS</h3>
										<ul class="simple-list">
											<li><i class="icon icon-location-pin"></i>Shop No.2, Opp New Airport Authority of India Building, Sahar Road, Parsiwada, Andheri-East,Mumbai-400099
</li>
											<li><i class="icon icon-phone"></i>Phone: +91 9867724488/9136663355</li>
											
											<li><i class="icon icon-close-envelope"></i>Email: <a href="mailto:support@emrmarketing.in">support@emrmarketing.in</a></li>
										</ul>
									</div>
<!--
									<div class="address-block last">
										<h3>ADDRESS 2</h3>
										<ul class="simple-list">
											<li><i class="icon icon-location-pin"></i>Adress: 5487 Capers Road, Glasgow D43 66 GR, Boston</li>
											<li><i class="icon icon-phone"></i>Phone: 9823xxx</li>
											<li><i class="icon icon-phone"></i>Fax: 123456789xxxx</li>
											<li><i class="icon icon-close-envelope"></i>Email: <a href="mailto:support@seiko.com">Seico@example.com</a></li>
										</ul>
									</div>
-->
								</div>
							</div>
							<div class="col-sm-7">
								<?php
if( isset($_SESSION['verifysuccfully']) && is_array($_SESSION['verifysuccfully']) && count($_SESSION['verifysuccfully']) >0 ) {
foreach($_SESSION['verifysuccfully'] as $msg) {
echo $msg;  
}
unset($_SESSION['verifysuccfully']); }?>
								<div class="text-wrapper">
									<h2>Contact Information</h2>
									<p id="contactFormSuccess">Your email was send successfully!</p>
									<p id="contactFormError">Error, try to submit this form again.</p>
									<form id="contactform" action="form_processor.php" class="contact-form white" name="contactform" method="post">
										<label>Name<span class="required">*</span></label>
										<input type="text" class="form-control input-lg" name="fullname" required>
										<label>E-mail<span class="required">*</span></label>
										<input type="email" class="form-control input-lg" name="email" required>
										<label>Phone<span class="required">*</span></label>
										<input type="tel" class="form-control input-lg" name="phone" required>
										<label>Subject<span class="required">*</span></label>
										<input type="text" class="form-control input-lg" name="subject" required>
										<label>Comment<span class="required">*</span></label>
										<textarea class="form-control input-lg" name="message"></textarea>
										<div>
											<button type="submit" name="requestquote" class="btn btn-lg" id="submit">Submit</button>
										</div>
										<div class="required-text">* Required Fields</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="block fullwidth">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3770.2564648386965!2d72.86293309999999!3d19.096401699999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c84ff39b90d5%3A0xfc6dd6378d129a2f!2sAirports%20Authority%20Of%20India!5e0!3m2!1sen!2sin!4v1688889880214!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</main>

<?php include('include/footer.php');?>