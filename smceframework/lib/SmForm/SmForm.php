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

	/**
	 * @param $array
	 *
	 * @return SmFormField
	 */
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
	
	/**
	 *
	 * echo </form>
	 */

	public static function endWidget()
	{
		echo '</form>';
	}
	
	/**
	 *
	 * @return error count
	 */

	public static function getError()
	{
		return count(SmForm::$errorData) > 0;
	}
	
	/**
	 *
	 * @return error data
	 */

	public static function getErrorData()
	{
		return SmForm::$errorData;
	}
}
