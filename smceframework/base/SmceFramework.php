<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/smceframework
 */
 
namespace Smce\Base;

use Smce\Extension\SmTracy;
use Smce\SmAutoload;
use Tracy\configger;

class SmceFramework
{

	
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
		
		static::SmTrancy($config);
		
		static::appConfig($config);
		
		SmBase::run();
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
		
	}
	
	/**
	 *
	 * @param $config
	 *
	 */
	
	private static function SmAutoload($config)
	{
		$SmAutoload = new SmAutoload;
		$SmAutoload::register($config);
	}
	
	/**
	 *
	 * @param $config
	 *
	 */
	
	private static function SmTrancy($config)
	{
		if(isset($config["config"]) && $config["config"]!=false)
		{
			$SmTracy = new SmTracy;
			$SmTracy->register();
			
			if($config=="DEVELOPMENT")
				$config=configger::DEVELOPMENT;
			elseif($config=="PRODUCTION")
				$config=configger::PRODUCTION;
			elseif($config=="DETECT")
				$config=configger::DETECT;
			else
				$config=configger::DEVELOPMENT;
				
			if(!file_exists(BASE_PATH . '/log'))
				mkdir(BASE_PATH . '/log');
				
			 configger::enable($config, BASE_PATH . '/log');
		}
	}
	
	/**
	 *
	 * @param $config
	 *
	 */
	
	private static function appConfig($config)
	{

		if(!empty($config))
        	SmBase::$config=$config;
        else{
	        //SmceFramework Config
			SmBase::$config=require SMCE_PATH."/config/config.php";
		}
	}
	
	/**
	 *
	 * smce $config
	 *
	 */
	
	private static function smceConfig()
	{
		
	}
	
	
}
