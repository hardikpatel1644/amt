<?php

require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../../../API/models/maintenance_model.php';

/**
 * Maintenance model test cases 
 *
 * @author Hardikkumar Patel <hpca1644@gmail.com>
 */
class Maintenance_model_test extends \PHPUnit_Framework_TestCase {

    private $obModel;
    private $ssTableName = 'maintenance';

    /**
     * Initialize an object
     */
    public function setUp() {
        $this->obModel = new Maintenance_model();
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
        $this->assertEquals('maintenance', $this->ssTableName, "Table name is " . $this->ssTableName);
        $this->assertNotEquals('test', $this->ssTableName, " \" test \"Table name is not equals to defined" . $this->ssTableName);
    }

    /**
     * Function to test getall method
     */
    public function testGetAll() {
        $asData = $this->obModel->getAll();
        $obData = $asData[0];
        $this->assertArrayHasKey(0, $asData);
        $this->assertAttributeEquals('oil_change', "maintenance_name", $obData);
        $this->assertAttributeNotEquals('admin12', "maintenance_name", $obData);
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
        $asData3 = $this->obModel->getById(14);
        $this->assertAttributeEquals('oil_change', "maintenance_name", $asData3);
        $this->assertAttributeNotEquals('admin12', "maintenance_name", $asData3);
        $this->assertObjectHasAttribute('maintenance_name', $asData3);
    }

    /**
     * Function to test GetByField
     */
    public function testGetByField() {
        //test with empty values 
        $asData1 = $this->obModel->GetByField();
        $this->assertFalse($asData1);

        $asData2 = $this->obModel->GetByField('maintenance_name', '');
        $this->assertFalse($asData2);

        $asData3 = $this->obModel->GetByField('', 'oil_change');
        $this->assertFalse($asData3);



        /**
         * *  test with valid values with only one record
         */
        $asData4 = $this->obModel->GetByField('maintenance_name', 'oil_change');

        $this->assertAttributeEquals('oil_change', "maintenance_name", $asData4);
        $this->assertAttributeNotEquals('admin12', "maintenance_name", $asData4);
        $this->assertObjectHasAttribute('maintenance_name', $asData4);


        /**
         *  test with valid values with all possible records found
         */
        $asData5 = $this->obModel->GetByField('maintenance_name', 'oil_change', 1);
        $this->assertCount(1, $asData5); // Total records = 3 
        $asData = $asData5[0];
        $this->assertAttributeEquals('oil_change', "maintenance_name", $asData);
        $this->assertAttributeNotEquals('admin12', "maintenance_name", $asData);
        $this->assertObjectHasAttribute('maintenance_name', $asData);
        $this->assertEquals('oil_change', $asData->maintenance_name);
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
        $asFeedData = array('id_vehicle' => 13, 'maintenance_name' => 'tire_rotation', 'cost' => 1000, 'description' => 'Tire Rotation');
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
        $asData = $this->obModel->updateById(14, $asFeedData);
        $this->assertFalse($asData);
        /**
         * Test with blank id and valid data
         */
        $asFeedData = array('id_vehicle' => 13, 'maintenance_name' => 'tire_rotation', 'cost' => 1000, 'description' => 'Tire Rotation');
        $asData = $this->obModel->updateById('', $asFeedData);
        $this->assertFalse($asData);


        /**
         * Test with valid id and  valid data
         */
        $asFeedData = array('id_vehicle' => 13, 'maintenance_name' => 'tire_rotation', 'cost' => 1000, 'description' => 'Tire Rotation');
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
        $asData2 = $this->obModel->deleteById(18);
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

        $ssExpectedStr = "id_vehicle=:id_vehicle,maintenance_name=:maintenance_name,cost=:cost,description=:description";

        /**
         * Test with valid array 
         */
        $asFeedData = array('id_vehicle' => 13, 'maintenance_name' => 'tire_rotation', 'cost' => 1000, 'description' => 'Tire Rotation');
        $asData2 = $this->obModel->parameterizeData($asFeedData);

        $this->assertTrue(is_string($asData2));
        $this->assertStringStartsWith("id_vehicle", $asData2);
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

        $ssExpectedStr = ":id_vehicle,:maintenance_name,:cost,:description";

        /**
         * Test with valid array 
         */
        $asFeedData = array('id_vehicle' => 13, 'maintenance_name' => 'tire_rotation', 'cost' => 1000, 'description' => 'Tire Rotation');
        $asData2 = $this->obModel->parameterizeDataForInsert($asFeedData);

        $this->assertTrue(is_string($asData2));
        $this->assertStringStartsWith(":id_vehicle", $asData2);
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

        $ssExpectedArray = array('id_vehicle' => 13, 'maintenance_name' => 'tire_rotation', 'cost' => 1000, 'description' => 'Tire Rotation');


        /**
         * Test with valid array 
         */
        $asFeedData = $asFeedData = array('id_vehicle' => 13, 'maintenance_name' => 'tire_rotation', 'cost' => 1000, 'description' => 'Tire Rotation');

        $asData2 = $this->obModel->mapPostFields($asFeedData);
        $this->assertArrayHasKey('id_vehicle', $asData2);
        $this->assertTrue(is_array($asData2));
    }

    /**
     * Function to test getcount
     */
    public function testGetCount() {
        //test with empty values 
        $asData1 = $this->obModel->getCount();

        $this->assertNull($asData1);

        $asData2 = $this->obModel->getCount('maintenance_name', '');
        $this->assertNull($asData2);

        $asData3 = $this->obModel->getCount('', 'tire_rotation');
        $this->assertNull($asData3);


        /**
         * *  test with valid values with only one record
         */
        $asData4 = $this->obModel->getCount('maintenance_name', 'oil_change');

        $this->assertEquals(1, $asData4);
        $this->assertTrue(is_integer($asData4));


        /**
         *  test with valid values with all possible records found
         */
        $asData5 = $this->obModel->getCount('maintenance_name', 'oil_change', 1);
        $this->assertEquals(1, $asData5);
        $this->assertTrue(is_integer($asData5));
    }

}
