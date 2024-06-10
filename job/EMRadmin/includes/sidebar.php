<aside class="left-side sidebar-offcanvas">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <?php if($profile_row['image']!='') { image_size(); ?>
        <img src="../uploads/<?php echo $profile_row['image'];?>" class="img-circle" />
        <?php } ?>
      </div>
      <div class="pull-left info">
        <p>Hello, <?php echo $profile_row['firstname']." ".$profile_row['lastname']; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a> </div>
    </div>
    <ul class="sidebar-menu">
      <li> <a href="index.php"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> </a> </li>
      <li class="treeview active"> <a href="#"> <i class="fa fa-bar-chart-o"></i> <span>CMS</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li><a href="cms_manage.php"><i class="fa fa-angle-double-right"></i> Manage Pages</a></li>
          <li class="treeview"><a href="#"><i class="fa fa-angle-double-down"></i> Manage Home Page</a>
            <ul class="treeview-menu">
              <li><a href="homepage_manage.php"><i class="fa fa-angle-double-right"></i> Home Content</a></li>
              <li><a href="signature_manage.php"><i class="fa fa-angle-double-right"></i>SIGNATURE DISHES</a></li>
            </ul>
          </li>
          <li><a href="services_manage.php"><i class="fa fa-angle-double-right"></i> Manage Sarvices</a></li>
          <li><a href="value_manage.php"><i class="fa fa-angle-double-right"></i>Manage Project</a></li>
          <li><a href="gallery_manage.php"><i class="fa fa-angle-double-right"></i>Gallary</a></li>
          <li><a href="banner_manage.php"><i class="fa fa-angle-double-right"></i>Manage Slider</a></li>
          <li><a href="clients_manage.php"><i class="fa fa-angle-double-right"></i>Manage Grid</a></li>
        </ul>
      </li>
     
    </ul>
  </section>
</aside>
