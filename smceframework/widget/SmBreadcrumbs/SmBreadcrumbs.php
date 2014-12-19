<?php

namespace Smce\Widget;

use Smce\Core\SmAssetsManager;
use Smce;

class SmBreadcrumbs
{
	 private $breadcrumbs=array(
	 	"Home"=>array("site/index"),
	 );
	 
	 private $breadcrumbsSTR;
	 
	 private $file=array(
		 "/assets/breadcrumbs.css",
	 );
	 
	 /**
	 *
	 * @params $breadcrumbs
	 *
	 * @return $breadcrumbsSTR
	 */
	 
	 public function __construct()
	 {
			
		 $this->name="SmBreadcrumbs_1002";
		 $SmAssetsManager=new SmAssetsManager($this->name);
		 
		 foreach($this->file as $key=>$value)
		 	$SmAssetsManager->addFile(dirname(__FILE__).$value);
		
		 $SmAssetsManager->run();
	 }
	 
	 
	 /**
	 *
	 * new BreadCrumbs
	 *
	 * @return breadcrumbsSettings()
	 */
	 
	 public function newBreadCrumbs($breadcrumbs=array())
	 {
		 
		 $this->breadcrumbs=array_merge($this->breadcrumbs,$breadcrumbs);
		 
		 $this->breadcrumbsSTR="";
		 
		 echo $this->breadcrumbsSettings();
	 }
	 
	 
	 /**
	 *
	 * breadcrumbs settings
	 *
	 * @return breadcrumbsSTR
	 */
	 
	 private function breadcrumbsSettings()
	 {
		 foreach($this->breadcrumbs as $key=>$value){
			 
			 if(!empty($value)){
				 
				 if(!isset($value[1]))
			 	$value[1]=array();
				
			 	$this->breadcrumbsSTR.=sprintf('<a class="breadcrumbs" href="%s">» %s</a>',Smce::app()->createUrl($value[0],$value[1]),$key);
				
			 }else
			 	$this->breadcrumbsSTR.=sprintf('<span class="breadcrumbs_span">» %s</span>',$key);
		 }
		 
		 $this->breadcrumbsSTR.='<div class="clear"></div>';
		 
		 return $this->breadcrumbsSTR;
	 }
	 
	 
	
}