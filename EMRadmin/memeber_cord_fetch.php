<?php include('../config.php')?>
<?php
$country_id = ($_REQUEST["city_id"] <> "") ? trim($_REQUEST["city_id"]) : "";
if ($country_id <> "") {
    $result_cms2=mysqli_query($link,"SELECT * FROM membership 
	INNER JOIN cities ON membership.city = cities.id 
	INNER JOIN states ON membership.state = states.id
	WHERE userid= '$country_id'"); 
	$row_cms2=mysqli_fetch_array($result_cms2);
	
    $result_cms21=mysqli_query($link,"SELECT * FROM states 
	INNER JOIN region ON states.region_id = region.region_id 
	WHERE name= '".$row_cms2['name']."'"); 
	$row_cms21=mysqli_fetch_array($result_cms21);
	
        ?>
        <div class="table_view">
				  <table style="background: #ccc; padding: 10px;line-height: 1" cellpadding="5">
				  	<tr>
						<th>UserId</th>
						<th> Full Name</th>
						<th>District</th>
						<th>State</th>
						<th>Region</th>
					  </tr>
					  
					  <tr>
						<td><?php echo $row_cms2['userid'];?></td>
						<td><?php echo $row_cms2['fname']." ".$row_cms2['lname'];?></th>
						<td><?php echo $row_cms2['city'];?></td>
						<td><?php echo $row_cms2['name'];?></td>
						<td><?php echo $row_cms21['regionName'];;?></td>
					  </tr>
				  </table>
			  </div>
               
       
        <?php
   
}
?>
