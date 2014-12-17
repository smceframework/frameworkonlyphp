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
use Smce\Lib\SmUrlRouter;
use Smce;
use ActiveRecord\ConnectionManager;

class SmUser
{
	public $data=array();

	/**
	 * data
	 * 
	 *
	 */
	public function __construct()
	{
		$this->data["basepath"]=BASE_PATH;
		$this->data["baseurl"]=$this->base_url();
	    $this->data["ip"]=$this->getIP();

	    foreach(SmBase::$config as $key=>$value)
	    	$this->data[$key]=$value;
	}
	
	public static function db($db)
	{
      	$conn=new ConnectionManager; 
	  	return $conn::get_connection($db);
	  
	}
	
	/**
	 * @param $name
	 *
	 * return $data
	 */

	public function __get($name)
	{
		return $this->data[strtolower($name)];
	}
	
	/**
	 * @param $controllerView
	 * @param $array
	 *
	 * @return createUrl
	 */

	public function createUrl($controllerView="",$array=array())
	{
		$request=str_replace(Smce::app()->baseUrl."/", "",$_SERVER["REQUEST_URI"]);
		$request=str_replace("index.php", "",$request);
		
		$SmUrlRouter=new SmUrlRouter;
		$SmUrlRouter->setRequest($request);
		if(isset(SmBase::$config["urlrouter"])){
			$SmUrlRouter->setRouter(SmBase::$config["urlrouter"]);
		}else
			$SmUrlRouter->setRouter(SmBase::$configSmce["urlrouter"]);
		
		return $SmUrlRouter->createUrl($controllerView,$array,$this->data["baseurl"]);
	}
	
	/**
	 *
	 * @return url
	 */

	private function base_url()
	{
		$url=str_replace("/index.php","",$_SERVER['SCRIPT_NAME']);
		define("BASE_URL",$url);
		return $url;
	}
	
	/**
	 *
	 * @return ip addres
	 */

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
	
	/**
	 * @param $key
	 * @param $value
	 *
	 * @return bool
	 */

	public function setState($key,$value)
	{
		if ($_SESSION[$key] = $value)
			return true;

		return false;
	}
	
	/**
	 * @param $key
	 *
	 * @return session or false
	 */

	public function getState($key)
	{
		if (isset($_SESSION[$key]))
			return $_SESSION[$key];

		return false;
	}

	/**
	 *
	 * session_destroy
	 */
	 
	public function stateClear()
	{
		session_destroy();
	}
	
	/**
	 * @param $_identity
	 * @param $duration
	 *
	 * session_set_cookie_params
	 */

	public function login($_identity, $duration)
	{
		ini_set('session.gc_maxlifetime', $duration);
		session_set_cookie_params($duration);
		$this->setState("SMCE_login71", true);
	}
	
	/**
	 * @param $urlArray
	 *
	 * @return bool
	 */

	public function caControl($urlArray=array())
	{
		$ur = BASE_CONTROLLER . '/'. BASE_VIEW;

		if (in_array($ur, $urlArray))
			return true;

		return false;
	}

}