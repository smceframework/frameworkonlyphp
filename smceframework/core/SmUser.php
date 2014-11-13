<?php


namespace Smce\Core;

use Smce\Core\SmCli;
use Smce\Base\SmBase;
use Smce\Core\SmUrlRouter;

class SmUser extends SmCli
{
	public $data=array();

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

	public function createUrl($url="",$array=array())
	{
		$STR="";
		if(isset(SmBase::$config["urlRouter"]["showScriptName"]) && SmBase::$config["urlRouter"]["showScriptName"]==true){
			 $STR.=$this->data["baseurl"]."/".$url;
		}
		else
			 $STR.=$this->data["baseurl"]."/index.php?route=".$url;
		
		$SmUrlRouter=new SmUrlRouter;
		
		if(isset(SmBase::$config["urlRouter"]["showScriptName"]) && SmBase::$config["urlRouter"]["showScriptName"]==false){
			$i=0;
			foreach($array as $key=>$value){
				$STR.="&".$key."=".$value;
				$i++;
			}
		}else{
			foreach($array as $key=>$value){
				$STR.="/".$value;
			}
		}

		return $STR;
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

	public function caControl($urlArray=array())
	{
		$ur=BASE_CONTROLLER."/".BASE_VIEW;

		if(in_array($ur,$urlArray))
			return true;
	}

}