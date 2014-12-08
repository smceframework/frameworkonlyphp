<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
namespace Smce\Core;

use Smce;

class SmPagination
{
	 public $count;
	 
	 public $pageSize;
	  
	 public $file=array(
		 "/assets/pager.css",
	 );
	
	 public function __construct($pageSize=10)
	 {
		 $this->name="SmPagination_2328274";
		 $SmAssetsManager=new SmAssetsManager($this->name);
		 
		 foreach($this->file as $key=>$value)
		 	$SmAssetsManager->addFile(dirname(__FILE__).$value);
			
		 $SmAssetsManager->run();
		 
		 $this->pageSize=$pageSize;
	 }
	 
	 public function getPageSize()
	 {
		 return $this->pageSize;
	 }
	 
	 public function setCount($count=0)
	 {
		 $this->count=$count;
	 }
	 
	 public function linkPager()
	 {
		 foreach($this->file as $key=>$value){
			 $parts = pathinfo(BASE_PATH."/assets/".$this->name."/".basename($value));
			 if($parts['extension']=="css")
			 	echo "<link rel='stylesheet' type='text/css' href='".Smce::app()->baseUrl."/assets/".$this->name."/".basename($value)."' />";  
			 elseif($parts['extension']=="js")
			 	echo '<script type="text/javascript" src="'.Smce::app()->baseUrl."/assets/".$this->name."/".basename($value).'"></script>';  
			  
		 }
		 
		 $page		= isset($_GET["page"])?$_GET["page"]:"";
		 if(empty($page) || !is_numeric($page))
		 	$page=1;
			
		
		$atLeastMod = ceil($this->pageSize/2);
		$mostMod = (($this->count/$this->pageSize)+1) - $atLeastMod;
		
		$pagesMod = $page;
		if($pagesMod < $atLeastMod) $pagesMod = $atLeastMod;
		if($pagesMod > $mostMod) $pagesMod = $mostMod;
		 
		$leftPages = round($pagesMod - (($this->pageSize-1) / 2));
		$rightPages = round((($this->pageSize-1) / 2) + $pagesMod);
		 
		if($leftPages < 1) $leftPages = 1;
		if($rightPages > $this->count) $rightPages = $this->count;
		 
		 $pageCount	=	ceil($this->count/$this->pageSize);
		 
		 $str='<div class="pagination">';
		 
		 if($page!=1)
			 $str.='<a href="'.$this->buildQueryString(1).'" class="page gradient">First</a>';
		 
		 if($page!=1)
			 $str.='<a href="'.$this->buildQueryString($page-1).'" class="page gradient">Prev</a>';
			 
		 for($s = $leftPages; $s <= $rightPages; $s++) {
			if($s == $page)
			    $str.='<a href="'.$this->buildQueryString($s).'" class="page active">'.$s.'</a>';
			else
				$str.='<a href="'.$this->buildQueryString($s).'" class="page">'.$s.'</a>';
				
		}
		
		if($pageCount!=$page)
			$str.='<a href="'.$this->buildQueryString($page+1).'" class="page gradient">Next</a>';
			
		if($pageCount!=$page)
			$str.='<a href="'.$this->buildQueryString($pageCount).'" class="page gradient">Last</a>';	
		return $str;
	 }
	 
	 
	private function buildQueryString($page)
	{
		if($page==0)
			$page=1;
			
		$query = preg_replace('/&page=\d*/i', '', $_SERVER['REQUEST_URI']);
		if(strpos("?",$query))
			return $query."".http_build_query(array("page"=>$page));
		else
			return $query."&".http_build_query(array("page"=>$page));
	}

}