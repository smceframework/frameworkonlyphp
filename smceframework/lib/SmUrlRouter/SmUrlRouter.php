<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
namespace Smce\Lib;

class SmUrlRouter{

	private $router;
	
	private $request;


	/**
	 * @param $request
	 * 
	 * 
	 */
	public function setRequest($request)
	{
		$this->request=$request;
	}
	
	/**
	 * @param $router
	 * 
	 * 
	 */
	public function setRouter($router)
	{
		$this->router=$router;
	}
	
	/**
	 * run
	 * 
	 * @return requestArray
	 */
	public function run()
	{
		$requestArray=array(
				"controller"=>"",
				"view"=>"",
		);
		
		if(empty($this->request)){
			$requestArray=array(
				"controller"=>"site",
				"view"=>"index",
			);
		}else{
			
			$routeGetEx=array();
			if(!isset($this->router["showScriptName"]) || $this->router["showScriptName"]==false){
				
				if(isset($_GET["route"])){
					$routeGetEx=explode("/",$_GET["route"]);
					
					$requestArray=array(
						"controller"=>isset($routeGetEx[0])?$routeGetEx[0]:"",
						"view"=>isset($routeGetEx[1])?$routeGetEx[1]:"",
					);
				}
				foreach($_GET as $key=>$value){
					$requestArray[$key]=$value;
				}
			}else{
				
				$parse=parse_url($this->request);
				$requestGetEx=explode("/",$parse["path"]);
				$requestArray=array(
					"controller"=>isset($requestGetEx[0])?$requestGetEx[0]:"",
					"view"=>isset($requestGetEx[1])?$requestGetEx[1]:"",
				);
				if(isset($this->router["router"][$requestGetEx[0]])){
					foreach($this->router["router"][$requestGetEx[0]] as $key=>$value){
						if(isset($requestGetEx[$key+2]))
							$requestArray[$value]=$requestGetEx[$key+2];
							
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

	/**
	 * @param $controllerView
	 * @param $array
	 * @param $baseUrl
	 * 
	 * @return url
	 */
	
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
				$STR.=sprintf("&%s=%s",$key,$value);
				$i++;
			}
		}
		
		return $STR;
	}
	
	/**
	 * @param $controllerView
	 * @param $array
	 * @param $baseUrl
	 * 
	 * @header url
	 */
	
	public function redirect($controllerView="",$array=array(),$baseUrl)
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

        header('Location: '.$STR);
    }

}