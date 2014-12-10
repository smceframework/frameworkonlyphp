<?php

use Smce\Core\SmController;

use Smce\Core\SmSSH;

class SshController extends SmController
{

    public $layout='//layouts/column1';
	
	public function actionIndex()
	{
		$conn=new SmSSH();
		$login=$conn->login("ssh1");
		echo "<pre>";
		echo $login->exec('cd /etc;ls -a');
		
		//print_r($conn->getError());
	}
	
}