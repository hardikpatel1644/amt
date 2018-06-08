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

if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    try {
        parse_str(file_get_contents("php://input"), $asPost);
        $asPost = cleanInputs($asPost);
        if (isset($asPost['id'])) {
            $snUserid = $obModel->updateById($asPost['id'], $asPost);
            echo parseJson(array("success" => true, "message" => "Record updated successfully."));
        } else
            echo parseJson(array("error" => true, "message" => "Something went wrong. Please try again."));
    } catch (Exception $e) {
        echo parseJson(array("error" => true, "message" => $e->getMessage()));
    }
} else {
    echo parseJson(array("error" => true, "message" => "Please select proper http method."));
}