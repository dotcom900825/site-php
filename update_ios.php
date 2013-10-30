<?php
require_once (dirname(__file__) . "/../lib/class/Database.php");

$db = Database::get();
$statement = $db->prepare("update devices set device_type = 'ios' where ID = ?");

$handle = fopen("result.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $id = trim($line);
        $statement->execute(array($id));
    }
} else {
    echo "error!";
}
echo "complete!";

