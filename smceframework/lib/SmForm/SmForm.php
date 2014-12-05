<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
namespace Smce\Lib;

class SmForm  
{
	public static $errorData = array();

	public static function beginWidget($array = array())
	{
		$form = array(
			"method" => "post"
		);

		foreach($array as $key => $value)
			$form[$key] = $value;

		$STR = '<form';
		
		foreach ($form as $key => $value)
			$STR .= sprintf(' %s="%s" ', $key, $value);

		$STR .= '/>';

		echo $STR;

		return new SmFormField();
	}

	public static function endWidget()
	{
		echo '</form>';
	}

	public function getError()
	{
		return count(SmForm::$errorData) > 0;
	}

	public function getErrorData()
	{
		return SmForm::$errorData;
	}
}
