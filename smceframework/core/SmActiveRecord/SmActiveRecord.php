<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
namespace Smce\Core;

use Smce\Lib\SmForm;
use Smce\Lib\SmGump;


class SmActiveRecord extends SmActiveEvent
{
	public $error = false;
	private $lastError = false;
	
	private $model = '';

	public $attributes=array();

	/**
	 *
	 * @param $attribute
	 * @param $params
	 *
	 */
	
	
	public function addError($attribute, $params)
	{
		SmForm::$errorData[$attribute] = $params;
		$this->error = true;
	}

	/**
	 *
	 * @return bool
	 *
	 */

	public function validate()
	{
		$_rules = $this->Smrules();
		
		if (count($_rules) > 0 || $this->error)
			return false;
		else
			return true;
	}

	/**
	 *
	 * void
	 *
	 */

	private function Smrules()
	{
		if (method_exists($this, 'rules')) {

			$_rules = $this->rules();
			$_lastvalid = array();

			if (is_array($this->rules())) {

				$valid = array();
				$data = array();
				
				foreach ($_rules as $key => $value) {

					$validExplode = explode(",", $value[0]);

					foreach ($validExplode as $key2 => $value2) {
						
						if (!isset($value[2])) {
							
							$value[2] = "y";
						}
							
						if ($value[2] != false && $value[2] != "after") {
							
							$value2 = trim($value2);
							$valid[$value2] = trim($value[1]);
							
							if(isset($this->attributes[$value2])){
								$data[$value2] = $this->attributes[$value2];
								$this->$value2 = $this->attributes[$value2];
							}	

						} else {
							
							if ($value[2] != "after") {
								
								$this->$value[1]($value2, $this->$value2);
							} else {
								
								$this->lastError = true;
								$_lastvalid[] = array(
									"model" => $value[1],
									"attribute" => $value2,
									"value" => $this->$value2
								);
							}
						}
					}
				}

				
				$SmGump = new SmGump();
				$SmGump->validate($data, $valid);
				$rul = $SmGump->get_readable_errors();
				if (count($rul) > 0) {
					
					foreach ($rul as $key => $value) {

						$this->addError($key, $value);
					}
					
				} elseif ($this->lastError && empty($rul)) {
					
					if (count($_lastvalid) > 0) {
						
						foreach($_lastvalid as $key => $value)
							$this->$value["model"]($value["attribute"], $this->$value2);

					}
				}
			}
		}
	}
	
}

