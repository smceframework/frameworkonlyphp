<?php

namespace Smce\Base;

use Smce\Extension\SmTracy;
use Smce\SmAutoload;
use Tracy\Debugger;

class SmceFramework
{
    public static function createWebApplication($config)
    {
		if(file_exists(SMCE_PATH.'/vendor/autoload.php'))
        	require_once SMCE_PATH.'/vendor/autoload.php';
			
        require SMCE_PATH."/SmAutoload.php";
		$SmAutoload = new SmAutoload;
		$SmAutoload->register($config);
		
		$SmTracy = new SmTracy;
		$SmTracy->register();
		
		$debug=Debugger::PRODUCTION;
		if(isset($config["debug"]) && $config["debug"]==true)
			$debug=Debugger::DEVELOPMENT;
			
		if(!file_exists(BASE_PATH . '/log'))
			mkdir(BASE_PATH . '/log');
	
		Debugger::enable($debug, BASE_PATH . '/log');
			
		//App Config
		$SmBase=new SmBase;
        SmBase::$config=$config;
		
		//Smce Config
		$configSmce=require SMCE_PATH."/config/config.php";
		SmBase::$configSmce=$configSmce;
        return $SmBase;
    }
	
}
