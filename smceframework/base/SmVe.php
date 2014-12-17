<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
namespace Smce\Base;

use Smce\Lib\SmUrlRouter;
use Smce;

class SmVe
{
	
	
	/**
	 *
	 * @param $controllerView
	 * @param $array
	 *
	 * header location
	 */

    public function redirect($controllerView="",$array=array())
    {
        $request=str_replace(Smce::app()->baseUrl."/", "",$_SERVER["REQUEST_URI"]);
		$request=str_replace("index.php", "",$request);
		
		$SmUrlRouter=new SmUrlRouter;
		$SmUrlRouter->setRequest($request);
		if(isset(SmBase::$config["urlrouter"])){
			$SmUrlRouter->setRouter(SmBase::$config["urlrouter"]);
		}else
			$SmUrlRouter->setRouter(SmBase::$configSmce["urlrouter"]);
		
		$SmUrlRouter->redirect($controllerView,$array,Smce::app()->baseUrl);
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
