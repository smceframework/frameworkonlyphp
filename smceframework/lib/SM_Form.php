<?php


namespace SMLib;

class SM_Form  extends \SMLib\SM_Cli
{
	public static $errorData=array();

	public function beginWidget($array=array())
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

		return new SM_Form_Field();
	}

	public function endWidget()
	{
		$STR='</form>';
		echo $STR;
	}

	public function getError()
	{
		if(count(SM_Form::$errorData)>0)
			return true;
	}

	public function getErrorData()
	{
			return SM_Form::$errorData;
	}
}
