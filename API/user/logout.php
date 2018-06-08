<?php

include_once '../models/auth.php';
$obModel = new Auth();

$ssFlag = $obModel->logout();
if ($ssFlag)
    echo parseJson(array("success" => true, "message" => "Logout successfully."));
else
    echo parseJson(array("error" => true, "message" => "Something went wrong."));