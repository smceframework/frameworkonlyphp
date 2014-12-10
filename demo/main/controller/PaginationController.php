<?php

use Smce\Core\SmController;

use Smce\Core\SmPagination;

class PaginationController extends SmController
{

    public $layout='//layouts/column1';
	
	public function actionIndex()
	{
		$SmPagination=new SmPagination(5);
		
		$model=new ListModel;
		$model->apply($SmPagination);
		$list=$model->findAll();
		
		$this->render("index",array(
			'list'=>$list,
			'SmPagination'=>$SmPagination
		));
	}
	
}