<?php

session_start();
require_once (dirname(__file__) . "/../../../lib/class/DebugLog.php");
require_once (dirname(__file__) . "/../../../lib/class/DataInterface.php");
require_once (dirname(__file__) . "/../../../lib/class/JsonInterface.php");
require_once (dirname(__file__) . "/../../../lib/class/Utils.php");
DebugLog::WriteLogWithFormat(dirname(__file__) . "/push.php");

if (!isset($_SESSION['status']) || $_SESSION['status'] != "In") {
    header("Location: test.php");
}
$cardId = $_POST['cardId'];
$username = $_SESSION['username'];
$form = array();

foreach($_POST as $key => $value){
    if(Utils::startsWith($key,"json")){
        $form[$key] = $value;
    }
}
$intCardId = intval($cardId);
$jsonObject = new JsonInterface($cardId);

$jsonContent = $jsonObject->getJsonContent();

foreach($form as $key => $value){
    $path = explode('_', $key);
    $path = array_slice($path, 1);
    $path = implode('_', $path);
    if(Utils::arrayAccessSetter($jsonContent, $path, $value)){
	echo $path.'</br>';
	echo "+saved+".'</br>';
    }
    else
	echo $path.'</br>';
	echo "+notSaved+".'</br>';
}

$jsonObject->setJsonContent($jsonContent);
$jsonObject->saveJsonToFile();
