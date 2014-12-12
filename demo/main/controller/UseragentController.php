<?php

use Smce\Core\SmController;
use Smce\Extension\SmUserAgent;

class UseragentController extends SmController
{

    public $layout='//layouts/column1';
	
	public function actionIndex(){
		
		// $userAgentString = 'Mozilla/5.0 (X11; U; Linux x86_64; en-US; rv:1.9.2pre) Gecko/20100116 Ubuntu/9.10 (karmic) Namoroka/3.6pre';
		
		$userAgentString=$_SERVER['HTTP_USER_AGENT'];
		
		$userAgent = new SmUserAgent($userAgentString);
		
		echo $userAgent->getBrowserName()."<br>";
		
		echo $userAgent->getBrowserVersion()."<br>";
		
		echo $userAgent->getOperatingSystem()."<br>";
		
		echo $userAgent->getEngine()."<br>";
		
		echo $userAgent->isUnknown()."<br>";
	
	}
}