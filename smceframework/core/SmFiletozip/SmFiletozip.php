<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/smceframework
 */
 
namespace Smce\Core;

class SmFiletozip{
	
	private $file=array();
	
	private $params=array("current","away");
	
	private $tmpFile;
	
	private $SmTempManager;
	
	/**
	 * @param $fileUrl
	 * @param $params
	 *
	 */
	
	public function addFile($fileUrl="",$params=""){
		
		$this->file[]=array("file"=>$fileUrl,"params"=>$params);
		
	}
	
	/**
	 * zip file package
	 *
	 * @return this
	 */
	
	public function filePackage()
	{
		$this->SmTempManager=new SmTempManager;
		
		$this->tmpFile = $this->SmTempManager->newTemp();
		
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
	
	public function download($fileName="")
	{
		if(empty($fileName))
			$fileName="File_".time();
		
		$SmOutput=new SmOutput;
		$SmOutput->setContentType("application/zip");	
		$SmOutput->setFileName($fileName);
		$SmOutput->putFile($this->tmpFile);
		
		$this->SmTempManager->deleteTemp();
	}
	
	/**
	 * @param $name
	 *
	 * file put
	 */
	
	public function filePutContent($name="")
	{
		file_put_contents($name,file_get_contents($this->tmpFile));
		
		$this->SmTempManager->deleteTemp();
	}
	
	
}


