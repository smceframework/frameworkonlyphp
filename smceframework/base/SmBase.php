<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/smceframework
 */

namespace Smce\Base;


use Smce\Core\SmHttpException;
use Smce\Core\SmACL;
use Smce\Core\SmRouter;
use ActiveRecord;
use Smce;

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

	public function commandLineRun()
    {
        SmBase::includeFile();
        SmBase::dbSetting();
    }

    private function baseURL()
    {
		$request=str_replace($this->base_url(), "",$_SERVER["REQUEST_URI"]);
		
		if(substr($request,0,1)=="/")
			$request=substr($request,1,strlen($request));
			
		$request=str_replace("index.php", "",$request);
		
		$SmRouter=new SmRouter;
		
		$SmRouter->setRequest($request);

		if(isset($_GET["route"]))
			$SmRouter->setRoute($_GET["route"]);

		if(isset(self::$config["urlrouter"])){
			$SmRouter->setRouter(self::$config["urlrouter"]);
		}else
			$SmRouter->setRouter(self::$configSmce["urlrouter"]);
		
		$requestArray=$SmRouter->run();
		
	
		if(isset($requestArray)){
			foreach ($requestArray as $key => $value)
				$_GET[$key]=$value;
			
		}
		
      	$this->controller=strtolower($requestArray["controller"]);
        $this->view=strtolower($requestArray["view"]);
		
        define('BASE_CONTROLLER',strtolower($this->controller));
        define('BASE_VIEW',strtolower($this->view));

    }

    private function command()
    {
        if (! is_file(BASE_PATH."/main/controller/".ucfirst($this->controller)."Controller.php")) {
            SmHttpException::htppError(404,"Controller Not Found");
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
        $actionController = ucfirst($this->controller."Controller");
		
		$this->controllerAction($componentsController,"beforeAction");
		
        $class = new $actionController;
		
        if (method_exists($class, $actionView)) {
           
            if (method_exists ($class , "accessRules" )) {

                $accessRules=$class->accessRules();

                if (is_array($accessRules) && count($accessRules)>0) {

                    $SmACL=new SmACL();
                    if($SmACL->rules($accessRules,$this->view,Smce::app()->IP,Smce::app()->getState(md5(md5("SMCE_".Smce::app()->securitycode)))))
                        $class->$actionView();
                    else{
					    header('HTTP/1.0 404 Not Found');
                        SmHttpException::htppError(404,"You do not have authority to allow");
					}
                }
            } else {
				try
				{
					$class->$actionView();
					$this->controllerAction($componentsController,"afterAction");
				}catch(SmHttpException $e){
				 	SmHttpException::htppError($e->getHttpCode,$e->getMessage());
				}
            }

        } else {
			header('HTTP/1.0 404 Not Found');
            SmHttpException::htppError(404,"Page Not Found");
        }
    }
	
	public function controllerAction($class,$action)
	{	
		if(method_exists($class, $action))
		{
			$class->$action();
		}
	}
 

    private function includeFile()
    {
      require_once SMCE_PATH."/Smce.php";
    }

    private function dbSetting()
    {
		
		if(isset(SmBase::$config["components"]["activerecord"])){
			
			require_once SMCE_PATH.'/extension/SmActiverecord/ActiveRecord.php';
			
			ActiveRecord\Config::initialize(function($cfg)
			{
				$cfg->set_model_directory(BASE_PATH."/main/model");
				foreach(SmBase::$config["components"]["activerecord"] as $key=>$value){
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
