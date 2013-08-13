<?php

session_start();
require_once (dirname(__file__) . "/../../../lib/class/DebugLog.php");
require_once (dirname(__file__) . "/../../../lib/class/DataInterface.php");
require_once (dirname(__file__) . "/../../../lib/class/JsonInterface.php");
DebugLog::WriteLogWithFormat(dirname(__file__) . "/push.php");
if (!isset($_SESSION['status']) || $_SESSION['status'] != "In") {
    header("Location: ./../../secret_new.php");
}
DebugLog::WriteLogWithFormat("passed session check");
$cardId = $_POST['cardId'];
$username = $_SESSION['username'];
$form = array();
if (isset($_POST['header_field_value']) && $_POST['header_field_value'] != "") {
    $form["header"] = $_POST['header_field_value'];
    $header_file_value = $_POST['header_field_value'];
}
try{
    $intCardId = intval($cardId);
    DataInterface::pushToOneCard($username,$intCardId);
    echo "Push was successful";
}catch(Exception $e){
    DebugLog::WriteLogWithFormat("EXCEPTION:".$e->getTraceAsString());
    echo "Push failed, something went wrong, sorry!";

}