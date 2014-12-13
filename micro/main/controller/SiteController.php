<?php

use Smce\Core\SmController;
use Smce\Lib\SmOutput;

class SiteController extends SmController
{

    public $layout='//layouts/column1';

    public function actionIndex()
    {
        $hello="Hello World";
		
        $this->render("index",array("hello"=>$hello));
        
    }

    public function actionOutput()
	{
		$SmOutput=new SmOutput;
		$SmOutput->setContentType("application/json")
		//->setFileName("hello.json")
		->put(json_encode(array('message' => 'Hello, World!')));
	}


	public function error($err)
    {
         $this->render("error",array(
            "code"=>$err,
         ));
    }
	
}
