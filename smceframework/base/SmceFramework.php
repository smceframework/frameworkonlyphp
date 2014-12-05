<?php

namespace Smce\Base;

use Smce\Extension\SmTracy;
use Smce\SmAutoload;
use Tracy\Debugger;

class SmceFramework
{
	private static $smBase;
	
	private static $configSmce;
	
	/**
	 *
	 * @param $config
	 *
	 * @return new SmBase
	 */
	 
    public static function createWebApplication($config)
    {
		static::includeFile();
		
		static::SmAutoload($config);
		
		static::SmTrancy($config);
		
		static::appConfig($config);
		
		static::smceConfig($config);
		
		return self::$smBase;
    }
	
	
	private static function includeFile()
	{
		if(file_exists(SMCE_PATH.'/vendor/autoload.php'))
        	require_once SMCE_PATH.'/vendor/autoload.php';
			
        require SMCE_PATH."/SmAutoload.php";
		self::$configSmce=require SMCE_PATH."/config/config.php";
	}
	
	/**
	 *
	 * @param $config
	 *
	 */
	
	private static function SmAutoload($config)
	{
		$SmAutoload = new SmAutoload;
		$SmAutoload->register($config);
	}
	
	/**
	 *
	 * @param $config
	 *
	 */
	
	private static function SmTrancy($config)
	{
		$SmTracy = new SmTracy;
		$SmTracy->register();
		
		$debug=Debugger::PRODUCTION;
		if(isset($config["debug"]) && $config["debug"]==true)
			$debug=Debugger::DEVELOPMENT;
			
		if(!file_exists(BASE_PATH . '/log'))
			mkdir(BASE_PATH . '/log');
			
		 Debugger::enable($debug, BASE_PATH . '/log');
	}
	
	/**
	 *
	 * @param $config
	 *
	 */
	
	private static function appConfig($config)
	{
		//Application Config
		self::$smBase=new SmBase;
        SmBase::$config=$config;
	}
	
	/**
	 *
	 * @param $config
	 *
	 */
	
	private static function smceConfig($config)
	{
		//SmceFramework Config
		SmBase::$configSmce=$configSmce;
	}
	
	
	
	
	
	
}
