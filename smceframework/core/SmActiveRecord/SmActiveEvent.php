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
	
	/**
	 *
	 * @param $pagination
	 *
	 */
	
	public function apply($pagination)
	{
		self::$pageSize=$pagination->getPageSize();
		self::$pagination=$pagination;
	}
	
	/**
	 *
	 * @param $options=array()
	 *
	 * @return array
	 */

	public static function findAll($options=array())
	{
		$options2=$options;
		
		if(is_numeric(self::$pageSize))
		{
			$options2["limit"]=self::$pageSize;
			$page=0;
			
			if(isset($_GET["page"]) && is_numeric($_GET["page"]))
				$page=($_GET["page"]-1)*self::$pageSize;
			
			$options2["offset"]=$page;
			
			self::$offset=$page;
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
	
	/**
	 *
	 * @param $id
	 *
	 * @return array
	 */

	
	public static function findByPk($id)
	{
		return self::find($id);
	}
	
	
	/**
	 *
	 *
	 * @return offset
	 */

	
	public function getOffset()
	{
		return self::$offset;	
	}
	
	
	/**
	 *
	 *
	 * @return pageSize
	 */

	public function getPageSize()
	{
		return self::$pageSize;	
	}
	
	
	/**
	 *
	 *
	 * @return count
	 */

	
	public function getCount()
	{
		return self::$count;	
	}
	
	
	
}



