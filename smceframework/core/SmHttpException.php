<?php

namespace Smce\Core;

use SiteController;

class SmHttpException
{
	private $httpCode;
	
	private $message;
	
	public function __construct($httpCode,$message)
	{
		$this->message=$message;
		$this->httpCode=$httpCode;
	}
	
	public function getMessage()
	{
		return $this->message;
	}
	
	public function getHttpCode()
	{
		return $this->httpCode;
	}
	
	public static function htppError($httpCode,$message)
    {
        $SiteController=new SiteController();

        SiteController::$error=true;
		
        $SiteController->error($httpCode,$message);
		
		exit;

    }
}
