<?php

include_once '../models/vehicle_model.php';
$obModel = new Vehicle_model();
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