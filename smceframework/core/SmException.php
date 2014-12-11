<?php

namespace Smce\Core;

class SmException extends \Exception
{
	public $error;
	
	public function __construct($error)
	{
		$this->error=$error;
	}
	
	public function errorMessage()
	{
		return $this->error;
	}
}