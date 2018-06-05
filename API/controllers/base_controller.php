<?php

header("Content-Type: application/json");

/**
 * base controller class 
 *
 * @author Hardikkumar Patel <hpca1644@gmail.com>
 */
class Base_controller {

    public $ssModel;

    /**
     * default constructor
     * @param type $ssModel
     */
    public function __construct($ssModel) {
        $this->ssModel = $ssModel;
        $_POST = $this->cleanInputs($_POST);
        $_GET = $this->cleanInputs($_GET);
    }

    /**
     * Function to process get request
     */
    function getRequest() {

        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case "getall":
                    try {
                        echo $this->parseJson($this->ssModel->getAll());
                    } catch (Exception $e) {
                        echo $this->parseJson(array("error" => true, "message" => $e->getMessage()));
                    }
                    break;
                case "getbyid":
                    try {
                        echo $this->parseJson($this->ssModel->getById($_GET['id']));
                    } catch (Exception $e) {
                        echo $this->parseJson(array("error" => true, "message" => $e->getMessage()));
                    }
                    break;
                case "getbyfield":
                    try {
                        echo $this->parseJson($this->ssModel->getByField($_GET['field'], $_GET['field_value']));
                    } catch (Exception $e) {
                        echo $this->parseJson(array("error" => true, "message" => $e->getMessage()));
                    }
                    break;
                default:
                    echo $this->parseJson(array("error" => true, "message" => "API route is not defined"));
                    break;
            }
        }
    }

    /**
     * Function to POST request
     */
    function postRequest() {

        $asQueryValues = array();
        foreach ($this->ssModel->ssFields as $ssField) {
            if (isset($_POST["{$ssField}"])) {
                $ssFieldValue = $_POST["{$ssField}"];
                $asQueryValues[$ssField] = $ssFieldValue;
            } else {
                $asQueryValues[$ssField] = "";
            }
        }
        unset($ssField);

        try {
            echo $this->parseJson($this->ssModel->postItem($asQueryValues));
        } catch (Exception $e) {
            echo $this->parseJson(array("error" => true, "message" => $e->getMessage()));
        }
    }

    /**
     * Function to process PUT request
     */
    function putRequest() {
        parse_str(file_get_contents("php://input"), $asPost);
        $asPost = ($this->cleanInputs($asPost));
        $asQueryValues = array();
        foreach ($this->ssModel->ssFields as $ssField) {
            if (isset($asPost["{$ssField}"])) {
                $ssFieldValue = $asPost["{$ssField}"];
                $asQueryValues[$ssField] = $ssFieldValue;
            }
        }
        unset($ssField);
        if (isset($asPost['id'])) {
            try {
                echo $this->parseJson($this->ssModel->updateById($asPost['id'], $asQueryValues));
            } catch (Exception $e) {
                echo $this->parseJson(array("error" => true, "message" => $e->getMessage()));
            }
        } else {
            echo $this->parseJson(array("error" => true, "message" => "Item ID is not defined"));
        }
    }

    /**
     * Function to process delete request
     */
    function deleteRequest() {

        parse_str(file_get_contents("php://input"), $asPost);
        $asPost = $this->cleanInputs($asPost);
        if (isset($asPost['id'])) {
            try {
                echo $this->parseJson($this->ssModel->deleteById($asPost['id']));
            } catch (Exception $e) {
                echo $this->parseJson(array("error" => true, "message" => $e->getMessage()));
            }
        } else {
            echo $this->parseJson(array("error" => true, "message" => "Item ID is not defined"));
        }
    }

    /**
     * Function to parse Json data
     * @param type $asData
     * @return type
     */
    function parseJson($asData) {
        return json_encode($asData, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Function to clean inputs
     * @param array $asData
     * @return array
     */
    private function cleanInputs($asData) {
        $asCleanInput = array();
        if (is_array($asData)) {
            foreach ($asData as $k => $v) {
                $asCleanInput[$k] = $this->cleanInputs($v);
            }
        } else {
            if (get_magic_quotes_gpc()) {
                $asData = trim(stripslashes($asData));
            }
            $asData = strip_tags($asData);
            $asCleanInput = trim($asData);
        }
        return $asCleanInput;
    }

}
