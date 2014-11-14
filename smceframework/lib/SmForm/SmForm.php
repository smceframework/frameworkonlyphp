<?php

namespace Smce\Lib;

use Smce\Lib\SmFormField;

class SmForm  
{
	public static $errorData=array();

	public static function beginWidget($array=array())
	{
		$form=array(
			"method"=>"post",
		);

		foreach($array as $key=>$value)
			$form[$key]=$value;

		$STR='<form';
		foreach($form as $key=>$value)
			$STR.=' '.$key.'="'.$value.'" ';

		$STR.='/>';

		echo $STR;

		return new SmFormField();
	}

	public static function endWidget()
	{
		$STR='</form>';
		echo $STR;
	}

	public function getError()
	{
		if(count(SmForm::$errorData)>0)
			return true;
	}

	public function getErrorData()
	{
		return SmForm::$errorData;
	}
}
