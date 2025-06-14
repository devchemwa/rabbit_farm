<?php
include 'c:\xampp\htdocs\rabbit_farm\includes\config.php';
$mysqli =  mysqli_connect($server,$user,$pass,$db_name);
if (!$mysqli) {
    echo "Connection error". mysqli_connect_error();
}
    $sql = "select id,buck_ear_tag,doe_ear_tag,breeding_date,expected_kindling_date,actual_kindling_date,litter_size from breeding_records";
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
          <th>Actual Kindling Date</th>
          <th>Litter Size</th>
        </tr>
      </thead>
      <tbody>
      <?php for ($i=0; $i < count($records); $i++) { ?>
            <tr>
            <td><?= $records[$i]['buck_ear_tag']; ?></td>
            <td><?= $records[$i]['doe_ear_tag']; ?></td>
            <td><?= $records[$i]['breeding_date']; ?></td>
            <td><?= $records[$i]['expected_kindling_date']; ?></td>
            <form action="records.php" method="post">
            <td><input type="date" name="date" id="date" placeholder="Enter Date"></td>
            <td><input type="number" name="litter_size" id="litter_size" placeholder="Enter Litter Size"></td>
            <td><input type="submit" name="submit" id="submit" value="Save Changes"></td>          
            <td><input type="number" name="id" id="id" value="<?=$records[$i]['id']?>" hidden></td> 
            <?php
if(isset($_POST['submit'])){
  $id = htmlspecialchars((string)$_POST['id']);
  $date = htmlspecialchars((string)$_POST['date']);
  $litter = htmlspecialchars((string)$_POST['litter_size']);
  $sql = "
update breeding_records set actual_kindling_date = '$date', litter_size = '$litter' where id = '$id'
  ";
  $save = mysqli_query( $mysqli,$sql);
  if (!$save) {
    echo "error: ". mysqli_connect_error();
}

      } }


?>

            </form>
            </tr>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>