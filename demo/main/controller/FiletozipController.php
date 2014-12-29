<?php

use Smce\Core\SmController;
use Smce\Core\SmFiletozip;

class FiletozipController extends SmController
{

    public $layout='//layouts/column2';
	
	public function actionZipdownload(){
		
		$fileEvent=new SmFiletozip;
		
		$fileEvent->addFile(
				"http://www.kotusozluk.com/img/2012/07/araba_1341958758.jpeg",
				"away"
			);
			
		$fileEvent->addFile(
				"http://www.gulum.net/kartlari-resimleri/araba-resimleri/images/araba-resmi6.jpg",
				"away"
			);
			
		$fileEvent->addFile(
				BASE_PATH."/front/images/logo.jpg",
				"current"
			);
		
		$fileEvent->filePackage()->download();
		
	}
	
	
	public function actionPut(){
		
		$fileEvent=new SmFiletozip;
		
		$fileEvent->addFile(
				"http://www.kotusozluk.com/img/2012/07/araba_1341958758.jpeg",
				"away"
			);
			
		$fileEvent->addFile(
				"http://www.gulum.net/kartlari-resimleri/araba-resimleri/images/araba-resmi6.jpg",
				"away"
			);
			
		$fileEvent->addFile(
				BASE_PATH."/front/images/logo.jpg",
				"current"
			);
		
		$fileEvent->filePackage()->filePutContent(BASE_PATH."/zip10001.zip");
		
	}
	
}