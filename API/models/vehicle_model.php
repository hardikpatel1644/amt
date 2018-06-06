<?php

include_once 'base_model.php';

/**
 * Vehicle model class
 *
 * @author Hardikkumar Patel <hpca1644@gmail.com>
 */
class Vehicle_model extends Base_model {

    private $ssTableName = "vehicle";
    public $ssFields = array("id_user", "company", "model", "model_year", "vehicle_type", "licence_plate", "color", "vin_no", "transmission", "body_type", "last_odometer");

    public function __construct() {
        parent::__construct($this->ssTableName, $this->ssFields);
    }

    /**
     * Function to check validation by car type
     * @param int $id
     * @return boolean
     */
    public function validateMintainanceType($id) {
        if ($id != '') {
            $asVehicle = $this->getById($id);
            if ($asVehicle->vehicle_type == 'electric') {
                echo parseJson(array("error" => true, "message" => "Oil change is not applied on electric vehicle."));
                exit;
            }
        }
        return false;
    }

}
