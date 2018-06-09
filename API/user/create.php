<?php

include_once '../models/auth.php';
$obModel = new Auth();
if (!$obModel->validateToken()) {
    echo parseJson(array("error" => true, "message" => "Please login to get access."));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $asPost = cleanInputs($_POST);
        $ssEmail = $asPost['email'];
        $ssPassword = $asPost['password'];

        $obModel->isUnique('email', $ssEmail, 0); // check for unique record
        $asPasswordHash = $obModel->generatePasswordHash($ssEmail, $ssPassword); // generate password hash
        $asPost = array_merge($asPost, $asPasswordHash);
        validateFields($asPost);
        $snUserid = $obModel->insertData($asPost);
        if ($snUserid != '' && is_integer($snUserid))
            echo parseJson(array("success" => true, "message" => "Record added successfully."));
        else
            echo parseJson(array("error" => true, "message" => "Something went wrong. Please try again."));
    } catch (Exception $e) {
        echo parseJson(array("error" => true, "message" => $e->getMessage()));
    }
} else {
    echo parseJson(array("error" => true, "message" => "Please select proper http method."));
}
