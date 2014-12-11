<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */

namespace Smce\Lib;

use Smce\Core\SmException;
 
class SmTemplate 
{
	
	private $layout;
	
	private $view=array();
	
	private static $themeDirectory;
	
	public $error=array();
	
	private $content="";
	
	/**
	 * @param $layout
	 *
	 * 
	 */

	
	public function setLayout($layout="")
	{
		 $this->layout=$layout;
	}
	
	/**
	 * @param $view
	 * @param $array
	 * 
	 */
	
	public function setView($view="",$array=array())
	{
		 $this->view["view"]=$view;
		 $this->view["array"]=$array;
	}
	
	/**
	 * @param $theme
	 * 
	 * 
	 */
	
	public function setThemeDirectory($theme="")
	{
		if(file_exists($theme))
			self::$themeDirectory=$theme;
		else
			throw  new SmException("directory could not be found in the theme");
	}
	
	/**
	 * run
	 * 
	 * 
	 */
	
	public function run()
	{
		$this->adjustmentDirectoryFile();
	}
	
	
	/**
	 * 
	 * 
	 * return $layout
	 */
	
	public function getLayout()
	{
		 return $this->layout;
	}
	
	/**
	 * 
	 * 
	 * return $view
	 */
	
	public function getView()
	{
		 return $this->view;
	} 
	
	/**
	 * Adjustment Directory File
	 * 
	 * 
	 */
	
	
	private function adjustmentDirectoryFile()
	{
		$layoutFile=self::$themeDirectory."/view/".$this->layout.".php";
		$viewFile=self::$themeDirectory."/view/".$this->view["view"].".php";
		
		if(file_exists($viewFile))
		{	
			$this->view["view"]=$viewFile;
			$this->adjustmentView($this->view);
		}else
			throw  new SmException("View Not Found ".$viewFile);
			
			
		if(file_exists($layoutFile))
		{
			$this->layout=$layoutFile;
			$this->adjustmentLayout();
			
		}else
			throw  new SmException("Layout Not Found ".$layoutFile);
		
	}
	
	/**
	 * 
	 * 
	 * include $layout
	 */
	
	private function adjustmentLayout()
	{
		$content=$this->content;
		include $this->layout;
	}
	
	/**
	 *  Adjustment View
	 * 
	 * 
	 */
	
	private function adjustmentView()
	{
		ob_start();
        extract($this->view["array"]);
        include $this->view["view"];
        $this->content = ob_get_contents();
        ob_end_clean();
	}
	
}

