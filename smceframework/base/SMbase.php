<?PHP
require(SMCE_BASE_PATH."/base/SMdb.php");

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SMbase extends DB {
	
  	public $controller;
  	public $view;
  
  	public function __construct(){
	    $this->baseURL();
	    $this->_db_SETTING_();
		$this->_includeFILE_();
		$this->baseURLCommand();
  	}
  
  	private function  getCurrentDirectory() {
		return DIRNAME($_SERVER['PHP_SELF']);
 	}
 
	private function baseURL(){

		$request = Request::createFromGlobals();
		$uri = $request->getPathInfo();

		$uriEx = explode("/",substr($uri, 1));

		$this->controller = ucfirst($uriEx[0]);
		$this->view	= ucfirst($uriEx[1]);
		
			
		if(empty($this->controller)){
			$this->controller = "site";
		}

		if(empty($this->view)){
			$this->view = "index";
		}

		define('BASE_CONTROLLER',$this->controller);
		define('BASE_VIEW',$this->view);
	}
  
  	private function baseURLCommand() {
	
		if(! is_file(BASE_PATH."/controller/".$this->controller."Controller.php")){
			$html = '<html><body><h1>Page Not Found</h1></body></html>';
	    	$response = new Response($html, 404);
	    	return $response->send();
		}

		require(BASE_PATH."/controller/".$this->controller."Controller.php");

		$actionView = 'action'.$this->view;
		$actionController = $this->controller."Controller";
	
		$class = new $actionController;

		if(method_exists($class, $actionView)){
			$class->$actionView();
		}else{
			$html = '<html><body><h1>Page Not Found</h1></body></html>';
	    	$response = new Response($html, 404);
	    	return $response->send();
		}
  	}
  
  
  	private function _includeFILE_(){
		require(SMCE_BASE_PATH."/base/Smcontroller.php");
	  	require(SMCE_BASE_PATH."/base/Smce.php");
	  	require(SMCE_BASE_PATH."/GUMP/gump.class.php");
	 
  	}
  
	private function _db_SETTING_(){
		DB::$user=DB_USER;
		DB::$password = DB_PASSWORD; 
		DB::$dbName = DB_NAME;
		DB::$host = DB_HOST;
  	} 
}

  	function __autoload($class_name) {
	    if(file_exists(BASE_PATH."/components/".$class_name . '.php'))
   			 require_once(BASE_PATH."/components/".$class_name . '.php');
			 
		if(file_exists(BASE_PATH."/model/".$class_name . '.php'))
   			 require_once(BASE_PATH."/model/".$class_name . '.php');
  	}
  