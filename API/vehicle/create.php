<?php

include_once '../models/vehicle_model.php';
$obModel = new Vehicle_model();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $asPost = cleanInputs($_POST);
        $snId = $obModel->insertData($asPost); 
        echo parseJson(array("success" => true, "message" => "Record added successfully."));
    } catch (Exception $e) {
        echo parseJson(array("error" => true, "message" => $e->getMessage()));
    }
} else {
    echo parseJson(array("error" => true, "message" => "Please select proper http method."));
}