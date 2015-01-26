<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/smceframework
 */

namespace Smce\Core;

use Exception;

class SmException extends Exception
{
	
	/**
	 *
	 * @return name
	 *
	 */
	 
	public function getName()
	{
		return "Core/SmException";
	}
}