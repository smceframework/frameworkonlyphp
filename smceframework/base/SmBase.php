<?php

namespace smce\base;

use smce\base\SmLib\DB;
use smce\base\SmLib\SmController;
use smce\base\SmLib\SmAccessRules;
use smce\base\SmLib\SmCli;

class SmBase extends SmCli
{
    public static $config;

    public static $controller;
    public static $view;

	
    public function run()
    {
        session_start();
        SmBase::baseURL();
        SmBase::_includeFILE_();
        SmBase::_db_SETTING_();
        SmBase::baseURLCommand();
		
    }

    private function getCurrentDirectory()
    {
        return  DIRNAME($_SERVER['PHP_SELF']);
    }

    private function baseURL()
    {
        $uri=$_SERVER["REQUEST_URI"];
        $uri=str_replace ( SmBase::getCurrentDirectory() ,"" ,$uri );
        $uriEx=explode("/",$uri);

        SmBase::$controller    = ucfirst ($uriEx[count($uriEx)-2]);
        $uriEx[count($uriEx)]=explode("?",$uriEx[count($uriEx)-1]);
        SmBase::$view    = ucfirst ($uriEx[count($uriEx)-1][0]);
        if (empty(SmBase::$controller) || empty(SmBase::$view)) {
            SmBase::$controller="site";
            SmBase::$view="index";
        }
        define('BASE_CONTROLLER',strtolower(SmBase::$controller));
        define('BASE_VIEW',strtolower(SmBase::$view));
    }

    private function baseURLCommand()
    {
        if (! is_file(BASE_PATH."/controller/".ucfirst(SmBase::$controller)."Controller.php")) {
            SmBase::error("Controller Not Found");
            exit;
        }
		
        require BASE_PATH."/controller/".ucfirst(SmBase::$controller)."Controller.php";

        if(!empty(SmBase::$controller->layout))
            SmBase::$layout=SmBase::$controller->layout;
		
        $actionView = 'action'.SmBase::$view;
        $actionController = SmBase::$controller."Controller";
		
        $class = new $actionController();

        if (method_exists($class, $actionView)) {

            if (method_exists ($class , "accessRules" )) {

                $accessRules=$class->accessRules();
                if (is_array($accessRules) && count($accessRules)>0) {

                    $SmAccessRules=new SmAccessRules();
                    if($SmAccessRules->rules($accessRules,SmBase::$view))
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

    private function error($err)
    {
        $SiteController=new SiteController();

        SiteController::$error=false;

        $SiteController->error($err);

    }

    private function _includeFILE_()
    {
      require SMCE_PATH."/Smce.php";
    }

    private function _db_SETTING_()
    {
        $_db=SmBase::$config["components"]["db"];

        DB::$user= $_db["user"];
        DB::$password = $_db["password"];
        DB::$dbName = $_db["name"];
        DB::$host = $_db["host"];
    }

}
