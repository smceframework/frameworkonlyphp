<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */

namespace Smce;

class SmAutoload
{
	private static $config;
	
	
	/**
	 * @param $className
	 * 
	 * include class
	 */
	
	private static  function autoloadFramework($className)
	{
		$classMap=self::getClassMapAll();
		
		if(isset($classMap[$className]))
		{
			include $classMap[$className];
		}else{
		
			$className = ltrim($className, '\\');
			$parts=explode("\\",$className);
			
			$fileName  = '';
			$namespace = '';
			
				
				if ($lastNsPos = strrpos($className, '\\')) {
					$namespace = substr($className, 0, $lastNsPos);
					$className = substr($className, $lastNsPos + 1);
					$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
					$fileName  = SMCE_PATH.str_replace($parts[0], "", $fileName) ;
					
				}
				$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
				
				if(is_file($fileName))
					require $fileName;
		}
		
	}
	
	/**
	 * @param $className
	 * 
	 * include class
	 */
	
	private static function autoloadApp($className)
	{
		
		$parts = explode('\\', $className);
		if(isset(self::$config["import"])){
			foreach (self::$config["import"] as $key=>$value) {
				if(file_exists(BASE_PATH."/main/".$value."/".$className . '.php'))
					include BASE_PATH."/main/".$value."/".$className . '.php';
			}
		
		}
		
		if(file_exists(BASE_PATH."/main/controller/".$className . '.php'))
			include BASE_PATH."/main/controller/".$className . '.php';
	}
	
	/**
	 * @param $className
	 * 
	 * include class
	 */
	
	private static  function autoloadComposer($className)
	{
		$classMap=self::classMapLib();
		
		if(isset($classMap[$className]))
		{
			include $classMap[$className];
		}
	}
	
	/**
	 * autoload register
	 * 
	 * @param $config
	 */
	
	public function register($config){
		self::$config=$config;
		spl_autoload_register(array($this, 'autoloadFramework'),true,true);
		spl_autoload_register(array($this, 'autoloadApp'),true,true);
	}
	
	/**
	 * composer autoload register
	 * 
	 * 
	 */
	
	public function registerComposer(){
		spl_autoload_register(array($this, 'autoloadComposer'),true,true);
	}
	
	/**
	 * class all map
	 * 
	 * 
	 */
	
	private static function getClassMapAll()
	{
		$clasMap=array();
		$clasMap=array_merge(self::classMap(), self::classMapLib());
		return $clasMap;
	}
	
	/**
	 * class map
	 * 
	 * @return array
	 */
	
	
	private static function classMap(){
		return array(

			//Core
			"Smce\Core\SmException"=>SMCE_PATH."/core/SmException.php",
			"Smce\Core\SmController"=>SMCE_PATH."/core/SmController.php",
			"Smce\Core\SmFormModel"=>SMCE_PATH."/core/SmFormModel.php",
			"Smce\Core\SmUserIdentity"=>SMCE_PATH."/core/SmUserIdentity.php",
			"Smce\Core\SmACL"=>SMCE_PATH."/core/SmACL.php",
			"Smce\Core\SmUser"=>SMCE_PATH."/core/SmUser.php",
			"Smce\Core\SmLayout"=>SMCE_PATH."/core/SmLayout.php",
			"Smce\Core\SmModel"=>SMCE_PATH."/core/SmModel.php",
			"Smce\Core\SmUrlManager"=>SMCE_PATH."/core/SmUrlManager.php",
			"Smce\Core\SmAssetsManager"=>SMCE_PATH."/core/SmAssetsManager/SmAssetsManager.php",
			"Smce\Core\SmActiveRecord"=>SMCE_PATH."/core/SmActiveRecord/SmActiveRecord.php",
			"Smce\Core\SmActiveEvent"=>SMCE_PATH."/core/SmActiveRecord/SmActiveEvent.php",
			"Smce\Core\SmPagination"=>SMCE_PATH."/core/SmPagination/SmPagination.php",
			"Smce\Core\SmSSH"=>SMCE_PATH."/core/SmSSH/SmSSH.php",
			"Smce\Core\SmSFTP"=>SMCE_PATH."/core/SmSSH/SmSFTP.php",
			"Smce\Core\SmMemCache"=>SMCE_PATH."/core/SmMemCache.php",
			"Smce\Core\SmRedis"=>SMCE_PATH."/core/SmRedis.php",
			"Smce\Core\SmMigration"=>SMCE_PATH."/core/SmMigration/SmMigration.php",
			"Smce\Core\SmMigrationForge"=>SMCE_PATH."/core/SmMigration/SmMigrationForge.php",
			
			//base
			"Smce\Base\SmBase"=>SMCE_PATH."/base/SmBase.php",
			"Smce\Base\SmceFramework"=>SMCE_PATH."/base/SmceFramework.php",
			"Smce\Base\SmVe"=>SMCE_PATH."/base/SmVe.php",
			
			//extension
			"Smce\Extension\SmTracy"=>SMCE_PATH."/extension/SmTracy/SmTracy.php",
			"Smce\Extension\SmUserAgent"=>SMCE_PATH."/extension/SmUserAgent/SmUserAgent.php",
			"Smce\Extension\SmUserAgentStringParser"=>SMCE_PATH."/extension/SmUserAgent/SmUserAgentStringParser.php",
			
			//amp
			"Smce\Amp\SMUserIdentityImp"=>SMCE_PATH."/amp/SMUserIdentityImp.php",
			
			
		);
	}
	
	/**
	 * lib class map
	 * 
	 * @return array
	 */
	 
	private static function classMapLib(){
		return array(
			//lib
			"Smce\Lib\SmForm"=>SMCE_PATH."/lib/SmForm/SmForm.php",
			"Smce\Lib\SmFormField"=>SMCE_PATH."/lib/SmForm/SmFormField.php",
			"Smce\Lib\SmTemplate"=>SMCE_PATH."/lib/SmTemplate/SmTemplate.php",
			"Smce\Lib\SmGump"=>SMCE_PATH."/lib/SmGump/SmGump.php",
			"Smce\Lib\SmUrlRouter"=>SMCE_PATH."/lib/SmUrlRouter/SmUrlRouter.php",
			"Smce\Lib\SmFiletozip"=>SMCE_PATH."/lib/SmFiletozip/SmFiletozip.php",
			"Smce\Lib\SmOutput"=>SMCE_PATH."/lib/SmOutput/SmOutput.php",
			"Smce\Lib\SmHelper"=>SMCE_PATH."/lib/SmHelper/SmHelper.php",
			
		);
	}
	
}
