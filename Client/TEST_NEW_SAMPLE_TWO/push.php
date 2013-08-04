<?php

if (($_POST['admin_name'] == 'admin_wangfute') && ($_POST['admin_password'] == 'wangfute95536')){
	
	require_once(dirname(__FILE__)."/../../../lib/class/Database.php");
	$db = Database::get();
	//set lastUpdated on all passes to now
	$db->prepare("UPDATE passes SET LastUpdated=?") ->execute(array(time()));
	
	require_once(dirname(__FILE__)."/../../../lib/class/APNS.php");
	
    $keyPath = dirname(__FILE__)."/pass";
    $keyPassword = "ucsdcssa95536";
	$apns = new APNS($keyPath, $keyPassword);
	
	//update all registered devices
	$apns->updateAllPasses();
	header("Location: push_panel.php?message=Push was successful");
}

else {
	header("Location: push_panel.php?message=Not Authorized");
}

exit();

?>