<?php
include 'c:\xampp\htdocs\rabbit_farm\includes\config.php';
$mysqli =  mysqli_connect($server,$user,$pass,$db_name);
if (!$mysqli) {
    echo "Connection error". mysqli_connect_error();
}else{ 
?>

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
            <input type="submit" name="breed_rabits" id="breed_rabbits" value="BREED"><br><br>
        </form>
    </div>
</div>

<?php
}
?>