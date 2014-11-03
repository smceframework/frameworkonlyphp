<?php

namespace SMLib;

class SM_Access_Rules extends \SMLib\SM_Cli
{
	public function rules($accessRules,$view)
	{
		foreach ($accessRules as $key=>$value) {

			if (isset($value["actions"]) && in_array(strtolower($view),$value["actions"])==true) {
				if (isset($value["ip"]) && is_array($value["ip"])) {
					if(in_array(\Smce::app()->IP,$value["ip"])==true)
						return true;
					else
						return false;
				}

				if ($value["users"]=="@" && \Smce::app()->getState("smce_login71")=="") {
					Sm_Controller::redirect($value["redirect"]);
				}

				if ($value["expression"]===true) {
					return true;
				}

			}

		}
	}

}
