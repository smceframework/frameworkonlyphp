<?php

namespace Smce\Core;

use Smce;

class SmBreadcrumbs
{
	 private $breadcrumbs=array(
	 	"Home"=>array("site/index"),
	 );
	 
	 private $breadcrumbsSTR="";
	 
	 public $file=array(
		 "/assets/breadcrumbs.css",
	 );
	 
	 /**
	 *
	 * @params $breadcrumbs
	 *
	 * @return $breadcrumbsSTR
	 */
	 
	 public function __construct($breadcrumbs=array())
	 {
		 
		 $this->breadcrumbs=array_merge($this->breadcrumbs,$breadcrumbs);
		 
		 $this->breadcrumbsSettings();
		 
	 }
	 
	 
	 /**
	 *
	 * breadcrumbs settings
	 *
	 */
	 
	 private function breadcrumbsSettings()
	 {
		 foreach($this->breadcrumbs as $key=>$value){
			 
			 if(!empty($value)){
				 
				 if(!isset($value[1]))
			 	$value[1]=array();
				
			 	$this->breadcrumbsSTR.=sprintf(' » <a class="breadcrumbs" href="%s">%s</a>',Smce::app()->createUrl($value[0],$value[1]),$key);
				
			 }else
			 	$this->breadcrumbsSTR.=sprintf(' » %s',$key);
		 }
		 
		 $this->breadcrumbsSTR.='<div class="clear"></div>';
		 
		 echo $this->breadcrumbsSTR;
	 }
	 
	 
	
}