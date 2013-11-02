<?php
//organization_id ----- organization's id retrieved from server
//serial_number ----- serial number scanned from pass
$payload = json_decode(file_get_contents('php://input'), true);


$org_id = $payload['organization_id'];
$serial = $payload['serial_number'];

$legal_serial = array(1);
$legal_data = array(5=>$legal_serial);

header('Content-type: application/json');
if (in_array($org_id,$legal_data) && in_array($legal_data[$org_id], $serial)) {
    echo json_encode(array('status' => 200, 'text' => "success"));
} else {
    echo json_encode(array('status' => 404));
}