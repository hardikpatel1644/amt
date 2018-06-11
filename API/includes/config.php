<?php

// Constant or common variable for API


define("ROOT", $_SERVER['DOCUMENT_ROOT']);


define("ENVIRONMENT", 1); // 1 = live || 0 = TEST
// Database details
define("DB_HOST", "127.0.0.1"); // Database Host  or ip address
define("DB_USERNAME", "root"); // Database username
define("DB_PASSWORD", ""); // Database Password
if (ENVIRONMENT == 1)
    define("DB_NAME", "amt"); // Database name
else
    define("DB_NAME", "amt_test"); // Database name

define("PASSWORD_SECRET", "AMT_PASSWORD");
define("TOKEN_SECRET", "AMT_TOKEN");


