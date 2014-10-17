

<?PHP


require(SMCE_BASE_PATH."/base/SMdb.php");

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
	return  DIRNAME($_SERVER['PHP_SELF']);
 }
 
  private function baseURL(){
	 $uri=$_SERVER["REQUEST_URI"];
	$uri=str_replace ( $this->getCurrentDirectory() ,"" ,$uri );
	$uriEx=explode("/",$uri);
	
	$this->controller	= ucfirst ($uriEx[count($uriEx)-2]);
	$uriEx[count($uriEx)]=explode("?",$uriEx[count($uriEx)-1]);
	$this->view	= ucfirst ($uriEx[count($uriEx)-1][0]);
	
		
	if(empty($this->controller) || empty($this->view)){
		$this->controller="site";
		$this->view="index";
	}
	define('BASE_CONTROLLER',$this->controller);
	define('BASE_VIEW',$this->view);
  }
  
  private function baseURLCommand(){
	
	require(BASE_PATH."/controller/".$this->controller."Controller.php");
	$actionView="action".$this->view;
	$actionController=$this->controller."Controller";
	
	$class=new $actionController;
	
	
	$class->$actionView();
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
  