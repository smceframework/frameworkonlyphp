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
use Smce\Core\SmUser;
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
        $SmUser=new SmUser;
		$SmUser->redirect(strtolower($controllerView),$array);
    }
	
	
	
	/**
	 *
	 * @param $url
	 *
	 * header location
	 */

	
	public function redirectUrl($url)
	{
		
		$SmUser=new SmUser;
		$SmUser->redirect($url);
		
	}

}
