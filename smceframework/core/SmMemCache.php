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

class SmMemCache {

    /**
     * @var array memcache server
     */
    private $server = array();

    /**
     * @var memcache instance
     */
    private $memcache;

    
    /**
     * @return array memcache server
     */
    public function getServer() 
    {
        return $this->server;
    }

    /*
     * @return memcache connect
     */
    public function getMemcache() 
    {
        return $this->memcache;
    }


    /**
     * @return array memcache server instance
     */
    public function connect($server="") 
    {
		if(!isset(SmBase::$config["components"]["memcache"][$server]))
			  throw new SmException('MemCache server configuration must have "host" and "port" values in array.');
			  
		$config=SmBase::$config["components"]["memcache"][$server];
		
		if (!empty($config['host']) && !empty($config['port'])) {
            $this->server = $server;
        } else {
            throw new SmException('MemCache server configuration must have "host" and "port" not empty');
        }
		
		$this->memcache = new \Memcache;
        if(!$this->memcache->connect($config['host'], $config['port']))
			 throw new SmException('Failed on connecting to memcache server at ' . $config['host'] . ':' . $config['port']);
		else
			return $this;

        
    }
	
	 /**
     * @param $name
	 *
	 * @return $get
     */

    public function get($name){
		
		return $this->memcache->get($name);
		
    }

      /**
     * @param $name
	 * @param $value
     * @param $bolen
	 * @param $duration
	 *
	 * @return $set
     */
    public function set($name,$value,$bolen,$duration){
        if(!$set=$this->memcache->set($name, $value, $bolen, $duration))
			 throw new SmException("Failed to set data at the server");
			
		return $set;
    }



      /**
     * @param $name
     * @param $value
     * @param $bolen
     * @param $duration
     *
     * @return $set
     */
    public function add($name,$value,$bolen,$duration=10){
        if(!$set=$this->memcache->add($name, $value, $bolen, $duration))
             throw new SmException("Failed to add data at the server");
            
        return $set;
    }


     /**
     * @param $host
     * @param $port
     *
     * @return $get
     */

    public function addServer($host,$port){
        if(!$get=$this->memcache->addServer($host,$port))
             throw new SmException("Failed to addServer data at the server");
             
        return $get;
    }


      /**
     * 
     *
     * @return  $get
     *
     */

    public function close(){
        if(!$get=$this->memcache->close())
             throw new SmException("Failed to close data at the server");
         
         return $get;
    }


    /**
     * @param $key
     * @param $item
     *
     * @return $get
     */

    public function decrement($key,$item){
        if(!$get=$this->memcache->decrement($key,$item))
             throw new SmException("Failed to decrement data at the server");
             
        return $get;
    }


    /**
     * @param $key
     *
     * @return $get
     */

    public function delete($key){
        if(!$get=$this->memcache->delete($key))
             throw new SmException("Failed to delete data at the server");
             
        return $get;
    }

    /**
     * 
     *
     * @return $get
     */

    public function flush(){
        if(!$get=$this->memcache->flush())
             throw new SmException("Failed to flush data at the server");
             
        return $get;
    }

    /**
     * 
     *
     * @return $get
     */

    public function getExtendedStats(){
        if(!$get=$this->memcache->getExtendedStats())
             throw new SmException("Failed to getExtendedStats data at the server");
             
        return $get;
    }


     /**
     * @param $host
     * @param $port
     *
     * @return $get
     */

    public function getServerStatus($host,$port){
        if(!$get=$this->memcache->getServerStatus($host,$port))
             throw new SmException("Failed to getServerStatus data at the server");
             
        return $get;
    }


    /**
     * 
     *
     * @return $get
     */

    public function getStats(){
        if(!$get=$this->memcache->getStats())
             throw new SmException("Failed to getStats data at the server");
             
        return $get;
    }


    /**
     * 
     *
     * @return $get
     */

    public function getVersion(){
        if(!$get=$this->memcache->getVersion())
             throw new SmException("Failed to getVersion data at the server");
             
        return $get;
    }


     /**
     * @param $key
     * @param $item
     *
     * @return $get
     */

    public function increment($key,$item){
        if(!$get=$this->memcache->increment($key,$item))
             throw new SmException("Failed to increment data at the server");
             
        return $get;
    }


    /**
     * @param $host
     * @param $port
     *
     * @return $get
     */

    public function pconnect($host,$port){
        if(!$get=$this->memcache->pconnect($host,$port))
             throw new SmException("Failed to pconnect data at the server");
             
        return $get;
    }



     /**
     * @param $key
     * @param $value
     * @param $bolen
     * @param $duration
     *
     * @return $get
     */

    public function replace($key,$value,$bol,$duration){
        if(!$get=$this->memcache->replace($key,$value,$bol,$duration))
             throw new SmException("Failed to replace data at the server");
             
        return $get;
    }


    /**
     * @param $i
     * @param $d
     *
     * @return $get
     */

    public function setCompressThreshold($i,$d){
        if(!$get=$this->memcache->setCompressThreshold($i,$d))
             throw new SmException("Failed to setCompressThreshold data at the server");
             
        return $get;
    }


}

?>
