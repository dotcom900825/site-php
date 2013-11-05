<?php
require_once (dirname(__file__) . "/../../../lib/class/DataInterface.php");

$pEmail = $_POST['email'];
$pPassword = $_POST['password'];

//$payload = json_decode(file_get_contents('php://input'), true);

//$email = $payload['email'];
//$password = $payload['password'];

header('Content-type: application/json');
// careful! $email = UserName in db!
if (DataInterface::login($pEmail, $pPassword)) {
    $org_id = DataInterface::getOrgIdByUsername($email);
    echo json_encode(array('status' => 200, 'organization_id' => "$org_id"));
} else {
    echo json_encode(array('status' => 404, 'text'=>"$pEmail $pPassword"));
}
;
