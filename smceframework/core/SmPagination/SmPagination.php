<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/smceframework
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
	 
	 /**
	 *
	 * @param $pageSize
	 *
	 */

	
	 public function __construct($pageSize=10)
	 {
		 $this->name="SmPagination_1003";
		 $SmAssetsManager=new SmAssetsManager($this->name);
		 
		 foreach($this->file as $key=>$value)
		 	$SmAssetsManager->addFile(dirname(__FILE__).$value);
			
		 $SmAssetsManager->run();
		 
		 $this->pageSize=$pageSize;
	 }
	 
	 /**
	 *
	 *
	 * @return pageSize
	 */

	 
	 public function getPageSize()
	 {
		 return $this->pageSize;
	 }
	 
	 /**
	 *
	 *
	 * @return count
	 */

	 
	 public function setCount($count=0)
	 {
		 $this->count=$count;
	 }
	 
	 /**
	 *
	 *
	 * @return linkPager
	 */

	 
	 public function linkPager()
	 {
		 
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
			 $str.='<a href="'.$this->buildQueryString(array("page"=>1)).'" class="page gradient">First</a>';
		 
		 if($page!=1)
			 $str.='<a href="'.$this->buildQueryString(array("page"=>$page-1)).'" class="page gradient">Prev</a>';
			 
		 for($s = $leftPages; $s <= $rightPages; $s++) {
			if($s == $page)
			    $str.='<a href="'.$this->buildQueryString(array("page"=>$s)).'" class="page active">'.$s.'</a>';
			else
				$str.='<a href="'.$this->buildQueryString(array("page"=>$s)).'" class="page">'.$s.'</a>';
				
		}
		
		if($pageCount!=$page)
			$str.='<a href="'.$this->buildQueryString(array("page"=>$page+1)).'" class="page gradient">Next</a>';
			
		if($pageCount!=$page)
			$str.='<a href="'.$this->buildQueryString(array("page"=>$pageCount)).'" class="page gradient">Last</a>';	
		return $str;
	 }
	 
	/**
	 * @params $params
	 *
	 * @return buildQueryString
	 */
 
	 
	private function buildQueryString($params)
	{
		$SmUrlManager=new SmUrlManager();
		return $SmUrlManager->buildQueryString($params);
	}

}