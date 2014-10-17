<?PHP


define('BASE_PATH',dirname(__FILE__));
define('BASE_URL',$_SERVER["HTTP_REFERER"]);
require("config/config.php");

$smce=dirname(__FILE__).'/../smceframework/index.php';

require_once($smce);



?>