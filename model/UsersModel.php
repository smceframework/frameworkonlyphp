<?php

class UsersModel{ 

	public function __construct(){
		DB::$error_handler = false;
		DB::$throw_exception_on_error = true;
	}
	
	public function create($array){
		
		try {
		  $query=DB::insert('users',$array);
		  return array("result"=>true,"id"=>DB::insertId());
		  
		}catch(MeekroDBException $e) {
		 	return array("result"=>false,"message"=>$e->getMessage());
		}
		
	}
	
	public function update($array){
		
		
		try {
		  $query=DB::update('users', $array, "userID=%s", $array["userID"]);
		  return array("result"=>true);
		}catch(MeekroDBException $e) {
		 	return array("result"=>false,"message"=>$e->getMessage());
		}
		
	}
	
	
	public function admin(){
		
		try {
		 $query=DB::query("SELECT * FROM agencies");
		  	return array("result"=>true,"params"=>$query);
		}catch(MeekroDBException $e) {
		 	return array("result"=>false,"message"=>$e->getMessage());
		}
	}

}
?>