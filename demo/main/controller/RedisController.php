<?php

use Smce\Core\SmController;

use Smce\Core\SmException;
use Smce\Core\SmRedis;

class RedisController extends SmController
{

    public $layout='//layouts/column1';
	
	public function actionIndex()
	{
		try{
			$conn=new SmRedis();
			$login=$conn->connect("red1");
			
			$object = new stdClass;
			$object->str_attr = 'test';
			$object->int_attr = 123;
			
			$login->set("key",$object,300); //300 second
			print_r($login->get("key"));
			
		}catch(SmException $e){
			echo $e->getMessage();
		}
		
	}
	
	
	
	
}