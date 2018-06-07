<?php

include_once __DIR__ . '/base_model.php';

/**
 * Maintainance model class
 *
 * @author Hardikkumar Patel <hpca1644@gmail.com>
 */
class Maintainance_model extends Base_model {

    private $ssTableName = "maintainance";
    public $ssFields = array("id_vehicle", "maintainance_name", "cost", "description");

    public function __construct() {
        parent::__construct($this->ssTableName, $this->ssFields);
    }

}
