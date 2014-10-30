<?PHP

namespace SMLib;

class SMCli{
	private $_e;
	private $_m;
	public function __get($name)
	{
		$getter='get'.$name;
		if(method_exists($this,$getter))
			return $this->$getter();
		elseif(strncasecmp($name,'on',2)===0 && method_exists($this,$name))
		{
			// duplicating getEventHandlers() here for performance
			$name=strtolower($name);
			if(!isset($this->_e[$name]))
				$this->_e[$name]=new CList;
			return $this->_e[$name];
		}
		elseif(isset($this->_m[$name]))
			return $this->_m[$name];
		elseif(is_array($this->_m))
		{
			foreach($this->_m as $object)
			{
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
		elseif(strncasecmp($name,'on',2)===0 && method_exists($this,$name))
		{
			// duplicating getEventHandlers() here for performance
			$name=strtolower($name);
			if(!isset($this->_e[$name]))
				$this->_e[$name]=new CList;
			return $this->_e[$name]->add($value);
		}
		elseif(is_array($this->_m))
		{
			foreach($this->_m as $object)
			{
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
		elseif(strncasecmp($name,'on',2)===0 && method_exists($this,$name))
		{
			$name=strtolower($name);
			return isset($this->_e[$name]) && $this->_e[$name]->getCount();
		}
		elseif(is_array($this->_m))
		{
 			if(isset($this->_m[$name]))
 				return true;
			foreach($this->_m as $object)
			{
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
		elseif(is_array($this->_m))
		{
			if(isset($this->_m[$name]))
				$this->detachBehavior($name);
			else
			{
				foreach($this->_m as $object)
				{
					if($object->getEnabled())
					{
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
		if($this->_m!==null)
		{
			foreach($this->_m as $object)
			{
				if($object->getEnabled() && method_exists($object,$name))
					return call_user_func_array(array($object,$name),$parameters);
			}
		}
		if(class_exists('Closure', false) && $this->canGetProperty($name) && $this->$name instanceof Closure)
			return call_user_func_array($this->$name, $parameters);
		
	}
	
}