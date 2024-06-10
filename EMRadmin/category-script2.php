<?php include('config.php')?>
<?php
$country_id = ($_REQUEST["city_id"] <> "") ? trim($_REQUEST["city_id"]) : "";
if ($country_id <> "") {
    $sql = "SELECT * FROM cities WHERE  state_id= '$country_id' ORDER BY city ASC";
    $result_cms2=mysqli_query($link,$sql); 

    if ($result_cms2) {
        ?>
        <option value="">--Select city -- </option>
                <?php while($row_cms2=mysqli_fetch_array($result_cms2)) { ?>
                    <option value="<?php echo $row_cms2["id"]; ?>"><?php echo $row_cms2["city"]; ?></option>
                <?php } ?>
       
        <?php
    }
}
?>
