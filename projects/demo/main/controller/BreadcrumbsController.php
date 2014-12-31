<?php

use Smce\Core\SmController;


class BreadcrumbsController extends SmController
{

    public $layout='//layouts/column2';
	
	public function actionIndex()
	{
		$this->render("index");
	}
	
}