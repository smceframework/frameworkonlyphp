<?php
	
  
return array(
	'name'=>'SmceFramework',
	
	// autoloading model and component classes
	'import'=>array(
		'models',
		'components',
	),
	
	'debug'=>false,
	
	'components'=>array(
		'db'=>array(
			'user'=>"root",
			'password'=>"",
			'name'=>"",
			'host'=>"localhost",
		),
	),
);


?>