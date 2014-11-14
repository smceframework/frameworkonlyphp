<?php

namespace Smce;

class SmAutoload
{
	private static $config;
	
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
	
	private static function autoloadApp($class_name)
	{
		
		$parts = explode('\\', $class_name);
		if(isset(self::$config["import"])){
			foreach (self::$config["import"] as $key=>$value) {
				if(file_exists(BASE_PATH."/".$value."/".$class_name . '.php'))
					include BASE_PATH."/".$value."/".$class_name . '.php';
			}

			if(file_exists(BASE_PATH."/controller/".$class_name . '.php'))
					include BASE_PATH."/controller/".$class_name . '.php';
		}
	}
	
	
	private static  function autoloadComposer($className)
	{
		$classMap=self::classMapLib();
		
		if(isset($classMap[$className]))
		{
			include $classMap[$className];
		}
	}
	
	public function register($config){
		self::$config=$config;
		spl_autoload_register(array($this, 'autoloadFramework'),true,true);
		spl_autoload_register(array($this, 'autoloadApp'),true,true);
	}
	
	public function registerComposer(){
		spl_autoload_register(array($this, 'autoloadComposer'),true,true);
	}
	
	private static function getClassMapAll()
	{
		$clasMap=array();
		$clasMap=array_merge(self::classMap(), self::classMapLib());
		return $clasMap;
	}
	
	
	private static function classMap(){
		return array(

			//Core
			"Smce\Core\SmController"=>SMCE_PATH."/core/SmController.php",
			"Smce\Core\SmFormModel"=>SMCE_PATH."/core/SmFormModel.php",
			"DB"=>SMCE_PATH."/core/DB.php",
			"Smce\Core\SmUserIdentity"=>SMCE_PATH."/core/SmUserIdentity.php",
			"Smce\Core\SmAccessRules"=>SMCE_PATH."/core/SmAccessRules.php",
			"Smce\Core\SmCli"=>SMCE_PATH."/core/SmCli.php",
			"Smce\Core\SmUser"=>SMCE_PATH."/core/SmUser.php",
			"Smce\Core\SmLayout"=>SMCE_PATH."/core/SmLayout.php",
			
			//base
			"Smce\Base\SmBase"=>SMCE_PATH."/base/SmBase.php",
			"Smce\Base\SmceFramework"=>SMCE_PATH."/base/SmceFramework.php",
			"Smce\Base\SmVe"=>SMCE_PATH."/base/SmVe.php",
			
			//extension
			"Smce\Core\SmAccessRulesExtension\SmTracy"=>SMCE_PATH."/extension/SmTracy/SmTracy.php",
			
			//amp
			"Smce\Amp\SMUserIdentityImp"=>SMCE_PATH."/amp/SMUserIdentityImp.php",
			
			
		);
	}
	
	
	private static function classMapLib(){
		return array(
			//lib
			"Smce\Lib\SmForm"=>SMCE_PATH."/lib/SmForm/SmForm.php",
			"Smce\Lib\SmForm"=>SMCE_PATH."/lib/SmForm/SmFormField.php",
			"Smce\Lib\SmTemplate"=>SMCE_PATH."/lib/SmTemplate/SmTemplate.php",
			"Smce\Lib\SmGump"=>SMCE_PATH."/lib/SmGump/SmGump.php",
			"Smce\Lib\SmUrlRouter"=>SMCE_PATH."/lib/SmUrlRouter/SmUrlRouter.php",
		);
	}
	
}
