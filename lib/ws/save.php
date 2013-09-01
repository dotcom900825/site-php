<?php

session_start();
require_once (dirname(__file__) . "/../../../lib/class/DebugLog.php");
require_once (dirname(__file__) . "/../../../lib/class/DataInterface.php");
require_once (dirname(__file__) . "/../../../lib/class/JsonInterface.php");
require_once (dirname(__file__) . "/../../../lib/class/Utils.php");
DebugLog::WriteLogWithFormat(dirname(__file__) . "/push.php");

if (!isset($_SESSION['status']) || $_SESSION['status'] != "In") {
    header("Location: secret_new.php");
}
$cardId = $_POST['cardId'];
$cardType = $_POST['cardType'];
$username = $_SESSION['username'];
$frontContent = array();
$backContent = array();
try {
    foreach ($_POST as $key => $value) {
        if (Utils::startsWith($key, "json")) {
            $frontContent[$key] = $value;
        } else if (Utils::startsWith($key, "backjson")) {
            $splitName = explode("_", $key);
            $num = $splitName[3];
            $field = $splitName[4];
            if (isset($backContent[$num])) {
                $backContent[$num][$field] = $value;
            } else {
                $backContent[$num] = array($field => $value);
            }
        }
    }
    $intCardId = intval($cardId);
    $jsonObject = new JsonInterface($cardId);

    $jsonContent = $jsonObject->getJsonContent();

    foreach ($frontContent as $key => $value) {
        if ($key == "json_foregroundColor" || $key == "json_backgroundColor") {
            $nameExplode = explode('_', $key);
            $fieldName = $nameExplode[1];
            $rgbColorArray = Utils::html2Rgb($value);
            $jsonContent[$fieldName] = Utils::convertIntRgbIntoString($rgbColorArray);
        } else {
            $path = explode('_', $key);
            $path = array_slice($path, 1);
            $path = implode('_', $path);
            Utils::arrayAccessSetter($jsonContent, $path, $value);
        }
    }
    ksort($backContent);
    $counter = 0;
    $jsonContent[$cardType]["backFields"] = array();
    foreach ($backContent as $key => $value) {
        $insertValue = $value;
        $insertValue["key"] = $counter;
        $jsonContent[$cardType]["backFields"][] = $insertValue;
        $counter++;
    }

    $jsonObject->setJsonContent($jsonContent);
    $jsonObject->saveJsonToFile();
    echo "success!";
} catch (Exception $e) {
    DebugLog::WriteLogWithFormat("Exception:" . $e->getTraceAsString());
    echo "Sorry, save failed, please contact the administrator!";
}