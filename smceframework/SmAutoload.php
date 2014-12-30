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
		$classMap=self::classMap();
		
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
	 * autoload register
	 * 
	 * @param $config
	 */
	
	public function register($config=array()){
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
	 * class map
	 * 
	 * @return array
	 */
	
	
	private static function classMap(){
		return array(

			//Core
			"Smce\Core\SmException"=>SMCE_PATH."/core/SmException.php",
			"Smce\Core\SmHttpException"=>SMCE_PATH."/core/SmHttpException.php",
			"Smce\Core\SmAssetsManager"=>SMCE_PATH."/core/SmAssetsManager/SmAssetsManager.php",
			"Smce\Core\SmTempManager"=>SMCE_PATH."/core/SmTempManager.php",
			"Smce\Core\SmController"=>SMCE_PATH."/core/SmController.php",
			"Smce\Core\SmFormModel"=>SMCE_PATH."/core/SmFormModel.php",
			"Smce\Core\SmUserIdentity"=>SMCE_PATH."/core/SmUserIdentity.php",
			"Smce\Core\SmACL"=>SMCE_PATH."/core/SmACL.php",
			"Smce\Core\SmUser"=>SMCE_PATH."/core/SmUser.php",
			"Smce\Core\SmLayout"=>SMCE_PATH."/core/SmLayout.php",
			"Smce\Core\SmModel"=>SMCE_PATH."/core/SmModel.php",
			"Smce\Core\SmUrlManager"=>SMCE_PATH."/core/SmUrlManager.php",
			"Smce\Core\SmActiveRecord"=>SMCE_PATH."/core/SmActiveRecord/SmActiveRecord.php",
			"Smce\Core\SmActiveEvent"=>SMCE_PATH."/core/SmActiveRecord/SmActiveEvent.php",
			"Smce\Core\SmPagination"=>SMCE_PATH."/core/SmPagination/SmPagination.php",
			"Smce\Core\SmSSH"=>SMCE_PATH."/core/SmSSH/SmSSH.php",
			"Smce\Core\SmSFTP"=>SMCE_PATH."/core/SmSSH/SmSFTP.php",
			"Smce\Core\SmMemCache"=>SMCE_PATH."/core/SmMemCache.php",
			"Smce\Core\SmRedis"=>SMCE_PATH."/core/SmRedis.php",
			"Smce\Core\SmMigration"=>SMCE_PATH."/core/SmMigration/SmMigration.php",
			"Smce\Core\SmMigrationForge"=>SMCE_PATH."/core/SmMigration/SmMigrationForge.php",
			"Smce\Core\SmConsole"=>SMCE_PATH."/core/SmConsole.php",
			"Smce\Core\SmGrud"=>SMCE_PATH."/core/SmGrud/SmGrud.php",
			"Smce\Core\SmForm"=>SMCE_PATH."/core/SmForm/SmForm.php",
			"Smce\Core\SmFormField"=>SMCE_PATH."/core/SmForm/SmFormField.php",
			"Smce\Core\SmTemplate"=>SMCE_PATH."/core/SmTemplate/SmTemplate.php",
			"Smce\Core\SmGump"=>SMCE_PATH."/core/SmGump/SmGump.php",
			"Smce\Core\SmUrlRouter"=>SMCE_PATH."/core/SmUrlRouter/SmUrlRouter.php",
			"Smce\Core\SmFiletozip"=>SMCE_PATH."/core/SmFiletozip/SmFiletozip.php",
			"Smce\Core\SmOutput"=>SMCE_PATH."/core/SmOutput/SmOutput.php",
			"Smce\Core\SmHelper"=>SMCE_PATH."/core/SmHelper/SmHelper.php",
			"Smce\Core\SmDbCriteria"=>SMCE_PATH."/core/SmDbCriteria.php",
			
			//base
			"Smce\Base\SmBase"=>SMCE_PATH."/base/SmBase.php",
			"Smce\Base\SmceFramework"=>SMCE_PATH."/base/SmceFramework.php",
			
			//extension
			"Smce\Extension\SmTracy"=>SMCE_PATH."/extension/SmTracy/SmTracy.php",
			"Smce\Extension\SmUserAgent"=>SMCE_PATH."/extension/SmUserAgent/SmUserAgent.php",
			"Smce\Extension\SmUserAgentStringParser"=>SMCE_PATH."/extension/SmUserAgent/SmUserAgentStringParser.php",
			
			//amp
			"Smce\Amp\SMUserIdentityImp"=>SMCE_PATH."/amp/SMUserIdentityImp.php",
			
			
			//widget
			"Smce\Widget\SmDetailView"=>SMCE_PATH."/widget/SmDetailView/SmDetailView.php",
			"Smce\Widget\SmBreadcrumbs"=>SMCE_PATH."/widget/SmBreadcrumbs/SmBreadcrumbs.php",
		);
	}
	
	
	
}
