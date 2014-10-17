<?PHP

class Smcontroller{
	public $layout='//layouts/column1';
	
	public $content;

	public function render($url="",$array=array()){
		ob_start();
		extract($array);
		  require_once(Smce::basePath()."/view/".BASE_CONTROLLER."/".$url.".php");
		$content = ob_get_contents();
		ob_end_clean();
		 
		require_once(Smce::basePath()."/view/".$this->layout.".php");   
	}
	
	public function content($url){
		require_once(Smce::basePath()."/view/".$url.".php");
	}
}