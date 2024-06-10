<div class="block-title"> 
	<h4 style="margin: 0; padding: 0;"><?php echo $customerchechlogin_row[ 'fname' ]." ".$customerchechlogin_row[ 'lname' ];?></h4>
	<h5 style="margin: 0; padding: 0;">UserID: <?php echo $customerchechlogin_row[ 'userid' ];?></h5>
	
  <div class="filtr_row"><a href="#" class="filter-col-toggle"></a></div>
</div>
<div class="block-content2" style="display: block !important">
  <div class="accordion-container">
    <ul class="category-list">
      <li><a href="profile/" class="value">Dashboard</a></li>
      
	 
	   
		
		

		
        
    </ul>
	
		
		
    <div class="set"> <a> Binary <i class="icon icon-plus"></i> </a>
      <div class="content">
        <ul class="category-list">
          <li><a href="tree.php">Tree</a></li>
          <li><a class="" href="left.php">Left Binary Team</a></li>
          <li><a class="" href="right.php">Right Binary Team</a></li>
          <li><a class="" href="binary_his.php">Binary Income</a></li>
        </ul>
      </div>
    </div>
	 
	  <div class="set"> <a > Robotic  <i class="icon icon-plus"></i> </a>
      <div class="content">
        <ul class="category-list">
			<li><a class="" href="robo.php">Robotic Income</a></li>
			<li><a class="" href="robow.php"> Robotic Wallet</a></li>
			<li><a class="" href="pool1.php"> Robotic Team</a></li>
        </ul>
      </div>
    </div>
	  
    <div class="set"> <a > Pool 2 <i class="icon icon-plus"></i> </a>
      <div class="content">
        <ul class="category-list">
          <li><a class="" href="selfpool.php">Pool Team</a></li>
          <li><a class="" href="self_his.php"> Pool Income</a></li>
          <li><a class="" href="pool_his.php">Pool Level Income</a></li>
		  <!-- <li><a class="" href="kyc.php">KYC</a></li> -->
			<li><a class="" href="global.php">Global Pool Carier Income</a>
            
        </li>
        </ul>
      </div>
    </div>
    <div class="set"> <a> Booster <i class="icon icon-plus"></i> </a>
      <div class="content">
        <ul class="category-list">
          <li><a><strong>Booster 1</strong></a>
            <ul>
              <li><a href="bos1.php">Booster 1 (B1) Team</a></li>
              <li><a href="bos12.php">Booster 1 (B2) Team</a></li>
              <li><a href="bos13.php">Booster 1 (B3) Team</a></li>
              <li><a href="bos14.php">Booster 1 (B4) Team</a></li>
              <li><a href="bos15.php">Booster 1 (B5) Team</a></li>
              <li><a href="bos16.php">Booster 1 (B6) Team</a></li>
              <li><a class="" href="boost1_his.php">Booster 1 Income</a></li>
              <li><a class="" href="boost1level_his.php">Booster 1 Level Income</a></li>
            </ul>
          </li>
          <li><a><strong>Booster 2</strong></a>
            <ul>
              <li><a href="bos2.php">Booster 2 Team</a></li>
              <li><a class="" href="boost2_his.php">Booster 2 Income</a></li>
            </ul>
          </li>
          <li><a><strong>Booster 3</strong></a>
            <ul>
              <li><a href="bos3.php">Booster 3 Team</a></li>
              <li><a class="" href="boost2_his.php">Booster 2 Income</a></li>
              <li><a class="" href="boost3_his.php">Booster 3 Income</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
		<div class="set"> <a>Other Income <i class="icon icon-plus"></i> </a>
      <div class="content">
        <ul class="category-list">
			<li><a class="" href="sponsor_his.php">Sponsor Income</a></li>
         
        <li><a class="" href="rep.php">Repurchase Income</a></li>
			 <li><a href="ad-view-income/">Ad View Income</a></li>
        </ul>
      </div>
    </div>
		
		<div class="set"> <a>Rank Income <i class="icon icon-plus"></i> </a>
      <div class="content">
        <ul class="category-list">
			<li><a class="" href="rankclub.php">Rank Club Income</a></li>
		<li><a class="" href="rankroyal.php">Rank Club Royalty Income</a></li>
        </ul>
      </div>
    </div>
		<div class="set"> <a> Code Team <i class="icon icon-plus"></i> </a>
      <div class="content">
        <ul class="category-list">
           <li><a class="" href="codeinc.php">Enter Code</a></li>
			<li><a class="" href="code.php">Code Income</a></li>
        </ul>
      </div>
    </div>
    <div class="set"> <a > Wallet <i class="icon icon-plus"></i> </a>
      <div class="content">
        <ul class="category-list">
          <li><a class="" href="pool2.php"> Pool 2 Wallet</a></li>
          <li><a class="" href="booster1.php">Booster 1 Wallet</a></li>
          <li><a class="" href="gold.php"> Booster 2 Wallet</a></li>
          <li><a class="" href="diamond.php"> Booster 3 Wallet</a></li>
        </ul>
      </div>
    </div>
    <div class="set"> <a> Account <i class="icon icon-plus"></i> </a>
      <div class="content">
        <ul class="category-list">
          <li><a href="address.php">Address Book</a></li>
          <li><a href="account_info.php">Account Information</a></li>
			<li class=""><a href="order.php">My Order</a>
      <?php
      $totalorder = '';
      $order_email11 = $customerchechlogin_row[ 'email' ];
      $sql_logs11 = "select * from datalogs where email='$order_email11' order by indate DESC";
      $res_logs11 = mysqli_query( $link, $sql_logs11 );
      while ( $listlogs11 = mysqli_fetch_array( $res_logs11 ) ) {
        if ( $listlogs11[ 'ship_details' ] ) {
          $datalog_id11 = $listlogs11[ 'dil_id' ];
          $sql_order11 = "select * from orderproduct WHERE datalogid='$datalog_id11'";
          $result_order11 = mysqli_query( $link, $sql_order11 );
          $totalorder = ( $totalorder + mysqli_num_rows( $result_order11 ) );
        }
      }
      if ( $totalorder > 0 ) {
        echo "<span class='ordnumcount'>" . $totalorder . "</span>";
      }
      ?>
    </li>
    <li><a href="wishlist/">Wishlist</a></li>
			<li><a href="kyc.php">KYC</a></li>
			<li><a href="withhis.php">Withdraw History</a></li>
		<li><a class="" href="rewardc.php">Rewards</a></li>
        </ul>
      </div>
    </div>
  </div>
  <ul class="category-list">
    
   
    
  </ul>
  <div class="bg-striped"></div>
</div>
