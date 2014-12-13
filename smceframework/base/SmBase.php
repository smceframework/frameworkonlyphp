<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */

namespace Smce\Base;

use Smce\Core\SmACL;
use Smce\Lib\SmUrlRouter;
use SiteController;
use ActiveRecord;

class SmBase
{
    public static $config;
	public static $configSmce;

    public $controller;
    public $view;
	
    public function run()
    {
        session_start();
        SmBase::baseURL();
        SmBase::includeFile();
        SmBase::dbSetting();
        SmBase::command();
		
    }


    private function baseURL()
    {
		$request=str_replace($this->base_url(), "",$_SERVER["REQUEST_URI"]);
		
		if(substr($request,0,1)=="/")
			$request=substr($request,1,strlen($request));
			
		$request=str_replace("index.php", "",$request);
		
		$SmUrlRouter=new SmUrlRouter;
		$SmUrlRouter->setRequest($request);
		if(isset(self::$config["urlRouter"])){
			$SmUrlRouter->setRouter(self::$config["urlRouter"]);
		}else
			$SmUrlRouter->setRouter(self::$configSmce["urlRouter"]);
		
		$requestArray=$SmUrlRouter->run();
		foreach($requestArray as $key=>$value){
			$_GET[str_replace("::","",$key)]=$value;
		}
		
      	$this->controller=strtolower($requestArray["controller"]);
        $this->view=strtolower($requestArray["view"]);
		
        define('BASE_CONTROLLER',strtolower($this->controller));
        define('BASE_VIEW',strtolower($this->view));

    }

    private function command()
    {
        if (! is_file(BASE_PATH."/main/controller/".ucfirst($this->controller)."Controller.php")) {
            SmBase::error("Controller Not Found");
            exit;
        }
		$componentsController="";
		if (is_file(BASE_PATH."/main/components/Controller.php")) {
			require BASE_PATH."/main/components/Controller.php";
			$componentsController=new \Controller;
		}
		
        require BASE_PATH."/main/controller/".ucfirst($this->controller)."Controller.php";

        if(!empty($this->controller->layout))
            SmBase::$layout=$this->controller->layout;
		
        $actionView = 'action'.ucfirst($this->view);
        $actionController = $this->controller."Controller";
		
		$this->controllerAction($componentsController,"beforeAction");
		
        $class = new $actionController;
		
        if (method_exists($class, $actionView)) {
           
            if (method_exists ($class , "accessRules" )) {

                $accessRules=$class->accessRules();

                if (is_array($accessRules) && count($accessRules)>0) {

                    $SmACL=new SmACL();
                    if($SmACL->rules($accessRules,$this->view))
                        $class->$actionView();
                    else
                        SmBase::error("You do not have authority to allow");
                }
            } else {
                $class->$actionView();
				$this->controllerAction($componentsController,"afterAction");
            }

        } else {
            SmBase::error("Page Not Found");
        }
    }
	
	public function controllerAction($class,$action)
	{	
		if(method_exists($class, $action))
		{
			$class->$action();
		}
	}

    public function error($err)
    {
        $SiteController=new SiteController();

        SiteController::$error=true;

        $SiteController->error($err);

    }

    private function includeFile()
    {
      require SMCE_PATH."/Smce.php";
    }

    private function dbSetting()
    {
		
		if(isset(SmBase::$config["components"]["ActiveRecord"])){
			
			require_once SMCE_PATH.'/extension/SmActiverecord/ActiveRecord.php';
			
			ActiveRecord\Config::initialize(function($cfg)
			{
				$cfg->set_model_directory(BASE_PATH."/main/model");
				foreach(SmBase::$config["components"]["ActiveRecord"] as $key=>$value){
					$cfg->set_connections(array(
						$key => $value["connectionString"]
					));
				}
			});
			
			
		}
		
    }

	private function base_url()
	{
		return str_replace("/index.php","",$_SERVER['SCRIPT_NAME']);
	}
}
