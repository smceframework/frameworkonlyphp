<?php

namespace Smce\Core;

class SmUrlRouter{

	private $rules;

	public function setRules($rules)
	{
		$this->rules=$rules;
	}

	public function getRules()
	{
		return $this->rules;
	}


	public function run($requestUri)
	{
		$page=$requestUri;
		
		$showScriptName=false;
		if(isset($this->rules["showScriptName"]) && $this->rules["showScriptName"]==true)
			$showScriptName=true;
			
		if($showScriptName==false)
		{
			
			$STR=$this->base_url()."?route=".$page["page"];
			foreach($page as $key=>$value){
				if($key!="page")
					$STR.="?".$key."=".$value;
			}
			header('Location: '.$STR);
		}else{
			
			$page=explode("/",$page["page"]);
			
			if(isset($this->rules["router"][$page[0]]))
			{
				
				$router=$this->rules["router"][$page[0]];

				$router=str_replace(array("controller","view"), array($page[0],$page[1]),$router);
				
				$router=$this->getGetVeriable($requestUri,$router);
				
				$STR=$this->base_url2()."/".$router;

				header('Location: '.$STR);
			}else{
				$router=$this->rules["router"]["all"];
				
				$router=str_replace(array("controller","view"), array($page[0],$page[1]),$router);
				
				$router.=$this->getGetVeriable($requestUri);
				$STR=$this->base_url2()."/".$router;

				header('Location: '.$STR);

			}
		}
	}

	private function base_url()
	{
		return $_SERVER['SCRIPT_NAME'];
	}

	private function base_url2()
	{
		return str_replace("/index.php","",$_SERVER['SCRIPT_NAME']);
		
	}
	
	public function getSet($router,$requestUri)
	{
		$pageEx=array();
		if(isset($_GET["page"]))
			$pageEx=explode("/",$requestUri["page"]);
		elseif(isset($_GET["route"]))
			$pageEx=explode("/",$requestUri["route"]);
		
		
		$routerEx=explode("/",$router);
		$arrayGet=array();
		$controllerView=array();
		foreach($routerEx as $key=>$value){
			preg_match("/::(.*?)::/i",$value,$valuePreg);
			
			foreach($routerEx as $key2=>$value2){
				if(isset($valuePreg[0]) && $value2==$valuePreg[0]){
					if(isset($pageEx[$key2]))
						$arrayGet[$valuePreg[1]]=$pageEx[$key2];
				}else{
					if(!strstr($value2,"::")){
						if(isset($pageEx[$key2]))
							$controllerView[$value2]=$pageEx[$key2];
					}
				}
			}
			
		}
		
		foreach($arrayGet as $key=>$value)
			$_GET[$key]=$value;	
			
		
		return $controllerView;
	}
	
	private function getGetVeriable($requestUri,$router)
	{
		
		foreach($requestUri as $key=>$value)
			$router=str_replace("::".$key."::",$value,$router);
		return $router;
	}
	
	
	public function showScriptName(){
		$showScriptName=false;
		if(isset(SmBase::$config["urlRouter"]["showScriptName"]) && SmBase::$config["urlRouter"]["showScriptName"]==true)
			$showScriptName=true;
		return  $showScriptName;
	}

}