<?php

// use SmceFramework
use Smce\Base\SmceFramework;

// include app config class
require_once dirname(__FILE__).'/config.php';

// include smce base class
require_once $smce_path.'/SmceBase.php';

// createWebApplication and run
SmceFramework::createWebApplication();
