<?php

require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../../../API/models/user_model.php';

/**
 * Usrer model test cases 
 *
 * @author Hardikkumar Patel <hpca1644@gmail.com>
 */
class User_model_test extends \PHPUnit_Framework_TestCase {

    private $obModel;
    private $ssTableName= 'user';

    /**
     * Initialize an object
     */
    public function setUp() {
        $this->obModel = new User_model();
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
        $this->assertEquals('user', $this->ssTableName, "Table name is " . $this->ssTableName);
        $this->assertNotEquals('test', $this->ssTableName, " \" test \"Table name is not equals to defined" . $this->ssTableName);
    }

    /**
     * Function to test getall method
     */
    public function testGetAll() {
        $asData = $this->obModel->getAll();
        $obData = $asData[0];
        $this->assertArrayHasKey(0, $asData);
        $this->assertAttributeEquals('admin', "user_type", $obData);
        $this->assertAttributeNotEquals('admin12', "user_type", $obData);
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
        $asData3 = $this->obModel->getById(32);
        $this->assertAttributeEquals('admin', "user_type", $asData3);
        $this->assertAttributeNotEquals('admin12', "user_type", $asData3);
        $this->assertObjectHasAttribute('user_type', $asData3);
    }

    /**
     * Function to test GetByField
     */
    public function testGetByField() {
        //test with empty values 
        $asData1 = $this->obModel->GetByField();
        $this->assertFalse($asData1);

        $asData2 = $this->obModel->GetByField('email', '');
        $this->assertFalse($asData2);

        $asData3 = $this->obModel->GetByField('', 'hpca1644@gmail.com');
        $this->assertFalse($asData3);



        /**
         * *  test with valid values with only one record
         */
        $asData4 = $this->obModel->GetByField('email', 'hpca1644@gmail.com');

        $this->assertAttributeEquals('admin', "user_type", $asData4);
        $this->assertAttributeNotEquals('admin12', "user_type", $asData4);
        $this->assertObjectHasAttribute('user_type', $asData4);


        /**
         *  test with valid values with all possible records found
         */
        $asData5 = $this->obModel->GetByField('email', 'hpca1644122213213@gmail.com', 1);
        $this->assertCount(3, $asData5); // Total records = 3 
        $asData = $asData5[0];
        $this->assertAttributeEquals('admin', "user_type", $asData);
        $this->assertAttributeNotEquals('admin12', "user_type", $asData);
        $this->assertObjectHasAttribute('user_type', $asData);
        $this->assertEquals('hpca1644122213213@gmail.com', $asData->email);
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
        $asFeedData = array('user_type' => 'admin', 'first_name' => 'Entered By phpunit', 'last_name' => 'Entered by phpunit', 'email' => 'phpunit@php.com', 'password' => 'test123');
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
        $asData = $this->obModel->updateById(49, $asFeedData);
        $this->assertFalse($asData);
        /**
         * Test with blank id and valid data
         */
        $asFeedData = array('user_type' => 'admin', 'first_name' => 'Updated By phpunit', 'last_name' => 'Updated by phpunit', 'email' => 'Updatedphpunit@php.com');
        $asData = $this->obModel->updateById('', $asFeedData);
        $this->assertFalse($asData);


        /**
         * Test with valid id and  valid data
         */
        $asFeedData = array('user_type' => 'customer', 'first_name' => 'Updated  By phpunit', 'last_name' => 'Updated by phpunit', 'email' => 'Updatedphpunit@php.com');
        $asData = $this->obModel->updateById(49, $asFeedData);
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
        $asData2 = $this->obModel->deleteById(50);
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

        $ssExpectedStr = "user_type=:user_type,first_name=:first_name,last_name=:last_name,email=:email";

        /**
         * Test with valid array 
         */
        $asFeedData = array('user_type' => 'customer', 'first_name' => 'parameterized first_name', 'last_name' => 'parameterized last_name', 'email' => 'Updatedphpunit@php.com');
        $asData2 = $this->obModel->parameterizeData($asFeedData);

        $this->assertTrue(is_string($asData2));
        $this->assertStringStartsWith("user_type", $asData2);
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

        $ssExpectedStr = ":user_type,:first_name,:last_name,:email";

        /**
         * Test with valid array 
         */
        $asFeedData = array('user_type' => 'customer', 'first_name' => 'parameterized first_name', 'last_name' => 'parameterized last_name', 'email' => 'Updatedphpunit@php.com');
        $asData2 = $this->obModel->parameterizeDataForInsert($asFeedData);

        $this->assertTrue(is_string($asData2));
        $this->assertStringStartsWith(":user_type", $asData2);
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

        $ssExpectedArray = array('user_type' => 'customer', 'first_name' => 'parameterized first_name', 'last_name' => 'parameterized last_name', 'email' => 'Updatedphpunit@php.com', 'password' => '', 'salt' => '');


        /**
         * Test with valid array 
         */
        $asFeedData = array('user_type' => 'customer', 'first_name' => 'parameterized first_name', 'last_name' => 'parameterized last_name', 'email' => 'Updatedphpunit@php.com');

        $asData2 = $this->obModel->mapPostFields($asFeedData);
        $this->assertArrayHasKey('user_type', $asData2);
        $this->assertTrue(is_array($asData2));
    }

    /**
     * Function to test getcount
     */
    public function testGetCount() {
        //test with empty values 
        $asData1 = $this->obModel->getCount();

        $this->assertNull($asData1);

        $asData2 = $this->obModel->getCount('email', '');
        $this->assertNull($asData2);

        $asData3 = $this->obModel->getCount('', 'hpca1644@gmail.com');
        $this->assertNull($asData3);


        /**
         * *  test with valid values with only one record
         */
        $asData4 = $this->obModel->getCount('email', 'hpca1644@gmail.com');

        $this->assertEquals(1, $asData4);
        $this->assertTrue(is_integer($asData4));


        /**
         *  test with valid values with all possible records found
         */
        $asData5 = $this->obModel->getCount('email', 'hpca1644122213213@gmail.com', 1);
        $this->assertEquals(3, $asData5);
        $this->assertTrue(is_integer($asData5));
    }

    /**
     * Function to test isUnique
     */
    public function testisUnique() {
        //test with empty values 
        $asData1 = $this->obModel->isUnique();

        $this->assertNull($asData1);

        $asData2 = $this->obModel->isUnique('email', '');
        $this->assertNull($asData2);

        $asData3 = $this->obModel->isUnique('', 'hpca1644@gmail.com');
        $this->assertNull($asData3);

        /**
         * *  test with valid values with only one record
         */
        $asData4 = $this->obModel->isUnique('email', 'hpca1644@gmail.com');

        $this->assertAttributeEquals('admin', "user_type", $asData4);
        $this->assertAttributeNotEquals('admin12', "user_type", $asData4);
        $this->assertObjectHasAttribute('user_type', $asData4);


        /**
         *  test with valid values with all possible records found
         */
        $asData5 = $this->obModel->isUnique('email', 'hpca1644122213213@gmail.com', 1);
        $this->assertCount(3, $asData5); // Total records = 3
        $asData = $asData5[0];
        $this->assertAttributeEquals('admin', "user_type", $asData);
        $this->assertAttributeNotEquals('admin12', "user_type", $asData);
        $this->assertObjectHasAttribute('user_type', $asData);
        $this->assertEquals('hpca1644122213213@gmail.com', $asData->email);
    }

}
