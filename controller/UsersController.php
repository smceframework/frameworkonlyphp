<?php

class UsersController 
{
	private $controller;
	
	public function __construct(){
		DB::$error_handler = false;
		DB::$throw_exception_on_error = true;
		
		$this->controller=new Controller;
	}
	private function paramsControl($params){
		
		$this->controller->paramsControl($params);
	}
	
	private function accessTokenControl($accessToken){
		
		$this->controller->accessTokenControl($accessToken);
	}
	
	/* $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
	
									ACTION
									
	   $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ */
	
	public function actionCreate(){
		$accessToken=@$_GET["accessToken"];
		$params=@$_GET["params"];
		$params=@$this->controller->jsonDecode($params,true);
		
		$this->paramsControl($params);
		$this->accessTokenControl($accessToken);
		
		echo  $this->controller->jsonEncode(UsersModel::create($params));
		
		/*
			E-mail gönderilecek
					*/
	}
	
	
	public function actionUpdate(){
		
		$accessToken=@$_GET["accessToken"];
		$params=@$_GET["params"];
		
		$params=@$this->controller->jsonDecode($params,true);
		
		$this->paramsControl($params);
		$this->accessTokenControl($accessToken);
		
		echo  $this->controller->jsonEncode(UsersModel::update($params));
		
	}
	
	
	public function actionAdmin(){
		$accessToken=@$_GET["accessToken"];
		
		$this->accessTokenControl($accessToken);
		
		echo  $this->controller->jsonEncode(UsersModel::admin($params));
		
		
		echo "<br><br>";
		
	}
}

?>