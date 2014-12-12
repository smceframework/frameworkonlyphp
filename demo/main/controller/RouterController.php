<?php

use Smce\Core\SmController;

class RouterController extends SmController
{
	
    public $layout='//layouts/column1';
	
	
	public function actionIndex(){
		
		print_r($_GET);
		
	}
}