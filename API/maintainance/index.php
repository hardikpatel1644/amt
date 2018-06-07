<?php

include_once '../models/maintainance_model.php';
include_once '../models/vehicle_model.php';
include_once '../models/auth.php';

$obModel = new Maintainance_model();
$obVehicleModel = new Vehicle_model();
$obAuth = new Auth();
if (!$obAuth->validateToken()) {
    echo parseJson(array("error" => true, "message" => "Please login to get access."));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        $asList = $obModel->getAll();
        echo parseJson(array("success" => true, "data" => $asList));
    } catch (Exception $e) {
        echo parseJson(array("error" => true, "message" => $e->getMessage()));
    }
} else {
    echo parseJson(array("error" => true, "message" => "Please select proper http method."));
}




