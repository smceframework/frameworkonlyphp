<?php

class PanelController  extends Smcontroller
{
	private $controller;
	
	public function __construct(){
		DB::$error_handler = false;
		DB::$throw_exception_on_error = true;
		
		$this->controller=new Controller;
	}
	
	private function indexControl(){
		return true;
	}
	
	
	public function accessRules()
	{
		return array(
			
			array(
				'actions'=>array('index'), // Actions. is array
				'users'=>'@',  // Only * or @ values ​​are
				'redirect'=>"site/login",
				'expression'=>$this->indexControl(),	//True is allowed only. Only TRUE or FALSE values ​​are.
				//'ip'=>array('127.0.0.1'), //IP is allowed only. is array
			),
			
		);
	}
		
	
	
	public function actionIndex(){
	 	$this->render("index");
		 
		
		/*
		UsersModel::create($params);
		*/
	}
	

	
	
}

?>