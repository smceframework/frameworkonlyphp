<?php

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

    public function init() {
        $this->redis = $this->connect();
    }

    /**
     * @return array redis server
     */
    public function getServer() {
        return $this->server;
    }


    /**
     * @return array redis server instance
     */
    public function connect($server="") {
		if(!isset(SmBase::$config["components"]["Redis"][$server]))
			  throw new SmException('redis server configuration must have "host" and "port" values in array.');
			  
		$config=SmBase::$config["components"]["Redis"][$server];
		
		if (!empty($config['host']) && !empty($config['port'])) {
            $this->server = $server;
        } else {
            throw new SmException('redis server configuration must have "host" and "port" not empty');
        }
		
		$this->redis = new \Redis;
        if(!$this->redis->connect($config['host'], $config['port']))
			 throw new SmException('Failed on connecting to redis server at ' . $config['host'] . ':' . $config['port']);
		else
			return $this->redis;

        
    }
	 /**
     * @param $name
	 *
	 * @return $get
     */
    public function get($name){
		if($get=$this->redis->get($name))
			 throw new SmException("Failed to save data at the server");
			 
		return $get;
    }

    /**
     * @param $name
	 * @param $value
	 * @param $duration
	 *
	 * @return $set
     */
    public function set($name,$value,$duration=10){
        if($set=$this->redis->set($name, $value, 0, $duration))
			 throw new SmException("Failed to save data at the server");
			
		return $set;
    }
	
	
	 /**
     * @param $name
	 *
	 * @return $get
     */

    public function lpush($name){
		if($get=$this->redis->get($name))
			 throw new SmException("Failed to save data at the server");
			 
		return $get;
    }

      /**
     * @param $name
	 * @param $value
	 * @param $duration
	 *
	 * @return $set
     */
    public function lrange($name,$value,$duration=10){
        if($set=$this->redis->lrange($name, $value, 0, $duration))
			 throw new SmException("Failed to save data at the server");
			
		return $set;
    }

}

?>
