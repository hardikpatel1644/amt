<?php

include_once '../includes/db.php';

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
    function getAll() {
        $ssQuery = "SELECT * FROM {$this->ssTableName}";
        $ssFields = array();
        return $this->obDb->getData($ssQuery, $ssFields);
    }

    /**
     * Function to get data by Id
     * @param int $id
     * @return array
     */
    function getById($id) {
        $ssQuery = "SELECT {$this->ssFields_str} FROM {$this->ssTableName} WHERE id= :id";
        $ssFields = array("id" => $id);
        return $this->obDb->getData($ssQuery, $ssFields);
    }

    /**
     * Function to get data by field
     * @param string $ssField
     * @param string $ssValue
     * @return array
     */
    function getByField($ssField, $ssValue) {
        $ssQuery = "SELECT {$this->ssFields_str} FROM {$this->ssTableName} WHERE " . $ssField . "= :value";
        $ssFields = array("value" => $ssValue);
        return $this->obDb->getData($ssQuery, $ssFields);
    }

    /**
     * Function to insert data into table
     * @param array $asData
     * @return int
     */
    function postItem($asData) {
        $ssQuery = "INSERT INTO {$this->ssTableName} ({$this->ssFields_str}) VALUES ({$this->parameterizeDataForInsert($asData)})";
        return $this->obDb->postData($ssQuery, $asData);
    }

    /**
     * Function to update data by id
     * @param int $id
     * @param array $asSetData
     * @return type
     */
    function updateById($id, $asSetData) {
        $ssQuery = "UPDATE {$this->ssTableName} SET {$this->parameterizeData($asSetData)} WHERE id = :id";
        $asSetData["id"] = $id;
        return $this->obDb->postData($ssQuery, $asSetData);
    }

    /**
     * Function to delete data by id
     * @param int $id
     * @return type
     */
    function deleteById($id) {
        $ssQuery = "DELETE FROM {$this->ssTableName} WHERE id = :id";
        $ssFields = array("id" => $id);
        return $this->obDb->postData($ssQuery, $ssFields);
    }

    /**
     * FUnction to convert array to string parameter
     * @param array $asData
     * @return string
     */
    function parameterizeData($asData) {
        $str = "";
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

    /**
     * Function to convert array to string parameter
     * @param array $asData
     * @return type
     */
    function parameterizeDataForInsert($asData) {
        $str = "";
        foreach ($asData as $key => $value) {
            $str .= ":" . $key . ",";
        }
        $str = substr($str, 0, -1);
        return $str;
    }

}
