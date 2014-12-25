<?php

namespace Smce\Widget;

use Smce\Core\SmAssetsManager;

class SmDetailView
{
	
	 private $file=array(
		 "/assets/gridview.css",
	 );
	
	public $model;
	
	public $view;
	
	 /**
	 *
	 * @params $breadcrumbs
	 *
	 * @return $breadcrumbsSTR
	 */
	 
	 public function __construct()
	 {
			
		 $this->name="detailview_1001";
		 $SmAssetsManager=new SmAssetsManager($this->name);
		 
		 foreach($this->file as $key=>$value)
		 	$SmAssetsManager->addFile(dirname(__FILE__).$value);
		
		 $SmAssetsManager->run();
	 }
	
	public function newDetailView($model,$view)
	{
	   $this->model=$model;
	   
	   $this->view=$view;
	   
	   return $this->run();
	}
	
	public function run()
	{
		$gridview=file_get_contents(dirname(__FILE__)."/detailview");
		
		$attributeLabels=$this->model->attributeLabels();
		
		$model="";
		
		foreach($this->view as $key=>$value){
			
			$attributeLabel="";
			if(isset($attributeLabels[$key]))
				$attributeLabel=$attributeLabels[$key];
			$model.='<tr>
						<td class="view_x1"><b>'.($attributeLabel!=""?$attributeLabel:$key).'</b></td>
						<td class="view_x2">:</td>
						<td class="view_x3">'.($value==""?$this->model->$key:$value).'</td>
					</tr>';
			
		}
		
		return str_replace("[model]",$model,$gridview);
		
	}
}