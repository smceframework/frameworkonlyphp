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
			
			$hello="Hello World!";
			//set
			$login->set("key",$hello,300); //300 second


			//get
			echo $login->get("key");
			
		}catch(SmException $e){
			echo $e->getMessage();
		}
		
	}


	public function actionIndex2()
	{
		try{
			$conn=new SmRedis();
			$login=$conn->connect("red1");
			
			$hello="Hello World!";
			//set
			$login->getRedis()->set("key",$hello,300); //300 second


			//get
			echo $login->getRedis()->get("key");
			
		}catch(SmException $e){
			echo $e->getMessage();
		}
		
	}
	
	
	
}