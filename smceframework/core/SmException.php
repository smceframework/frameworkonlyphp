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
	
	/**
	 *
	 * @return debug_backtrace()
	 */
	
	public function backtrace()
	{
		echo "<pre>";
		print_r(debug_backtrace());
		echo "</pre>";
	}
}