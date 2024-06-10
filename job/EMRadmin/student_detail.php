<?php
session_start();
include( '../config.php' );
include( 'configset.php' );
$fname = $_REQUEST[ 'fname' ];
$lname = $_REQUEST[ 'lname' ];
$id = $_REQUEST[ 'id' ];
$email = $_REQUEST[ 'email' ];
$phone = $_REQUEST[ 'phone' ];
$message = $_REQUEST[ 'message' ];

		if ( $_FILES[ "resume" ][ "name" ] != '' ) {
	$allowedExts = array("pdf", "doc", "docx");
	$extension = end(explode(".", $_FILES["resume"]["name"]));
  		if ( ( $_FILES[ "resume" ][ "type" ] == "application/pdf" ) || ( $_FILES[ "resume" ][ "type" ] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" ) || ( $_FILES[ "resume" ][ "type" ] == "application/msword" ) && ($_FILES["file"]["size"] < 20000000) && in_array($extension, $allowedExts)) 
  {
    $image = "../$path" . $rand1 . $_FILES[ "resume" ][ "name" ];
    $image0 = $rand1 . $_FILES[ "resume" ][ "name" ];
    move_uploaded_file( $_FILES[ "resume" ][ "tmp_name" ], $image );
  } else {
    $image0 = '';
  }
}else {
  $image0 = $_REQUEST[ 'hiddenimage' ];
}


if ( isset( $_REQUEST[ 'update' ] ) ) {
  $query = "update career SET fname='$fname',lname='$lname',email='$email',phone='$phone', message='$message',resume='$image0' WHERE id=$id";
  mysqli_query( $link, $query );
  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = 'Record modified successfully.';
  $errflag = true;
  $_SESSION[ 'ERRMSG_ARR' ] = $errmsg_arr;
  session_write_close();
} else if ( isset( $_REQUEST[ 'add' ] ) ) {
  $query = "insert into career(fname,lname,email,phone,message,resume,date)values('$fname','$lname','$email','$phone','$message','$image0',now())";
  mysqli_query( $link, $query );
  $errmsg_arr = array();
  $errflag = false;
  $errmsg_arr[] = 'Record Add successfully.';
  $errflag = true;
  $_SESSION[ 'ERRMSG_ARR' ] = $errmsg_arr;
  session_write_close();
} else if ( isset( $_REQUEST[ 'id' ] ) || isset( $_REQUEST[ 'id1' ] ) ) {
  if ( isset( $_REQUEST[ 'id' ] ) ) {
    $id = $_REQUEST[ 'id' ];
    $status = '0';
  } else if ( isset( $_REQUEST[ 'id1' ] ) ) {
    $id = $_REQUEST[ 'id1' ];
    $status = '1';
  } else {
    $status = '0';
  }
  $query = "update career SET status='$status' WHERE id='$id'";
  mysqli_query( $link, $query );
} else if ( isset( $_REQUEST[ 'del' ] ) ) {
  $id = $_REQUEST[ 'del' ];
  $query = "delete from career WHERE id=$id";
  mysqli_query( $link, $query );
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Admin Banner Content | FloorNation</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="CMS Banner FLoorNation" name="description" />
<meta content="FloorNation" name="Quadir" />
<link rel="icon" href="<?php echo $domain_url;?>uploads/<?php echo $profile_row['favicon']; ?>" sizes="32x32" />
<link rel="icon" href="<?php echo $domain_url;?>uploads/<?php echo $profile_row['favicon']; ?>" sizes="192x192" />
<link rel="apple-touch-icon" href="<?php echo $domain_url;?>uploads/<?php echo $profile_row['favicon']; ?>" />
<link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<link href="assets/css/awesome/css/all.css" rel="stylesheet">
</head>

<body>
<div id="layout-wrapper">
  <?php include('includes/top.php')?>
  <div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0">About Student</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                  <li class="breadcrumb-item active">About Student</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div> <a href="student_form.php">
            <button type="button" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Add Student</button>
            </a> </div>
          <?php
          if ( isset( $_SESSION[ 'ERRMSG_ARR' ] ) && is_array( $_SESSION[ 'ERRMSG_ARR' ] ) && count( $_SESSION[ 'ERRMSG_ARR' ] ) > 0 ) {
            foreach ( $_SESSION[ 'ERRMSG_ARR' ] as $msg ) {
              echo "<div class='pad margin no-print'><div style='margin: 20px !important;' class='alert alert-success alert-dismissible fade show'><i class='fa fa-info'></i><b>Note:</b>" . $msg . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div></div>";
            }
            unset( $_SESSION[ 'ERRMSG_ARR' ] );
          }
          ?>
          <div class="col-lg-12">
            <div class="table-responsive mb-4">
              <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                <thead>
                  <tr class="bg-transparent">
                    <th style="width: 20px;"> <div class="form-check text-center font-size-16">
                        <input type="checkbox" class="form-check-input" id="ordercheck">
                        <label class="form-check-label" for="ordercheck"></label>
                      </div>
                    </th>
                    <th>Fullname</th>
                    <th>Email</th>
					<th>Phone</th>
					  <th>Course</th>
					  <th>Message</th>
					  <th>Download Resume</th>
                    <th>Modify</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql_cms = "select * from career order by id DESC";
                  $result_cms = mysqli_query( $link, $sql_cms );
                  while ( $row_cms = mysqli_fetch_array( $result_cms ) ) {
                    ?>
                  <tr>
                    <td><div class="form-check text-center font-size-16">
                        <input type="checkbox" name="users[]" value="<?php echo $row_cms["id"]; ?>" />
                        <label class="form-check-label" for="ordercheck1"></label>
                      </div></td>
                    <td><?php echo $row_cms['fname']." ".$row_cms['lname'];?></td>
                    <td><?php echo $row_cms['email'];?></td>
					<td><?php echo $row_cms['phone'];?></td>
					  <td><?php echo $row_cms['course'];?></td>
					  <td><?php echo $row_cms['message'];?></td>
                    <td><?php if($row_cms['resume']!='') { ?>
                      <a href="../<?php echo $path.$row_cms['resume'];?>"> Download</a>
                      <?php } ?></td>
                    <td><a href="student_form.php?cms=<?php echo $row_cms['id'];?>" class="px-3 text-primary"><i class="fa bx bx-edit-alt font-size-18"></i></a>
               
                      <a href="student_detail.php?del=<?php echo $row_cms['id']; ?>" class="px-3 text-danger" onClick="return confirm('Do you really want to remove it?')"><i class="bx bx-trash font-size-18"></i></a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include('includes/footer.php')?>
  </div>
</div>
<script src="assets/libs/jquery/jquery.min.js"></script> 
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script> 
<script src="assets/libs/metismenu/metisMenu.min.js"></script> 
<script src="assets/libs/simplebar/simplebar.min.js"></script> 
<script src="assets/libs/node-waves/waves.min.js"></script> 
<script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script> 
<script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script> 
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script> 
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script> 
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script> 
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script> 
<script src="assets/js/pages/ecommerce-datatables.init.js"></script> 
<script src="assets/js/app.js"></script>
</body>
</html>