<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */


namespace Smce\Core;

class SmTempManager
{
	
	private $tmpFile;
	
	/**
	 * 
	 * mkdir tmp
	 *
	 */
	 
	public function __construct(){
		if(!file_exists(BASE_PATH."/tmp"))
			mkdir(BASE_PATH."/tmp", 0777);
		
	}
	
	public function newTemp($fileName="")
	{
		if(!empty($fileName)){
			$tmpFile=BASE_PATH.'\tmp\\'.$fileName.".tmp";
			file_put_contents($file);
		}else
			$tmpFile=tempnam(BASE_PATH.'\tmp\\','');
			
		$this->tmpFile=$tmpFile;
		
		return $this->tmpFile;
	}
	
	public function deleteTemp()
	{
		unlink($this->tmpFile);
	}
	
}