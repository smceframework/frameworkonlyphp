<?php

use Smce\Core\SmController;

use Smce\Core\SmActiveEvent;

class ActiverecordController extends SmController
{

    public $layout='//layouts/column1';
	
	public function actionIndex(){
		
		$connection = Smce::app()->db();
		
		//PDOStatement Class
		$list=$connection->query("select * from list")->fetchAll();
		// $list=$connection->query("select * from list")->fetch()
		
		echo "<pre>";
		print_r($list);
	}
	
	public function actionCreate(){
		ListModel::create(array(
			"name"=>"Samed",
			"email"=>"imadige@gmail.com",
		));
	}
	
	public function actionCreate2(){
		$model=new ListModel;
		$model->name="Samed";
		$model->email="imadige@gmail.com";
		$model->save();
	}
	
	
	public function actionUpdate(){
		$model=ListModel::model()->find(2);
		$model->name="Ceylan";
		$model->save();
	}
	
	
	public function actionRetrieve(){
		$model=ListModel::find(2);
		echo $model->name="Ceylan";
		echo "<br><br>";
		
		$model2=ListModel::find('all', array('order' => 'listID', 'limit' => 10));
		foreach( $model2 as $key=>$value)
			echo $value->name." ".$value->email."<br>";
	}
	
	
	public function actionDelete(){
		$model=ListModel::find(1);
		$model->delete();
	}
	
}