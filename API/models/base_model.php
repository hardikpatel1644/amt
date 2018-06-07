<?php

include_once __DIR__ . '/../includes/db.php';
include_once __DIR__ . '/../lib/functions.php';

/**
 * Base model class 
 *
 * @author Hardikkumar Patel <hpca1644@gmail.com>
 */
class Base_model extends Db {

    private $ssTableName;
    public $ssFields = array();
    private $ssFields_str;

    /**
     * Construction
     * @param string $table
     * @param string $ssFields
     */
    public function __construct($table, $ssFields) {
        $this->ssTableName = $table;
        $this->ssFields = $ssFields;
        $this->ssFields_str = implode(",", $ssFields);
        parent::getConnection();
    }

    /**
     * Function to get all data from table
     * @return array
     */
    public function getAll() {
        $ssQuery = "SELECT * FROM {$this->ssTableName}";
        $ssFields = array();
        return $this->obDb->getData($ssQuery, $ssFields);
    }

    /**
     * Function to get data by Id
     * @param int $id
     * @return array
     */
    public function getById($id = '') {
        if ($id != '') {
            $ssQuery = "SELECT * FROM {$this->ssTableName} WHERE id= :id";
            $ssFields = array("id" => $id);
            return $this->obDb->getOneData($ssQuery, $ssFields);
        }
        return false;
    }

    /**
     * Function to get data by field
     * @param string $ssField
     * @param string $ssValue
     * @return array
     */
    public function getByField($ssField = '', $ssValue = '', $ssFlag = 0) {

        if ($ssField != '' && $ssValue != '') {
            $ssQuery = "SELECT * FROM {$this->ssTableName} WHERE " . $ssField . "=:value";
            $ssFields = array("value" => $ssValue);
            return $this->obDb->getOneData($ssQuery, $ssFields, $ssFlag);
        }
        return false;
    }

    /**
     * Function to insert data into table
     * @param array $asData
     * @return int
     */
    public function insertData($asData = array()) {
        if (count($asData) > 0) {
            $asData = $this->mapPostFields($asData);
            $ssQuery = "INSERT INTO {$this->ssTableName} ({$this->ssFields_str}) VALUES ({$this->parameterizeDataForInsert($asData)})";
            return $this->obDb->postData($ssQuery, $asData);
        } else
            return false;
    }

    /**
     * Function to update data by id
     * @param int $id
     * @param array $asSetData
     * @return type
     */
    public function updateById($id = '', $asSetData = array()) {
        if ($id != '' && count($asSetData) > 0) {
            unset($asSetData['id']);
            $ssQuery = "UPDATE {$this->ssTableName} SET {$this->parameterizeData($asSetData)} WHERE id = :id";
            $asSetData["id"] = $id;
            return $this->obDb->updateData($ssQuery, $asSetData);
        }
        return false;
    }

    /**
     * Function to delete data by id
     * @param int $id
     * @return type
     */
    public function deleteById($id = '') {
        if ($id != '') {
            $ssQuery = "DELETE FROM {$this->ssTableName} WHERE id = :id";
            $ssFields = array("id" => $id);
            return $this->obDb->postData($ssQuery, $ssFields);
        }
        return false;
    }

    /**
     * FUnction to convert array to string parameter
     * @param array $asData
     * @return string
     */
    public function parameterizeData($asData = array()) {
        $str = "";
        if (count($asData) > 0) {

            $snCount = 1;
            foreach ($asData as $key => $value) {
                if ($snCount == count($asData))
                    $str .= $key . "=:" . $key;
                else
                    $str .= $key . "=:" . $key . ",";

                $snCount++;
            }
            return $str;
        }
        return $str;
    }

    /**
     * Function to convert array to string parameter
     * @param array $asData
     * @return type
     */
    public function parameterizeDataForInsert($asData = array()) {
        $str = "";
        if (count($asData) > 0) {
            foreach ($asData as $key => $value) {
                $str .= ":" . $key . ",";
            }
            $str = substr($str, 0, -1);
            return $str;
        }
        return $str;
    }

    /**
     * Function to map request array with model fields
     * @param type $asPostData
     * @return string
     */
    public function mapPostFields($asPostData = array()) {
        $asMapped = array();
        if (count($asPostData) > 0) {
            foreach ($this->ssFields as $ssKey => $ssField) {
                if (isset($asPostData["{$ssField}"])) {
                    $ssFieldValue = cleanInputs($asPostData["{$ssField}"]);
                    $asMapped[$ssField] = $ssFieldValue;
                } else {
                    $asMapped[$ssField] = "";
                }
            }
            unset($ssField);
        }
        return $asMapped;
    }

    /**
     * Function to check record exists or not
     * @param string $ssValue
     * @param boolean $ssFlag
     */
    public function isUnique($ssField = '', $ssValue = '', $ssFlag = 0) {
        if ($ssField != '' && $ssValue != '') {
            $snCount = $this->getCount($ssField, $ssValue, $ssFlag);
            if ($ssFlag == 1) {

                if ($snCount >= 1) { // check for update time 
                    echo parseJson(array("error" => true, "message" => "edit:Record alredy exist."));
                    exit;
                }
            } else {   // check for insert time
                if ($snCount > 0) { // check for update time 
                    echo parseJson(array("error" => true, "message" => "Record alredy exist."));
                    exit;
                }
            }
        }
    }

    /**
     * Function to get count by field
     * @param string $ssField
     * @param string $ssValue
     * @param boolean $ssFlag
     * @return int
     */
    public function getCount($ssField = '', $ssValue = '', $ssFlag = 0) {

        if ($ssField != '' && $ssValue != '') {
            $ssQuery = "SELECT * FROM {$this->ssTableName} WHERE " . $ssField . "= :value";
            $ssFields = array("value" => $ssValue);

            return $this->obDb->getCountData($ssQuery, $ssFields, $ssFlag);
        }
    }

}
