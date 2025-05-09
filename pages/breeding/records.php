<?php
include 'c:\xampp\htdocs\rabbit_farm\includes\config.php';
$mysqli =  mysqli_connect($server,$user,$pass,$db_name);
if (!$mysqli) {
    echo "Connection error". mysqli_connect_error();
}else{ 
    $sql = "select buck_ear_tag,doe_ear_tag,breeding_date,expected_kindling_date from breeding_records";
    $result = mysqli_query($mysqli,$sql);
    $records = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rabbit Farm</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
<ul class="nav justify-content-center">
  <li class="nav-item">
  <a class="nav-link" href="http://localhost/rabbit_farm/pages/dashboard.php">Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="http://localhost/rabbit_farm/pages/breeding/add.php">Breed Rabbits</a>
  </li>
</ul>
</div>    
<div class="container-fluid">
  <div class="table table-striped-columns">
    <table border="1">
      <thead>
        <tr>
          <th>Buck</th>
          <th>Doe</th>
          <th>Breeding Date</th>
          <th>Expected Kindling Date</th>
        </tr>
      </thead>
      <tbody>
      <?php for ($i=0; $i < count($records); $i++) { ?>
            <tr>
            <td><?= $records[$i]['buck_ear_tag']; ?></td>
            <td><?= $records[$i]['doe_ear_tag']; ?></td>
            <td><?= $records[$i]['breeding_date']; ?></td>
            <td><?= $records[$i]['expected_kindling_date']; ?></td>
            </tr>
            <?php } }?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>