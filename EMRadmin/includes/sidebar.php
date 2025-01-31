<aside class="left-side sidebar-offcanvas"> 
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar"> 
      <!-- Sidebar user panel -->
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
      <!-- search form --> 
      
      <!-- /.search form --> 
      <!-- sidebar menu: : style can be found in sidebar.less -->
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
        <li class="treeview"><a href="#"><i class="fa fa-angle-double-down"></i> catalogue</a>
    	        <ul class="treeview-menu">
                	<li><a href="category_manage.php"><i class="fa fa-angle-double-right"></i> category</a></li>
                    <li><a href="products_manage.php"><i class="fa fa-angle-double-right"></i> Products</a></li>
                    
            	</ul>
            </li>
		  
		   <li class="treeview"><a href="#"><i class="fa fa-angle-double-down"></i> ERP</a>
    	        <ul class="treeview-menu">
                	<li><a href="pool_list.php"><i class="fa fa-angle-double-right"></i> Pool</a></li>
                    
                    
            	</ul>
            </li>
        <!--li> <a href="../../widgets.html"> <i class="fa fa-th"></i> <span>Widgets</span> <small class="badge pull-right bg-green">new</small> </a> </li
        
        <li class="treeview"> <a href="#"> <i class="fa fa-laptop"></i> <span>UI Elements</span> <i class="fa fa-angle-left pull-right"></i> </a>
          <!--ul class="treeview-menu">
            <li><a href="../../UI/general.html"><i class="fa fa-angle-double-right"></i> General</a></li>
            <li><a href="../../UI/icons.html"><i class="fa fa-angle-double-right"></i> Icons</a></li>
            <li><a href="../../UI/buttons.html"><i class="fa fa-angle-double-right"></i> Buttons</a></li>
            <li><a href="../../UI/sliders.html"><i class="fa fa-angle-double-right"></i> Sliders</a></li>
            <li><a href="../../UI/timeline.html"><i class="fa fa-angle-double-right"></i> Timeline</a></li>
          </ul>
        </li
        <li class="treeview"> <a href="#"> <i class="fa fa-edit"></i> <span>Forms</span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li><a href="../../forms/general.html"><i class="fa fa-angle-double-right"></i> General Elements</a></li>
            <li><a href="../../forms/advanced.html"><i class="fa fa-angle-double-right"></i> Advanced Elements</a></li>
            <li><a href="../../forms/editors.html"><i class="fa fa-angle-double-right"></i> Editors</a></li>
          </ul>
        </li>
        <li class="treeview"> <a href="#"> <i class="fa fa-table"></i> <span>Tables</span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li><a href="../simple.html"><i class="fa fa-angle-double-right"></i> Simple tables</a></li>
            <li class="active"><a href="../data.html"><i class="fa fa-angle-double-right"></i> Data tables</a></li>
          </ul>
        </li>
        <li> <a href="../../calendar.html"> <i class="fa fa-calendar"></i> <span>Calendar</span> <small class="badge pull-right bg-red">3</small> </a> </li>
        <li> <a href="mailbox.php"> <i class="fa fa-envelope"></i> <span>Mailbox</span> <small class="badge pull-right bg-yellow">12</small> </a> </li>
        <li class="treeview"> <a href="#"> <i class="fa fa-folder"></i> <span>Examples</span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li><a href="../../examples/invoice.html"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
            <li><a href="../../examples/login.html"><i class="fa fa-angle-double-right"></i> Login</a></li>
            <li><a href="../../examples/register.html"><i class="fa fa-angle-double-right"></i> Register</a></li>
            <li><a href="../../examples/lockscreen.html"><i class="fa fa-angle-double-right"></i> Lockscreen</a></li>
            <li><a href="../../examples/404.html"><i class="fa fa-angle-double-right"></i> 404 Error</a></li>
            <li><a href="../../examples/500.html"><i class="fa fa-angle-double-right"></i> 500 Error</a></li>
            <li><a href="../../examples/blank.html"><i class="fa fa-angle-double-right"></i> Blank Page</a></li>
          </ul>
        </li>-->
      </ul>
    </section>
    <!-- /.sidebar --> 
  </aside>