<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/smceframework
 */
 
namespace Smce\Core;



class SmACL
{
	
	public $ip;
	
	public $loginState;
	
	/**
	 * @param $accessRules
	 * @param $view
	 *
	 * @return bool
	 */
	public function rules($accessRules, $view, $ip="", $loginState="")
	{
		$this->ip=$ip;
		
		$this->loginState=$loginState;
		
		foreach ($accessRules as $key => $value) {

			if (isset($value["actions"]) && in_array(strtolower($view), $value["actions"])) {
				
				
				if(isset($value["ip"]) && $this->ipAdressSearch($value["ip"])==true)
					return true;
					
				$this->loginControl($value["users"],$value["redirect"]);

				if(isset($value["expression"]) && $this->expressionControl($value["expression"])==true)
					return true;
					
			}
		}

		return false;
	}
	
	/**
	 * @param $ipAdress
	 *
	 * @return bool
	 */
	private function ipAdressSearch($ipAdress)
	{
		if (is_array($ipAdress)) {

			return in_array($this->ip, $ipAdress);
		}
	}
	
	/**
	 * @param $users
	 * @param $redirect
	 *
	 * @redirect url
	 */
	
	private function loginControl($users,$redirect="")
	{
	 
		if (isset($users) && $users == "@" && $this->loginState == '') {
			
			$SmController=new SmController;
			
			$SmController->redirect($redirect==""?"site/login":$redirect);
		}
	}
	
	/**
	 * @param $expression
	 *
	 * @return bool
	 */
	
	private function expressionControl($expression)
	{
		if ($expression === true) {

			return true;
		}
	}
}
