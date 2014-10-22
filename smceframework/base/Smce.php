<?PHP


class Smce extends \SMLib\SMCli
{
  	
	public function app(){
	  $SMUser=new \SMLib\SMUser;
	  return $SMUser;
	}
  
  	public function theme(){
	  $SMLayout=new \SMLib\SMLayout;
	  return $SMLayout;
	}
   
  	
		
    
}


?>
