<?php
include 'c://xampp/htdocs/rabbit_farm/includes/config.php';
$conn = mysqli_connect($server,$user,$pass,$db_name);
if(!$conn){
    echo "connection error: " . mysqli_connect_error();
}else{
    $sql = "select name,ear_tag,doe_ear_tag,buck_ear_tag,gender,breed,date_of_birth,status from rabbits where status = 'active'";
    $query = mysqli_query($conn,$sql);
    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
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
<div class="container">
<ul class="nav justify-content-center">
  <li class="nav-item">
  <a class="nav-link" href="http://localhost/rabbit_farm/pages/dashboard.php">Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="http://localhost/rabbit_farm/pages/rabbits/add.php">Add Rabbits</a>
  </li>
  <li class="nav-item">
    <a class="nav-link"  href="http://localhost/rabbit_farm/pages/rabbits/view.php">View Rabbits</a>
  </li>
</ul>
</div> 
    
<div class="container-fluid">
      <table class="table table-striped">
        <thead>
                <th>CAGE NUMBER</th>
                <th>EAR TAG</th>
                <th>MOTHER</th>
                <th>FATHER</th>
                <th>GENDER</th>
                <th>BREED</th>
                <th>DATE OF BIRTH</th>
                <th>STATUS</th>
        </thead>
        <tbody>
            <?php for ($i=0; $i < count($results); $i++) { ?>
            <tr>
            <td><?= $results[$i]['name']; ?></td>
            <td><?= $results[$i]['ear_tag']; ?></td>
            <td><?= $results[$i]['doe_ear_tag']; ?></td>
            <td><?= $results[$i]['buck_ear_tag']; ?></td>
            <td><?= $results[$i]['gender']; ?></td>
            <td><?= $results[$i]['breed']; ?></td>
            <td><?= $results[$i]['date_of_birth']; ?></td>
            <td><?= $results[$i]['status']; ?></td>
            </tr>
            <?php } }?>
        </tbody>
    </table>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
</body>
</html>