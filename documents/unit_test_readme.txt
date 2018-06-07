Installation
-------------------------------------
Unit test installation steps


2. Create composer.json in to root directory.
3. Add following script into composer.json
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
  test class path : \amt\Tests\API\lib\function_test.php



