<?PHP

class Smce extends SMCli
{
  	
	public function app(){
	  $SMUser=new SMUser;
	  return $SMUser;
	}
  
  	public function theme(){
	  $SMLayout=new SMLayout;
	  return $SMLayout;
	}
   
  	
		
    
}


?>
