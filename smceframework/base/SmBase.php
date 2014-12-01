<?php

namespace Smce\Base;

use Smce\Core\SmController;
use Smce\Core\SmAccessRules;
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
        SmBase::_includeFILE_();
        SmBase::_db_SETTING_();
        SmBase::baseURLCommand();
		
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

    private function baseURLCommand()
    {
        if (! is_file(BASE_PATH."/controller/".ucfirst($this->controller)."Controller.php")) {
            SmBase::error("Controller Not Found");
            exit;
        }
		
        require BASE_PATH."/controller/".ucfirst($this->controller)."Controller.php";

        if(!empty($this->controller->layout))
            SmBase::$layout=$this->controller->layout;
		
        $actionView = 'action'.ucfirst($this->view);
        $actionController = $this->controller."Controller";
		
        $class = new $actionController();
		
        if (method_exists($class, $actionView)) {
           
            if (method_exists ($class , "accessRules" )) {

                $accessRules=$class->accessRules();

                if (is_array($accessRules) && count($accessRules)>0) {

                    $SmAccessRules=new SmAccessRules();
                    if($SmAccessRules->rules($accessRules,$this->view))
                        $class->$actionView();
                    else
                        SmBase::error("You do not have authority to allow");
                }
            } else {
                $class->$actionView();
            }

        } else {
            SmBase::error("Page Not Found");
        }
    }

    public function error($err)
    {
        $SiteController=new SiteController();

        SiteController::$error=true;

        $SiteController->error($err);

    }

    private function _includeFILE_()
    {
      require SMCE_PATH."/Smce.php";
    }

    private function _db_SETTING_()
    {
		if(isset(SmBase::$config["components"]["MeekroDB"])){
			$_db=SmBase::$config["components"]["MeekroDB"];
	
			\DB::$user= $_db["user"];
			\DB::$password = $_db["password"];
			\DB::$dbName = $_db["name"];
			\DB::$host = $_db["host"];
			
			
		}
		
		if(isset(SmBase::$config["components"]["ActiveRecord"])){
			
			ActiveRecord\Config::initialize(function($cfg)
			{
				$cfg->set_model_directory(BASE_PATH."/model");
				$cfg->set_connections(array(
				'development' => SmBase::$config["components"]["ActiveRecord"]["connectionString"]));
			});
		}
		
    }

	private function base_url()
	{
		return str_replace("/index.php","",$_SERVER['SCRIPT_NAME']);
	}
}
