<?php

namespace Smce\Core;


use Smce\Base\SmVe;
use Smce\Lib\SmTemplate\SmTemplate;
use Smce\Base\SmBase;

class SmController extends SmVe
{
    private $content;
	
    public $theme="";
	
	public $layout="";
	
	public static $error;

	const COMPENENTS="Controller";

    public function render($view="",$array=array())
    {
		$controller=strtolower(get_class($this));
		$controller=str_replace("controller","",$controller);
		$this->setTheme();
		$SmTemplate=new SmTemplate();
		$SmTemplate->setView($this->getView($view,$controller),$array);
		$SmTemplate->setLayout($this->getLayout());
		$SmTemplate->setThemeDirectory($this->getTheme());
		$SmTemplate->run();
			
    }
	
	private function getLayout(){
		if($this->layout!="")
			return $this->layout;
	    elseif (class_exists(self::COMPENENTS) && isset(\Controller::$layout))
			return \Controller::$layout;	
	}
	
	private function getTheme(){
		if(empty($this->theme))
			return BASE_PATH;
		else
			return BASE_PATH."/theme/".$this->theme;
	}
	
	private function getView($view,$controller)
	{
		if(is_array($view)){
			$view=explode("/",$view[0]);
			$view= $view[0]."/".$view[1];
		}elseif (!is_array($view)) {
			$view= $controller."/".$view;
		} else {
			$view= "site/".$view[0];
		}
		return $view;
	}

	private function setTheme()
	{
		 define("BASE_THEME",$this->theme);
	}

	
}
