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
use Tracy\Debugger;

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
		self::includeFile();
		
		self::SmAutoload($config);
		
		
		if(isset($config["debug"]) && $config["debug"]!=false)
		{

			self::SmTrancy($config);
			
		}
		
		self::appConfig($config);
		
		$smBase=new SmBase;
		$smBase->run();
		
		
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
		$SmTracy = new SmTracy;
		$SmTracy->register();
		
		if($config["debug"]=="DEVELOPMENT")
			$config=Debugger::DEVELOPMENT;
		elseif($config["debug"]=="PRODUCTION")
			$config=Debugger::PRODUCTION;
		elseif($config["debug"]=="DETECT")
			$config=Debugger::DETECT;
		else
			$config=Debugger::DEVELOPMENT;
			
		if(!file_exists(BASE_PATH . '/log'))
			mkdir(BASE_PATH . '/log');
			
		 Debugger::enable($config, BASE_PATH . '/log');
		
	}
	

	/**
	 *
	 * @param $config
	 *
	 */
	
	
	private static function appConfig($config)
	{
        
		SmBase::$config=$config;
    
	}
	
	
	
	
}
