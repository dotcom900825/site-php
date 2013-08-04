<?php

require_once ("Database.php");
require_once ("DebugLog.php");

class DataInterface
{
    static $pathByOrgIdDict = array();

    static $pathByOrgIdAndCardIdDict = array(
        "pass.com.ipassstore.ucsdcssa:1" =>
            "/../../../Client/UCSD_CSSA_Membership_Card/pass",
        "pass.com.ipassstore.ucsdcssa:2" => "/../../../Client/TEST_NEW_SAMPLE/pass",
        "pass.com.ipassstore.ucsdcssa:3" => "/../../../Client/TEST_NEW_SAMPLE_TWO/pass");

    static $cardKeyPasswordDict = array("pass.com.ipassstore.ucsdcssa" =>
            "ucsdcssa95536");

    /*
    * function name: getPathByOrgIdAndCardId($orgID, $cardID)
    * purpose:       get the file path of a certain card
    * parameter:     $orgID the pass.type.id, $cardId ID in Card
    * return:        String containing the path of the card
    */
    public static function getPathByOrgIdAndCardId($orgId, $cardId)
    {
        if (empty($orgId)) {
            return null;
        }
        if (empty($cardId)) {
            return DataInterface::$pathByOrgIdDict[$orgId];
        } else {
            return DataInterface::$pathByOrgIdAndCardIdDict[$orgId . ":" . "$cardId"];
        }
    }

    /*
    * function name: ifRegistered($userEmail, $cardId)
    * purpose:       check whether an email is already registered
    * parameter:     $userEmail, $cardId
    * return:        ture if registered, false if not
    */
    public static function ifRegistered($userEmail, $cardId)
    {
        DebugLog::WriteLogWithFormat("Into ifRegistered!");
        // get database connection
        $db = Database::get();

        // catch redundant data
        $statement = $db->prepare("SELECT * FROM passes WHERE UserEmail = ? AND Card = ?");

        $statement->execute(array($userEmail, $cardId));

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            DebugLog::WriteLogRaw("In if row");
            DebugLog::WriteLogWithFormat(print_r($row, true));
            return true;
        } else {
            DebugLog::WriteLogRaw("In else");
            return false;
        }
    }

    /*
    * function name: getCardIdByPassId($passId)
    * purpose:       Look up card id by pass id
    * parameter:     $passId
    * return:        int, card id
    */
    public static function getCardIdByPassId($passId)
    {
        DebugLog::WriteLogWithFormat("LOG:In DataInterface::static passId\r\n" . "$passId");
        $db = Database::get();
        try {
            $statement = $db->prepare("
                SELECT Card 
                FROM passes
                WHERE ID = ?");
            $statement->execute(array($passId));
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                return null;
            }
        }
        catch (PDOException $e) {
            $error = $e->getMessage();
            DebugLog::WriteLogWithFormat("LOG:ERROR In DataInterface::static getCardIdByPassId\r\n" .
                print_r($error, true));
            return null;
        }
        return $row['Card'];
    }

    /*
    * function name: getKeyPasswordByOrgId($orgId)
    * purpose:       Look up key password of each org
    * parameter:     $orgId
    * return:        string, the password
    */
    public static function getKeyPasswordByOrgId($orgId)
    {
        return DataInterface::$cardKeyPasswordDict[$orgId];
    }

    /*
    * function name: getPassByPassIdWithAuth($passId, $authToken)
    * purpose:       Verify if the auth token match with database
    *                and return the record matched with pass id
    * parameter:     $passId, $authToken
    * return:        array("ID"=><data>,"LastUpdated=><data>") null if failed
    * optimization:  can be optimized by avoid calling getPassByPassId
    */
    public static function getPassByPassIdWithAuth($passId, $authToken)
    {
        DebugLog::WriteLogWithFormat("Into getPassByePassIdWithAuth");
        $row = DataInterface::getPassByPassId($passId);
        DebugLog::WriteLogWithFormat(print_r($row, true));
        //verification
        if ($row['AuthToken'] == $authToken) {
            return array("ID" => $row['ID'], "LastUpdated" => $row['LastUpdated']);
        } else {
            return null;
        }
    }

    /*
    * function name: getPassByPassId($passId)
    * purpose:       Look up pass record match with pass id
    * parameter:     $passId
    * return:        array() with all the rows of the record, null if failed
    */
    public static function getPassByPassId($passId)
    {
        DebugLog::WriteLogWithFormat("LOG:In DataInterface::static getPassBySerialNr\r\n" .
            "$passId");
        //load the pass data from the database
        $db = Database::get();
        $statement = $db->prepare("SELECT * FROM passes WHERE ID = ?");
        $statement->execute(array($passId));
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            //no pass with such passId found
            return null;
        }
        return $row;
    }

    /*
    * function name: insertPass($argv)
    * purpose:       insert one record into passes according to $argv
    * parameter:     $argv
    * return:        int pass id if success, null if failed
    */
    public static function insertPass($argv)
    {
        DebugLog::WriteLogWithFormat("LOG:In DataInterface::static insertPass\r\n" .
            print_r($argv, true));

        // get database connection
        $db = Database::get();

        // catch any database exceptions
        try {
            // 1 prepare
            $statement = $db->prepare("INSERT INTO passes(FirstName, LastName, UserEmail,
                AuthToken, LastUpdated, BarCode, Card)
                VALUES(?,?,?,?,?,?,?)");
            // 2 execute, values will be mapped to the ? marks
            $statement->execute($argv);

            // 3 check the rowCount to see if there was exactly one affected row
            if ($statement->rowCount() != 1) {
                throw new PDOException("Could not create a pass in the database");
            }
            $statement = $db->prepare("SELECT ID from passes where UserEmail = ? AND Card = ?");
            $statement->execute(array($argv[2], $argv[6]));
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row['ID'];
        }
        // 4 save the exception error message in $error and return null
        catch (PDOException $e) {
            $error = $e->getMessage();
            DebugLog::WriteLogWithFormat("LOG:ERROR In DataInterface::static insertPass\r\n" .
                print_r($error, true));
            return null;
        }
    }

    public static function login($username, $password)
    {
        DebugLog::WriteLogWithFormat("LOG:In DataInterface::static login\r\n");
       
        // get database connection
        $db = Database::get();

        // catch any database exceptions
        try {
            // 1 prepare
            $statement = $db->prepare("
                SELECT * FROM organizations
                WHERE UserName = ? and Password = ?");
            // 2 execute, values will be mapped to the ? marks
    
            $statement->execute(array($username, $password));
   
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            
            // 3 check the rowCount to see if there was exactly one affected row
            if ($statement->rowCount() != 1) {              
                return false;
            } else {
                return true;
            }
        }
        // 4 save the exception error message in $error and return null
        catch (PDOException $e) {
            $error = $e->getMessage();
            DebugLog::WriteLogWithFormat("LOG:ERROR In DataInterface::static login\r\n");
            return null;
        }

    }

}

?>
