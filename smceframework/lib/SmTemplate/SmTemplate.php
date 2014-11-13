<?php


/**
 *
 * @author Samed Ceylan
 * @link http://www.SMCEframework.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */

namespace Smce\Lib\SmTemplate;
 
class SmTemplate 
{
	
	private $layout;
	
	private $view=array();
	
	private static $themeDirectory;
	
	public $error=array();
	
	private $content="";
	
	public function setLayout($layout="")
	{
		 $this->layout=$layout;
	}
	
	public function setView($view="",$array=array())
	{
		 $this->view["view"]=$view;
		 $this->view["array"]=$array;
	}
	
	public function setThemeDirectory($theme="")
	{
		if(file_exists($theme))
			self::$themeDirectory=$theme;
		else
			$this->error[]="directory could not be found in the theme";
	}
	
	public function run()
	{
		$this->adjustmentDirectoryFile();
	}
	
	public function setError($error)
	{
		$this->error[]=$error;
	}
	
	public function getError()
	{
		return $this->error;
	}
	
	public function getLayout()
	{
		 return $this->layout;
	}
	
	public function getView()
	{
		 return $this->view;
	} 
	
	
	private function adjustmentDirectoryFile()
	{
		$layoutFile=self::$themeDirectory."/view/".$this->layout.".php";
		$viewFile=self::$themeDirectory."/view/".$this->view["view"].".php";
		
		if(file_exists($viewFile))
		{	
			$this->view["view"]=$viewFile;
			$this->adjustmentView($this->view);
		}else
			$this->setError("View Not Found ".$viewFile);
			
			
		if(file_exists($layoutFile))
		{
			$this->layout=$layoutFile;
			$this->adjustmentLayout();
			
		}else
			$this->setError("Layout Not Found ".$layoutFile);
		
	}
	
	private function adjustmentLayout()
	{
		$content=$this->content;
		include $this->layout;
		
	}
	
	private function adjustmentView()
	{
		ob_start();
        extract($this->view["array"]);
        include $this->view["view"];
        $this->content = ob_get_contents();
        ob_end_clean();
	}
	
}

