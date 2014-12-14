<?php

namespace Smce\Lib;


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

	public static function array_get($array,$params,$defalt=null)
	{
		
		if (is_null($params)) return $array;

		if (isset($array[$params])) return $array[$params];

		foreach (explode('.', $params) as $prEx)
		{
			if ( ! is_array($array) or ! array_key_exists($prEx, $array))
			{

				return self::value($default);
			}

			$array = $array[$prEx];
		}
		return $array;
	}


	public static function value($value)
	{
		return $value instanceof Closure ? $value() : $value;
	}
}