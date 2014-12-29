<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
namespace Smce\Core;

class SmFiletozip{
	
	private $file=array();
	private $params=array("current","away");
	private $tmpFile;
	
	/**
	 * 
	 * mkdir tmp
	 *
	 */
	 
	public function __construct(){
		if(!file_exists(__DIR__."/tmp"))
			mkdir(__DIR__."/tmp", 0777);
		
	}
	
	/**
	 * @param $fileUrl
	 * @param $params
	 *
	 */
	
	public function addFile($fileUrl="",$params=""){
		if(isset($this->params[$params])){
			return array("result"=>0,"message"=>'not params. Only "current","away"');
		}
		
		$this->file[]=array("file"=>$fileUrl,"params"=>$params);
	}
	
	/**
	 * zip file package
	 *
	 * @return this
	 */
	
	public function filePackage(){
		
		$this->tmpFile = tempnam(BASE_PATH.'\tmp.','');
		
		$zip = new \ZipArchive();
		$zip->open($this->tmpFile, \ZipArchive::CREATE);
		foreach($this->file as $key=>$value){
			
			if($value["params"]=="away"){
				$file=file_get_contents($value["file"]);
				if(!empty($file))
					$zip->addFromString(basename($value["file"]),$file);
			}else{
				if(file_exists($value["file"]))
					$zip->addFile($value["file"],basename($value["file"]));
			}
		}
		$zip->close();
		
		
		return $this;
		
	}
	
	/**
	 * @param $name
	 *
	 * @return temp file
	 */
	
	public function download($name="")
	{
		if(empty($name))
			$name="File_".time();
			
		header('Content-disposition: attachment; filename='.$name.".zip");
		header('Content-type: application/zip');
		readfile($this->tmpFile);
		unlink($this->tmpFile);
	}
	
	/**
	 * @param $name
	 *
	 * file put
	 */
	
	public function filePutContent($name="")
	{
		file_put_contents($name,file_get_contents($this->tmpFile));
		unlink($this->tmpFile);
	}
	
	
}


