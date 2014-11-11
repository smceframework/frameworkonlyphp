<?php


namespace SmForm;

interface SmFormImp
{
	public function beginWidget($array=array());

	public function endWidget();
	
	public function getError();
	
	public function getErrorData();
	
	
}
