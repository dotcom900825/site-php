<?php
require_once (dirname(__file__) . "/../../../lib/class/DataInterface.php");

$payload = json_decode(file_get_contents('php://input'), true);

$email = $payload['email'];
$password = $payload['password'];

// careful! $email = UserName in db!
if (DataInterface::login($email, $password)) {
    $org_id = DataInterface::getOrgIdByUsername($email);
    echo json_encode(array('status' => 200, 'organization_id' => "$org_id"));
} else {
    echo json_encode(array('status' => 404));
}
;
