<?php


return array(
	'name'=>'SmceFramework',

	// autoloading model and component classes
    'import'=>array(
		'model',
		'components',
	),

	'debug'=>true,
	
	
	'urlRouter'=>array(
		'router'=>array(
			"all"=>array(),
			"router"=>array("::veriA::","::dataB::"),
		),
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
	),
	
	'components'=>array(
		
		//MySQL, SQLite, PostgreSQL, Oracle
		'ActiveRecord'=>array(
			"connectionString"=>"mysql://username:password@localhost/db_name"
		),
		
		
	),
);
