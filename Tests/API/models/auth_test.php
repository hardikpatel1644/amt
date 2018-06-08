<?php

require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../../../API/models/auth.php';

/**
 * Auth test cases 
 *
 * @author Hardikkumar Patel <hpca1644@gmail.com>
 */
class Auth_test extends \PHPUnit_Framework_TestCase {

    private $obModel;

    /**
     * Initialize an object
     */
    public function setUp() {
        $this->obModel = new Auth();
    }

    /**
     * Initialize an object
     */
    public function tearDown() {
        $this->obModel = null;
    }

    /**
     * Function to test validateLogin
     */
    public function testValidateLogin() {
        $this->obModel->validateLogin();
        //test with empty values 
        //test with empty values 
        $asData1 = $this->obModel->validateLogin();
        $this->assertFalse($asData1);

        $asData2 = $this->obModel->validateLogin('hpca164412@gmail.com', '');
        $this->assertFalse($asData2);

        $asData3 = $this->obModel->validateLogin('', 'test123');
        $this->assertFalse($asData3);



        /**
         * *  test with valid values with only one record
         */
        $asData4 = $this->obModel->validateLogin('hpca1644@gmail.com', 'test123');

        $this->assertTrue(is_string($asData4));
        $this->assertNotEmpty($asData4);
    }

    /**
     * Function to test setToken
     */
    public function testSetToken() {
        $asData1 = $this->obModel->setToken();
        $this->assertFalse($asData1);

        //test with numeric and valid value
        $asData2 = $this->obModel->setToken(34);
        $this->assertTrue(is_string($asData2));
        $this->assertNotEmpty($asData2);
    }

    /**
     * Function to test generateToken
     */
    public function testGenerateToken() {
        $asData1 = $this->obModel->generateToken();

        $this->assertTrue(is_string($asData1));
        $this->assertNotEmpty($asData1);
    }

    /**
     * Function to test generatePasswordHash
     */
    public function testGeneratePasswordHash() {
        $this->obModel->generatePasswordHash();
        //test with empty values 
        //test with empty values 
        $asData1 = $this->obModel->generatePasswordHash();
        $this->assertTrue(is_array($asData1));

        $asData2 = $this->obModel->generatePasswordHash('hpca164412@gmail.com', '');
        $this->assertTrue(is_array($asData2));

        $asData3 = $this->obModel->generatePasswordHash('', 'test123');
        $this->assertTrue(is_array($asData3));



        /**
         * *  test with valid values with only one record
         */
        $asData4 = $this->obModel->generatePasswordHash('hpca1644@gmail.com', 'test123');

        $this->assertTrue(is_array($asData4));
        $this->assertNotEmpty($asData4);
        $this->assertArrayHasKey('password', $asData4);
        $this->assertArrayHasKey('salt', $asData4);
    }

}
