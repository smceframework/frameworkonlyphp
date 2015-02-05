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
use Smce\SmAutoload;
use ActiveRecord;
use Smce;

class SmBase
{
    public static $config;

    public static $controller;
    public static $view;

    /**
	 *
	 * void
	 *
	 * 
	 */
	
    public static function run()
    {
        session_start();

        self::router();

        if(isset(self::$config["components"]["activerecord"]) && count(self::$config["components"]["activerecord"])>0)
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
    	$request=str_replace(self::baseUrl(), "",isset($_SERVER["REQUEST_URI"])?$_SERVER["REQUEST_URI"]:"");

		
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

		if(isset(self::$config["urlrouter"]))
			$SmRouter->setRouter(self::$config["urlrouter"]);
		
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


    private static function command()
    {
        
        if(!self::isController())
        {
        	throw new SmHttpException(404,"Controller Not Found");

        }

		self::setLayout();


		$cController=self::isComponentsController();


		if($cController)
		{
			self::before();
		}
        
		self::getControllerAction($componentsController);
        
        if($cController)
		{
			self::after();
		}

    }

    private static function before()
    {

		self::controllerAction($componentsController,"beforeAction");

    }

    private static function after()
    {

		self::controllerAction($componentsController,"afterAction");

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
    	if (class_exists(ucfirst(self::$controller)."Controller")) {

            return true;

        }else
        {

        	return false;
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
    	if (class_exists("CController")) {

			return new \CController;

		}else
		{
			return false;
		}
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
		
		
		
        $class = new $actionController;
		
        if (method_exists($class, $actionView)) {
           
            if (method_exists ($class , "accessRules" )) {

                $accessRules=$class->accessRules();

                if (is_array($accessRules) && count($accessRules)>0) {

                    $SmACL=new SmACL();

                    if($SmACL->rules(
                    	$accessRules,
                    	self::$view,
                    	Smce::app()->IP,
                    	Smce::app()->getState(md5(md5("SMCE_".Smce::app()->securitycode))))
                    	){

                        $class->$actionView();
                    
                    }else{

					    throw new SmHttpException(404,"You do not have authority to allow");
					}

                }
            } else {

				$class->$actionView();

            }

        } else {

             throw new SmHttpException(404,"Page Not Found");

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
	 * @void
	 * 
	 */

    private static function dbSetting()
    {
		
		SmAutoload::includeFiles();

		ActiveRecord\Config::initialize(function($cfg)
		{
			$cfg->set_model_directory(BASE_PATH."/main/model");
			
			$cfg->set_connections(SmBase::$config["components"]["activerecord"]);
		});

    }

      /**
     *
	 *
	 * @return baseUrl
	 * 
	 */

	public static function baseUrl()
	{
		return str_replace("/index.php","",$_SERVER['SCRIPT_NAME']);
	}
}
