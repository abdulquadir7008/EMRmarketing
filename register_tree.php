<?php
include_once( 'include/configuration.php' );
$userLink = '';
if(isset($_REQUEST['userlink'])){
	$userLink = $_REQUEST['userlink'];
	
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
      <div class="block">
        <div class="container">
          <ul class="breadcrumbs">
            <li><a href="index.html"><i class="icon icon-home"></i></a></li>
            <li>/<span>Register</span></li>
          </ul>
        </div>
      </div>
      <div class="block">
        <div class="container">
          <div class="form-card">
            <h3>Create Account</h3>
            <?php
            if ( isset( $_SESSION[ 'registerpro' ] ) && is_array( $_SESSION[ 'registerpro' ] ) && count( $_SESSION[ 'registerpro' ] ) > 0 ) {
              foreach ( $_SESSION[ 'registerpro' ] as $msg ) {
                echo $msg;
              }
              unset( $_SESSION[ 'registerpro' ] );
            }
            ?>
            <form class="theme-form" action="emrscript/regsiterpros.php" method="post" enctype="multipart/form-data">
              <div class="sopnser_input_details">
               Sponser ID <input type="text" id="sponsor_id" name="spnoser_id" maxlength="30" class="form-control" placeholder="Sponser ID *" value="<?php echo $userLink;?>" readonly style="background-color: #f7f7f7;">
				  <?php if($userLink){?>
				  <input type="hidden" name="sponser_status" value="yes" />
				  <?php } else{?>
				  <input type="hidden" name="sponser_status" value="no" />
				  <?php } 
				  $SqlSponsergen = mysqli_query($link,"select * from membership where userid='$userLink'"); 
				  $ListSponserList = mysqli_fetch_array($SqlSponsergen);
				  echo "<spann>".$ListSponserList['fname']." ".$ListSponserList['lname']."</span>"
				  ?>
              </div>
              <div class="row form-row">
                <div class="col-md-4">
                  <label class="field-label">First Name *</label>
                  <input type="text" name="fname" maxlength="30" class="form-control" placeholder="First Name" required>
                </div>
                <div class="col-md-4">
                  <label class="field-label">Last Name *</label>
                  <input type="text" name="lname" maxlength="30" class="form-control" placeholder="Last Name" required>
                </div>
                <div class="col-md-4">
                  <label class="field-label">Phone *</label>
                  <input type="tel" name="phone" class="form-control phonecode" placeholder="Phone" maxlength="11" required>
                </div>
                <div class="col-md-4">
                  <label class="field-label">Email Address *</label>
                  <input type="email" name="email" maxlength="40" class="form-control" placeholder="Email Address" required>
                </div>
                <div class="col-md-4">
                  <label class="field-label">Password *</label>
                  <input type="password" name="password" maxlength="11" id="password" class="form-control" value="" placeholder="password" required>
                </div>
                <div class="col-md-4">
                  <label>Repeat Password</label>
                  <input class="form-control" type="password" maxlength="11" id="confirm_password">
                </div>
                <div class="col-md-4">
                  <label>Select Position</label>
                  <select class="form-control" name="position" id="position" required style="-webkit-appearance:inner-spin-button;">
                    <option value="">Select Position</option>
                    <option value="L" >Left</option>
                    <option value="R" >Right</option>
                  </select>
                  <!-- <input class="form-control" type="password" maxlength="11" id="confirm_password"  placeholder="Repeat Password"> -->
                </div>
                <div class="col-md-8">
                  <label class="field-label">Address *</label>
                  <input type="text" name="stree_address" maxlength="150" class="form-control" placeholder="Street address" required>
                  <input type="hidden" name="ref" value="1" >
                </div>
                <div class="col-md-4">
                  <label class="field-label">City *</label>
                  <input type="text" name="city" maxlength="50" class="form-control" placeholder="City" required>
                </div>
               <div class="col-md-4">
                  <label class="field-label">State *</label>
                  <select name="state" class="form-control" required onChange="showCity(this);" style="-webkit-appearance:inner-spin-button;">
					  <option value="">--Select State -- </option>
					  <?php
$stateSql = mysqli_query( $link, "select * from states order by name ASC" );
while($stateSqli = mysqli_fetch_array( $stateSql )){
	echo "<option value='".$stateSqli['id']."'>".$stateSqli['name']."</option>";
}
?>
					</select>
                </div>
                <div class="col-md-4">
                  <label class="field-label">District *</label>
					<select class="form-control" name="city" id="cityoutput" required style="-webkit-appearance:inner-spin-button;">
						<option value="">--Select City -- </option>
					</select>
                </div>
                <div class="col-md-4">
                  <label class="field-label">Postal Code *</label>
                  <input type="number" name="postalcode" maxlength="30" class="form-control" placeholder="Postal Code" required>
                </div>
              </div>
              <div class="middle">
                <label>
                  <input type="radio" name="gender" value="female" checked/>
                  <span class="fa fa-female"><strong>Women</strong></span> </label>
                <label>
                  <input type="radio" name="gender" value="male" />
                  <span class="fa fa-male"><strong>Men</strong></span> </label>
              </div>
              <button type="submit" class="btn-solid btn" name="order">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </main>
    <?php include('include/footer.php');?>