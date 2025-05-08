<?php
include 'c://xampp/htdocs/rabbit_farm/includes/config.php';
$conn = mysqli_connect($server,$user,$pass,$db_name);
if(!$conn){
    echo "connection error: " . mysqli_connect_error();
}else{
    $sql = "select * from rabbits";
    $query = mysqli_query($conn,$sql);
    $results = mysqli_fetch_assoc($query);
    
}

?>