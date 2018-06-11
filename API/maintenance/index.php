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

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        //$asList = $obModel->getAll();
        if (isset($_GET['id_vehicle']) && $_GET['id_vehicle'] != '') {
            $asList = $obModel->getByField('id_vehicle', cleanInputs($_GET['id_vehicle']), 1);
            echo parseJson(array("success" => true, "data" => $asList));
        } else
            echo parseJson(array("error" => true, "message" => "Something went wrong. Please try again."));
    } catch (Exception $e) {
        echo parseJson(array("error" => true, "message" => $e->getMessage()));
    }
} else {
    echo parseJson(array("error" => true, "message" => "Please select proper http method."));
}




