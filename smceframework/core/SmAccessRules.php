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

				if (isset($value["ip"]) && is_array($value["ip"])) {

					return in_array(Smce::app()->IP, $value["ip"]);
				}

				if ($value["users"] == "@" && Smce::app()->getState("SMCE_login71") == '') {

					SmController::redirect($value["redirect"]);
				}

				if ($value["expression"] === true) {

					return true;
				}
			}
		}

		return false;
	}
}
