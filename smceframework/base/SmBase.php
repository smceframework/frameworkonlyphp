<?php

namespace Smce\Base;

use Smce\Core\SmController;
use Smce\Core\SmAccessRules;
use Smce\Core\SmCli;
use Smce\Core\SmUrlRouter;


class SmBase extends SmCli
{
    public static $config;

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
		$request=str_replace($this->base_url()."/", "",$_SERVER["REQUEST_URI"]);
		
		$SmUrlRouter=new SmUrlRouter;
		if(isset($_GET["page"]) && $request!=$_GET["page"]){
			
			
			$SmUrlRouter->setRules(self::$config["urlRouter"]);
			$SmUrlRouter->run($_GET);
		}else{
		
			if(isset($_GET["page"]))
				$page=explode("/",$_GET["page"]);
			elseif(isset($_GET["route"]))
				$page=explode("/",$_GET["route"]);
			
			if(isset($page) && isset(self::$config["urlRouter"]["router"][$page[0]]))
			{
				$router=self::$config["urlRouter"]["router"][$page[0]];
			}else{
				$router=self::$config["urlRouter"]["router"]["all"];
			}
			
			
		}
		
		$controllerView=$SmUrlRouter->getSet($router,$_GET);
		
        if(isset($_GET["page"]))
        {
			
            $this->controller    = ucfirst($controllerView["controller"]);
            $this->view    = ucfirst($controllerView["view"]);
        }elseif(isset($_GET["route"])){
             $uriEx=explode("/",$_GET["route"]);
            $this->controller    = ucfirst($controllerView["controller"]);
            $this->view    = ucfirst($controllerView["view"]);
        }else{
            $this->controller="Site";
            $this->view="Index";
        }
		
        define('BASE_CONTROLLER',strtolower($this->controller));
        define('BASE_VIEW',strtolower($this->view));

    }

    private function baseURLCommand()
    {
        if (! is_file(BASE_PATH."/controller/".$this->controller."Controller.php")) {
            SmBase::error("Controller Not Found");
            exit;
        }
		
        require BASE_PATH."/controller/".ucfirst($this->controller)."Controller.php";

        if(!empty($this->controller->layout))
            SmBase::$layout=$this->controller->layout;
		
        $actionView = 'action'.$this->view;
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
        $SiteController=new \SiteController();

        \SiteController::$error=true;

        $SiteController->error($err);

    }

    private function _includeFILE_()
    {
      require SMCE_PATH."/Smce.php";
    }

    private function _db_SETTING_()
    {
        $_db=SmBase::$config["components"]["db"];

        \DB::$user= $_db["user"];
        \DB::$password = $_db["password"];
        \DB::$dbName = $_db["name"];
        \DB::$host = $_db["host"];
    }

	private function base_url()
	{
		return str_replace("/index.php","",$_SERVER['SCRIPT_NAME']);
	}
}
