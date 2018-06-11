Installation
-------------------------------------
Unit test installation steps


1. Create composer.json in to root directory.
2. Add following script into composer.json
{
    "require": {
    },
    "require-dev": {
        "phpunit/phpunit": "3.7.14"
    },
    "autoload": {
        "psr-0": {
            "API": ""
        }
    }
}

3. Open command prompt or windows power shell and go to project root directory (eg. c://xampp/htdocs/amt/).
4. now run command "composer install".


---------------------------------------------
run unit test 

- Go to project root directory : /amt
- Run command like : phpunit Test\API\lib\function_test.php

- lib/functions.php
    - function_test.php :  phpunit \amt\Tests\API\lib\function_test.php
- models
    - auth_test.php :  phpunit \amt\Tests\API\models\auth_test.php
    - maintainance_model_test.php :  phpunit \amt\Tests\API\models\maintainance_model_test.php
    - user_model_test.php :  phpunit \amt\Tests\API\models\user_model_test.php
    - vehicle_model_test.php :  phpunit \amt\Tests\API\models\vehicle_model_test.php



