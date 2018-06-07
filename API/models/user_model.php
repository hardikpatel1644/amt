<?php

include_once __DIR__ . '/base_model.php';

/**
 * User model class
 *
 * @author Hardikkumar Patel <hpca1644@gmail.com>
 */
class User_model extends Base_model {

    private $ssTableName = "user";
    public $ssFields = array("user_type", "first_name", "last_name", "email", "password", "salt");

    public function __construct() {
        parent::__construct($this->ssTableName, $this->ssFields);
    }

}
