<?php

namespace Smce\Core;

use Smce\Core\SmException;

class SmGrud
{

	public function newModel($conn="",$model="")
	{
		if(empty($conn))
			throw new SmException("Connection String not be empty");
			
		if(empty($model))
			throw new SmException("TableName not be empty");
			
		echo "hello";
	}
}