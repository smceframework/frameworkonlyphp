<?php

class ThemebasicController extends \SmceFramework\Smcontroller
{

    public $layout='//layouts/column2';
    public $theme='basic';

    public function actionIndex()
    {
        $this->render("index");
    }

}
