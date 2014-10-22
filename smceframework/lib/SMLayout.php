<?PHP

namespace SMLib;

class SMLayout extends \SMLib\SMCli{
	
	public  function content($url){
		
		
		include(\Smce::app()->basePath."\\view".$url.".php");
		
		
	}
}