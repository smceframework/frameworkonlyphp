<?php


namespace Smce\Core;

use Smce\Base\SmBase;
use Smce\Lib\SmUrlRouter;
use Smce;

class SmUser
{
	public $data=[];

	public function __construct()
	{
		$this->data["basepath"]=BASE_PATH;
		$this->data["baseurl"]=$this->base_url();
	    $this->data["ip"]=$this->getIP();
	}

	public function __get($name)
	{
		return $this->data[strtolower($name)];
	}

	public function createUrl($controllerView="",$array=[])
	{
		$request=str_replace(Smce::app()->baseUrl."/", "",$_SERVER["REQUEST_URI"]);
		$request=str_replace("index.php", "",$request);
		
		$SmUrlRouter=new SmUrlRouter;
		$SmUrlRouter->setRequest($request);
		if(isset(SmBase::$config["urlRouter"])){
			$SmUrlRouter->setRouter(SmBase::$config["urlRouter"]);
		}else
			$SmUrlRouter->setRouter(SmBase::$configSmce["urlRouter"]);
		
		return $SmUrlRouter->createUrl($controllerView,$array,$this->data["baseurl"]);
	}

	private function base_url()
	{
		$url=str_replace("/index.php","",$_SERVER['SCRIPT_NAME']);
		define("BASE_URL",$url);
		return $url;
	}

	private function getIP()
	{
		if (getenv("HTTP_CLIENT_IP")) {
			$ip = getenv("HTTP_CLIENT_IP");
		} elseif (getenv("HTTP_X_FORWARDED_FOR")) {
			$ip = getenv("HTTP_X_FORWARDED_FOR");
			if (strstr($ip, ',')) {
				$tmp = explode (',', $ip);
				$ip = trim($tmp[0]);
			}
		} else {
		$ip = getenv("REMOTE_ADDR");
		}
		return $ip;
	}

	public function setState($key,$value)
	{
		if($_SESSION[$key]=$value)
			return true;
	}

	public function getState($key)
	{
		if(isset($_SESSION[$key]))
			return $_SESSION[$key];
		else
			return false;
	}

	public function stateClear()
	{
		session_destroy();
	}

	public function login($_identity,$duration)
	{
		$this->setState("SMCE_login71",true);

		session_set_cookie_params($duration);
	}

	public function caControl($urlArray=[])
	{
		$ur=BASE_CONTROLLER."/".BASE_VIEW;

		if(in_array($ur,$urlArray))
			return true;
	}

}