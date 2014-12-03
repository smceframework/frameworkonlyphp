<?php

use Smce\Core\SmController;

class PanelController  extends SmController
{
    private $components1;

    public function __construct()
    {
        $this->components1=new Components1();
    }

    private function indexControl()
    {
       return  $this->components1->getControl();
    }

    public function accessRules()
    {
        return array(

            array(
                'actions'=>array('index'), // Actions. is array
                'users'=>'@',  // Only * or @ values ​​are
                'redirect'=>"site/login",
                'expression'=>$this->indexControl(),    //True is allowed only. Only TRUE or FALSE values ​​are.
                //'ip'=>array('127.0.0.1'), //IP is allowed only. is array
            ),

        );
    }

    public function actionIndex()
    {
        $this->render("index");

        /*
		UserSmodel::create($params);
		*/
    }

}
