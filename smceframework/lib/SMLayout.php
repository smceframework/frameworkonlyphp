<?PHP

class SMLayout extends SMCli{
	
	public  function content($url){
		
		include(Smce::app()->basePath."\\view".$url.".php");
	}
}