<?php
require_once (dirname(__file__) . "/../../../lib/class/DataInterface.php");

$email = $_POST['email'];
$password = $_POST['password'];

if(DataInterface::login($email, $password)){
    echo "success";
}else{
    echo "failed";
};
