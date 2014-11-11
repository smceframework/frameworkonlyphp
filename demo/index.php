<?php

//error_reporting(E_ALL | E_STRICT);

define('BASE_PATH',dirname(__FILE__));

$config=require "config/config.php";

$SMCE=dirname(__FILE__).'/../smceframework/smceBase.php';

require_once $SMCE;
SmceFramework::createWebApplication($config)->run();
