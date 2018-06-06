<?php

include_once '../includes/config.php';

/**
 * Database class
 *
 * @author Hardikkumar Patel <hpca1644@gmail.com>
 */
class Db {

    protected $obDb;

    /**
     * Default constructor
     */
    protected function __construct() {
        try {
            $this->obDb = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . "", DB_USERNAME, DB_PASSWORD);
            $this->obDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->obDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Database connection Error: " . $e->getMessage();
            die;
        }
    }

    /**
     * Function to create connection to database
     */
    protected function getConnection() {
        if (!$this->obDb) {
            $this->obDb = new Db();
        }
        return $this->obDb;
    }

    /**
     * Function to get data from table
     * @param string $ssQuery
     * @param string $ssFields
     * @return array
     * @throws Exception
     */
    protected function getData($ssQuery, $ssFields) {
        try {

            $ssStatement = $this->obDb->prepare($ssQuery);
            $ssStatement->execute($ssFields);

            $asResult = array();
            while ($result = $ssStatement->fetchObject()) {
                array_push($asResult, $result);
            }

            if (sizeof($asResult) == 0) {
                throw new Exception("No matching records found");
            }

            return $asResult;
        } catch (PDOException $e) {
            throw new Exception("Database query error");
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Function to get single data from table
     * @param string $ssQuery
     * @param string $ssFields
     * @return array
     * @throws Exception
     */
    protected function getOneData($ssQuery, $ssFields, $ssFlag = 0) {
        try {

            $ssStatement = $this->obDb->prepare($ssQuery);
            $ssStatement->execute($ssFields);
            $asResult = array();
            while ($result = $ssStatement->fetchObject()) {
                if ($ssFlag == 1)
                    array_push($asResult, $result);
                else
                    $asResult = $result;
            }
            if (sizeof($asResult) == 0) {
                throw new Exception("No matching records found");
            }

            return $asResult;
        } catch (PDOException $e) {
            throw new Exception("Database query error");
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Function to get count data from table
     * @param string $ssQuery
     * @param string $ssFields
     * @return array
     * @throws Exception
     */
    protected function getCountData($ssQuery, $ssFields, $ssFlag = 0) {
        try {

            $ssStatement = $this->obDb->prepare($ssQuery);
            $ssStatement->execute($ssFields);
            $asResult = array();
            while ($result = $ssStatement->fetchObject()) {
                array_push($asResult, $result);
            }
           // echo "<pre>";            print_r($asResult);
           // echo count($asResult);
           // exit;
            return count($asResult);
        } catch (PDOException $e) {
            throw new Exception("Database query error");
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Function to post data into table
     * @param string $ssQuery
     * @param array $asFields
     * @return string
     * @throws Exception
     */
    protected function postData($ssQuery, $asFields) {
        try {
            $ssStatement = $this->obDb->prepare($ssQuery);
            $ssStatement->execute($asFields);
            return $this->obDb->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Database query error");
        }
    }

    /**
     * Function to post data into table
     * @param string $ssQuery
     * @param array $asFields
     * @return string
     * @throws Exception
     */
    protected function updateData($ssQuery, $asFields) {
        try {
            $ssStatement = $this->obDb->prepare($ssQuery);

            $ssStatement->execute($asFields);
        } catch (PDOException $e) {
            throw new Exception("Database query error");
        }
    }

}
