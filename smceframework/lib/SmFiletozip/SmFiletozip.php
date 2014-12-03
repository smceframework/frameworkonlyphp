<?php

namespace Smce\Lib;

class SmFiletozip{
	
	private $_file=array();
	private $_params=array("current","away");
	private $tmp_file;
	
	public function __construct(){
		if(!file_exists(__DIR__."/tmp"))
			mkdir(__DIR__."/tmp", 0777);
		
	}
	
	public function addFile($file_url="",$params=""){
		if(isset($this->_params[$params])){
			return array("result"=>0,"message"=>'not params. Only "current","away"');
			exit;
		}
		
		$this->_file[]=array("file"=>$file_url,"params"=>$params);
	}
	
	public function filePackage(){
		
		$this->tmp_file = tempnam(BASE_PATH.'\tmp.','');
		
		$zip = new \ZipArchive();
		$zip->open($this->tmp_file, \ZipArchive::CREATE);
		foreach($this->_file as $key=>$value){
			
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
	
	public function download($name="")
	{
		if(empty($name))
			$name="File_".time();
			
		header('Content-disposition: attachment; filename='.$name.".zip");
		header('Content-type: application/zip');
		readfile($this->tmp_file);
		unlink($this->tmp_file);
	}
	
	public function filePutContent($name="")
	{
		file_put_contents($name,file_get_contents($this->tmp_file));
		unlink($this->tmp_file);
	}
	
	
}


