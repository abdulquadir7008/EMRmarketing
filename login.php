<?php include_once( 'include/configuration.php' );


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
							<li>/<span>Login</span></li>
						</ul>
					</div>
				</div>
				<div class="block">
					<div class="container">
						<div class="row row-eq-height">
							<div class="col-sm-6">
								<div class="form-card">
									<h4>New Customers</h4>
									<p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
									<div><a href="register/" class="btn btn-lg"><i class="icon icon-user"></i><span>Create An Account</span></a></div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-card">
									<h4>Registered Customers</h4>
									<p>If you have an account with us, please log in.</p>
									<?php
if( isset($_SESSION['verifysuccfully']) && is_array($_SESSION['verifysuccfully']) && count($_SESSION['verifysuccfully']) >0 ) {
foreach($_SESSION['verifysuccfully'] as $msg) {
echo $msg;  
}
unset($_SESSION['verifysuccfully']); }?>

			<?php
if( isset($_SESSION['loginerror']) && is_array($_SESSION['loginerror']) && count($_SESSION['loginerror']) >0 ) {
foreach($_SESSION['loginerror'] as $msg) {
echo $msg;  
}
unset($_SESSION['loginerror']); }?>
									<?php
if( isset($_SESSION['passwordch']) && is_array($_SESSION['passwordch']) && count($_SESSION['passwordch']) >0 ) {
foreach($_SESSION['passwordch'] as $msg) {
echo $msg;  
}
unset($_SESSION['passwordch']); }?>
									<form class="account-create" action="<?php echo $domain_url ?>/emrscript/login_proccess.php" method="post">
										<label>E-mail or User ID<span class="required">*</span></label>
										<input type="text" name="email" class="form-control input-lg" required>
										<label>Password<span class="required">*</span></label>
										<input type="password" name="password" class="form-control input-lg" required>
										<div>
											<?php if(mysqli_num_rows($numlistlogincheck) > 2){ ?>
							<div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LdKtNIbAAAAAPZpgGiJEoI4_dZ4yJlWQaRvGlOA" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                            <input class="form-control d-none" data-recaptcha="true" required data-error="Please complete the Captcha">
                            <div class="help-block with-errors"></div>
                        </div>
							<?php } ?>
											<button class="btn btn-lg">Login</button><span class="required-text">* Required Fields</span></div>
										<div class="back"><a href="reset.php">Forgot Your Password?</a></div>
									</form>
									<div class="social_btnrick"><a href = "faceconfig.php"><img src="images/facebook-btn.png"></a>
                    <a href = "#"><?php echo $login_button;?></a>
                </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
    <!-- /Page Content -->
    <?php include('include/footer.php');?>