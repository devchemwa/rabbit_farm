<?php
require '../includes/config.php';
require '../includes/auth.php';
class Admin{
    protected $username;
    protected $password;
    public function __construct($username,$password){
        $this->username = $username;
        $this->password = $password;
    }
}

?>