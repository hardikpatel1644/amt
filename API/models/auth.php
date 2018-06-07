<?php

include_once __DIR__ . '/user_model.php';

/**
 * Authentication class
 *
 * @author Hardikkumar Patel <hpca1644@gmail.com>
 */
class Auth extends User_model {

    public $ssEmail;
    public $ssPassword;
    public $asUserData;

    public function __construct() {

        parent::__construct();
        $this->validateToken();
    }

    /**
     * Function to check login for user
     * @param type $ssEmail
     * @param type $ssPassword
     * @return boolean
     */
    public function validateLogin($ssEmail, $ssPassword) {
        if ($ssEmail != '' && $ssPassword != "") {
            $ssToken = "";
            $asUser = $this->getByField('email', $ssEmail);
            $asPasswordHash = $this->generatePasswordHash($ssEmail, $ssPassword);
            if ($asUser->password == $asPasswordHash['password']) {
                $ssToken = $this->setToken($asUser->id);
                $_SESSION['TOKEN'] = $ssToken;
            }
            return $ssToken;
        }
        return false;
    }

    /**
     * Function to set token after validate login
     * @param int $id
     * @return string / boolean
     */
    public function setToken($id) {
        if ($id != '') {
            $ssToken = $this->generateToken();
            $asToken['token'] = $ssToken;
            $this->updateById($id, $asToken);
            return $ssToken;
        }
        return false;
    }

    /**
     * Function to generate token
     * @return string
     */
    public function generateToken() {
        return $ssToken = md5(TOKEN_SECRET . rand());
    }

    /**
     * Function to get Token 
     * @return string
     */
    public function getToken() {
        $headers = apache_request_headers();
        if (isset($headers['TOKEN']) && $headers['TOKEN'] != '') {
            return $headers['TOKEN'];
        } else
            return false;
    }

    /**
     * Validate Token 
     * @return boolean
     */
    public function validateToken() {
        $ssToken = $this->getToken();

        if ($ssToken != '') {
            $asUser = $this->getByField('token', $ssToken);
            if (count($asUser) > 0) {
                if ($asUser->token == $ssToken) {
                    return true;
                } else {
                    echo parseJson(array("error" => true, "message" => "Invalid token.Please login with valid credentials."));
                    exit;
                }
            }
        }
        return false;
    }

    /**
     * Generate password and salt hash
     * @param string $ssEmail
     * @param string $ssPassword
     * @return array
     */
    public function generatePasswordHash($ssEmail, $ssPassword) {
        $asHash = array();
        if ($ssEmail != '' && $ssPassword != "") {
            $ssSalt = md5($ssEmail . PASSWORD_SECRET);
            $ssGeneratedPassword = sha1($ssPassword . $ssSalt);
            $asHash['salt'] = $ssSalt;
            $asHash['password'] = $ssGeneratedPassword;
        }
        return $asHash;
    }

}
