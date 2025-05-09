<?php
include 'c:\xampp\htdocs\rabbit_farm\includes\config.php';
$mysqli =  mysqli_connect($server,$user,$pass,$db_name);
if (!$mysqli) {
    echo "Connection error". mysqli_connect_error();
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
<ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link" href="http://localhost/rabbit_farm/index.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="http://localhost/rabbit_farm/pages/breeding/records.php">Breeding Records</a>
  </li>
</ul>
</div>

<div class="container-fluid">
    <div class="breeding-form">
        <form action="add.php" method="post">
        <label for="doe_ear_tag">Select Doe Ear Tag: </label><br><br>
<select name="doe_ear_tag" id="doe_ear_tag" required>
    <option value="">-- Select a Doe --</option>
    <?php 
    $sql = "SELECT DISTINCT ear_tag FROM rabbits WHERE gender = 'female' ORDER BY ear_tag";
    $doe_results = mysqli_query($mysqli, $sql);
    
    if ($doe_results && mysqli_num_rows($doe_results) > 0) {
        while ($row = mysqli_fetch_assoc($doe_results)) {
            echo '<option value="' . htmlspecialchars($row['ear_tag']) . '">' 
                . htmlspecialchars($row['ear_tag']) . '</option>';
        }
    } else {
        echo '<option value="" disabled>No female rabbits found</option>';
    }
    ?>
</select><br><br>
<label for="buck_ear_tag">Select Buck Ear Tag: </label><br><br>
<select name="buck_ear_tag" id="buck_ear_tag" required>
    <option value="">-- Select a Buck --</option>
    <?php 
    $sql = "SELECT DISTINCT ear_tag FROM rabbits WHERE gender = 'male' ORDER BY ear_tag";
    $buck_results = mysqli_query($mysqli, $sql);
    
    if ($buck_results && mysqli_num_rows($buck_results) > 0) {
        while ($row = mysqli_fetch_assoc($buck_results)) {
            $ear_tag = htmlspecialchars($row['ear_tag'], ENT_QUOTES, 'UTF-8');
            echo "<option value=\"$ear_tag\">$ear_tag</option>";
        }
    } else {
        echo '<option value="" disabled>No male rabbits available</option>';
    }
    
    // Free the result set
    mysqli_free_result($buck_results);
    ?>
</select><br><br>
            <label for="Breeding Date">Breeding Date: </label><br><br>
            <input type="date" name="breeding_date" id="breeding_date"><br><br>
            <input type="number" name="litter_size" id="litter_size" placeholder="Litter Size"><br><br>
            <label for="Notes">Notes: </label><br><br>
            <textarea name="notes" id="notes" rows="5" cols="20"> </textarea><br><br>
            <input type="submit" name="submit" id="submit" value="BREED"><br><br>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
</body>
</html>

<?php
if(isset($_POST['submit'])) {
    $doe_ear_tag = htmlspecialchars($_POST['doe_ear_tag']);
    $buck_ear_tag = htmlspecialchars($_POST['buck_ear_tag']);
    $breeding_date = htmlspecialchars($_POST['breeding_date']);
    $litter_size = htmlspecialchars($_POST['litter_size']);
    $notes = htmlspecialchars($_POST['notes']);
    $sql = "insert into breeding_records(buck_ear_tag,doe_ear_tag,breeding_date,litter_size,notes) values('$buck_ear_tag','$doe_ear_tag','$breeding_date','$litter_size','$notes')";
    $query = mysqli_query( $mysqli, $sql);
    if($query == true){
        printf("Record Added Succesfully...");
    }else{
        $url = "http://localhost/rabbit_farm/pages/breeding/dashboard.php";
        header("Location" . $url);  
    }
}
}
?>