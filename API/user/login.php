<?php

include_once '../models/auth.php';
$obModel = new Auth();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $asPost = cleanInputs($_POST);
        $ssEmail = $asPost['email'];
        $ssPassword = $asPost['password'];
        $ssToken = $obModel->validateLogin($ssEmail, $ssPassword);
        echo parseJson(array("success" => true, "message" => "Record added successfully.", "TOKEN" => $ssToken));
    } catch (Exception $e) {
        echo parseJson(array("error" => true, "message" => $e->getMessage()));
    }
} else {
    echo parseJson(array("error" => true, "message" => "Please select proper http method."));
}