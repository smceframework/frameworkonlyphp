<?php

namespace Smce\Core;

class SmCli
{
	private $_e;
	private $_m;
	public function __get($name)
	{
		$getter='get'.$name;
		if(method_exists($this,$getter))
			return $this->$getter();
		elseif (strncasecmp($name,'on',2)===0 && method_exists($this,$name)) {
			// duplicating getEventHandlers() here for performance
            $name=strtolower($name);
			if(!isset($this->_e[$name]))
				$this->_e[$name]=new CList();
			return $this->_e[$name];
		} elseif(isset($this->_m[$name]))
			return $this->_m[$name];
		elseif (is_array($this->_m)) {
			foreach ($this->_m as $object) {
				if($object->getEnabled() && (property_exists($object,$name) || $object->canGetProperty($name)))
					return $object->$name;
			}
		}

	}
	public function __set($name,$value)
	{
		$setter='set'.$name;
		if(method_exists($this,$setter))
			return $this->$setter($value);
		elseif (strncasecmp($name,'on',2)===0 && method_exists($this,$name)) {
			// duplicating getEventHandlers() here for performance
            $name=strtolower($name);
			if(!isset($this->_e[$name]))
				$this->_e[$name]=new CList();
			return $this->_e[$name]->add($value);
		} elseif (is_array($this->_m)) {
			foreach ($this->_m as $object) {
				if($object->getEnabled() && (property_exists($object,$name) || $object->canSetProperty($name)))
					return $object->$name=$value;
			}
		}

	}
	public function __isset($name)
	{
		$getter='get'.$name;
		if(method_exists($this,$getter))
			return $this->$getter()!==null;
		elseif (strncasecmp($name,'on',2)===0 && method_exists($this,$name)) {
			$name=strtolower($name);
			return isset($this->_e[$name]) && $this->_e[$name]->getCount();
		} elseif (is_array($this->_m)) {
 			if(isset($this->_m[$name]))
 				return true;
			foreach ($this->_m as $object) {
				if($object->getEnabled() && (property_exists($object,$name) || $object->canGetProperty($name)))
					return $object->$name!==null;
			}
		}
		return false;
	}
	public function __unset($name)
	{
		$setter='set'.$name;
		if(method_exists($this,$setter))
			$this->$setter(null);
		elseif(strncasecmp($name,'on',2)===0 && method_exists($this,$name))
			unset($this->_e[strtolower($name)]);
		elseif (is_array($this->_m)) {
			if(isset($this->_m[$name]))
				$this->detachBehavior($name);
			else {
				foreach ($this->_m as $object) {
					if ($object->getEnabled()) {
						if(property_exists($object,$name))
							return $object->$name=null;
						elseif($object->canSetProperty($name))
							return $object->$setter(null);
					}
				}
			}
		}

	}
	public function __call($name,$parameters)
	{
		if ($this->_m!==null) {
			foreach ($this->_m as $object) {
				if($object->getEnabled() && method_exists($object,$name))
					return call_user_func_array(array($object,$name),$parameters);
			}
		}
		if(class_exists('Closure', false) && $this->canGetProperty($name) && $this->$name instanceof Closure)
			return call_user_func_array($this->$name, $parameters);

	}
	public function asa($behavior)
	{
		return isset($this->_m[$behavior]) ? $this->_m[$behavior] : null;
	}
	public function attachBehaviors($behaviors)
	{
		foreach($behaviors as $name=>$behavior)
			$this->attachBehavior($name,$behavior);
	}
	public function detachBehaviors()
	{
		if ($this->_m!==null) {
			foreach($this->_m as $name=>$behavior)
				$this->detachBehavior($name);
			$this->_m=null;
		}
	}
	public function attachBehavior($name,$behavior)
	{

		$behavior->setEnabled(true);
		$behavior->attach($this);
		return $this->_m[$name]=$behavior;
	}
	public function detachBehavior($name)
	{
		if (isset($this->_m[$name])) {
			$this->_m[$name]->detach($this);
			$behavior=$this->_m[$name];
			unset($this->_m[$name]);
			return $behavior;
		}
	}
	public function enableBehaviors()
	{
		if ($this->_m!==null) {
			foreach($this->_m as $behavior)
				$behavior->setEnabled(true);
		}
	}
	public function disableBehaviors()
	{
		if ($this->_m!==null) {
			foreach($this->_m as $behavior)
				$behavior->setEnabled(false);
		}
	}
	public function enableBehavior($name)
	{
		if(isset($this->_m[$name]))
			$this->_m[$name]->setEnabled(true);
	}
	public function disableBehavior($name)
	{
		if(isset($this->_m[$name]))
			$this->_m[$name]->setEnabled(false);
	}
	public function hasProperty($name)
	{
		return method_exists($this,'get'.$name) || method_exists($this,'set'.$name);
	}
	public function canGetProperty($name)
	{
		return method_exists($this,'get'.$name);
	}
	public function canSetProperty($name)
	{
		return method_exists($this,'set'.$name);
	}
	public function hasEvent($name)
	{
		return !strncasecmp($name,'on',2) && method_exists($this,$name);
	}
	public function hasEventHandler($name)
	{
		$name=strtolower($name);
		return isset($this->_e[$name]) && $this->_e[$name]->getCount()>0;
	}
	public function getEventHandlers($name)
	{
		if ($this->hasEvent($name)) {
			$name=strtolower($name);
			if(!isset($this->_e[$name]))
				$this->_e[$name]=new CList();
			return $this->_e[$name];
		}

	}
	public function attachEventHandler($name,$handler)
	{
		$this->getEventHandlers($name)->add($handler);
	}
	public function detachEventHandler($name,$handler)
	{
		if($this->hasEventHandler($name))
			return $this->getEventHandlers($name)->remove($handler)!==false;
		else
			return false;
	}
	public function raiseEvent($name,$event)
	{
		$name=strtolower($name);
		if (isset($this->_e[$name])) {
			foreach ($this->_e[$name] as $handler) {
				if(is_string($handler))
					call_user_func($handler,$event);
				elseif (is_callable($handler,true)) {
					if (is_array($handler)) {
						// an array: 0 - object, 1 - method name
                        list($object,$method)=$handler;
						if(is_string($object))    // static method call
                            call_user_func($handler,$event);
						elseif(method_exists($object,$method))
							$object->$method($event);

					} else // PHP 5.3: anonymous function
                        call_user_func($handler,$event);
				} else

				// stop further handling if param.handled is set true
                if(($event instanceof CEvent) && $event->handled)
					return;
			}
		}

	}
	public function evaluateExpression($_expression_,$_data_=array())
	{
		if (is_string($_expression_)) {
			extract($_data_);
			return eval('return '.$_expression_.';');
		} else {
			$_data_[]=$this;
			return call_user_func_array($_expression_, $_data_);
		}
	}

}
