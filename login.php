<?php

session_start();
$username = $_POST['username'];
$password = $_POST['password'];
require_once (dirname(__file__) . "/../lib/class/DataInterface.php");
if (isset($_POST['action']) && isset($_POST['username']) && isset($_POST['password']) &&
    $_POST['action'] == "Login" && DataInterface::login($username, $password)) {
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "In";
    if (isset($_REQUEST['test']))
        header("location: push_panel_new.php");
    else
        header("location: push_panel.php");
} else
    if (isset($_POST['action']) && $_POST['action'] == "Logout") {
        $_SESSION = array();
        session_destroy();
        echo "Logout success!\n";
    } else
        if (isset($_POST['action']) && $_POST['action'] == "Login") {
            echo "Login failed! in login.php\n";
        } else {
            echo "Unexpected error\n";
        }

?>