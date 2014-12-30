<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */


namespace Smce\Core;

class SmDbCriteria
{
	public $criteria=array();
	
	public function select($critical)
	{
		
		$this->criteria["select"]=$critical;
		
	}
	
	public function condition($critical)
	{
		
		$this->criteria["conditions"]=$critical;
		
	}
	
	public function limit($critical)
	{
		
		$this->criteria["limit"]=$critical;
		
	}
	
	public function offset($critical)
	{
		
		$this->criteria["offset"]=$critical;
		
	}
	
	
	public function order($critical)
	{
		
		$this->criteria["order"]=$critical;
		
	}
	
	public function from($critical)
	{
		
		$this->criteria["from"]=$critical;
		
	}
	
	public function group($critical)
	{
		
		$this->criteria["group"]=$critical;
		
	}
	
	public function having($critical)
	{
		
		$this->criteria["having"]=$critical;
		
	}
	
	public function join($critical)
	{
		
		$this->criteria["joins"]=$critical;
		
	}
	
	public function push()
	{
		
		return $this->criteria;
		
	}
	
}