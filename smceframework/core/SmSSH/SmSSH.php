<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */

namespace Smce\Core;

use Smce\Base\SmBase;
require_once(dirname(__FILE__).'/Math/BigInteger.php');
require_once(dirname(__FILE__).'/Net/SSH2.php');
require_once(dirname(__FILE__).'/Crypt/RSA.php');

class SmSSH
{
	public $error=array();
	
	
	/**
	 *
	 * @param config $ssh
	 *
	 * @return $conn
	 *
	 */
	public function login($ssh)
	{
		$config=SmBase::$config["components"]["SHH"][$ssh];
		$key = new \Crypt_RSA();
		if(isset($config["pemfile"]) && $config["pemfile"]!="")
			if(file_exists(BASE_PATH."/main/data/centosKEy.pem"))
				$key->loadKey(file_get_contents(BASE_PATH."/main/data/centosKEy.pem"));
			else
				$this->error[]="File not found";
		else{
			if(isset($config["password"]) && $config["password"])
				$key=$config["password"];
			else
				$this->error[]="Passwords can not be empty";
		}
			
		$ssh = new \Net_SSH2($config["host"],$config["port"]);
		if (!$ssh->login($config["username"], $key)) {
			$this->error[]="Login Failed";
		}
		return $ssh;
	}
	
	/**
	 *
	 * @return $error
	 *
	 */
	
	public function getError()
	{
		return $this->error;
	}
	
}