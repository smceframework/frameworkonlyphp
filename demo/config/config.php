<?php


return [
	'name'=>'SmceFramework',

	// autoloading model and component classes
    'import'=>[
		'model',
		'components',
	],

	'debug'=>true,
	
	
	'urlRouter'=>[
		'router'=>[
			"all"=>[],
			"router"=>["::veriA::","::dataB::"],
		],
		'showScriptName'=>false, //false - true
		
		/*
			'showScriptName'=>true,
			
			//App Path .htaccess
			
			RewriteEngine on

			# if a directory or a file exists, use it directly
			RewriteCond %{REQUEST_FILENAME} !-f
			RewriteCond %{REQUEST_FILENAME} !-d
			
			# otherwise forward it to index.php
			
			# RewriteRule . index.php
			RewriteRule ^(.*)$ index.php?page=$1 [L,NC]
		
		*/	
	],
	
	'components'=>[
		'db'=>[
			'user'=>"root",
			'password'=>"",
			'name'=>"",
			'host'=>"localhost",
		],
	],
];
