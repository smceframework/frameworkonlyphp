<?php

class Controller
{
	
	public function paramsControl($params){
		
		if(count(@$params)<1){
			echo json_encode(
				array(
					"result"=>false,
					"message"=>"1001: Parametre yok"
				));
			
			exit;
		}
	}
	public function accessTokenControl($accessToken){
		/*
			accessToken kontrol işlemleri
		*/
	}
	
	
	 public $passwordHash="F@S3L!S";
	 public function getRandom(){
			$password = "";
			$harf=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			$sayilar=array('1','2','3','4','5','6','7','8','9');
			$basamak= rand(3,5);
			for($i=0;$i<$basamak;$i++){
				$password.= $harf[rand(0,count($harf)-1)];
				$password.= $sayilar[rand(0,count($sayilar)-1)];
			}
			
			$date = new DateTime(date("Y-m-d H:i:s"));

			return $date->format("U")."_".$password;
	 }
	 
	public function jsonEncode($params){
		return json_encode($params);
	}
	public function jsonEncode2($params){
		return urlencode(json_encode($params));
	}
	public function jsonDecode($params,$p=false){
		return json_decode(urldecode($params),$p);
	}
}