<?php
	
  
	
	$debug = false;
	
	if($debug){
		ini_set('display_errors', 1);
		error_reporting(E_ALL ^ E_NOTICE);
	}else{
		ini_set('display_errors', 0);
		error_reporting(0);
	}
	
	
	define("DB_USER","root");
	define("DB_PASSWORD","");
	define("DB_NAME","");
	define("DB_HOST","localhost");
	
	
	

?>