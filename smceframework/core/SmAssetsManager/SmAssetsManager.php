<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */


namespace Smce\Core;

use Smce\Core\SmException;

class SmAssetsManager
{
	public $file=array();
	
	public $name="";
	
	public $error=array();
	
	public function __construct($name)
	{
		if($name=="")
			throw  new SmException("Not assets name");
		else
			$this->name=$name;
			
		if(!is_dir(BASE_PATH."/assets/".$name))
			mkdir(BASE_PATH."/assets/".$name,0777);
	}
	
	public function addFile($file)
	{
		$this->file[]=$file;
	}
	
	public function run()
	{
		foreach($this->file as $key=>$value)
		{
			if(!file_exists(BASE_PATH."/assets/".$this->name."/".basename($value)))
				copy($value,BASE_PATH."/assets/".$this->name."/".basename($value));
		}
	}
	
	
}