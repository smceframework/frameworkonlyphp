<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/smceframework
 */
 
namespace Smce\Core;

class SmFormModel extends SmModel
{
	
	/**
	 *
	 * @param $attributes
	 *
	 */
	 
	public function attributesApply($attributes)
	{
		foreach($attributes as $key=>$value)
			$this->$key=$value;
	}
	
}
