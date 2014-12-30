<?php


/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
namespace Smce\Core;

use Smce\Core\SmMigrationForge;
use Smce;

class SmMigration extends SmMigrationForge
{

	public function __construct($dbConn)
	{
		
		$this->conn=Smce::app()->db($dbConn);

		return  $this;
	}
}