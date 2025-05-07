<?php
include '../includes/config.php';
class login{
    public $username;
    public $password;
    public $user_role;
    protected $roles = array('admin','manager','worker');
    public function __construct($username,$password, $user_role){
        $this->username = $username;
        $this->password = $password;
        $this->user_role = $user_role;
    }
}
$new_user = new login('chemwa','At._.420','admin');

require '../includes/config.php';
$conn = mysqli_connect($server, $user,$pass,$db_name);
if(!$conn){
    echo ' connection error: ' . mysqli_connect_error();
}else{
    if(isset($_POST['submit'])){
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        if($username == $new_user->username && $password == $new_user->password){
            $url = "http://localhost/rabbit_farm/pages/dashboard.php";
            header("Location: " . $url);
}
}
}
?>