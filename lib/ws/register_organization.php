<?php
//TODO: add user schema to db
require_once("./../../../lib/phpass-0.3/PasswordHash.php");
require_once("./../../../lib/class/config.php");

//TODO: need actual code to get user name and password
$username = "qdxkkk";
$password = "qidexin69";

$user_input = "mypassword";

echo hash("sha512", $user_input);


/*
$hasher = new PasswordHash(configs::$hasher['$hash_cost_log2'], configs::$hasher['hash_portable']);

$hash = $hasher->HashPassword($password);
$len = strlen($hash);
echo "</br>$len</br>";
if (strlen($hash) < 20)
    echo 'Failed to hash new password';
else
    echo "$hash";

echo "\n testing";
try{
if($hasher->CheckPassword($password,$hash)){
    echo "passed";
}
else{
    echo "not passed";
}
}catch(Exception $e){
    echo $e->getTraceAsString();
}