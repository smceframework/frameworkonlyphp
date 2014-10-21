<?PHP
require_once(SMCE_BASE_PATH."\base\Smve.php");
class Smcontroller extends Smve{
	
	public $content;
	public static $error=true;
	
	
	
	public function render($url="",$array=array()){
		ob_start();
		
		if(! is_file(Smce::app()->basePath."\\view\\".(self::$error==true?BASE_CONTROLLER:"site")."\\".$url.".php")){
				$html = '<html><body><h1>View Not Found "'.$url.'"</h1></body></html>';
				echo $html;
				exit;
		}else{
			
			 extract($array);
			 include(Smce::app()->basePath."\\view\\".(self::$error==true?BASE_CONTROLLER:"site")."\\".$url.".php");
		}
		
		$content = ob_get_contents();
		
		ob_end_clean();
		
		if(!empty($this->layout) && ! is_file(Smce::app()->basePath."\\view".$this->layout.".php")){
			echo "asdasd";
			exit;
				$html = '<html><body><h1>Layout Not Found "'.$this->layout.'"</h1></body></html>';
				echo $html;
				exit;
		}else{
			 include(Smce::app()->basePath."\\view".Controller::$layout.".php");
		}
		   
	}
	
	
	
	
	
}