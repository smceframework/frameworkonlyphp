<?php

namespace SmceFramework;
class Sm_Controller extends \Sm_Base\Sm_Ve
{
    public $content;
    public static $error=true;

    public $theme="";
	public $layout="";
	
	const COMPENENTS="Controller";
	

    public function render($url="",$array=array())
    {
		
		
        ob_start();

        if (! is_file(\Smce::app()->basePath.(empty($this->theme) ? "\\" : "\\theme\\".$this->theme."\\")."view\\".(self::$error==true ? BASE_CONTROLLER : "site")."\\".$url.".php")) {
                $html = '<html><body><h1>View Not Found "'.(empty($this->theme) ? "\\" : "theme\\".$this->theme."\\")."view\\".(self::$error==true ? BASE_CONTROLLER : "site")."\\".$url.'"</h1></body></html>';
                echo $html;
                exit;
        } else {
             extract($array);
             include (\Smce::app()->basePath.(empty($this->theme) ? "\\" : "\\theme\\".$this->theme."\\")."view\\".(self::$error==true ? BASE_CONTROLLER : "site")."\\".$url.".php");
        }

        $this->content = ob_get_contents();

        ob_end_clean();
		
		$this->settingRender();

    }
	
	private function settingRender(){
		$this->setTheme();
		$this->adjustmentLayout();
	}
	
	private function setTheme(){
		 define("BASE_THEME",$this->theme);
	}
	
	private function adjustmentLayout(){
		
		$content=$this->content;
		
		if (!empty($this->layout)) {
			$layout=$this->layout;
		} elseif (class_exists($components) && isset(\Controller::$layout)) {
			$layout=\Controller::$layout;
		}
		
		 if (empty($layout)) {
		
				$html = '<html><body><h1>Not Set Layout</h1></body></html>';
				echo $html;
				exit;
		} elseif (!is_file(\Smce::app()->basePath.(empty($this->theme) ? "\\" : "\\theme\\".$this->theme."\\")."view".$layout.".php")) {
		
				$html = '<html><body><h1>Layout Not Found "'.(empty($this->theme) ? "\\" : "theme\\".$this->theme."\\")."view\\".$layout.'"</h1></body></html>';
				echo $html;
				exit;
		} else {
		
				include (\Smce::app()->basePath.(empty($this->theme) ? "\\" : "\\theme\\".$this->theme."\\")."view".$layout.".php");
		}
	}

}
