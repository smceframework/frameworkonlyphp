<?php

namespace Smce\Core;


class SmConsole
{
	private $help=array(
		"language 		php smce --lang path/to/project/main/lang/main.php",
		"grud/newmodel		php smce --grud model users",
	);

	private $words=array(
		'--help',
		"--lang",
		"--grud",
	);

	public function __construct($argv=array())
	{
		
		if (isset($argv[1]) && in_array($argv[1], $this->words)) {
			$word=str_replace("-", "_", $argv[1]);
			$this->$word($argv);
		}else
			echo "Undefined words. You can get help . ( php smce --help )";

	}


	public function __help($argv)
	{
		foreach($this->help as $key=>$value)
		{
			echo $value."\n\n\r\r";
		}
	}

	public function __lang($argv)
	{
		echo "Cooming Son";
	}
	
	
	public function __grud($argv)
	{
		
		if(isset($argv[2]) && isset($argv[3]) && isset($argv[4]) && !empty($argv[2]) && !empty($argv[4]) && $argv[2]=="model"){
			
			try{
				
				$SmGrud=new SmGrud();
				$SmGrud->newModel($argv[3],$argv[4]);
				
			}catch(SmException $e){
				
				echo $e->getMessage();
				
			}
			
		}else
			echo "Undefined words. You can get help . ( php smce --help )";
	}


	public function __destruct() {
      echo "\n\n\r\r";
   }
}