<?php

/**
 * User controller 
 * @author Hardikkumar Patel <hpca1644@gmail.com>
 */
include_once '../models/user_model.php';


include_once './base_controller.php';

$ssController = new Base_controller(new User_model());

$ssMethod = $_SERVER['REQUEST_METHOD'];


switch ($ssMethod) {
    case 'GET':
        $ssController->getRequest();
        break;
    case 'PUT':
        $ssController->putRequest();
        break;
    case 'POST':
        $ssController->postRequest();
        break;
    case 'DELETE':
        $ssController->deleteRequest();
        break;
    default:
        echo json_encode(array("error" => true, "message" => "Wrong HTTP Method"), JSON_UNESCAPED_UNICODE);
        break;
}
