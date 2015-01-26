<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/smceframework
 */

namespace Smce\Core;

use Smce\Base\SmBase;

class Smredis {

    /**
     * @var array redis server
     */
    private $server = array();

    /**
     * @var redis instance
     */
    private $redis;

    /**
     * @return array redis server
     */
    public function getServer() {
        return $this->server;
    }

     /*
     * @return memcache connect
     */
    public function getRedis() 
    {
        return $this->redis;
    }


    /**
     * @return array redis server instance
     */
    public function connect($server="") {
		if(!isset(SmBase::$config["components"]["redis"][$server]))
			  throw new SmException('redis server configuration must have "host" and "port" values in array.');
			  
		$config=SmBase::$config["components"]["redis"][$server];
		
		if (!empty($config['host']) && !empty($config['port'])) {
            $this->server = $server;
        } else {
            throw new SmException('redis server configuration must have "host" and "port" not empty');
        }
		
		$this->redis = new \Redis;
        if(!$this->redis->connect($config['host'], $config['port']))
			 throw new SmException('Failed on connecting to redis server at ' . $config['host'] . ':' . $config['port']);
		else
			return $this;

        
    }
    
	 /**
     * @param $name
	 *
	 * @return $get
     */
    public function get($name){
        if(!$get=$this->redis->get($name))
            throw new SmException('Failed to get data at the server');
		
			 
		return $get;
    }

    /**
     * @param $name
	 * @param $value
	 * @param $duration
	 *
	 * @return $set
     */
    public function set($name,$value,$duration){
       if(!$set=$this->redis->set($name, $value, $duration))
            throw new SmException('Failed to set data at the server');
		return $set;
    }
	
	
	/**
     * @param $name
     * @param $value
     * @param $duration
     *
     * @return $set
     */

    public function lpush($key,$value){
		if($get=$this->redis->lpush($key,$value))
			 throw new SmException("Failed to lpush data at the server");
			 
		return $get;
    }

      /**
     * @param $name
     * @param $x
     * @param $y
     *
     * @return $set
     */
    public function lrange($name,$x,$y){
        if(!$set=$this->redis->lrange($name, $x, $y))
             throw new SmException("Failed to lrange data at the server");
            
        return $set;
    }

}

?>
