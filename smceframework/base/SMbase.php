

<?PHP


require(SMCE_BASE."/base/SMdb.php");

class SMbase extends DB {
	
	
  public function __construct(){
	    $this->_db_SETTING_();
   		$this->baseURLCommand();
		$this->_includeFILE_();
		
  }
  
  private function  getCurrentDirectory() {
	return  DIRNAME($_SERVER['PHP_SELF']);
 }
  
  private function baseURLCommand(){
	
	 $uri=$_SERVER["REQUEST_URI"];
	$uri=str_replace ( $this->getCurrentDirectory() ,"" ,$uri );
	$uriEx=explode("/",$uri);
	
	$controller	= ucfirst ($uriEx[count($uriEx)-2]);
	$uriEx[count($uriEx)]=explode("?",$uriEx[count($uriEx)-1]);
	$view	= ucfirst ($uriEx[count($uriEx)-1][0]);
	
	if(empty($controller) || empty($view)){
		$controller="site";
		$view="index";
	}
		
	require(BASE_PATH."/controller/".$controller."Controller.php");
	$actionView="action".$view;
	$actionController=$controller."Controller";
	
	$class=new $actionController;
	
	
	$class->$actionView();
  }
  
  
  private function _includeFILE_(){
	
	  require(SMCE_BASE."/GUMP/gump.class.php");
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
  