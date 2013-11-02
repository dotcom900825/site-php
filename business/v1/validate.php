<?php
//organization_id ----- organization's id retrieved from server
//serial_number ----- serial number scanned from pass
$payload = json_decode(file_get_contents('php://input'), true);


$org_id = $payload['organization_id'];
$serial = $payload['serial_number'];

header('Content-type: application/json');
if ($org_id == 5) {
    echo json_encode(array('status' => 200, 'text' => "I got: $serial"));
} else {
    echo json_encode(array('status' => 404));
}