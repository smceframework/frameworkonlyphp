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

    public static $controller;
    public static $view;

    /**
	 *
	 * void
	 *
	 * 
	 */
	
    public function run()
    {
        session_start();

        self::router();

        self::includeFile();

        self::dbSetting();

        self::command();
		
    }

    /**
	 *
	 * void
	 *
	 * 
	 */

	public function commandLineRun()
    {
        self::includeFile();
        self::dbSetting();
    }

    /**
	 *
	 *
	 * @return request
	 * 
	 */

    private static function getRequestUri()
    {
    	$request=str_replace(self::base_url(), "",isset($_SERVER["REQUEST_URI"])?$_SERVER["REQUEST_URI"]:"");

		
		if(substr($request,0,1)=="/")
			$request=substr($request,1,strlen($request));
			
		return str_replace("index.php", "",$request);
		
    }

     /**
	 * 
	 * @param request
	 *
	 * @return SmRouter requestArray
	 * 
	 */

    private static function setSmRouter($request)
    {
    	$SmRouter=new SmRouter;
		
		$SmRouter->setRequest($request);

		if(isset($_GET["route"]))
			$SmRouter->setRoute($_GET["route"]);

		if(isset(self::$config["urlrouter"])){
			$SmRouter->setRouter(self::$config["urlrouter"]);
		}else
			$SmRouter->setRouter(self::$configSmce["urlrouter"]);
		
		return $SmRouter->run();

    }

      /**
     *
	 * @param requestArray
	 *
	 * @void
	 * 
	 */


    private static function setControllerView($requestArray)
    {
    	if(isset($requestArray)){
			foreach ($requestArray as $key => $value)
				$_GET[$key]=$value;
			
		}
		
      	self::$controller=strtolower($requestArray["controller"]);
        self::$view=strtolower($requestArray["view"]);
		
        define('BASE_CONTROLLER',strtolower(self::$controller));
        define('BASE_VIEW',strtolower(self::$view));
    }


      /**
     *
	 * 
	 *
	 * @void
	 * 
	 */
   
    private static function router()
    {
		
		$request=self::getRequestUri();

		self::setControllerView(self::setSmRouter($request));
		
    }


      /**
     *
	 * 
	 *
	 * @void
	 * 
	 */


    private static function command()
    {
        
        self::isController();

		$componentsController=self::isComponentsController();
		
		self::includeController();
        
		self::setLayout();
        
		self::getControllerAction($componentsController);
        
    }



      /**
     *
	 *
	 *
	 * @void
	 * 
	 */

    private static function isController()
    {
    	if (! is_file(BASE_PATH."/main/controller/".ucfirst(self::$controller)."Controller.php")) {
            SmHttpException::htppError(404,"Controller Not Found");
			exit();
        }
    }


      /**
     *
	 * 
	 *
	 * @return Controller or empty;
	 * 
	 */

    private static function isComponentsController()
    {
    	if (is_file(BASE_PATH."/main/components/Controller.php")) {
			require BASE_PATH."/main/components/Controller.php";
			return new \Controller;
		}else
			return "";
    }

     /**
     *
	 * 
	 *
	 * @void
	 * 
	 */


    private static function includeController()
    {

    	require BASE_PATH."/main/controller/".ucfirst(self::$controller)."Controller.php";
    }

     /**
     *
	 * 
	 *
	 * @void
	 * 
	 */

    private static function setLayout()
    {

    	if(!empty(self::$controller->layout))
            self::$layout=self::$controller->layout;
    }

     /**
     *
	 * @param componentsController
	 *
	 * @void
	 * 
	 */

    public static function getControllerAction($componentsController)
    {
    	$actionView = 'action'.ucfirst(self::$view);
        $actionController = ucfirst(self::$controller."Controller");
		
		self::controllerAction($componentsController,"beforeAction");
		
        $class = new $actionController;
		
        if (method_exists($class, $actionView)) {
           
            if (method_exists ($class , "accessRules" )) {

                $accessRules=$class->accessRules();

                if (is_array($accessRules) && count($accessRules)>0) {

                    $SmACL=new SmACL();
                    if($SmACL->rules($accessRules,self::$view,Smce::app()->IP,Smce::app()->getState(md5(md5("SMCE_".Smce::app()->securitycode)))))
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
					self::controllerAction($componentsController,"afterAction");

				}catch(SmHttpException $e){

				 	SmHttpException::htppError($e->getHttpCode,$e->getMessage());

				}
            }

        } else {

			header('HTTP/1.0 404 Not Found');
            SmHttpException::htppError(404,"Page Not Found");

        }
    }
    
    /**
     *
	 * @param $class
	 * @param $action
	 *
	 * @void
	 * 
	 */
	
	public static function controllerAction($class,$action)
	{	
		if(method_exists($class, $action))
		{
			$class->$action();
		}
	}


	  /**
     *
	 *
	 * @void
	 * 
	 */
 

    private function includeFile()
    {
      	require_once SMCE_PATH."/Smce.php";
    }


      /**
     *
	 * @void
	 * 
	 */

    private function dbSetting()
    {
		
		if(isset(self::$config["components"]["activerecord"]) && count(self::$config["components"]["activerecord"])>0){
			
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

      /**
     *
	 *
	 * @return baseUrl
	 * 
	 */

	private static function base_url()
	{
		return str_replace("/index.php","",$_SERVER['SCRIPT_NAME']);
	}
}
