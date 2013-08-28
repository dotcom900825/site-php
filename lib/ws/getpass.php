<?php
require_once (dirname(__file__) . "/../../../lib/class/DebugLog.php");
require_once (dirname(__file__) . "/../../../lib/class/DataInterface.php");
require_once (dirname(__file__) . "/../../../lib/class/AmazonSES.php");
require_once (dirname(__file__) . "/../../../lib/class/StorePass.php");
DebugLog::WriteLogWithFormat(dirname(__file__)."/getpass.php");

$emailSubject = array("UCSD_UTA_Membership_Card" => "Your UCSD UTA membership card has arrived",
					"UCSD_CSSA_Membership_Card" => "Your UCSD CSSA membership card has arrived" );
$emailContent = array("UCSD_UTA_Membership_Card" => ", Thank you for participating! \n"
."Now you can get real time information update and all the benefits of members!\n"
."Congratulations again, now you are a true UTA fan and loyal member,"
."enjoy your digital membership card! ;)\n\n" ."Best Regards\n" ."iPassStore.com\n",
"UCSD_CSSA_Membership_Card" => ", Thank you for participating! \n"
."Now you can use this discount card at stores listed in the back of this card.\n"
."Congratulations again, now you are a true CSSA fan and loyal member, "
."enjoy your free membership discount card. :)\n\n"
."Best Regards\n"
."iPassStore.com\n" );
$instructions = "\n\nInstructions:\n If you are iPhone/iPod Touch user, please view this email in the \"Mail\" "
."application on your device, download the attachment and your device will automatically recognize your pass.\n\n"
."If you are android user, please download the \"PassWallet\" app from play store, then view this email on "
."your device and download the attachment, PassWallet will automatically recognize your pass.\n\n"
."We worked really hard to put everything together, and we definitely want you to have a great"
."user experience. Your feedback is extremely valuable to us. Please let us know about any problems "
."you might have in the future, we are here to help. For Passbook related feedback or question, feel "
."free to send an email to: support@ipassstore.com.";

$cardFolder = $_POST['folder'];
$fullpath = "./../../Client/$cardFolder";

$no_password_filter = array("UCSD_CSSA_Membership_Card");

// input validation check
if (strlen($_POST['first_name']) < 2) {
    header("Location: $fullpath/form.php?message=Sorry, please enter a valid first name!");
    exit();
}
if (strlen($_POST['last_name']) < 2) {
    header("Location: $fullpath/form.php?message=Sorry, please enter a valid last name");
    exit();
}
// email address validation

if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    header("Location: $fullpath/form.php?message=Sorry, please enter a valid email");
    exit();
}

//**********************************************************************************
// password check
if(! in_array($cardFolder,$no_password_filter)){
	if ($_POST['password'] != "aaa") {
		header("Location: $fullpath/form.php?message=Oops! Password did not match! Try again.");
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
    header("Location: $fullpath/form.php?message=Sorry, this email address has already been registered.");
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
iPassStore Team";

    //************************************************************************************
	
	if(array_key_exists($cardFolder,$emailSubject)){
		$subject = $emailSubject[$cardFolder];
		$message = $firstName.$emailContent[$cardFolder].$instructions;
	}
	
    //send it over to the user
    $card->outputPassBundleAsEmailAttachmentAmazonSES($userEmail, $subject, $message);
    //$card->outputPassBundleAsWebDownload();

    //show thank you message
    header("Location: $fullpath/form.php?message=Congratulations! Your membership card has been sent to " .
        $_POST['user_email']);

} else {
//******************** Debug Block **************************
//DebugLog::WriteLogWithFormat("point 8");
//***********************************************************
    //there was an error
    die("Error: " . $error);
}

?>
