<?PHP

namespace SMLib;

class SMLayout extends \SMLib\SMCli
{
	public function content($url,$array=array())
	{
		extract($array);
		if (!is_file(\Smce::app()->basePath.(BASE_THEME=="" ? "\\" : "\\theme\\".BASE_THEME."\\")."view".$url.".php")) {

				$html = '<html><body><h1>Content Not Found "'.(BASE_THEME=="" ? "\\" : "theme\\".BASE_THEME."\\")."view\\".$url.'"</h1></body></html>';
				echo $html;
				exit;
		} else {
			include (\Smce::app()->basePath.(BASE_THEME=="" ? "\\" : "\\theme\\".BASE_THEME."\\")."view".$url.".php");
		}
	}
}
