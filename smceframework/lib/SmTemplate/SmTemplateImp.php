<?php


namespace SmTemplate;

interface SmTemplateImp
{
	public function setLayout($layout);

	public function setView($view,$array=array());
	
	public function setThemeDirectory($theme);
	
	public function run();
	
	public function setError($error);
	
	public function getError();
	
	public function getLayout();
	
	public function getView();
}
