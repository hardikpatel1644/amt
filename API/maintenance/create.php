<?php

include_once '../models/maintenance_model.php';
include_once '../models/vehicle_model.php';
include_once '../models/auth.php';

$obModel = new Maintenance_model();
$obVehicleModel = new Vehicle_model();
$obAuth = new Auth();
if (!$obAuth->validateToken()) {
    echo parseJson(array("error" => true, "message" => "Please login to get access."));
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $asPost = cleanInputs($_POST);

        if ($asPost['maintenance_name'] == "oil_change") {
            $obVehicleModel->validateMintainanceType($asPost['id_vehicle']);
        }
        $snId = $obModel->insertData($asPost);
        echo parseJson(array("success" => true, "message" => "Record added successfully."));
    } catch (Exception $e) {
        echo parseJson(array("error" => true, "message" => $e->getMessage()));
    }
} else {
    echo parseJson(array("error" => true, "message" => "Please select proper http method."));
}