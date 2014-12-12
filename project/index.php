<?php

// display php errors on screen
ini_set('display_errors', 'On');
error_reporting(E_ALL);

// setting default timezone setting to Europe/Istanbul
date_default_timezone_set('Europe/Istanbul');

// set the base path, ex: /home/smce/public_html
define('BASE_PATH', dirname(__FILE__));

// load configuration settings
$config = require_once dirname(__FILE__).'/main/config/config.php';

// include smce base class
require_once dirname(__FILE__).'/../smceframework/smceBase.php';

// createWebApplication and run
Smce\Base\SmceFramework::createWebApplication($config)->run();