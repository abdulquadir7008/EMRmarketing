<header id="page-topbar">
  <div class="navbar-header">
    <div class="d-flex">
      <div class="navbar-brand-box"> <a href="index.html" class="logo logo-dark"> <span class="logo-sm"> <img src="assets/images/logo-sm.png" alt="" height="22"> </span> <span class="logo-lg"> <img src="assets/images/logo-dark.png" alt="" height="20"> </span> </a> <a href="index.html" class="logo logo-light"> <span class="logo-sm"> <img src="assets/images/logo-sm.png" alt="" height="22"> </span> <span class="logo-lg"> <img src="assets/images/logo-light.png" alt="" height="20"> </span> </a> </div>
      <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn"> <i class="fa fa-fw fa-bars"></i> </button>
    </div>
    <div class="d-flex">
      <div class="dropdown d-inline-block d-lg-none ms-2">
        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="uil-search"></i> </button>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
          <form class="p-3">
            <div class="form-group m-0">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="dropdown d-none d-lg-inline-block ms-1">
        <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen"> <i class="fa fa-expand"></i> </button>
      </div>
      <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php if($profile_row['image']!='') { ?>
        <img src="../uploads/<?php echo $profile_row['image'];?>" class="rounded-circle header-profile-user" />
        <?php } ?>
        <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15"><?php echo $profile_row['firstname']." ".$profile_row['lastname']; ?></span> <i class="fa fa-angle-down d-none d-xl-inline-block font-size-15"></i> </button>
        <div class="dropdown-menu dropdown-menu-end"> <a class="dropdown-item d-block" href="setting.php"><i class="fa fa-cog font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Settings</span></a> <a class="dropdown-item" href="#"><i class="fa fa-lock font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Lock screen</span></a> <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Sign out</span></a> </div>
      </div>
    </div>
  </div>
</header>
<div class="vertical-menu">
  <div class="navbar-brand-box"> <a href="index.php" class="logo logo-dark"> <span class="logo-sm"> <img src="../uploads/<?php echo $profile_row['image'];?>" alt="" height="22"> </span> <span class="logo-lg"> <img src="../uploads/<?php echo $profile_row['image'];?>" alt="" height="70"> </span> </a> <a href="index.php" class="logo logo-light"> <span class="logo-sm"> <img src="assets/images/logo-sm.png" alt="" height="22"> </span> <span class="logo-lg"> <img src="../uploads/<?php echo $profile_row['image'];?>" alt="" height="20"> </span> </a> </div>
  <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn"> <i class="fa fa-fw fa-bars"></i> </button>
  <div data-simplebar class="sidebar-menu-scroll">
    <div id="sidebar-menu">
      <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Menu</li>
        <li> <a href="index.php"> <i class="fa fa-home"></i><span class="badge rounded-pill bg-primary float-end">01</span> <span>Dashboard</span> </a> </li>
        <li class="menu-title">Apps</li>
       
        <?php if($profile_row['admin_id'] == '1'){ ?>

		   <li><a href="student_detail.php"><i class="fa fa-phone-square"></i> Request Student List</a></li>
<!--        <li> <a href="setting.php"> <i class="fa fa-cog"></i> <span>Setting</span> </a> </li>-->
        <?php } ?>
      </ul>
    </div>
  </div>
</div>
