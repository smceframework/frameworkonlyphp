<?PHP


/*
	HATA KODLARI
		
	1001: Parametre yok, $_GET["params"] boş

*/




define('BASE_PATH',dirname(__FILE__));
require("config/config.php");

$smce=dirname(__FILE__).'/smceframework/index.php';

require_once($smce);



?>