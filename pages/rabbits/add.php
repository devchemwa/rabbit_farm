<?php
include 'c://xampp/htdocs/rabbit_farm/includes/config.php';

//rabbit class to implement adding new rabbits
class Rabbit{
    protected $name;
    protected $ear_tag;
    protected $gender;
    protected $date_of_birth;
    protected $mother_id;
    protected $father_id;
    protected $status;
   public function __construct($name, $ear_tag, $gender, $date_of_birth, $mother_id, $father_id, $status){
        $this->name = $name;
        $this->ear_tag = $ear_tag;
        $this->gender = $gender;
        $this->date_of_birth = $date_of_birth;
        $this->mother_id = $mother_id;
        $this->father_id = $father_id;
        $this->status = $status;
    }
    public function getDetails(){
        $details = array($this->name,$this->ear_tag,$this->gender,$this->date_of_birth,$this->mother_id,$this->father_id,$this->status);
        for($i = 0; $i < count($details); $i++){
            echo $details[$i] . "<br>";
        }
    }
}
$conn = mysqli_connect($server,$user,$pass,$db_name); 
if(!$conn){
    echo "Connection failed: " . mysqli_connect_error();
}else{
?>
<div class="new-rabbit-form">
    <form action="add.php" method="post">
        <input type="text" name="rabbit_name" id="rabbit_name" placeholder="Rabbit Name"><br><br>
        <input type="text" name="ear_tag" id="ear_tag" placeholder="Ear Tag"><br><br>
        <label for="gender">Choose Gender: </label><br><br>
        <select name="gender" id="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>
        <input type="date" name="date_of_birth" id="date_of_birth" placeholder="Date Of Birth"><br><br>
        <label for="status">Status: </label><br><br>
        <select name="status" id="status">
        <option value="active">Active</option>
        <option value="sold">Sold</option>
        <option value="deceased">Deceased</option>
        <option value="retired">Retired</option>
        </select><br><br>
        <input type="submit" value="Add Rabbit" name="add_rabbit" id="add_rabbit">
    </form>
</div>

<?php
if(isset($_POST["add_rabbit"])){
    $name = htmlspecialchars($_POST["rabbit_name"]);
    $ear_tag = htmlspecialchars($_POST["ear_tag"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $date_of_birth = htmlspecialchars($_POST["date_of_birth"]);
    $mother_id = htmlspecialchars($_POST["mother_id"]);
    $father_id = htmlspecialchars($_POST["father_id"]);
    $status = htmlspecialchars($_POST["status"]);
    $new_rabbit = new Rabbit($name,$ear_tag,$gender,$date_of_birth,$mother_id,$father_id,$status);
    $sql = "insert into rabbits(name,ear_tag,gender,date_of_birth,mother_id,father_id,status) values('$name','$ear_tag','$gender','$date_of_birth','$mother_id','$father_id','$status')";
    $query = mysqli_query($conn, $sql);
    if(!$query){
        echo "failed to add new rabbit: " . $query;
}else{
    $url = "http://localhost/rabbit_farm/pages/rabbits/list.php";
    header("Location: " . $url);
}
}
}
?>