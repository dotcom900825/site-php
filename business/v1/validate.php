<?php
//organization_id ----- organization's id retrieved from server
//serial_number ----- serial number scanned from pass


$org_id = $_POST['organization_id'];
$serial = $_POST['serial_number'];

$legal_serial = array(1);
$legal_data = array(5 => $legal_serial);

header('Content-type: application/json');
if (array_key_exists($org_id, $legal_data)) {
    //if (in_array($serial, $legal_data[$org_id])) {
        echo json_encode(array('status' => 200, 'text' => "success"));
    //} else {
        //echo json_encode(array('status' => 200, 'text' => "failed"));
    //}
} else {
    echo json_encode(array('status' => 404));
}
