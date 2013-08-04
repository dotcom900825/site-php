<?php

session_start();
require_once (dirname(__file__) . "/../../../lib/class/DebugLog.php");
require_once (dirname(__file__) . "/../../../lib/class/DataInterface.php");
require_once (dirname(__file__) . "/../../../lib/class/JsonInterface.php");
DebugLog::WriteLogWithFormat(dirname(__file__) . "/push.php");

if (!isset($_SESSION['status']) || $_SESSION['status'] != "In") {
    header("Location: test.php");
}
$cardId = $_POST['cardId'];
$username = $_SESSION['username'];
$form = array();
if (isset($_POST['header_field_value']) && $_POST['header_field_value'] != "") {
    $form["header"] = $_POST['header_field_value'];
    $header_file_value = $_POST['header_field_value'];
}
$intCardId = intval($cardId);
if (count($form) >= 1) {
    $jsonObject = new JsonInterface();
    if ($cardId != 4) {
        $jsonObject->Push($intCardId, $header_file_value);
    }
    DataInterface::pushToOneCard($username, $cardId);
    header("Location: https://www.ipassstore.com/push_panel.php?message=Push was successful");
} else {
    if ($cardId == 4) {
        DataInterface::pushToOneCard($username, $cardId);
        header("Location: https://www.ipassstore.com/push_panel.php?message=Push was successful");
    } else {
        header("Location: https://www.ipassstore.com/push_panel.php?message=Nothing to push");
    }
}
exit();

?>