<?php

namespace smce\base;

use Tracy\Debugger;

class SmceFramework
{
    public static function createWebApplication($config)
    {
        
        require SMCE_PATH."/SmAutoload.php";
		$SmAutoload=new \smce\SmAutoload;
		$SmAutoload->register($config);
		
		if(isset($config["debug"]) && $config["debug"]==true){
			require SMCE_PATH."/SmTracy/SmTracy.php";
			Debugger::enable();
		}
		
        require SMCE_PATH."/base/SmBase.php";
		
		$SmBase=new \smce\base\SmBase;
        \smce\base\SmBase::$config=$config;
		
        return $SmBase;
    }
	
}
