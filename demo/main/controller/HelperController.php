<?php

use Smce\Core\SmController;


class HelperController extends SmController
{

    public $layout='//layouts/column1';


    public function actionArrayfirst()
	{
		$array=array(100, 200, 120, 336, 680, 247, 300, 185, 90, 125, 140);

		echo S::array_first(function($x){
			return $x > 200 ? true:false;
		},$array);
	}
	
	public function actionArraylast()
	{
		$array=array(100, 200, 120, 336, 680, 247, 300, 185, 90, 125, 140);

		echo S::array_last(function($x){
			return $x > 200 ? true:false;
		},$array);
	}

	public function actionArrayfilter()
	{
		$array=array(100, 200, 120, 336, 680, 247, 300, 185, 90, 125, 140);

		$arr=S::array_filter(function($x){
			return $x > 200 ? true:false;
		},$array);

		echo "<pre>";
		print_r($arr);
	}

	public function actionArrayflatten()
	{
		$array = array(1,2,array(3,10,17, array(5,6,7), 14,8), 9);

		$arr=S::array_flatten($array);

		echo "<pre>";
		print_r($arr);
	}

	public function actionArrayget()
	{
		$array = array("name"=>array("foo"=>array("bar"=>"fu")));

		$arr=S::array_get($array,"name.foo");

		echo "<pre>";
		print_r($arr);
	}

	
}