<?PHP

namespace SmceFramework;
class Smcontroller extends \SMBase\Smve{
	
	public $content;
	public static $error=true;
	
	
	
	public function render($url="",$array=array()){
		ob_start();
		
		if(! is_file(\Smce::app()->basePath."\\view\\".(self::$error==true?BASE_CONTROLLER:"site")."\\".$url.".php")){
				$html = '<html><body><h1>View Not Found "'.$url.'"</h1></body></html>';
				echo $html;
				exit;
		}else{
			
			 extract($array);
			 include(\Smce::app()->basePath."\\view\\".(self::$error==true?BASE_CONTROLLER:"site")."\\".$url.".php");
		}
		
		$content = ob_get_contents();
		
		ob_end_clean();
		
		$components="Controller";
		$layout="";
		if(!empty($this->layout)){
			$layout=$this->layout;
		}elseif(class_exists($components) && isset(\Controller::$layout)){
			$layout=\Controller::$layout;
		}
		
		if(empty($layout)){
			
				$html = '<html><body><h1>Not Set Layout</h1></body></html>';
				echo $html;
				exit;
		}elseif(!is_file(\Smce::app()->basePath."\\view".$layout.".php")){
			
				$html = '<html><body><h1>Layout Not Found "'.$layout.'"</h1></body></html>';
				echo $html;
				exit;
		}else{
				include(\Smce::app()->basePath."\\view".$layout.".php");
		}
		   
	}
	
	
	
	
	
}