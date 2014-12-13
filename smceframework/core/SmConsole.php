<?php

namespace Smce\Core;

class SmConsole
{
	private $help=array(
		"language 	 php smce --lang path/to/project/main/lang/main.php",
	);

	private $words=array(
		'--help',
		"--lang",
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
		echo "Comming Soon";
	}

	public function __destruct() {
      echo "\n\n\r\r";
   }
}