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

		return $this->memcache->set($name, $value, $bolen, $duration);

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
          
        return $this->memcache->add($name, $value, $bolen, $duration);
    }


     /**
     * @param $host
     * @param $port
     *
     * @return $get
     */

    public function addServer($host,$port){
          
        return $this->memcache->addServer($host,$port);
    }


      /**
     * 
     *
     * @return  $get
     *
     */

    public function close(){
        
         return $this->memcache->close();
    }


    /**
     * @param $key
     * @param $item
     *
     * @return $get
     */

    public function decrement($key,$item){
         
        return $this->memcache->decrement($key,$item);
    }


    /**
     * @param $key
     *
     * @return $get
     */

    public function delete($key){
         
        return $this->memcache->delete($key);
    }

    /**
     * 
     *
     * @return $get
     */

    public function flush(){
           
        return $this->memcache->flush();
    }

    /**
     * 
     *
     * @return $get
     */

    public function getExtendedStats(){
        
        return $this->memcache->getExtendedStats();
    }


     /**
     * @param $host
     * @param $port
     *
     * @return $get
     */

    public function getServerStatus($host,$port){
       
        return $this->memcache->getServerStatus($host,$port);
    }


    /**
     * 
     *
     * @return $get
     */

    public function getStats(){
           
        return $this->memcache->getStats();
    }


    /**
     * 
     *
     * @return $get
     */

    public function getVersion(){
          
        return $this->memcache->getVersion();
    }


     /**
     * @param $key
     * @param $item
     *
     * @return $get
     */

    public function increment($key,$item){
           
        return $this->memcache->increment($key,$item);
    }


    /**
     * @param $host
     * @param $port
     *
     * @return $get
     */

    public function pconnect($host,$port){
          
        return $this->memcache->pconnect($host,$port);
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
         
        return $this->memcache->replace($key,$value,$bol,$duration);
    }


    /**
     * @param $i
     * @param $d
     *
     * @return $get
     */

    public function setCompressThreshold($i,$d){
            
        return $this->memcache->setCompressThreshold($i,$d);
    }


}

?>
