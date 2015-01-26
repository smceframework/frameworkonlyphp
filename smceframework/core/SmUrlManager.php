<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/smceframework
 */

namespace Smce\Core;


class SmUrlManager
{
	public $requestUri="";

	/**
     * @param $requestUri
     */

	 public function __construct($requestUri="")
	 {
	 	if(!empty($requestUri))
	 		$this->requestUri=$requestUri;
	 	else
	 		$this->requestUri=$_SERVER["REQUEST_URI"];
			
	 }

	 /**
     *
	 *
	 * @return parse_url()
     */

	 public function parseUrl()
	 {
	 	return parse_url($this->requestUri);
	 }

	 /**
     * @param $params
	 *
	 * @return $url
     */

	 public function buildQueryString($params=array())
	 {
	 	$query=array();

	 	if(!empty($_GET))
	 		$query=$_GET;

	 	if(isset($query["controller"]))
	 		unset($query["controller"]);

	 	if(isset($query["view"]))
	 		unset($query["view"]);

	 	if(isset($query["p"]))
	 		unset($query["p"]);

	 	$query=array_merge($query,$params);
		$parse=$this->parseUrl();
	 	return urldecode($parse["path"]."?".http_build_query($query));

	 }

}