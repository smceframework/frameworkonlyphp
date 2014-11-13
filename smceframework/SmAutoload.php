<?php

namespace smce;

class SmAutoload
{
	private static $config;
	
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
	
	private static function autoloadApp($class_name)
	{
		$parts = explode('\\', $class_name);
		if(isset(self::$config["import"])){
			foreach (self::$config["import"] as $key=>$value) {
				if(file_exists(BASE_PATH."/".$value."/".$class_name . '.php'))
					include BASE_PATH."/".$value."/".$class_name . '.php';
			}
		}
	}
	
	public function register($config){
		self::$config=$config;
		spl_autoload_register(array($this, 'autoloadFramework'),true,true);
		spl_autoload_register(array($this, 'autoloadApp'),true,true);
	}
	
	
	private static function classMap(){
		return array(
			"smce\SmController"=>SMCE_PATH."/base/SmLib/SmController.php",
			"smce\SmFormModel"=>SMCE_PATH."/base/SmLib/SmFormModel.php",
			"DB"=>SMCE_PATH."/base/SmLib/DB.php",
			"smce\SmUserIdentity"=>SMCE_PATH."/base/SmLib/SmUserIdentity.php",
		);
	}
	
}
