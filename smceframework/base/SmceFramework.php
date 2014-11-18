<?php

namespace Smce\Base;


use Smce\Base\SmBase;
use Smce\Core\SmAccessRulesSmAutoload;
use Smce\Core\SmAccessRulesExtension\SmTracy;
use Tracy\Debugger;

class SmceFramework
{
    public static function createWebApplication($config)
    {
       
        require SMCE_PATH."/SmAutoload.php";
		$SmAutoload=new \Smce\SmAutoload;
		$SmAutoload->register($config);
		
		if(isset($config["debug"]) && $config["debug"]==true){
			$SmTracy=new SmTracy;
			$SmTracy->register();
			Debugger::enable();
		}
		
		//App Config
		$SmBase=new SmBase;
        SmBase::$config=$config;
		
		//Smce Config
		$configSmce=require SMCE_PATH."/config/config.php";
		SmBase::$configSmce=$configSmce;
        return $SmBase;
    }
	
}
