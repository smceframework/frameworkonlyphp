<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
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
	 
    public static function createWebApplication($config=array())
    {
		static::includeFile();
		
		static::SmAutoload($config);
		
		
		if(isset($config["debug"]) && $config["debug"]!=false)
			static::SmTrancy($config);
		
		static::appConfig($config);
		
		static::smceConfig();
		
		return self::$smBase;
    }
	
	/**
	 *
	 * icludefile
	 *
	 */
	
	
	
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
	
	private static function SmTrancy($debug)
	{
		
		$SmTracy = new SmTracy;
		$SmTracy->register();
		
		if($debug=="DEVELOPMENT")
			$debug=Debugger::DEVELOPMENT;
		elseif($debug=="PRODUCTION")
			$debug=Debugger::PRODUCTION;
		elseif($debug=="DETECT")
			$debug=Debugger::DETECT;
		else
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
	 * smce $config
	 *
	 */
	
	private static function smceConfig()
	{
		//SmceFramework Config
		SmBase::$configSmce=self::$configSmce;
	}
	
	
	
	
	
	
}
