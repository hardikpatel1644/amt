<?php

header("Content-Type: application/json");
session_start();

/**
 * Function to parse Json data
 * @param array $asData
 * @return string
 */
function parseJson($asData) {
    if (is_array($asData) && count($asData) > 0)
        return json_encode($asData, JSON_UNESCAPED_UNICODE);
    else
        return FALSE;
}

/**
 * Function to clean inputs
 * @param array $asData
 * @return array
 */
function cleanInputs($asData) {
    $asCleanInput = array();
    if (is_array($asData)) {
        foreach ($asData as $ssKey => $ssVal) {
            $asCleanInput[$ssKey] = cleanInputs($ssVal);
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

/**
 * Validate fields
 * @param type $asData
 */
function validateFields($asData = array()) {
    if (is_array($asData)) {
        $asError = array();
        foreach ($asData as $ssKey => $ssVal) {
            if ($ssVal == '') {
                $asError[$ssKey] = ucfirst(str_replace('_', " ", $ssKey)) . " is required.";
            }
        }
        
      

        if (count($asError) > 0) {
            $ssErrorStr = "<ul>";
            foreach ($asError as $ssEror) {
                $ssErrorStr .= "<li>" . $ssEror . "</li>";
            }
            $ssErrorStr .= "</ul>";
            echo parseJson(array("error" => true, "message" => $ssErrorStr));
            exit;
        }
    }
}
