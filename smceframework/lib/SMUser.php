<?PHP


class SMUser extends SMCli{
	 
	 
	public $data=array();
	
	public function __construct(){
		$this->data["basepath"]=BASE_PATH;
		$this->data["baseurl"]=$this->base_url();
	    $this->data["ip"]=$this->getIP();
		
	}
	
	public function __get($name){
		return $this->data[strtolower($name)];
	}
	
	public function createUrl($url="",$array=array()){
	  $STR=$this->data["baseurl"]."/".$url;
	  if(isset($array["id"])){
	  	$STR.="/".$array["id"];
		unset($array["id"]);
	  }
	  foreach($array as $key=>$value)
	  	$STR.="?".$key."=".$value;
		
		return $STR;
	}
	
	private  function base_url(){
		return str_replace("/index.php","",$_SERVER['SCRIPT_NAME']);
	}
	
	private function getIP(){
		if(getenv("HTTP_CLIENT_IP")) {
			$ip = getenv("HTTP_CLIENT_IP");
		} elseif(getenv("HTTP_X_FORWARDED_FOR")) {
			$ip = getenv("HTTP_X_FORWARDED_FOR");
			if (strstr($ip, ',')) {
				$tmp = explode (',', $ip);
				$ip = trim($tmp[0]);
			}
		} else {
		$ip = getenv("REMOTE_ADDR");
		}
		return $ip;
	}
	
	
	public function setState($key,$value){
		if($_SESSION[$key]=$value)
			return true;
	}
	
	public function getState($key){
		if(isset($_SESSION[$key]))
			return $_SESSION[$key];
		else
			return false;
	}
	
	public function stateClear(){
		session_destroy();
	}
	
	public function login($_identity,$duration){
		$this->setState("smce_login71",true);
		
		session_set_cookie_params($duration);
	}
	
	public function caControl($urlArray=array()){
		
		$ur=BASE_CONTROLLER."/".BASE_VIEW;
		
		if(in_array($ur,$urlArray))
			return true;
	}
	
}