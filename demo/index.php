<?PHP


define('BASE_PATH',dirname(__FILE__));

require("config/config.php");


$smce=dirname(__FILE__).'/../smceframework/index.php';

require(__DIR__ . '/../vendor/autoload.php');
require_once($smce);



?>