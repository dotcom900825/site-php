<?php
require_once (dirname(__file__) . "/../../../lib/class/Database.php");

$email = $_POST['email'];
$password = $_POST['password'];

if(DataInterface::login($email, $password)){
    echo "success!";
}else{
    echo "failed!";
};