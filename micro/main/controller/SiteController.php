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
	
}
