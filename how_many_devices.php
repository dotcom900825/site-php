<?php

require_once (dirname(__file__) . "/../lib/class/DataInterface.php");

$pass = $_GET['pass'];
$pool = array(168,110);
if(in_array(intval($pass),$pool)){
    $cardId = DataInterface::getCardIdByPassId($pass);
    $cardName = DataInterface::$folderByCardId[intval($cardId)];
    $numOfDevices = DataInterface::getDevicesCount($pass);
    echo "<h1>we now have ".$numOfDevices." devices using ".$cardName."!!!</h1>";
}else{
    echo "<h3>invalid param!</h3>";
}