<?php

require_once ("Log.php");
require_once (dirname(__file__) . "/../../../../lib/class/Database.php");
require_once (dirname(__file__) . "/../../../../lib/class/DebugLog.php");

class Devices
{

    //ctor takes in the request URL parameters and creates a response
    function __construct($params)
    {
        DebugLog::WriteLogWithFormat("Devices::__construct(params:$params)");
        //detect the HTTP method - can be get, post or delete
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $action = strtolower($params[4]);
        DebugLog::WriteLogWithFormat("- method:$method,action:$action");
        //switch between the list of valid requests or return 401
        switch ($method . ":" . $action) {
            case "post:registrations":
                $this->createRegistration($params);
                Log::WriteLog("post:registrations");
                break;

            case "post:registrations_attido":
                $this->createRegistration($params);
                Log::WriteLog("post:registrations_attido");
                break;

            case "delete:registrations":
                $this->deleteRegistration($params);
                Log::WriteLog("delete:registrations");
                break;

            case "delete:registrations_attido":
                $this->deleteRegistration($params);
                Log::WriteLog("delete:registrations_attido");
                break;

                /**
                 * $_GET is a special globally-accessible PHP dictionary, which is 
                 * automatically populated with all parameters coming through the 
                 * query string of the requested URL.
                 */
            case "get:registrations":
                //******************** Debug Block **************************
                Log::WriteLog("get:registrations");
                Log::WriteLog(print_r($params, true));
                //***********************************************************

                $whatisthis = @(int)$_GET['passesUpdatedSince'];

                //******************** Debug Block **************************
                //Log::WriteLog("What is this:$whatisthis");
                //***********************************************************

                $this->getDeviceUpdates($params, @(int)$_GET['passesUpdatedSince']);
                break;

            case "get:registrations_attido":
                //******************** Debug Block **************************
                Log::WriteLog("get:registrations_attido");
                Log::WriteLog(print_r($params, true));
                //***********************************************************
                $this->getDeviceUpdates($params, @(int)$_GET['passesUpdatedSince']);
                break;

            default: //not a valid web service call
                httpResponseCode(401);
                exit();
                break;
        }
    }

    //register device with ID for a pass instance
    private function createRegistration($params)
    {
        DebugLog::WriteLogWithFormat("Devices::createRegistration(params:" . print_r($params, true) .
            ")");

        $deviceID = $params[3];
        //$passTypeID = $params[5];
        $passID = $params[6];
        $payload = json_decode(file_get_contents('php://input'), true);
        $pushToken = $payload['pushToken'];
        $headers = getallheaders();
        $authToken = str_replace("ApplePass ", "", $headers['Authorization']);

        $db = Database::get();
        DebugLog::WriteLogRaw("Point 1:before select pass\n");
		DebugLog::WriteLogRaw("Got device id:$deviceID\n Got pushToken:$pushToken");
        //check authorization token
        $statement = $db->prepare("SELECT COUNT(*) FROM passes WHERE ID=? AND AuthToken=?");
        $statement->execute(array($passID, $authToken));
        $debugNum = $statement->rowCount();
        DebugLog::WriteLogRaw("Find rowCount:$debugNum\n");
        if ($statement->rowCount() == 0) {
            //no such pass found in the database
            httpResponseCode(401);
            exit();
        }

        $statement = $db->prepare("SELECT * FROM devices WHERE ID = ?");
        $statement->execute(array($deviceID));
        $debugNum = $statement->rowCount();
        DebugLog::WriteLogRaw("Point 2: found $debugNum devices\n");
        if ($statement->rowCount() == 0) {
            //No device registered for this org, so both table need insertion
            $db->beginTransaction();

            $stmtInsert = $db->prepare("INSERT INTO devices (ID, PushToken) values (?, ?)");
            $stmtInsert->execute(array($deviceID, $pushToken));
            $debugNum = $stmtInsert->affected_rows;
            DebugLog::WriteLogRaw("First insert affected rows: $debugNum\n");

            $stmtInsert = $db->prepare("INSERT INTO DeviceVSPass (Device,Pass) values(?,?)");
            $stmtInsert->execute(array($deviceID, $passID));
            $debugNum = $stmtInsert->affected_rows;
            DebugLog::WriteLogRaw("Second insert affected rows: $debugNum\n");

            $db->commit();
            DebugLog::WriteLogRaw("after insertion\n");
        } else
            if ($statement->rowCount() == 1) {
                //check for existing registration
                $statement = $db->prepare(" SELECT * FROM devices,DeviceVSPass 
                                            WHERE devices.ID=? AND devices.ID = DeviceVSPass.Device
                                            AND DeviceVSPass.Pass = ?");
                $statement->execute(array($deviceID, $passID));
                $debugNum = $statement->rowCount();
                DebugLog::WriteLogRaw("Point 3: found existing $debugNum registrations\n");
                if ($statement->rowCount() == 0) {
                    //insert the registration in the database
                    $stmtInsert = $db->prepare("INSERT INTO DeviceVSPass (Device, Pass) values (?, ?)");
                    $stmtInsert->execute(array($deviceID, $passID));
                    httpResponseCode(201);
                } else
                    if ($statement->rowCount() > 0) {
                        //update the pushToken of the existing registration
                        $stmtUpdate = $db->prepare("UPDATE devices SET PushToken=? WHERE ID=? ");
                        $stmtUpdate->execute(array($pushToken, $deviceID));
                        httpResponseCode(200);
                    } else {
                        DebugLog::WriteLogWithFormat("!!!FATAL ERROR!!! in Devices::createRegistration() 1");
                    }
            } else {
                DebugLog::WriteLogWithFormat("!!!FATAL ERROR!!! in Devices::createRegistration() 2");
            }
            exit();
    }

    //delete device with ID
    private function deleteRegistration($params)
    {
        DebugLog::WriteLogWithFormat("Devices:deleteRegistration(params:$params)");
        DebugLog::WriteLogWithFormat("- Delete params:" . print_r($params, true));
        $deviceID = $params[3];
        $passID = $params[6];
        $headers = getallheaders();
        $authToken = str_replace("ApplePass ", "", $headers['Authorization']);

        $db = Database::get();

        //check authorization token
        $statement = $db->prepare("SELECT * 
                                    FROM devices, DeviceVSPass, passes
                                    WHERE   devices.ID = DeviceVSPass.Device 
                                            AND DeviceVSPass.Pass = passes.ID
                                            AND devices.ID=? AND AuthToken=?");
        $statement->execute(array($deviceID, $authToken));
        $debugNum = $statement->rowCount();
        DebugLog::WriteLogRaw("AuthoToken: $authToken");
        DebugLog::WriteLogRaw("found devices: $debugNum\n");
        if ($statement->rowCount() == 0) {
            //no such registration found in the database
            httpResponseCode(401);
            exit();
        } else
            if ($statement->rowCount() == 1) {
                //such device exists, check if DeviceVSPass record exist
                $statement = $db->prepare("SELECT * FROM DeviceVSPass WHERE Device = ? AND Pass = ?");
                $statement->execute(array($deviceID, $passID));
                $debugNum = $statement->rowCount();
                DebugLog::WriteLogRaw("found DeviceVSPass record: $debugNum\n");
                $db->beginTransaction();
                if ($statement->rowCount() > 0) {
                    //DeviceVSPass record found, delete them
                    $statDel = $db->prepare("DELETE FROM DeviceVSPass WHERE Device = ? AND Pass = ?");
                    $statDel->execute(array($deviceID, $passID));

                    $num = $statDel->affected_rows;
                    DebugLog::WriteLogWithFormat("- Delete from DeviceVSPass $num records");
                }

                $statement = $db->prepare("SELECT * FROM DeviceVSPass WHERE Device = ?");
                $statement->execute(array($deviceID));
                if ($statement->rowCount() == 0) {
                    $statDel = $db->prepare("DELETE FROM devices WHERE ID = ?");
                    $statDel->execute(array($deviceID));
                }
                $db->commit();
            } else {
                DebugLog::WriteLogWithFormat("!!!FATAL ERROR!!! in Devices::deleteRegistration()");
            } //delete the registration from devices

            httpResponseCode(200);

        exit();
    }

    //get list of pass updates for a device ID
    private function getDeviceUpdates($params, $updateTag)
    {
        DebugLog::WriteLogWithFormat("Devices:getDeviceUpdates(
				params:$params,updateTag:$updateTag)");
        $deviceID = $params[3];
        //$passTypeID = $params[5];

        //******************** Debug Block **************************
        //Log::WriteLog("\r\nCheckPoint1: DeviceID:".$deviceID."\r\n");
        //***********************************************************

        $db = Database::get();
        //TODO: update tag is 0, so that every time the pass will be updated.
        $updateTagtmp = 0;
        /*grab the updated serial numbers*/
        //The SELECT filters out any rows from the passes table that have a value in their
        //lastUpdated column less than the last update tag that PassKit received from your
        //server, and it returns the list of the corresponding serial numbers from the
        /*serialNr column.*/
        $statement = $db->prepare("
            SELECT passes.ID, passes.LastUpdated
            FROM passes , DeviceVSPass , devices
            WHERE   passes.lastUpdated > ? 
                    AND devices.ID = DeviceVSPass.Device 
                    AND DeviceVSPass.Pass = passes.ID
                    AND devices.ID = ?");
        $statement->execute(array($updateTagtmp, $deviceID));
        $debugNum = $statement->rowCount();
        DebugLog::WriteLogWithFormat("deviceID:$deviceID,rowCount:$debugNum");
        // If there were no updated passes found in the database
        if ($statement->rowCount() == 0) {

            //******************** Debug Block **************************
            DebugLog::WriteLogWithFormat("\r\nCheckPoint2: DeviceID:".$deviceID."\r\n");
            //***********************************************************

            $statement = $db->prepare("SELECT COUNT(*) FROM devices WHERE ID = ?");
            $statement->execute(array($deviceID));

            // If the device ID is not registered at all
            if ($statement->rowCount() == 0) {
                httpResponseCode(404); // 404 Not found
            } else //no pass updates for that particular device
            {
                httpResponseCode(204); // 204 No content
            }
            exit();
        }

        $serialList = array();
        $newUpdateTag = 0;

        //Loop and get the the update tag of the latest updated pass
        //also add all serials into an array
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

            //******************** Debug Block **************************
            //Log::WriteLog(print_r($row));
            //***********************************************************

            $serialList[] = $row['ID'];
            if ($row['LastUpdated'] > $newUpdateTag) {
                $newUpdateTag = $row['LastUpdated']; //4
            }
        }

        //******************** Debug Block **************************
        //Log::WriteLog("\r\nCheckPoint3: DeviceID:".$deviceID."\r\n");
        //Log::WriteLog(strval(count($serialList)));
        //***********************************************************

        // There are updates, prepare the response
        $response = array();
        $response['serialNumbers'] = $serialList;
        $response['lastUpdated'] = $newUpdateTag;
        $json_response = json_encode($response);
        
        //******************** Debug Block **************************
        DebugLog::WriteLogRaw("##########################");
        DebugLog::WriteLogWithFormat(print_r($json_response, true));
        //***********************************************************
       
        //return JSON encoded response
        header('Content-Type: application/json');
        print ($json_response);
        exit();
    }
}

?>
