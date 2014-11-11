<?php

class ThemebasicController extends SmLib\SmController
{

    public $layout='//layouts/column2';
    public $theme='basic';

    public function actionIndex()
    {
        $this->render("index");
    }

}
