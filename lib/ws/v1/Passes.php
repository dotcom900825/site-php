<?php

require_once (dirname(__file__) . "/../../../../lib/class/DataInterface.php");
require_once ("Log.php");
require_once (dirname(__file__) . "/../../../../lib/class/DebugLog.php");

class Passes
{

    //takes in the request URL parameters and creates a response
    function __construct($params)
    {
        /** $Params:
         * [0] => <?EMPTY?> //explode will left the first param to empty
         * [1] => <Version>
         * [2] => <EndPoint>
         * [3] => <PassTypeID>
         * [4] => <Database.passes.ID>
         */
		DebugLog::WriteLogWithFormat("Passes::__construct(params:$params)");
        //detect the HTTP method - can be get, post or delete
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        //switch between the list of valid requests or return 401
        switch ($method) {
            case "get":
                $this->getPass($params);
                break;

            case "delete":
                $this->deletePass($params);
                break;

            default: //not a valid web service call
                httpResponseCode(401);
                exit();
                break;
        }
    }

    private function deletePass($params){
        DebugLog::WriteLogWithFormat("!!!!!!!! should not reach this point!");
        DebugLog::WriteLogWithFormat(print_r($params,true));
        httpResponseCode(401);
        return;
    }

    //download the pass with given authentication token and serial number
    private function getPass($params)
    {
	DebugLog::WriteLogWithFormat("Passes::getPass(params:$params)");
        //******************** Debug Block **************************
        Log::WriteLog("In Passes getPass !!!!!!");
        Log::WriteLog(print_r($params, true));
        //***********************************************************

        $serialNr = $params[4];
        $headers = getallheaders();
        $authenticationToken = str_replace("ApplePass ", "", $headers['Authorization']);
        $ifModifiedSince = $headers['If-Modified-Since'];

        $row = DataInterface::getPassByPassIdWithAuth($serialNr, $authenticationToken);
        //******************** Debug Block **************************
        Log::WriteLog("The pass ID:" . strval($row['ID']));
        //***********************************************************

        //check if a matching pass was found
        if (!$row) {
            //no pass was found
            httpResponseCode(401);
            exit();
        }

        //******************** Debug Block **************************
        Log::WriteLog("Before comparing lastUpdated!");
        Log::WriteLog("lastUpdated:" . print_r($row, true));
        //***********************************************************

        /*check if the pass was modified on the server to save user bandwidth
        $ifModifiedSince - the timestamp of the last update to the pass that the device
        already has installed
        lastUpdated      - the lastUpdated timestamp of the pass in the database*/
        if ($ifModifiedSince != null && $ifModifiedSince >= $row['LastUpdated']) {
            //******************** Debug Block **************************
            Log::WriteLog("lastUpdated:" . strval($row['LastUpdated']));
            //***********************************************************

            //the pass was not modified
            httpResponseCode(304);
            exit();
        }

        //provide the last modified time to the user
        header("Last-modified: " . $row['LastUpdated'], true);

        //create a new pass instance with the latest data
        require_once (dirname(__file__) . "/../../../../lib/class/StorePass.php");
		require_once (dirname(__file__) . "/../../../../lib/class/GenericPass.php");
		require_once (dirname(__file__) . "/../../../../lib/class/EventPass.php");

        //******************** Debug Block **************************
        Log::WriteLog("StorePass.php loaded!");
        //***********************************************************

        //############ Create the StorePass object ##################

        // passTypeID registered on Apple Developer Portal
        $passTypeID = $params[3];

        $cardID = DataInterface::getCardIdByPassId($params[4]);

        // password for the key file
        $keyPassword = DataInterface::getKeyPasswordByOrgId($passTypeID);

        // absolute path to pass files
        $keyPath = dirname(__file__) . DataInterface::getPathByOrgIdAndCardId($passTypeID,
            $cardID);
        //TODO: start attacking the bug here
        // absolute path to pass source files
        $sourcePath = $keyPath . "/source";
        //###########################################################
		Log::WriteLog("keyPath:$keyPath \n sourcePath:$sourcePath \n keyPassword:$keyPassword \n passTypeID:$passTypeID \n cardID:$cardID");
		if($cardID == 4){
			Log::WriteLog("cardID:4");
			$pass = new GenericPass(4, "pass.com.ipassstore.dailyFreeAppGame", ".com", "iPassStore", "admin@iPassStore.com");
			$pass = $pass->createPassWithExistingSerialNr($error);
		}
        else if($cardID == 6){
            Log::WriteLog("cardID:6");
            $pass = new EventPass(6, "pass.com.ipassstore.ucsduta", "UTA", "UCSD UTA", "tmp@gmail.com");
            $pass = $pass->createPassWithExistingSerialNr($error);
        }
		else if($cardID == 7){
			Log::WriteLog("cardID:7");
			$pass = new EventPass(7, "pass.com.ipassstore.tucssa", "TU_CSSA", "tucssa",	"admin@ipassstore.com");
			$pass = $pass->createPassWithExistingSerialNr($error);
		}
		else if($cardID == 8){
			Log::WriteLog("cardID:8");
			$pass = new EventPass(8, "pass.com.ipassstore.ucsdcssa", "UCSD_CSSA", "UCSD_CSSA", "qdxaaa@gmail.com");
			$pass = $pass->createPassWithExistingSerialNr($error);
		}
		else if($cardID == 9){
			Log::WriteLog("cardID:9");
			$pass = new EventPass(9, "pass.com.ipassstore.georgeAtTheCove", "GeorgeCove", "GeorgeAtTheCove", "GeorgeAtTheCove@ipassstore.com");
			$pass = $pass->createPassWithExistingSerialNr($error);
		}
		else{
			Log::WriteLog("cardID:other");
			$pass = new StorePass($keyPath, $sourcePath, $keyPassword, $passTypeID, $cardID);
			//******************** Debug Block **************************
			Log::WriteLog("StorePass object created!");
			//***********************************************************
			$pass = $pass->passWithSerialNr($serialNr);
		}


        //******************** Debug Block **************************
        Log::WriteLog("Pass:before output pass data");
        //***********************************************************

        //output the pass contents to the client
        $pass->outputPassBundleAsWebDownload();

        //******************** Debug Block **************************
        Log::WriteLog("pass outputed!");
        //***********************************************************

        exit();
    }
}

?>
