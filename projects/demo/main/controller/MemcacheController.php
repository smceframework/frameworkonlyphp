<?php

use Smce\Core\SmController;

use Smce\Core\SmException;
use Smce\Core\SmMemCache;

class MemcacheController extends SmController
{

    public $layout='//layouts/column2';
	
	public function actionIndex()
	{
		try{
			$conn=new SmMemCache();
			$login=$conn->connect("mem1");
			
			$object = new stdClass;
			$object->str_attr = 'test';
			$object->int_attr = 1234;
			
			//set
			$login->set("key",$object,false,300); //300 second

			//get
			print_r($login->get("key"));
			
		}catch(SmException $e){
			echo $e->getMessage();
		}
		
	}
	
	
	public function actionIndex2()
	{
		try{
			$conn=new SmMemCache();
			$login=$conn->connect("mem1");
			
			$object = new stdClass;
			$object->str_attr = 'test';
			$object->int_attr = 1234;
			
			//set
			$login->getMemcache()->set("key",$object,false,300); //300 second

			//get
			print_r($login->getMemcache()->get("key"));
			
		}catch(SmException $e){
			echo $e->getMessage();
		}
		
	}
	
	
}