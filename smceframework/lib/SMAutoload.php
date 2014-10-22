<?PHP
	
	global $SMCE_IMPORT;
	if(isset($import))
		$SMCE_IMPORT=$import;
	else
		$SMCE_IMPORT=array();
		
	function __autoload($class_name) {
		
		foreach($GLOBALS['SMCE_IMPORT'] as $key=>$value){
			if(file_exists(BASE_PATH."/".$value."/".$class_name . '.php'))
				 require_once(BASE_PATH."/".$value."/".$class_name . '.php');
		}
		
		
		if(file_exists(BASE_PATH."/controller/".$class_name . '.php'))
			 require_once(BASE_PATH."/controller/".$class_name . '.php'); 
		
		if(file_exists(SMCE_BASE_PATH."/lib/".$class_name . '.php'))
			 require_once(SMCE_BASE_PATH."/lib/".$class_name . '.php');
			 
		if(file_exists(SMCE_BASE_PATH."/implements/".$class_name . '.php'))
			 require_once(SMCE_BASE_PATH."/implements/".$class_name . '.php');
			 
		if(file_exists(SMCE_BASE_PATH."/base/".$class_name . '.php'))
			 require_once(SMCE_BASE_PATH."/base/".$class_name . '.php');	 
	}
