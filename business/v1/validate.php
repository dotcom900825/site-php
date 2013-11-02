<?php
//organization_id ----- organization's id retrieved from server
//serial_number ----- serial number scanned from pass
$org_id = $_POST['organization_id'];
$serial = $_POST['serial_number'];

if ($org_id == 5) {
    echo json_encode(array('status' => 200, 'text' => "I got: $serial"));
} else {
    echo json_encode(array('status' => 404));
}