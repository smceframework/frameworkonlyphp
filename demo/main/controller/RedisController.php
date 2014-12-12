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


	public function actionTest()
	{
		try{
			$conn=new SmRedis();
			$login=$conn->connect("red1");
			
			$hello="Hello World!";
			
			//set
			$login->lpush("key",$hello); //300 second

			$login->lpush("key","hello2"); //300 second


			//get
			print_r($login->lrange("key",0,-1));
			
		}catch(SmException $e){
			echo $e->getMessage();
		}
		
	}
	
	
	
}