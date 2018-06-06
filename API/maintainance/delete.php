<?php

include_once '../models/maintainance_model.php';
$obModel = new Maintainance_model();
if (isset($_GET['id'])) {
    try {
        $snId = cleanInputs($_GET['id']);
        $asList = $obModel->deleteById($snId);
        echo parseJson(array("success" => true, "message" => "Record deleted successfully."));
    } catch (Exception $e) {
        echo parseJson(array("error" => true, "message" => $e->getMessage()));
    }
}