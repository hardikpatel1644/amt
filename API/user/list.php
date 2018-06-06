<?php

include_once '../models/auth.php';
$obModel = new Auth();

echo $obModel->getCount('email', 'hpca1644122213213@gmail.com',0);exit;

//$obModel->validateLogin('hpca1644@gmail.com', 'test123');
if ($obModel->validateToken()) {
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
} else
    echo parseJson(array("error" => true, "message" => "Please login to get access."));



