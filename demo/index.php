<?PHP


define('BASE_PATH',dirname(__FILE__));

$config=require("config/config.php");

$smce=dirname(__FILE__).'/../smceframework/smceBase.php';

require_once($smce);
SmceFramework::createWebApplication($config)->run();


?>