<?php

use Smce\Core\SmOutput;

class SiteController 
{

    public function actionIndex()
    {
    
        echo "Hello World";
		
    }

    public function actionOutput()
	{
		$SmOutput=new SmOutput;
		$SmOutput->setContentType("application/json")
		//->setFileName("hello.json")
		->put(json_encode(array('message' => 'Hello World!')));
	}


	
}
