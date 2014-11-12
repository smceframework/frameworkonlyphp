<?php

namespace smce\base\SmLib;


use smce\base\SmVe;
use smce\lib\SmTemplate\SmTemplate;

class SmController extends SmVe
{
    private $content;
	
    public $theme="";
	
	public $layout="";

	const COMPENENTS="Controller";

    public function render($view="",$array=array())
    {
		
		$this->setTheme();
		$SmTemplate=new SmTemplate();
		$SmTemplate->setView($this->getView($view),$array);
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
	
	private function getView($view)
	{
		if (!is_array($view)) {
			return BASE_CONTROLLER."/".$view;
		} else {
			return "site/".$view[0];
		}
	}

	private function setTheme()
	{
		 define("BASE_THEME",$this->theme);
	}

	
}
