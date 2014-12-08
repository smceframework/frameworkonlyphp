<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
namespace Smce\Core;

use ActiveRecord;

class SmActiveEvent extends ActiveRecord\Model
{
	public static $pageSize="";
	
	public static $offset="";
	
	public static $count="";
	
	public static $pagination;
	
	public function apply($pagination)
	{
		self::$pageSize=$pagination->getPageSize();
		self::$pagination=$pagination;
	}

	public static function findAll($options=array())
	{
		$options2=$options;
		
		if(is_numeric(self::$pageSize))
		{
			$options2["limit"]=self::$pageSize;
			$options2["offset"]=isset($_GET["page"])?($_GET["page"]-1)*self::$pageSize:0;
			
			self::$offset=isset($_GET["page"])?($_GET["page"]-1)*self::$pageSize:0;
		}
		if(count($options)>1)
			$all2=self::all($options);
		else
			$all2=self::all();
			
		$all=self::all($options2);
		self::$count=count($all2);
		self::$pagination->setCount(self::$count);
		
		return $all;
	}
	
	public static function findByPk($id)
	{
		return self::find($id);
	}
	
	public function getOffset()
	{
		return self::$offset;	
	}
	
	public function getPageSize()
	{
		return self::$pageSize;	
	}
	
	public function getCount()
	{
		return self::$count;	
	}
	
	
	
}



