<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
namespace Smce\Core;

class SmLayout
{
	
	public function content($url,$array=array())
	{
		
		extract($array);
		$contentFile=\Smce::app()->basePath."/";
		if(BASE_THEME!=""){
			$contentFile.="main/theme/".BASE_THEME."/";
			$contentFile.="view".$url.".php";
		}
		else{
			$contentFile.="main/view".$url.".php";
		}
			
		if (!is_file($contentFile)) {
			$html = '<html><body><h1>Content Not Found "'.$contentFile.'"</h1></body></html>';
			echo $html;
			exit;
		} else {
			include ($contentFile);
		}
	}
	
}