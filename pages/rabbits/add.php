<?php
include 'c://xampp/htdocs/rabbit_farm/includes/config.php';
include 'c://xampp/htdocs/rabbit_farm/includes/db.php'
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
    <a class="nav-link" href="http://localhost/rabbit_farm/pages/rabbits/list.php">List Rabbits</a>
  </li>
  <li class="nav-item">
    <a class="nav-link"  href="http://localhost/rabbit_farm/pages/rabbits/view.php">View Rabbits</a>
  </li>
</ul>
</div>   
<div class="container-fluid">
<div class="new-rabbit-form">
    <form action="add.php" method="post">
        <input type="text" name="rabbit_name" id="rabbit_name" placeholder="Rabbit Name" required><br><br>
        <input type="text" name="ear_tag" id="ear_tag" placeholder="Ear Tag" required><br><br>
        <select name="doe_ear_tag" id="doe_ear_tag">
            <option disabled>--Select Doe Ear Tag--</option>
            <?php 
            $sql = "select distinct doe_ear_tag from breeding_records";
            $query = mysqli_query($conn, $sql);
            $doeEarTags = mysqli_fetch_all($query, MYSQLI_ASSOC);
            for($i=0;$i<count($doeEarTags); $i++){ ?>
            <option value="<?= $doeEarTags[$i]['doe_ear_tag']; ?>"><?= $doeEarTags[$i]['doe_ear_tag']; ?></option>
            <?php } ?>       
        </select><br><br>
        <select name="buck_ear_tag" id="buck_ear_tag">
            <option  disabled>--Select Buck Ear Tag--</option>
            <?php 
            $sql = "select distinct buck_ear_tag from breeding_records";
            $query = mysqli_query($conn, $sql);
            $doeEarTags = mysqli_fetch_all($query, MYSQLI_ASSOC);
            for($i=0;$i<count($doeEarTags); $i++){ ?>
            <option value="<?= $doeEarTags[$i]['buck_ear_tag']; ?>"><?= $doeEarTags[$i]['buck_ear_tag']; ?></option>
            <?php } ?>       
        </select><br><br>
        <label for="gender">Gender: </label><br><br>
        <select name="gender" id="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>
        <select name="breed" id="breed">
            <option disabled>--Select Breed--</option>
            <?php
            $breeds = array("New Zealand White", "California White", "Chinchilla", "Flemish Giant", "Angora");
            for($i=0;$i<count($breeds);$i++){
            ?>
            <option value="<?=$breeds[$i];?>"><?=$breeds[$i];?></option>
            <?php } ?>
        </select><br><br>
        <label for="dob">Date Of Birth: </label><br><br>
        <input type="date" name="date_of_birth" id="date_of_birth"  required><br><br>
        <label for="status">Status: </label><br><br>
        <select name="status" id="status" required>
        <option value="active">Active</option>
        <option value="sold">Sold</option>
        <option value="deceased">Deceased</option>
        <option value="retired">Retired</option>
        </select><br><br>
        <input type="submit" value="Add Rabbit" name="add_rabbit" id="add_rabbit">
    </form>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
</body>
</html>

<?php
if(isset($_POST["add_rabbit"])){
    $name = htmlspecialchars($_POST["rabbit_name"]);
    $ear_tag = htmlspecialchars($_POST["ear_tag"]);
    $doe_ear_tag = $_POST['doe_ear_tag'];
    $buck_ear_tag = $_POST['buck_ear_tag'];
    $gender = htmlspecialchars($_POST["gender"]);
    $breed = $_POST['breed'];
    $date_of_birth = htmlspecialchars($_POST["date_of_birth"]);
    $status = htmlspecialchars($_POST["status"]);
    $sql = "insert into rabbits(name,ear_tag,doe_ear_tag,buck_ear_tag,gender,breed,date_of_birth,status) values('$name','$ear_tag','$doe_ear_tag','$buck_ear_tag','$gender','$breed','$date_of_birth','$status')";
    $query = mysqli_query($conn, $sql);
    if(!$query){
        echo "failed to add new rabbit: " . $query;
}else{
    $url = "http://localhost/rabbit_farm/pages/rabbits/list.php";
    header("Location: " . $url);
}
}
?>