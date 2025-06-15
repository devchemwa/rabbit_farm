<?php
$db_name = "rabbit_farm";
$server = "localhost";
$user = "chemwa";
$pass = "At._.420";
$conn = mysqli_connect($server, $user, $pass, $db_name);
if(!$conn){
    echo "connection error: " . mysqli_connect_error();
}else{

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
<div class="container-fluid">
<ul class="nav justify-content-center">
  <li class="nav-item">
  <a class="nav-link" href="http://localhost/rabbit_farm/pages/dashboard.php">Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="http://localhost/rabbit_farm/pages/finance/transactions.php">Transactions</a>
  </li>
</ul>
</div>
</div>


<div class="container-fluid">
   <div class="new-expense-form">
    <form action="add.php" method="post">
        <label for="transaction_type"> Transaction Type: </label><br><br>
        <select name="transaction_type" id="transaction_type">
            <option value="" disabled>--Transaction Type--</option>
            <?php
            $choices = array('income','expense');
            for ($i = 0; $i < count($choices); $i++){
             ?>
            <option value="<?=$choices[$i];?>"><?=$choices[$i];?></option>
            <?php } ?>
        </select><br><br>
        <select name="category" id="category">
            <option disabled>--Choose Category--</option>
            <?php 
            $categories = array("Feeds","Medicine","Equipment","Fresh Meat","Baked Meat");
            for($i=0;$i<count($categories);$i++){
            ?>
            <option value="<?=$categories[$i];?>"><?=$categories[$i];?></option>
            <?php } ?>
        </select><br><br>
        <input type="number" name="amount" id="amount" placeholder="Amount" required><br><br>
        <label for="description">Description: </label><br><br>
        <textarea name="description" id="description" cols="30" rows="5"></textarea><br><br>
        <?php
        $ear_tags = mysqli_query($conn, "select ear_tag,gender from rabbits");
        $results = mysqli_fetch_all($ear_tags, MYSQLI_ASSOC);
        ?>
        <label for="ear_tag">Ear Tag: </label><br><br>
        <select name="ear_tag" id="ear_tag">
            <option value="">--Ear Tag--</option>
         <?php for ($i=0; $i < count($results); $i++) { ?>
            <option value="<?=$results[$i]['ear_tag']?>"><?=$results[$i]['ear_tag'] . " " . $results[$i]['gender'];?></option>
            <?php } ?>
        </select><br><br>
        <input type="submit" name="submit" id="submit"><br><br>
        <?php
        if(isset($_POST['submit'])){
            $type = htmlspecialchars($_POST['transaction_type']);
            $category = htmlspecialchars($_POST['category']);
            $amount = htmlspecialchars($_POST['amount']);
            $description = htmlspecialchars($_POST['description']);
            $ear_tag = htmlspecialchars($_POST['ear_tag']);
            $sql = "insert into financial_transactions(type,category,amount,description,ear_tag) values('$type','$category','$amount','$description','$ear_tag')";
            $save = mysqli_query($conn, $sql);
            if($save == true){
                echo "Record Added Succesfully...";
            }
        } } 
        ?>
    </form>
   </div>
</div>    


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
</body>
</html>