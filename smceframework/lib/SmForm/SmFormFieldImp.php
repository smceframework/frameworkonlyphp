<?php


namespace SmForm;

interface SmFormFieldImp
{
	public function labelEx($model,$attribute);

	public function textField($model,$attribute,$array=array());
	
	public function passwordField($model,$attribute,$array=array());
	
	public function textArea($model,$attribute,$array=array());
	
	public function dropDownList($model,$attribute,$item=array(),$array=array());
	
	public function checkBox($model,$attribute,$array=array());
	
	public function submit($val,$array=array());
	
	public function error($model,$attribute);
	
	public function errorSummary();
}
