<?php
$db_name = "rabbit_farm";
$server = "localhost";
$user = "chemwa";
$pass = "At._.420";
$conn = mysqli_connect($server,$user,$pass,$db_name);
if(!$conn){
  echo "Connection Error: " . mysqli_connect_error();
}
$sql = "select transaction_date,type,category,sum(amount) as total,description,ear_tag from financial_transactions
group by transaction_date,type,category,description,ear_tag
order by sum(amount)
;";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_all( $query );
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
  <a class="nav-link" href="http://localhost/rabbit_farm/pages/finance/add.php">New Expense</a>
  </li>
</ul>
  </div>
  <div class="container-fluid">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Date</th>
          <th>Type</th>
          <th>Category</th>
          <th>Amount</th>
          <th>Description</th>
          <th>Ear Tag</th>
        </tr>
      </thead>
      <tbody>
           <?php for($i= 0;$i<count($result);$i++){ ?>
            <tr>
              <td><?=$result[$i][0];?></td>
              <td><?=$result[$i][1];?></td>
              <td><?=$result[$i][2];?></td>
              <td><?=$result[$i][3];?></td>
              <td><?=$result[$i][4];?></td>
              <td><?=$result[$i][5];?></td>
            </tr>
          <?php }  ?>
      </tbody>
    </table>
          </div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
</body>
</html>