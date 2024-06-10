<?php
session_start();
include( '../config.php' );
if ( isset( $_SESSION[ 'username' ] ) ) {
  session_write_close();
  header( "location:index.php" );
  exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>Log In | EMR Education</title>
<meta content="Login FLoorNation" name="description" />
<meta content="FloorNation" name="Quadir" />
<link rel="icon" href="<?php echo $domain_url;?>uploads/<?php echo $profile_row['favicon']; ?>" sizes="32x32" />
<link rel="icon" href="<?php echo $domain_url;?>uploads/<?php echo $profile_row['favicon']; ?>" sizes="192x192" />
<link rel="apple-touch-icon" href="<?php echo $domain_url;?>uploads/<?php echo $profile_row['favicon']; ?>" />
<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg">
<div class="account-pages my-5 pt-sm-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="text-center"> <a class="mb-5 d-block auth-logo"> <img src="../images/logo.jpg" width="200"> </a> </div>
      </div>
    </div>
    <div class="row align-items-center justify-content-center">
      <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card">
          <div class="card-body p-4">
            <div class="text-center mt-2">
              <h5 class="text-primary">Welcome Back !</h5>
              <p class="text-muted">Sign in to continue to EMR.</p>
            </div>
            <div class="p-2 mt-4">
              <?php
              if ( isset( $_SESSION[ 'ERRMSG_ARR' ] ) && is_array( $_SESSION[ 'ERRMSG_ARR' ] ) && count( $_SESSION[ 'ERRMSG_ARR' ] ) > 0 ) {
                foreach ( $_SESSION[ 'ERRMSG_ARR' ] as $msg ) {
                  echo "<div style='background:#d5f0e4; color:#3d9970; text-align:center; line-height:45px; font-weight:bold;'>" . $msg . "</div>";
                }
                unset( $_SESSION[ 'ERRMSG_ARR' ] );
              }
              ?>
              <form id="form1" name="form1" method="post" action="script/login_exec.php">
                <div class="mb-3">
                  <label class="form-label" for="username">Username</label>
                  <input type="text" name="username" class="form-control" id="username" placeholder="Enter username">
                </div>
                <div class="mb-3">
                  
                  <label class="form-label" for="userpassword">Password</label>
                  <input type="password" name="password" class="form-control" id="userpassword" placeholder="Enter password">
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="auth-remember-check">
                  <label class="form-check-label" for="auth-remember-check">Remember me</label>
                </div>
                <div class="mt-3 text-end">
                  <button class="btn btn-primary w-sm waves-effect waves-light" name="login_button" type="submit">Log In</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="mt-5 text-center">
          <p>© <script>document.write(new Date().getFullYear())</script> EMR Education. </p>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="assets/libs/jquery/jquery.min.js"></script> 
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script> 
<script src="assets/libs/metismenu/metisMenu.min.js"></script> 
<script src="assets/libs/simplebar/simplebar.min.js"></script> 
<script src="assets/libs/node-waves/waves.min.js"></script> 
<script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script> 
<script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script> 
<script src="assets/js/app.js"></script>
</body>
</html>