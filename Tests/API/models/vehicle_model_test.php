<?php

require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../../../API/models/vehicle_model.php';

/**
 * Vehicle model test cases 
 *
 * @author Hardikkumar Patel <hpca1644@gmail.com>
 */
class Vehicle_model_test extends \PHPUnit_Framework_TestCase {

    private $obModel;
    private $ssTableName = 'vehicle';

    /**
     * Initialize an object
     */
    public function setUp() {
        $this->obModel = new Vehicle_model;
    }

    /**
     * Initialize an object
     */
    public function tearDown() {
        $this->obModel = null;
    }

    /**
     * Function to check table name
     */
    public function testTableName() {
        $this->assertEquals('vehicle', $this->ssTableName, "Table name is " . $this->ssTableName);
        $this->assertNotEquals('test', $this->ssTableName, " \" test \"Table name is not equals to defined" . $this->ssTableName);
    }

    /**
     * Function to test getall method
     */
    public function testGetAll() {
        $asData = $this->obModel->getAll();
        $obData = $asData[0];

        $this->assertArrayHasKey(0, $asData);
        $this->assertAttributeEquals('gas', "vehicle_type", $obData);
        $this->assertAttributeNotEquals('admin12', "vehicle_type", $obData);
        // $this->assertCount(7, $asData); // Total records = 7 
    }

    /**
     * Function to test getbyid
     */
    public function testGetById() {
        //test with empty id 
        $asData1 = $this->obModel->getById();
        $this->assertFalse($asData1);
        // test with string value
        $asData2 = $this->obModel->getById("teeet");

        $this->assertArrayNotHasKey(0, $asData2);
        $this->assertCount(0, $asData2); // Total records = 0 
        //test with numeric and valid value
        $asData3 = $this->obModel->getById(13);
        $this->assertAttributeEquals('gas', "vehicle_type", $asData3);
        $this->assertAttributeNotEquals('admin12', "vehicle_type", $asData3);
        $this->assertObjectHasAttribute('vehicle_type', $asData3);
    }

    /**
     * Function to test GetByField
     */
    public function testGetByField() {
        //test with empty values 
        $asData1 = $this->obModel->GetByField();
        $this->assertFalse($asData1);

        $asData2 = $this->obModel->GetByField('vehicle_type', '');
        $this->assertFalse($asData2);

        $asData3 = $this->obModel->GetByField('', 'gas');
        $this->assertFalse($asData3);



        /**
         * *  test with valid values with only one record
         */
        $asData4 = $this->obModel->GetByField('vehicle_type', 'gas');

        $this->assertAttributeEquals('gas', "vehicle_type", $asData4);
        $this->assertAttributeNotEquals('admin12', "vehicle_type", $asData4);
        $this->assertObjectHasAttribute('vehicle_type', $asData4);


        /**
         *  test with valid values with all possible records found
         */
        $asData5 = $this->obModel->GetByField('vehicle_type', 'gas', 1);
        $this->assertCount(1, $asData5); // Total records = 3 
        $asData = $asData5[0];
        $this->assertAttributeEquals('gas', "vehicle_type", $asData);
        $this->assertAttributeNotEquals('admin12', "vehicle_type", $asData);
        $this->assertObjectHasAttribute('vehicle_type', $asData);
        $this->assertEquals('gas', $asData->vehicle_type);
    }

    /**
     * Function to test insert data
     */
    public function testInsertData() {

        /**
         * Test with empty array
         */
        $asFeedData = array();
        $id = $this->obModel->insertData($asFeedData);

        $this->assertFalse($id);

        /**
         * Test with valid data
         */
        $asFeedData = array('id_user' => 32, 'company' => 'Honda', 'model' => 'Civic', 'model_year' => '2018', 'vehicle_type' => 'electric', 'licence_plate' => "ZZZ454");
        $id = $this->obModel->insertData($asFeedData);
        $this->assertTrue(is_integer($id));
    }

    /**
     * Function to test insert data
     */
    public function testUpdateById() {

        /**
         * Test with empty array
         */
        $asFeedData = array();
        $asData = $this->obModel->updateById();

        $this->assertFalse($asData);

        /**
         * Test with valid id  and empty data array
         */
        $asData = $this->obModel->updateById(13, $asFeedData);
        $this->assertFalse($asData);
        /**
         * Test with blank id and valid data
         */
        $asFeedData = array('id_user' => 32, 'company' => 'Honda', 'model' => 'Civic', 'model_year' => '2018', 'vehicle_type' => 'gas', 'licence_plate' => "ZZZ454");
        $asData = $this->obModel->updateById('', $asFeedData);
        $this->assertFalse($asData);


        /**
         * Test with valid id and  valid data
         */
        $asFeedData = array('id_user' => 32, 'company' => 'Honda', 'model' => 'Civic', 'model_year' => '2018', 'vehicle_type' => 'electric', 'licence_plate' => "ZZZ454");
        $asData = $this->obModel->updateById(14, $asFeedData);
        $this->assertNull($asData);
    }

    /**
     * Function to test deleteById
     */
    public function testDeleteById() {
        //test with empty id 
        $asData1 = $this->obModel->deleteById();
        $this->assertFalse($asData1);

        //test with numeric and valid value
        $asData2 = $this->obModel->deleteById(16);
        $this->assertEquals($asData2, 0);
    }

    /**
     * Function to test parameterizeData
     */
    public function testParameterizeData() {
        /**
         * Test with an empty array
         */
        $asFeedData = array();
        $asData1 = $this->obModel->parameterizeData();
        $this->assertEmpty($asData1);
        $this->assertTrue(is_string($asData1));

        $ssExpectedStr = "id_user=:id_user,company=:company,model=:model,model_year=:model_year,vehicle_type=:vehicle_type,licence_plate=:licence_plate";

        /**
         * Test with valid array 
         */
        $asFeedData = array('id_user' => 32, 'company' => 'Honda', 'model' => 'Civic', 'model_year' => '2018', 'vehicle_type' => 'electric', 'licence_plate' => "ZZZ454");
        $asData2 = $this->obModel->parameterizeData($asFeedData);


        $this->assertTrue(is_string($asData2));
        $this->assertStringStartsWith("id_user", $asData2);
        $this->assertStringMatchesFormat($ssExpectedStr, $asData2);
    }

    /**
     * Function to test ParameterizeForInsert
     */
    public function testParameterizeForInsert() {
        /**
         * Test with an empty array
         */
        $asFeedData = array();
        $asData1 = $this->obModel->parameterizeDataForInsert();
        $this->assertEmpty($asData1);
        $this->assertTrue(is_string($asData1));

        $ssExpectedStr = ":id_user,:company,:model,:model_year,:vehicle_type,:licence_plate";

        /**
         * Test with valid array 
         */
        $asFeedData = array('id_user' => 32, 'company' => 'Honda', 'model' => 'Civic', 'model_year' => '2018', 'vehicle_type' => 'electric', 'licence_plate' => "ZZZ454");
        $asData2 = $this->obModel->parameterizeDataForInsert($asFeedData);

        $this->assertTrue(is_string($asData2));
        $this->assertStringStartsWith(":id_user", $asData2);
        $this->assertStringMatchesFormat($ssExpectedStr, $asData2);
    }

    /**
     * Function to test MapPostFields
     */
    public function testMapPostFields() {
        /**
         * Test with an empty array
         */
        $asFeedData = array();
        $asData1 = $this->obModel->mapPostFields();
        $this->assertEmpty($asData1);
        $this->assertTrue(is_array($asData1));

        $ssExpectedArray = array('id_user' => 32, 'company' => 'Honda', 'model' => 'Civic', 'model_year' => '2018', 'vehicle_type' => 'electric', 'licence_plate' => "ZZZ454", 'color' => '', 'vin_no' => '', 'transmission' => '', 'body_type' => '', 'last_odometer' => '');


        /**
         * Test with valid array 
         */
        $asFeedData = array('id_user' => 32, 'company' => 'Honda', 'model' => 'Civic', 'model_year' => '2018', 'vehicle_type' => 'electric', 'licence_plate' => "ZZZ454");

        $asData2 = $this->obModel->mapPostFields($asFeedData);

        $this->assertArrayHasKey('company', $asData2);
        $this->assertTrue(is_array($asData2));
    }

    /**
     * Function to test getcount
     */
    public function testGetCount() {
        //test with empty values 
        $asData1 = $this->obModel->getCount();

        $this->assertNull($asData1);

        $asData2 = $this->obModel->getCount('vehicle_type', '');
        $this->assertNull($asData2);

        $asData3 = $this->obModel->getCount('', 'gas');
        $this->assertNull($asData3);


        /**
         * *  test with valid values with only one record
         */
        $asData4 = $this->obModel->getCount('vehicle_type', 'electric');

        $this->assertEquals(16, $asData4);
        $this->assertTrue(is_integer($asData4));


        /**
         *  test with valid values with all possible records found
         */
        $asData5 = $this->obModel->getCount('vehicle_type', 'gas', 1);
        $this->assertEquals(1, $asData5);
        $this->assertTrue(is_integer($asData5));
    }

    /**
     * Function to test validateMintainanceType
     */
    public function testValidateMintainanceType() {
        //test with empty id 
        $asData1 = $this->obModel->validateMintainanceType();
        $this->assertFalse($asData1);
        // test with string value
        $asData2 = $this->obModel->validateMintainanceType("teeet");

        $this->assertArrayNotHasKey(0, $asData2);
        $this->assertCount(0, $asData2); // Total records = 0 
        //test with numeric and valid value
        $asData3 = $this->obModel->validateMintainanceType(13);
        $this->assertAttributeEquals('gas', "vehicle_type", $asData3);
        $this->assertAttributeNotEquals('admin12', "vehicle_type", $asData3);
        $this->assertObjectHasAttribute('vehicle_type', $asData3);
    }

}
