<?php


return array(
	'name'=>'SmceFramework',

	// autoloading model and component classes
    'import'=>array(
		'model',
		'components',
	),

	'debug'=>false,

	'components'=>array(
		'db'=>array(
			'user'=>"root",
			'password'=>"fy23tz98",
			'name'=>"faselis",
			'host'=>"localhost",
		),
	),
);
