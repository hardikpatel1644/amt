<?php

include_once '../models/vehicle_model.php';
include_once '../models/auth.php';

$obModel = new Vehicle_model();

$obAuth = new Auth();
if (!$obAuth->validateToken()) {
    echo parseJson(array("error" => true, "message" => "Please login to get access."));
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $asPost = cleanInputs($_POST);
        $asPost['id_user'] = $_SESSION['id_user'];
        validateFields($asPost);
        $snId = $obModel->insertData($asPost);
        if ($snId != '' && is_integer($snId))
            echo parseJson(array("success" => true, "message" => "Record added successfully."));
        else
            echo parseJson(array("error" => true, "message" => "Something went wrong. Please try again."));
    } catch (Exception $e) {
        echo parseJson(array("error" => true, "message" => $e->getMessage()));
    }
} else {
    echo parseJson(array("error" => true, "message" => "Please select proper http method."));
}