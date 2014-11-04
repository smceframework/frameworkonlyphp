<?php

namespace SmceFramework;
class Sm_Controller extends \Sm_Base\Sm_Ve
{
    private $content;
    public static $error=true;

    public $theme="";
	public $layout="";
	
	const COMPENENTS="Controller";
	
	private $viewFile="";
	private $layoutFile="";
	
    public function render($url="",$array=array())
    {
		$this->setViewFile($url);
		$this->setLayoutFile();
		$this->settingRender($array);

    }
	
	
	
	private function settingRender($array){
		$this->setTheme();
		$this->adjustmentView($array);
		$this->adjustmentLayout();
	}
	
	private function setTheme(){
		 define("BASE_THEME",$this->theme);
	}
	
	private function adjustmentView($array){
		ob_start();
        if (! is_file($this->viewFile)){
                $html = '<html><body><h1>View Not Found "'.$this->viewFile.'"</h1></body></html>';
                echo $html;
                exit;
        } else {
             extract($array);
             include ($this->viewFile);
        }
        $this->content = ob_get_contents();
        ob_end_clean();
	}
	
	private function adjustmentLayout(){
		
		$content=$this->content;
		
		 if (empty($this->layoutFile)) {
				$html = '<html><body><h1>Not Set Layout</h1></body></html>';
				echo $html;
				exit;
		} elseif (!is_file($this->layoutFile)) {
		
				$html = '<html><body><h1>Layout Not Found "'.$this->layoutFile.'"</h1></body></html>';
				echo $html;
				exit;
		} else {
		
				include ($this->layoutFile);
		}
	}
	
	
	private function setViewFile($url){
		
		$this->viewFile=\Smce::app()->basePath."\\";
		if(!empty($this->theme)){
			$this->viewFile.="theme\\".$this->theme."\\";
		}
		$this->viewFile.="view\\";
		if(self::$error==true){
			$this->viewFile.=BASE_CONTROLLER."\\";
		}else{
			$this->viewFile.="site\\";
		}
		
		$this->viewFile.=$url.".php";
	}
	
	private function setLayoutFile(){
		$layout="";
		if (!empty($this->layout)) {
			$layout=$this->layout;
		} elseif (class_exists(self::COMPENENTS) && isset(\Controller::$layout)) {
			$layout=\Controller::$layout;
		}
		
		$this->layoutFile=\Smce::app()->basePath."\\";
		if(!empty($this->theme)){
			$this->layoutFile.="theme\\".$this->theme."\\";
		}
		$this->layoutFile.="view";
		$this->layoutFile.=$layout.".php";
	}

}
