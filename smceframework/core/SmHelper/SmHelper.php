<?php

namespace Smce\Core;

use Smce\Ext\SmHelperc;

class SmHelper
{

	public static function array_first($command,$array)
	{

		return array_shift(array_filter($array,$command));	
	}

	public static function array_last($command,$array)
	{

		return end(array_filter($array,$command));	
	}

	public static function array_filter($command,$array)
	{

		return array_filter($array,$command);	
	}

	public static function array_flatten($array)
	{
		$array_re=array();
		$rarray=new \RecursiveIteratorIterator(new \RecursiveArrayIterator($array));

		foreach($rarray as $value)
			$array_re[]=$value;

		return $array_re;
	}

	public static function array_get($params,$array)
	{
		$SmHelper=new SmHelperc;

		return $SmHelper->array_get($params,$array);
	}
	
	
	public static function array_sort($command,$array)
	{
		usort($array,$command);
		
		return $array;
	}

}