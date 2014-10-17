<?php

class UsersModel{ 


	public function __construct(){
		DB::$error_handler = false;
		DB::$throw_exception_on_error = true;
	}
	
	public function create($array){
		  //insert
		  $query=DB::insert('users',$array);
		 
	}
	
	public function update($array){
		
	     //update
		  $query=DB::update('users', $array, "userID=%s", $array["userID"]);
		
	}
	
	
	public function admin(){
		 //select
		 $query=DB::query("SELECT * FROM agencies");
		  
	}

}
?>