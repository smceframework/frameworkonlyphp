<?PHP

namespace SMBase;

class Smbase extends \SMLib\SMCli
{
    public static $config;

    public static $controller;
    public static $view;

    public function run()
    {
        session_start();

        Smbase::baseURL();
        Smbase::_includeFILE_();
        Smbase::_db_SETTING_();
        Smbase::baseURLCommand();

    }

    private function getCurrentDirectory()
    {
        return  DIRNAME($_SERVER['PHP_SELF']);
    }

    private function baseURL()
    {
        $uri=$_SERVER["REQUEST_URI"];
        $uri=str_replace ( Smbase::getCurrentDirectory() ,"" ,$uri );
        $uriEx=explode("/",$uri);

        Smbase::$controller    = ucfirst ($uriEx[count($uriEx)-2]);
        $uriEx[count($uriEx)]=explode("?",$uriEx[count($uriEx)-1]);
        Smbase::$view    = ucfirst ($uriEx[count($uriEx)-1][0]);

        if (empty(Smbase::$controller) || empty(Smbase::$view)) {
            Smbase::$controller="site";
            Smbase::$view="index";
        }
        define('BASE_CONTROLLER',strtolower(Smbase::$controller));
        define('BASE_VIEW',strtolower(Smbase::$view));
    }

    private function baseURLCommand()
    {
        if (! is_file(BASE_PATH."/controller/".Smbase::$controller."Controller.php")) {
            Smbase::error("Controller Not Found");
            exit;
        }

        require BASE_PATH."/controller/".Smbase::$controller."Controller.php";

        if(!empty(Smbase::$controller->layout))
            Smbase::$layout=Smbase::$controller->layout;

        $actionView = 'action'.Smbase::$view;
        $actionController = Smbase::$controller."Controller";

        $class = new $actionController();

        if (method_exists($class, $actionView)) {

            if (method_exists ($class , "accessRules" )) {

                $accessRules=$class->accessRules();
                if (is_array($accessRules) && count($accessRules)>0) {

                    $SMAccessRules=new \SMLib\SMAccessRules();
                    if($SMAccessRules->rules($accessRules,Smbase::$view))
                        $class->$actionView();
                    else
                        Smbase::error("You do not have authority to allow");
                }
            } else {
                $class->$actionView();
            }

        } else {

            Smbase::error("Page Not Found");

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
      require SMCE_BASE_PATH."/base/Smcontroller.php";
      require SMCE_BASE_PATH."/base/Smce.php";
    }

    private function _db_SETTING_()
    {
        $_db=Smbase::$config["components"]["db"];

        \DB::$user= $_db["user"];
        \DB::$password = $_db["password"];
        \DB::$dbName = $_db["name"];
        \DB::$host = $_db["host"];
    }

}
