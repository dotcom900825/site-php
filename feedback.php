<?php
require_once ("/home/production/lib/class/FeedBack.php");

$path = "/home/production/public_html/Client/TU_CSSA_Membership_Card/pass";
$keyPassword = "tucssa95536";

$tokens = FeedBack::send_feedback_request($path, $keyPassword);
$lostTokenFilePath = "/home/production/log/lost_tokens.log";
foreach($tokens as $token){
    $tokenStr = print_r($token, true);
    file_put_contents($lostTokenFilePath , $tokenStr."\n" , FILE_APPEND | LOCK_EX);
    echo $tokenStr;
}