<?php

require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../../../API/lib/functions.php';

/**
 * Functions test cases 
 *
 * @author Hardikkumar Patel <hpca1644@gmail.com>
 */
class function_test extends \PHPUnit_Framework_TestCase {

    /**
     * Function to check cleanInputs with empty array
     */
    public function testCleanInputsWithEmpty() {
        $asData = array();
        $asData = cleanInputs($asData);
        $this->assertEmpty($asData, "Array is empty");
    }

    /**
     * Function to check cleanInputs with valid array
     */
    public function testCleanInputs() {
        $asData = array("email" => "<script>email@email.com</script>", "password" => "<b>test</b>123");
        $asData = cleanInputs($asData);
        $this->assertArrayHasKey('email', $asData); // check key is exist or not 
        $this->assertArrayHasKey('password', $asData); // check key is exist or not 
    }

    /**
     * Check with empty values
     */
    public function testParseJsonWithEmpty() {
        $asData = array();
        $asData = parseJson($asData);
        $this->assertEquals(false, $asData, "Return false while array is black.");
        $this->assertFalse($asData);
    }

    /**
     * Chcek with valid array
     */
    public function testParseJson() {
        $asData = array("email" => "email@email.com", "password" => "test123");
        $asData = parseJson($asData);
        $this->assertEquals($asData, '{"email":"email@email.com","password":"test123"}', "Return Json string.");
        $this->assertEquals($asData, '{"email":email@email.com,password":"test123"}', "Return Json string.");
    }

}
