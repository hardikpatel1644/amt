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
if (isset($_GET['id'])) {
    try {
        $snId = cleanInputs($_GET['id']);
        $asList = $obModel->getById($snId);
        echo parseJson(array("success" => true, "data" => $asList));
    } catch (Exception $e) {
        echo parseJson(array("error" => true, "message" => $e->getMessage()));
    }
}


