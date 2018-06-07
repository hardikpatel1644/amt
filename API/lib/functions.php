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
        foreach ($asData as $k => $v) {
            $asCleanInput[$k] = cleanInputs($v);
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
