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
use Smce\Core\SmRouter;
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
		$this->data["baseurl"]=SmBase::baseUrl();
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
		$request=str_replace(SmBase::baseUrl(), "",$_SERVER["REQUEST_URI"]);
		
		if(substr($request,0,1)=="/")
			$request=substr($request,1,strlen($request));
			
		$request=str_replace("index.php", "",$request);

		
		$SmRouter=new SmRouter;

		$SmRouter->setRequest($request);

		if(isset($_GET["route"]))
			$SmRouter->setRoute($_GET["route"]);


		if(isset(SmBase::$config["urlrouter"])){
			$SmRouter->setRouter(SmBase::$config["urlrouter"]);
		}else
			$SmRouter->setRouter(SmBase::$configSmce["urlrouter"]);
	
		
		return $SmRouter->createUrl($controllerView,$array,$this->data["baseurl"]);
		
		
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
		if ($_SESSION[md5(md5(Smce::app()->securitycode)).$key] = $value)
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
		if (isset($_SESSION[md5(md5(Smce::app()->securitycode)).$key]))
			return $_SESSION[md5(md5(Smce::app()->securitycode)).$key];

		return false;
	}

	/**
	 *
	 * session_destroy
	 */
	 
	public function stateClear()
	{
		
		foreach($_SESSION as $key=>$value){
			$key=str_replace(md5(md5(Smce::app()->securitycode)),"",$key);
			unset($_SESSION[md5(md5(Smce::app()->securitycode)).$key]);
		}
		
		unset($_SESSION[md5(md5(Smce::app()->securitycode)).md5(md5("SMCE_".Smce::app()->securitycode))]);
		
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
		$this->setState(md5(md5("SMCE_".Smce::app()->securitycode)), true);
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
	
	
	/**
	 *
	 * @param $controllerView
	 * @param $array
	 *
	 * header location
	 */

    public function redirect($controllerView="",$array=array())
    {
       $request=str_replace(SmBase::baseUrl(), "",$_SERVER["REQUEST_URI"]);
		
		if(substr($request,0,1)=="/")
			$request=substr($request,1,strlen($request));
			
		$request=str_replace("index.php", "",$request);

		
		$SmRouter=new SmRouter;

		$SmRouter->setRequest($request);

		if(isset($_GET["route"]))
			$SmRouter->setRoute($_GET["route"]);


		if(isset(SmBase::$config["urlrouter"])){
			$SmRouter->setRouter(SmBase::$config["urlrouter"]);
		}else
			$SmRouter->setRouter(SmBase::$configSmce["urlrouter"]);
	
		
		return $SmRouter->redirect($controllerView,$array,$this->data["baseurl"]);
		
    }
	
	
	
	/**
	 *
	 * @param $url
	 *
	 * header location
	 */

	
	public function redirectUrl($url){
		header('Location: '.$url);
	}

}