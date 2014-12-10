<?php

namespace Smce\Core;

use Smce\Base\SmBase;
require_once(dirname(__FILE__).'/Math/BigInteger.php');
require_once(dirname(__FILE__).'/Net/SSH2.php');
require_once(dirname(__FILE__).'/Crypt/RSA.php');

class SmSSH
{
	
	
	public function login($ssh)
	{
		$config=SmBase::$config["components"]["SHH"][$ssh];
		$key = new \Crypt_RSA();
		if(isset($config["pemfile"]) && $config["pemfile"]!="")
			$key->loadKey(file_get_contents(BASE_PATH."/main/data/centosKEy.pem"));
		else
			$key=$config["password"];
			
		$ssh = new \Net_SSH2($config["host"]);
		if (!$ssh->login($config["username"], $key)) {
			exit('Login Failed');
		}
		return $ssh;
	}
	
}