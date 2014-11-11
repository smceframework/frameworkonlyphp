<?php

	global $SMCE_IMPORT;
	if(isset($import))
		$SMCE_IMPORT=$import;
	else
		$SMCE_IMPORT=array();

	
	function __autoload($class_name)
	{
		$parts = explode('\\', $class_name);
		
		foreach ($GLOBALS['SMCE_IMPORT'] as $key=>$value) {
			if(file_exists(BASE_PATH."/".$value."/".$class_name . '.php'))
				 include BASE_PATH."/".$value."/".$class_name . '.php';
		}

		if(file_exists(BASE_PATH."/controller/".end($parts). '.php'))
			 include BASE_PATH."/controller/".end($parts) . '.php';
		elseif(file_exists(SMCE_BASE_PATH."/lib/".end($parts) . '.php'))
			 include SMCE_BASE_PATH."/lib/".end($parts) . '.php';
			 
		elseif(file_exists(SMCE_BASE_PATH."/lib/".end($parts)."/".end($parts).'.php'))
			 include SMCE_BASE_PATH."/lib/".end($parts)."/".end($parts).'.php';
		elseif(file_exists(SMCE_BASE_PATH."/lib/".$parts[0]."/".end($parts).'.php'))
			 include SMCE_BASE_PATH."/lib/".$parts[0]."/".end($parts).'.php';
			 
		elseif(file_exists(SMCE_BASE_PATH."/implements/".end($parts). '.php'))
			 include SMCE_BASE_PATH."/implements/".end($parts) . '.php';

		elseif(file_exists(SMCE_BASE_PATH."/base/".end($parts) . '.php'))
			 include SMCE_BASE_PATH."/base/".end($parts) . '.php';
		
		elseif(file_exists(SMCE_BASE_PATH."/base/SmLib/".end($parts) . '.php'))
			 include SMCE_BASE_PATH."/base/SmLib/".end($parts) . '.php';
	}
