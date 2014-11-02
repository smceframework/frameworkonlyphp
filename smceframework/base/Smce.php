<?PHP


class Smce extends \SMLib\SMCli
{
  	private static $SMUser = null;
  	private static $SMLayout = null;

	public static function app(){
	  if (static::$SMUser === null) {
	  	static::$SMUser=new \SMLib\SMUser;
	  }
	  return static::$SMUser;
	}
  
  	public static function theme(){
  	  if (static::$SMLayout === null) {
	  	static::$SMLayout=new \SMLib\SMLayout;
	  }
	  return static::$SMLayout;
	}
   
  	
		
    
}


?>
