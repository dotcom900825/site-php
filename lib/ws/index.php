<?php
require_once("lib.php");
require_once("v1/Log.php");
require_once("v1/Devices.php");
require_once("v1/Passes.php");
require_once (dirname(__file__) . "/../../../lib/class/DebugLog.php");
DebugLog::WriteLogWithFormat(dirname(__file__)."/index.php");

//get the request parameters out of the request URL
$requestURL = (($_SERVER['REDIRECT_URL']!="")?
    $_SERVER['REDIRECT_URL']:$_SERVER['REQUEST_URI']);

$scriptPath = dirname($_SERVER['PHP_SELF']);

//strip $scriptPath out of $requestURL 
$requestURL = str_replace($scriptPath, "",$requestURL );

//split the requested URL into parts and store them in an array
$requestParts = explode("/",$requestURL);

//******************** Debug Block **************************
DebugLog::WriteLogWithFormat("file__index.php::requestURL:$requestURL");
//***********************************************************

//check for valid API version
$validAPIVersions = array("v1");
$apiVersion = $requestParts[1];
if (!in_array($apiVersion, $validAPIVersions)){
    httpResponseCode(404);
    exit();
}

//check for valid API endpoint
$validEndPoints = array("devices","passes","log");
$endPoint = $requestParts[2];
if (!in_array($endPoint, $validEndPoints)){
    httpResponseCode(404);
    exit();
}

//get the endpoint class name
$endPoint = ucfirst(strtolower($endPoint)); 
$classFilePath = "$apiVersion/$endPoint.php"; // ex: v1/Devices.php

//******************** Debug Block **************************
//Log::WriteLog("vvvvvvvvvvvvvvvvvvvvvvvvvvvvvv");
//Log::WriteLog(print_r($classFilePath,true));
//***********************************************************

if (!file_exists($classFilePath)) {
    httpResponseCode(404);
    exit();
}

//******************** Debug Block **************************
//Log::WriteLog("We passed the file exist examation!");
//load the endpoint class and make an instance
//***********************************************************

try{
    //******************** Debug Block **************************
    //Log::WriteLog("Check before requiring the class");
    //Log::WriteLog("In index.php:"."$endPoint");
    //***********************************************************

    //if you have stored the string “Devices” in the $endPoint variable, 
    //this is same as calling new Device($requestParts);
    $instance = new $endPoint($requestParts);

    //******************** Debug Block **************************
    //Log::WriteLog("Check after instanciate the class");
    //***********************************************************
}
catch (Exception $e){
    //save $e->getMessage() to a log file
    $error = $e->getMessage();

    //******************** Debug Block **************************
    Log::WriteLog($error);
    //***********************************************************

    httpResponseCode(500);
}

exit();

?>
