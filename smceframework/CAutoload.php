<?PHP

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
use Smce\SmAutoload;

define('SMCE_PATH',dirname(__FILE__));

require("SmAutoload.php");
$SmAutoload=new SmAutoload;
$SmAutoload->registerComposer();