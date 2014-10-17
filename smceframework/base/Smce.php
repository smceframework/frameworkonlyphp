<?PHP

class Smce extends Smcontroller{
 	
  
   public static $basePath=BASE_PATH;
   
   public function baseUrl(){
	   return Smce::base_url();
	 	
   }
   
   
   public static function basePath(){
	 	return  Smce::$basePath;
   }
   private static function base_url(){
	  return str_replace("/index.php","",$_SERVER['SCRIPT_NAME']);
	}

    
}


?>
