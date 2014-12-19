<?php

namespace Smce\Widget;

class SmGridView
{
	public $model;
	
	public $view;
	
	public function newGridView($model,$view)
	{
	   $this->model=$model;
	   
	   $this->view=$view;
	   
	   $this->run();
	}
	
	public function run()
	{
		$str='<table class="SmGridView">';
		
		foreach($model as $key=>$value){
			
			foreach($value as $key=>$value2){  
			
				if(in_array($value,$view)){
					$str.="<tr><td>sasa</td></tr>";
				}
				
			}
		}
		
	}
}