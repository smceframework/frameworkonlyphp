<?php

namespace Smce\Core;

use Smce;

class SmAccessRules
{
	/**
	 * @param $accessRules
	 * @param $view
	 *
	 * @return bool
	 */
	public function rules($accessRules, $view)
	{
		foreach ($accessRules as $key => $value) {

			if (isset($value["actions"]) && in_array(strtolower($view), $value["actions"])) {
				
				if($this->ipAdressSearch($value["ip"])==true)
					return true;
					
				$this->loginControl($value["users"],$value["redirect"]);

				if($this->expressionControl($value["expression"])==true)
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
		if (!isset($ipAdress) && is_array($ipAdress)) {

			return in_array(Smce::app()->IP, $ipAdress);
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
		if (isset($users) && $users == "@" && Smce::app()->getState("SMCE_login71") == '') {
			
			SmController::redirect($redirect==""?"site/login":$redirect);
		}
	}
	
	/**
	 * @param $expression
	 *
	 * @return bool
	 */
	
	private function expressionControl($expression)
	{
		if (isset($expression) && $expression === true) {

			return true;
		}
	}
}
