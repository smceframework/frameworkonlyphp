<?php

use Smce\Core\SmController;

use Smce\Core\SmSSH;
use Smce\Core\SmSFTP;

class SshController extends SmController
{

    public $layout='//layouts/column1';
	
	public function actionExec()
	{
		$conn=new SmSSH();
		$login=$conn->login("ssh1");
		echo "<pre>";
		echo $login->exec('cd /etc;ls -a');
		
		//print_r($conn->getError());
	}
	
	
	public function actionPut()
	{
		$conn=new SmSFTP();
		$login=$conn->login("ssh1");
		
		echo "<pre>";
		$login->put('filename.txt', 'hello, world!');
		print_r($login->nlist());
		
		//print_r($conn->getError());
		
	}
	
}