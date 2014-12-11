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
		return "<h3>".$this->error."</h3>";
	}
}