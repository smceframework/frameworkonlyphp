<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/smceframework
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
		if(!isset(SmBase::$config["components"]["ssh"][$ssh]))
			  throw new SmException('SSH server configuration must have "host", "port", "username", "password" and "pemfile" values in array.');
			  
		$config=SmBase::$config["components"]["ssh"][$ssh];
		$key = new \Crypt_RSA();
		
		if(empty($config["pemfile"]) && empty($config["password"]))
			throw  new SmException("Passwords or .pem File can not be empty");
			
		
		if(!empty($config["pemfile"]) && !file_exists($config["pemfile"]))
			throw  new SmException(".pem File not found");
		elseif(!empty($config["pemfile"]))
			$key->loadKey(file_get_contents($config["pemfile"]));
		else{
			$key=$config["password"];
		}
		
		if(!isset($config["host"]) || empty($config["host"]))
				throw  new SmException("Host can not be empty");
		

		$waitTimeoutInSeconds = 1; 
		$fp=fsockopen($config["host"],$config["port"],$errCode,$errStr,$waitTimeoutInSeconds);
		if(!$fp){ 
		   throw  new SmException($errCode."_".$errStr);
		}
		fclose($fp);   
		
		$ssh = new \Net_SSH2($config["host"],$config["port"]);
		if (!$ssh->login($config["username"], $key)) {
			throw  new SmException("Login Failed");
		}
		return $ssh;
	}
	
	
}