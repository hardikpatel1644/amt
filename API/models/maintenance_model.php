<?php

include_once __DIR__ . '/base_model.php';

/**
 * Maintenance model class
 *
 * @author Hardikkumar Patel <hpca1644@gmail.com>
 */
class Maintenance_model extends Base_model {

    private $ssTableName = "maintenance";
    public $ssFields = array("id_vehicle", "maintenance_name", "cost", "description");

    public function __construct() {
        parent::__construct($this->ssTableName, $this->ssFields);
    }

}
