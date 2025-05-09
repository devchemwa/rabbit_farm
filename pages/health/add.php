<?php
//connection details
$db_name = "rabbit_farm";
$server = "localhost";
$user = "chemwa";
$pass = "At._.420";
$conn = mysqli_connect($server, $user, $pass, $db_name);
if(!$conn){
    echo "Connection error: " . mysqli_connect_error();
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
<div class="container">
<ul class="nav justify-content-center">
  <li class="nav-item">
  <a class="nav-link" href="http://localhost/rabbit_farm/pages/dashboard.php">Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="http://localhost/rabbit_farm/pages/health/records.php">Health Records</a>
  </li>
  <li class="nav-item">
    <a class="nav-link"  href="http://localhost/rabbit_farm/pages/rabbits/view.php">View Rabbits</a>
  </li>
</ul>
</div> 

<div class="container-fluid">
<div class="add-health-record-form">
    <form action="add.php" method="post">
         <label for="Health_Status">Health Status: </label><br><br>
         <select name="Health_Status" id="Health_Status">
            <option value="" disabled>--Health Conditions--</option>
            <?php $choices = array("excellent","good","fair","poor","critical"); 
            for ($i=0; $i < count($choices); $i++) {
            ?>
            <option value="<?=$choices[$i];?>"><?=$choices[$i];?></option>
            <?php }} ?>
         </select><br><br>
         <input type="number" name="weight" id="weight" placeholder="Weight"><br><br>
         <label for="Notes">Notes: </label><br><br>
         <textarea name="notes" id="notes" cols="30" rows="5"></textarea><br><br>
         <label for="treatment">Treatment: </label><br><br>
         <textarea name="treatment" id="treatment" cols="30" rows="5"></textarea><br><br>
         <input type="submit" name="submit" id="submit"><br><br>
    </form>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>    
</body>
</html>
<?php
if(isset($_POST["submit"])){
    $health_status = htmlspecialchars($_POST["Health_Status"]);
    $weight = htmlspecialchars($_POST["weight"]);
    $notes = htmlspecialchars($_POST["notes"]);
    $treatment = htmlspecialchars($_POST["treatment"]);
$sql = "insert into health_records (health_status,weight,notes,treatment) values('$health_status','$weight','$notes','$treatment')";
$save = mysqli_query($conn,$sql);
if($save == false){
    echo " Failed to add record ";
}else{
    echo "Record Added Succesfully";
}
}
?>
