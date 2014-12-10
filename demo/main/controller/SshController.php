<?php

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
	}
	
}