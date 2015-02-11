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
       
		return $this->redis->get($name);
		
    }

    /**
     * @param $name
	 * @param $value
	 * @param $duration
	 *
	 * @return $set
     */
    public function set($name,$value,$duration){

		return $this->redis->set($name, $value, $duration);
    }
	
	
	/**
     * @param $name
     * @param $value
     * @param $duration
     *
     * @return $set
     */

    public function lpush($key,$value){
			 
		return $this->redis->lpush($key,$value);
    }

      /**
     * @param $name
     * @param $x
     * @param $y
     *
     * @return $set
     */
    public function lrange($name,$x,$y){
       
        return $this->redis->lrange($name, $x, $y);
    }

}

?>
