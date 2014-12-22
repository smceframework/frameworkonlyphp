<?php


return array(
	'appname'=>'Smce Framework',
	
	//security code (change)
	"securitycode"=>"92378sadjsa712lf92s",

	// autoloading model and component classes
    'import'=>array(
		'model',
		'components',
	),

	'debug'=>true,
	
	
	'urlrouter'=>array(
		'router'=>array(
			"all"=>array("id"),
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
		'activerecord'=>array(
			'db1'=>array(
				"connectionString"=>"mysql://root:password@localhost/db_name"
			),
			
			/*
			'db2'=>array(
				"connectionString"=>"mysql://username:password@localhost/db_name"
			),
			*/
		),
		
		/*
		'ssh'=>array(
			"ssh1"=>array(
				"host"=>"ec2-xx.xx.xx.xx.compute-1.amazonaws.com",
				"username"=>"root",
				//"password"=>"",
				"port"=>"22",
				"pemfile"=>BASE_PATH."/main/data/centosKEy.pem",
			),
			
			
			"ssh2"=>array(
				"host"=>"ec2-xx.xx.xx.xx.compute-1.amazonaws.com",
				"username"=>"root",
				//"password"=>"",
				"port"=>"22",
				"pemfile"=>BASE_PATH."/main/data/centosKEy.pem",
			),
			
		),
		
		/*
		'memcache'=>array(
			"mem1"=>array(
				'host' => 'localhost', 
                'port' => 11211,
			),
			
			"mem2"=>array(
				'host' => 'localhost', 
                'port' => 11211,
			),
		),
		
		'redis'=>array(
			"red1"=>array(
				'host' => 'localhost', 
                'port' => 6379,
			),
			
			"red2"=>array(
				'host' => 'localhost', 
                'port' => 6379,
			),
		),
		
		*/
	),
);
