<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/smceframework
 */


namespace Smce\Core;

use Smce;

class SmAssetsManager
{
	private $file=array();
	
	private $name="";
	
	private $aInclude=array();
	
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
				
				
			$this->assetsInclude("/assets/".$this->name."/".basename($value));
		}
		
	}
	
	public function assetsInclude($file)
	{
		if(!isset($this->aInclude[$file])){
			
			 $parts = pathinfo($file);
			 if($parts['extension']=="css")
				echo "<link rel='stylesheet' type='text/css' href='".Smce::app()->baseUrl.$file."' />";  
			 elseif($parts['extension']=="js")
				echo '<script type="text/javascript" src="'.Smce::app()->baseUrl.$file.'"></script>';  
			 $this->aInclude[$file]=true;
			
		}
		
	}
	
	
}