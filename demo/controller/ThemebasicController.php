<?php

class ThemebasicController extends \SmceFramework\Sm_Controller
{

    public $layout='//layouts/column2';
    public $theme='basic';

    public function actionIndex()
    {
        $this->render("index");
    }

}
