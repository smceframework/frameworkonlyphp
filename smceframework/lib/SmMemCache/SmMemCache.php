<?php

namespace Smce\Lib;

use Smce\Core\SmException;
use Smce\Base\SmBase;

class SmMemCache {

    /**
     * @var array memcacheq server
     */
    private $server = array();

    /**
     * @var memcacheq instance
     */
    private $memcache;

    public function init() {
        $this->memcache = $this->connect();
    }

    /**
     * @return array memcacheq server
     */
    public function getServer() {
        return $this->server;
    }


    /**
     * @return array memcacheq server instance
     */
    public function connect($server="") {
		if(!isset(SmBase::$config["components"]["MemCache"][$server]))
			  throw new SmException('MemCache server configuration must have "host" and "port" values in array.');
			  
		$config=SmBase::$config["components"]["MemCache"][$server];
		
		if (!empty($config['host']) && !empty($config['port'])) {
            $this->server = $server;
        } else {
            throw new SmException('MemCache server configuration must have "host" and "port" not empty');
        }
		$this->memcache = new \Memcache;
        if(!$this->memcache->connect($config['host'], $config['port']))
			 throw new SmException('Failed on connecting to memcache server at ' . $config['host'] . ':' . $config['port']);
		else
			return $this->memcache;

        
    }

    public function get($name){
		if($get=$this->memcache->get($name))
			 throw new SmException("Failed to save data at the server");
			 
		return $get;
    }

    /**
     * @param mixed value to add to queue
     */
    public function set($name,$value,$duration=10){
        if($set=$this->memcache->set($name, $value, 0, $duration))
			 throw new SmException("Failed to save data at the server");
			
		return $set;
    }

}

?>
