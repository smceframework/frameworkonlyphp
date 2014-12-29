<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
namespace Smce\Core;

class SmOutput
{
	
	public $header;
	
	public $fileName;
	
	/**
	 * @param $mimeType
	 *
	 * @return this
	 */
	 
	public function setContentType($mimeType="")
	{
		$this->header = 'Content-Type: '.$mimeType;

		return $this;
	}
	
	
	/**
	 * @param $mimeType
	 *
	 * @return this
	 */
	 
	public function setFileName($fileName)
	{
		$this->fileName = $fileName;

		return $this;
	}
	
	/**
	 * @param $data
	 *
	 * echo
	 */
	
	
	public function put($data)
	{
		if(!empty($this->fileName))
			header('Content-disposition: attachment; filename='.$this->fileName);
		header($this->header);
		echo $data;
		
	}
	
	
	/**
	 *
	 * @return $header
	 */
	
	
	public function getHeader()
	{
		return $this->header;
	}
	
}