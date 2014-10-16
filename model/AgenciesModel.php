<?php

class AgenciesModel{ 

	public function __construct(){
		DB::$error_handler = false;
		DB::$throw_exception_on_error = true;
	}
	
	public function create($array){
		
		 
		try {
		 
		  $query=DB::queryFirstRow("SELECT count(*) as count FROM users WHERE email='%s'"
 ,$array["users"]["email"]);

  		  if($query["count"]>0){
			 return array("result"=>false,"message"=>"E-Posta Daha önce alınmış.");
		  }else{
			  
			  $queryAgencies=DB::insert('agencies',$array["agencies"]);
			  $lastid=DB::insertId();
			  $array["users"]["agencyID"]=$lastid;
			  $controller=new controller;
			  $array["users"]["password"]=md5(md5($controller->getRandom()).$controller->passwordHash);
			  $query=DB::insert('users',$array["users"]);
			  return array("result"=>true,"id"=>$lastid);
		  }
		}catch(MeekroDBException $e) {
		 		return array("result"=>false,"message"=>$e->getMessage());
		}
		
	}
	
	public function update($array){
		
		
		try {
		  $query=DB::update('agencies', $array, "agencyID=%i", $array["agencyID"]);
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
	
	
	
	public function findByPk($array){
		
		
		try {
		  $query=DB::queryFirstRow("SELECT * FROM agencies where agencyID=%i", $array["agencyID"]);
		  return array("result"=>true,"params"=>$query);
		}catch(MeekroDBException $e) {
		 	return array("result"=>false,"message"=>$e->getMessage());
		}
		
	}

}
?>