<?php

use Smce\Core\SmController;
use Smce\Lib\SmOutput;

class SiteController extends SmController
{

    public $layout='//layouts/column1';

    public function actionIndex()
    {
        $hello="Hello World";
		
        $this->render("index",array("hello"=>$hello));
        
    }
	
	public function actionOutput()
	{
		$SmOutput=new SmOutput;
		$SmOutput->setContentType("application/json")
		//->setFileName("hello.json")
		->put(json_encode(array('message' => 'Hello, World!')));
	}

    public function actionAbout()
    {
         $this->render("pages/about");
    }
	
	
	public static function methotTest(){
		return "This method was called from SiteController";
	}

	
    public function actionLogin()
    {
		
        $model=new LoginForm();

        if (isset($_POST["LoginForm"])) {
			
            $model->attributesApply($_POST["LoginForm"]);
		
            if ($model->validate() && $model->login()) {
			
                //redirect url
                $this->redirect("panel/index");

            }
			/*
			*use Smce\Core\SmForm;
			*print_r(SmForm::getErrorData());
			*
			*/
			
			
        }

        $this->render("login",array(
            "model"=>$model,
         ));

    }

    public function actionLogout()
    {
        Smce::app()->stateClear();
        $this->redirect("site/index");
    }

    public function error($httpCode,$message)
    {
		
		$this->render("error".$httpCode,array(
			"message"=>$message,
		));
    }
}
