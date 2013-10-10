<?php
require_once (dirname(__file__) . "/../../../../lib/class/config.php");
class Log {
    //takes in the request URL parameters and creates a response
    function __construct($params) {
        $this->emailTo = configs::$errorReportEmail;
        $this->emailFrom = configs::$errorReportEmailFrom;
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        switch ($method) {
            //save a message to the log 
        case "post": 
            $this->saveLog();
            break;

        default:
            //not valid request parameters 
            httpResponseCode(401);
            exit(); 
            break;
        }
    }

    public static function WriteLog($content){
        Log::WriteLogWithFormat($content);
    }

	public static function WriteLogRaw($content){
		$dbugFile = dirname(__FILE__)."/debug";
        file_put_contents($dbugFile, "$content", FILE_APPEND | LOCK_EX);
	}

	public static function WriteLogWithFormat($content){
		$date = date('m/d/Y h:i:s a', time());
        Log::WriteLogRaw(
            "==================$date====================\r\n".
            "$content \r\n");
	}

    private function saveLog(){
        //read the POST data and decode the JSON
        $payload = json_decode(file_get_contents('php://input'), true); 

        //validate the input
        if ($payload && $payload['logs']) { 
            mail($this->emailTo,
                "Apple Pass Service Log",
                "Log message on ".date("Y-m-d H:i:s")."\n".
                print_r($payload['logs'],true), "From: ".($this->emailFrom));
        }
        $this->WriteLog(print_r($payload,true));
    }
}
