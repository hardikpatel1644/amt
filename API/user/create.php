<?php

include_once '../models/auth.php';
$obModel = new Auth();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $asPost = cleanInputs($_POST);
        $ssEmail = $asPost['email'];
        $ssPassword = $asPost['password'];
        $obModel->isUnique('email', $ssEmail, 0); // check for unique record
        $asPasswordHash = $obModel->generatePasswordHash($ssEmail, $ssPassword); // generate password hash
        $asPost = array_merge($asPost, $asPasswordHash);
        $snUserid = $obModel->insertData($asPost);
        echo parseJson(array("success" => true, "message" => "Record added successfully."));
    } catch (Exception $e) {
        echo parseJson(array("error" => true, "message" => $e->getMessage()));
    }
} else {
    echo parseJson(array("error" => true, "message" => "Please select proper http method."));
}