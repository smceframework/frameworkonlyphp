<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */

use Smce\Core\SmController;

use Smce\Core\SmSSH;

class SshController extends SmController
{

    public $layout='//layouts/column1';
	
	public function actionIndex()
	{
		$conn=new SmSSH();
		$login=$conn->login("shh1");
		echo "<pre>";
		echo $login->exec('cd /etc;ls -a');
		
		//print_r($conn->getError());
	}
	
}