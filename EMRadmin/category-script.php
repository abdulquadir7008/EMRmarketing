<?php include('../config.php')?>
<?php
$country_id = ($_REQUEST["city_id"] <> "") ? trim($_REQUEST["city_id"]) : "";
if ($country_id <> "") {
    $sql = "SELECT * FROM category WHERE  maincat= '$country_id' ORDER BY id ASC";
    $result_cms2=mysqli_query($link,$sql); 

    if ($result_cms2) {
        ?>
        
                <?php while($row_cms2=mysqli_fetch_array($result_cms2)) { ?>
                    <option value="<?php echo $row_cms2["id"]; ?>"><?php echo $row_cms2["title"]; ?></option>
                <?php } ?>
       
        <?php
    }
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect();
    });
</script>