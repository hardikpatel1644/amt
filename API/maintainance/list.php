<?php

include_once '../models/maintainance_model.php';
$obModel = new Maintainance_model();
//$obModel->getToken("hpca1644@gmail.com", "test123");

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




