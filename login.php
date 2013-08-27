<?php

session_start();
$username = $_POST['username'];
$password = $_POST['password'];
require_once (dirname(__file__) . "/../lib/class/DataInterface.php");
if (isset($_POST['action']) && isset($_POST['username']) && isset($_POST['password']) &&
    $_POST['action'] == "Login" && DataInterface::login($username, $password)
) {
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "In";
    header("location: admin_panel.php");
} else if (isset($_POST['action']) && $_POST['action'] == "Logout") {
    $_SESSION = array();
    session_destroy();
    header("Location: login_panel.php");
} else if (isset($_POST['action']) && $_POST['action'] == "Login") {
    header("Location: login_panel.php?error_message=Sorry, login failed. Please double check your account information.");
} else {
    echo "Unexpected error\n";
}

