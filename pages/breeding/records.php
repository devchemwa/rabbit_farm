<?php
include 'c:\xampp\htdocs\rabbit_farm\includes\config.php';
$mysqli =  mysqli_connect($server,$user,$pass,$db_name);
if (!$mysqli) {
    echo "Connection error". mysqli_connect_error();
}else{ 
    $sql = "select * from breeding_records";
    $result = mysqli_query($mysqli,$sql);
    $records = mysqli_fetch_all($result);
    print_r($records);
?>




<?php } ?>