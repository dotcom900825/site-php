<?php 
require_once (dirname(__file__) . "/../../../lib/class/DebugLog.php");
require_once (dirname(__file__) . "/../../../lib/class/DataInterface.php");
require_once (dirname(__file__) . "/../../../lib/class/AmazonSES.php");
require_once (dirname(__file__) . "/../../../lib/class/StorePass.php");
DebugLog::WriteLogWithFormat(dirname(__file__)."/getpass.php");

$emailSubject = array("UCSD_UTA_Membership_Card" => "Your UCSD UTA membership card has arrived",
					"UCSD_CSSA_Membership_Card" => "Your UCSD CSSA membership card has arrived"
);
$emailContent = array("UCSD_UTA_Membership_Card" => "Thank you for participating! 
Now you can get real time information update and all the benefits of members!
Congratulations again, now you are a true UTA fan and loyal member, 
enjoy your digital membership card! ;)\n\n
Best Regards
iPassStore.com",
"UCSD_CSSA_Membership_Card" => "Thank you for participating! 
Now you can use this discount card at stores listed in the back of this card.
Congratulations again, now you are a true CSSA fan and loyal member, 
enjoy your free membership discount card. :)\n\n
Best Regards
iPassStore.com"
);

$cardFolder = $_POST['folder'];
$fullpath = "https://www.ipassstore.com/Client/$cardFolder";

$no_password_filter = array("UCSD_UTA_Membership_Card_StorePass");

// input validation check
if (strlen($_POST['first_name']) < 2) {    
    header("Location: $fullpath/index.php?message=Sorry, please enter a valid first name!");
    exit();
}
if (strlen($_POST['last_name']) < 2) {
    header("Location: $fullpath/index.php?message=Sorry, please enter a valid last name");
    exit();
}
// email address validation

if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    header("Location: $fullpath/index.php?message=Sorry, please enter a valid email");
    exit();
}

//**********************************************************************************
// password check
if(! in_array($cardFolder,$no_password_filter)){
	if ($_POST['password'] != "aaa") {
		header("Location: $fullpath/index.php?message=Oops! Password did not match! Try again.");
		exit();
	}
}

//######################## Modify for each card ##################################

//******************** Debug Block **************************
//DebugLog::WriteLogWithFormat("point 1");
//***********************************************************

// absolute path to pass files
$keyPath = dirname(__file__) . "/../../Client/$cardFolder/pass";
$cardID = $_POST['id'];

//******************** Debug Block **************************
//DebugLog::WriteLogWithFormat("point 2");
//***********************************************************

// passTypeID registered on Apple Developer Portal
$passTypeID = DataInterface::getOrgIdByFolder($cardFolder);

//******************** Debug Block **************************
//DebugLog::WriteLogWithFormat("point 3 $passTypeID");
//***********************************************************

// absolute path to pass source files
$sourcePath = $keyPath . "/source";

//******************** Debug Block **************************
//DebugLog::WriteLogWithFormat("point 4");
//***********************************************************

// password for the key file
$keyPassword = DataInterface::getKeyPasswordByOrgId($passTypeID);

//******************** Debug Block **************************
//DebugLog::WriteLogWithFormat("After getting specific information");
//***********************************************************

//################################################################################


// store user input
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$userEmail = $_POST['user_email'];


if (!DataInterface::ifRegistered($userEmail, $cardID)) {
    //no pass was found
    header("Location: $fullpath/index.php?message=Sorry, this email address has already been registered.");
    exit();
}

//******************** Debug Block **************************
//DebugLog::WriteLogWithFormat("point 5");
//***********************************************************


//******************** Debug Block **************************
//DebugLog::WriteLogWithFormat("point 6");
//***********************************************************

/*****************************error check**************************
$EmailFrom = "noreply@ipassstore.com";
$EmailTo = "xilldian@gmail.com";
$subject = "Check Point 1 Reached"; 

// prepare email body text
$body = "Check Point 1 Reached";

// send email 
$success = mail($EmailTo, $subject, $body, "From: <$EmailFrom>");
//******************************************************************/

//******************** Debug Block **************************
//DebugLog::WriteLogWithFormat("point 6.5 :$keyPath, $sourcePath, $keyPassword, $passTypeID, $cardID");
//***********************************************************

//generate a new pass instance
$card = new StorePass($keyPath, $sourcePath, $keyPassword, $passTypeID, $cardID);
$card = $card->createPassWithUniqueSerialNr($error, $firstName, $lastName, $userEmail);

if ($card != null) {
//******************** Debug Block **************************
//DebugLog::WriteLogWithFormat("point 7");
//***********************************************************
    
	
	//************************************************************************************
    $subject = "Your card has arrived";
    $message = $firstName .
        ", Thank you for participating! 
Now you can get real time information update from this digital card! 
Congratulations and enjoy your card! ;)\n\n
Best Regards
iPassStore.com";

    //************************************************************************************
	
	if(array_key_exists($cardFolder,$emailSubject)){
		$subject = $emailSubject[$cardFolder];
		$message = $emailContent[$cardFolder];
	}
	
    //send it over to the user
    $card->outputPassBundleAsEmailAttachmentAmazonSES($userEmail, $subject, $message);
    //$card->outputPassBundleAsWebDownload();

    //show thank you message
    header("Location: $fullpath/index.php?message=Congratulations! Your membership card has been sent to " .
        $_POST['user_email']);

} else {
//******************** Debug Block **************************
//DebugLog::WriteLogWithFormat("point 8");
//***********************************************************
    //there was an error
    die("Error: " . $error);
}

?>