<?php

namespace Sm_Base;

class Sm_Base extends \SMLib\SM_Cli
{
    public static $config;

    public static $controller;
    public static $view;

    public function run()
    {
        session_start();

        Sm_Base::baseURL();
        Sm_Base::_includeFILE_();
        Sm_Base::_db_SETTING_();
        Sm_Base::baseURLCommand();

    }

    private function getCurrentDirectory()
    {
        return  DIRNAME($_SERVER['PHP_SELF']);
    }

    private function baseURL()
    {
        $uri=$_SERVER["REQUEST_URI"];
        $uri=str_replace ( Sm_Base::getCurrentDirectory() ,"" ,$uri );
        $uriEx=explode("/",$uri);

        Sm_Base::$controller    = ucfirst ($uriEx[count($uriEx)-2]);
        $uriEx[count($uriEx)]=explode("?",$uriEx[count($uriEx)-1]);
        Sm_Base::$view    = ucfirst ($uriEx[count($uriEx)-1][0]);

        if (empty(Sm_Base::$controller) || empty(Sm_Base::$view)) {
            Sm_Base::$controller="site";
            Sm_Base::$view="index";
        }
        define('BASE_CONTROLLER',strtolower(Sm_Base::$controller));
        define('BASE_VIEW',strtolower(Sm_Base::$view));
    }

    private function baseURLCommand()
    {
        if (! is_file(BASE_PATH."/controller/".Sm_Base::$controller."Controller.php")) {
            Sm_Base::error("Controller Not Found");
            exit;
        }

        require BASE_PATH."/controller/".Sm_Base::$controller."Controller.php";

        if(!empty(Sm_Base::$controller->layout))
            Sm_Base::$layout=Sm_Base::$controller->layout;

        $actionView = 'action'.Sm_Base::$view;
        $actionController = Sm_Base::$controller."Controller";

        $class = new $actionController();

        if (method_exists($class, $actionView)) {

            if (method_exists ($class , "accessRules" )) {

                $accessRules=$class->accessRules();
                if (is_array($accessRules) && count($accessRules)>0) {

                    $SMAccessRules=new \SMLib\SM_Access_Rules();
                    if($SMAccessRules->rules($accessRules,Sm_Base::$view))
                        $class->$actionView();
                    else
                        Sm_Base::error("You do not have authority to allow");
                }
            } else {
                $class->$actionView();
            }

        } else {

            Sm_Base::error("Page Not Found");

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
      require SMCE_BASE_PATH."/base/Sm_Controller.php";
      require SMCE_BASE_PATH."/base/Smce.php";
    }

    private function _db_SETTING_()
    {
        $_db=Sm_Base::$config["components"]["db"];

        \DB::$user= $_db["user"];
        \DB::$password = $_db["password"];
        \DB::$dbName = $_db["name"];
        \DB::$host = $_db["host"];
    }

}
