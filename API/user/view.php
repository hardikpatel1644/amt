<?php

include_once '../models/auth.php';
$obModel = new Auth();

if (isset($_GET['id'])) {
    try {
        $snId = cleanInputs($_GET['id']);
        $asList = $obModel->getById($snId);
        echo parseJson(array("success" => true, "data" => $asList));
    } catch (Exception $e) {
        echo parseJson(array("error" => true, "message" => $e->getMessage()));
    }
}


