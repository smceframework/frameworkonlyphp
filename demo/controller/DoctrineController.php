<?php

use Smce\Core\SmController;
use Smce\Core\SmDoctrine;

class DoctrineController extends SmController
{

    public $layout='//layouts/column1';
	
	public function actionGet(){
		
		$SmDoctrine=new SmDoctrine;
		$dojoRepo = $SmDoctrine->entityManager->getRepository('Dojos');
		$dojos = $dojoRepo->findAll();
		print_r($dojos);
	}
	
	
	
}