<?php

//this shall never be commented
require_once (dirname(__file__) . "/../../../lib/class/EventPass.php");

// After creating the pass for the first time the following 3 lines of
// code is enough to function
$card = new EventPass(9, "pass.com.ipassstore.georgeAtTheCove", "GeorgeCove", "GeorgeAtTheCove",
"GeorgeAtTheCove@ipassstore.com");
$card = $card->createPassWithExistingSerialNr($error);
$card->outputPassBundleAsWebDownload();


/*
//When you creat the card for the first time, you need to uncomment all
//the following code, make the bottom part html, and press create button
//on this page, after that, you can comment them out, and have the three
//lines of code above to handle everything.
if (isset($_GET['action'])) {
$card = new EventPass(9, "pass.com.ipassstore.georgeAtTheCove", "GeorgeCove", "GeorgeAtTheCove",
"GeorgeAtTheCove@ipassstore.com");
$action = $_GET["action"];
if ($action == "create") {
$card->createPassWithUniqueSerialNr($error);
} else {
$card = $card->createPassWithExistingSerialNr($error);
}
$card->outputPassBundleAsWebDownload();
}





<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
<form action="index.php">
<input type="hidden" value="create" name="action"/>
<input type="submit" value = "create"/>
</form>
<form action="index.php">
<input type="hidden" value="produce" name="action"/>
<input type="submit" value = "produce"/>
</form>
</body>
</html>

*/
?>