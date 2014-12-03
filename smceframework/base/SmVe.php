<?php

namespace Smce\Base;

use Smce\Lib\SmUrlRouter;
use Smce;

class SmVe
{
    public function redirect($controllerView="",$array=array())
    {
        $request=str_replace(Smce::app()->baseUrl."/", "",$_SERVER["REQUEST_URI"]);
		$request=str_replace("index.php", "",$request);
		
		$SmUrlRouter=new SmUrlRouter;
		$SmUrlRouter->setRequest($request);
		if(isset(SmBase::$config["urlRouter"])){
			$SmUrlRouter->setRouter(SmBase::$config["urlRouter"]);
		}else
			$SmUrlRouter->setRouter(SmBase::$configSmce["urlRouter"]);
		
		$SmUrlRouter->redirect($controllerView,$array,Smce::app()->baseUrl);
    }
	
	public function redirectUrl($url){
		header('Location: '.$url);
	}

}
