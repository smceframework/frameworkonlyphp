<?php

use Smce\Core\SmController;


class BreadcrumbsController extends SmController
{

    public $layout='//layouts/column1';
	
	public function actionIndex()
	{
		$this->render("index");
	}
	
}