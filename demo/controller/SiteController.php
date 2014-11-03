<?php

class SiteController extends \SmceFramework\Smcontroller
{

    public $layout='//layouts/column1';

    public function actionIndex()
    {
        if (Smce::app()->getState("name")=="") {

             $this->render("index",array(
                "model"=>"Site controllerden gelen bi yazıdır",
                "grup"=>"PHP-TR grubu",
                "grup_site"=>"https://www.facebook.com/groups/tr.developers/",
             ));

        } else {
            $this->redirect("panel/index");
        }
    }

    public function actionAbout()
    {
         $this->render("pages/about");
    }

    public function actionLogin()
    {
        $model=new LoginForm();

        if (isset($_POST["LoginForm"])) {
            $post=(object) $_POST["LoginForm"];

            $model->username    =    $post->username;
            $model->password    =    $post->password;
            $model->rememberMe    =    isset($post->rememberMe);

            if ($model->validate() && $model->login()) {

                //redirect url
                $this->redirect("panel/index");

            }
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

    public function error($err)
    {
         $this->render("error",array(
            "code"=>$err,
         ));
    }
}
