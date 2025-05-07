<?php
//connect to db
require_once 'db.php';

class User{
    protected $username;
    protected $password;
    protected $role;
    public function __construct($username, $password, $role){
        $this->username = $username;
        $this->password = $password;  
        $this->role = $role;
    }
}
?>