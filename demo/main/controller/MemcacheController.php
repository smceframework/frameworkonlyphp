<?php

use Smce\Core\SmController;

use Smce\Core\SmException;
use Smce\Lib\SmMemCache;

class MemcacheController extends SmController
{

    public $layout='//layouts/column1';
	
	public function actionIndex()
	{
		try{
			$conn=new SmMemCache();
			$login=$conn->connect("mem1");
			
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