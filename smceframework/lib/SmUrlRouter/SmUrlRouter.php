<?php

namespace Smce\Lib;

class SmUrlRouter{

	private $router;
	
	private $request;

	public function setRequest($request)
	{
		$this->request=$request;
	}
	
	public function setRouter($router)
	{
		$this->router=$router;
	}
	

	public function run()
	{
		$requestArray=array();
		if(empty($this->request)){
			$requestArray=array(
				"controller"=>"site",
				"view"=>"index",
			);
		}else{
			if(!isset($this->router["showScriptName"]) || $this->router["showScriptName"]==false){
				$routeGetEx=explode("/",$_GET["route"]);
				$requestArray=array(
					"controller"=>$routeGetEx[0],
					"view"=>$routeGetEx[1],
				);
				foreach($_GET as $key=>$value){
					$requestArray[$key]=$value;
				}
			}else{
				$requestGetEx=explode("/",$this->request);
				$requestArray=array(
					"controller"=>$requestGetEx[0],
					"view"=>$requestGetEx[1],
				);
				if(isset($this->router["router"][$requestGetEx[0]])){
					foreach($this->router["router"][$requestGetEx[0]] as $key=>$value){
						if(isset($requestGetEx[$key]))
							$requestArray[$value]=$requestGetEx[$key];
							
					}
					
					
				}else{
					foreach($this->router["router"]["all"] as $key=>$value){
						if(isset($requestEx[$key+2]))
							$requestArray[$value]=$requestEx[$key+2];
					}
				}
			}
		}
		
		return $requestArray;
	}

	public function createUrl($controllerView="",$array=array(),$baseUrl)
	{
		$STR="";
		if(isset($this->router["showScriptName"]) && $this->router["showScriptName"]==true){
			$STR.=$baseUrl."/".$controllerView;
			foreach($array as $key=>$value){
				$STR.="/".$value;
			}
		}
		else{
			$STR.=$baseUrl."/index.php?route=".$controllerView;
			$i=0;
			foreach($array as $key=>$value){
				$STR.="&".$key."=".$value;
				$i++;
			}
		}
		
		return $STR;
	}

}