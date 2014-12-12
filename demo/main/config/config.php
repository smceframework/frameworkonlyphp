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
			'db'=>array(
				"connectionString"=>"mysql://username:password@localhost/db_name"
			),
			
			/*
			'db2'=>array(
				"connectionString"=>"mysql://username:password@localhost/db_name"
			),
			*/
		),
		
		
		'SSH'=>array(
			"ssh1"=>array(
				"host"=>"ec2-xx.xx.xx.xx.compute-1.amazonaws.com",
				"username"=>"root",
				//"password"=>"",
				"port"=>"22",
				"pemfile"=>BASE_PATH."/main/data/centosKEy.pem",
			),
			
			/*
			"ssh2"=>array(
				"host"=>"ec2-xx.xx.xx.xx.compute-1.amazonaws.com",
				"username"=>"root",
				//"password"=>"",
				"port"=>"22",
				"pemfile"=>BASE_PATH."/main/data/centosKEy.pem",
			),
			*/
		),
		
		
		'MemCache'=>array(
			"mem1"=>array(
				'host' => 'localhost', 
                'port' => 11211,
			),
			
		),
		
		
	),
);
