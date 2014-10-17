<?php

class UsersController 
{
	private $controller;
	
	public function __construct(){
		DB::$error_handler = false;
		DB::$throw_exception_on_error = true;
		
		$this->controller=new Controller;
	}
		
	/* $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
	
									ACTION
									
	   $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ */
	
	public function actionCreate(){
	
		echo $this->controller->_controller1();
		
		/*
		UsersModel::create($params);
		*/
	}
	
	
	
}

?>