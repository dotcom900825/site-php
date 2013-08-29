<?php

//helper function to provide the correct HTTP error codes to the client

function httpResponseCode($code) {
	switch ($code) {
		case 200: $message = "OK"; break;
		case 201: $message = 'Created'; break;
		case 204: $message = 'No Content'; break;
		case 304: $message = 'Not Modified'; break;
		case 401: $message = 'Unauthorized'; break;
		case 404: $message = 'Not Found'; break;
		case 500: $message = 'Internal Server Error'; break;
	}
	
	$httpProtocol = (isset($_SERVER['SERVER_PROTOCOL']))?$_SERVER['SERVER_PROTOCOL']:"HTTP/1.0";
	
	header("$httpProtocol $code $message", true);
}

//if your PHP does not support the function
//to read the HTTP request headers
//you provide a custom function which mimics it
if (!function_exists('getallheaders')) {
    function getallheaders() {
    	return array('Authorization'=>$_SERVER['HTTP_AUTHORIZATION']);
    }
}


?>
