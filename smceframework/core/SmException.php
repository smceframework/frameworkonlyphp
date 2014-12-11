<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */

namespace Smce\Core;

class SmException extends \Exception
{
	public $error;
	
	
	/**
	 * @param $error
	 * 
	 */
	 
	public function __construct($error)
	{
		$this->error=$error;
	}
	
	/**
	 *
	 * @return $error
	 */
	
	public function errorMessage()
	{
		return "<h3>".$this->error."</h3>";
	}
	
	/**
	 *
	 * @return debug_backtrace()
	 */
	
	public function backtrace()
	{
		print_r(debug_backtrace());
	}
}