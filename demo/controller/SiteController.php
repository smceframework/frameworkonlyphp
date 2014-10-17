<?php

class SiteController extends Smcontroller
{
	
	public $layout='//layouts/column1';


	public function actionIndex() {
	
		 $this->render("view",array(
		 	"model"=>"Site controllerden gelen bi yazıdır",
		 	"grup"=>"PHP-TR grubu",
			"grup_site"=>"https://www.facebook.com/groups/tr.developers/",
		 ));
	}
	
	
	public function actionDeneme(){
	
		 $this->render("deneme",array(
		 	"model"=>"deneme yazısıdır",
		 ));
	}
}