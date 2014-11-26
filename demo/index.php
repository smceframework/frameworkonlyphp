<?php



ini_set('display_errors', 'On');
error_reporting(E_ALL);


date_default_timezone_set('Europe/Istanbul');

define('BASE_PATH',dirname(__FILE__));

$config=require "config/config.php";

$smce=dirname(__FILE__).'/../smceframework/smceBase.php';

require_once $smce;
Smce\Base\SmceFramework::createWebApplication($config)->run();
