<?PHP

class Smcontroller{
	public $layout='//layouts/column1';
	
	public $content;
	
	public function render($url="",$array=array()){
		ob_start();
		
		extract($array);
		  include(Smce::basePath()."\\view\\".BASE_CONTROLLER."\\".$url.".php");
		$content = ob_get_contents();
		
		ob_end_clean();
		  include(Smce::basePath()."/view/".$this->layout.".php");
		   
	}
	
	public function content($url){
		 include(Smce::basePath()."/view/".$url.".php");
	}
	
	
	
}