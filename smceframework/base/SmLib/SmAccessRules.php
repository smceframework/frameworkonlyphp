<?php

namespace smce\base\SmLib;

use smce\base\SmLib\SmCli;


class SmAccessRules extends SmCli
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

				if ($value["users"]=="@" && \Smce::app()->getState("SMCE_login71")=="") {
					SmController::redirect($value["redirect"]);
				}

				if ($value["expression"]===true) {
					return true;
				}

			}

		}
	}

}
