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
		$SmAutoload=new \smce\SmAutoload;
		$SmAutoload->register($config);
		
		if(isset($config["debug"]) && $config["debug"]==true){
			SmTracy::register();
			Debugger::enable();
		}
		
		$SmBase=new SmBase;
        SmBase::$config=$config;
		
        return $SmBase;
    }
	
}
