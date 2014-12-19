<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
namespace Smce\Core;

class SmFormField  extends  SmForm
{
	/**
	 * @param $model
	 * @param $attribute
	 *
	 * @return label
	 */
	public function labelEx($model,$attribute)
	{
		$model=new $model();
		if (!property_exists($model,$attribute) && !property_exists($model,$attribute) && !isset($model->$attribute)) {
			echo '<html><body><h5>Not attribute '.$attribute.'</h5></body></html>';
			exit;
		}
		
		$label=$model->attributeLabels();
		
		return '<label>'.(isset($label[$attribute]) ? $label[$attribute] : '').'</label>';

	}
	
	/**
	 * @param $model
	 * @param $attribute
	 * @param $array
	 *
	 * @return input textfield
	 */

	public function textField($model,$attribute,$array=array())
	{
		if (!property_exists($model,$attribute) && !isset($model->$attribute)) {
			echo '<html><body><h5>Not attribute '.$attribute.'</h5></body></html>';
			exit;
		}
		$form=array(
			"type"=>"text",
			"id"=>get_class ($model)."_".$attribute,
		);

		$_error=$this->getErrorData();
		if (isset($_error[$attribute])) {
			$form["class"][]="error";
		}

		foreach ($array as $key=>$value) {
			if($key!="class")
				$form[$key]=$value;
			else
				$form["class"][]=$value;

		}

		$STR='<input';
		foreach ($form as $key=>$value) {
			if($key!="class")
				$STR.=' '.$key.'="'.$value.'" ';
			else{
				$STR.=' class="';
				foreach($value as $key2=>$value2)
					$STR.=$value2.' ';

				$STR.='"';
			}
		}

		$STR.=sprintf('name="%s[%s]" value="%s" />',get_class($model),$attribute,$model->$attribute);

		return $STR;
	}
	
	/**
	 * @param $model
	 * @param $attribute
	 * @param $array
	 *
	 * @return input passwordfield
	 */

	public function passwordField($model,$attribute,$array=array())
	{
		if (!property_exists($model,$attribute) && !isset($model->$attribute)) {
			echo '<html><body><h5>Not attribute '.$attribute.'</h5></body></html>';
			exit;
		}
		$form=array(
			"type"=>"password",
			"id"=>get_class ($model)."_".$attribute,
		);
		$_error=$this->getErrorData();
		if (isset($_error[$attribute])) {
			$form["class"][]="error";
		}

		foreach ($array as $key=>$value) {
			if($key!="class")
				$form[$key]=$value;
			else
				$form["class"][]=$value;

		}

		$STR='<input';
		foreach ($form as $key=>$value) {
			if($key!="class")
				$STR.=' '.$key.'="'.$value.'" ';
			else{
				$STR.=' class="';
				foreach($value as $key2=>$value2)
					$STR.=$value2.' ';

				$STR.='"';
			}
		}

		$STR.=sprintf('name="%s[%s]" value="%s" />',get_class($model),$attribute,$model->$attribute);

		return $STR;
	}
	
	/**
	 * @param $model
	 * @param $attribute
	 * @param $array
	 *
	 * @return textarea
	 */

	public function textArea($model,$attribute,$array=array())
	{
		if (!property_exists($model,$attribute) && !isset($model->$attribute)) {
			echo '<html><body><h5>Not attribute '.$attribute.'</h5></body></html>';
			exit;
		}

		$form=array(
			"id"=>get_class ($model)."_".$attribute,
		);

		$_error=$this->getErrorData();
		if (isset($_error[$attribute])) {
			$form["class"][]="error";
		}

		foreach ($array as $key=>$value) {
			if($key!="class")
				$form[$key]=$value;
			else
				$form["class"][]=$value;

		}

		$STR='<textarea ';
		foreach ($form as $key=>$value) {
			if($key!="class")
				$STR.=' '.$key.'="'.$value.'" ';
			else{
				$STR.=' class="';
				foreach($value as $key2=>$value2)
					$STR.=$value2.' ';

				$STR.='"';
			}
		}

		$STR.=sprintf('name="%s[%s]">%s</textarea>',get_class($model),$attribute,$model->$attribute);

		return $STR;
	}
	
	/**
	 * @param $model
	 * @param $attribute
	 * @param $item
	 * @param $array
	 *
	 * @return select
	 */

	public function dropDownList($model,$attribute,$item=array(),$array=array())
	{
		if (!property_exists($model,$attribute) && !isset($model->$attribute)) {
			echo '<html><body><h5>Not attribute '.$attribute.'</h5></body></html>';
			exit;
		}

		$form=array(
			"id"=>get_class ($model)."_".$attribute,
		);

		$_error=$this->getErrorData();
		if (isset($_error[$attribute])) {
			$form["class"][]="error";
		}

		foreach ($array as $key=>$value) {
			if($key!="class")
				$form[$key]=$value;
			else
				$form["class"][]=$value;

		}

		$STR='<select ';
		foreach ($form as $key=>$value) {
			if($key!="class")
				$STR.=' '.$key.'="'.$value.'" ';
			else{
				$STR.=' class="';
				foreach($value as $key2=>$value2)
					$STR.=$value2.' ';

				$STR.='"';
			}
		}

		
		$STR.=sprintf('name="%s[%s]">',get_class($model),$attribute);	
		foreach($item as $key=>$value)
			$STR.='<option value="'.$key.'" '.($key==$model->$attribute ? 'selected="selected"' : '').'>'.$value.'</option>';

		$STR.='</select>';

		return $STR;
	}
	
	/**
	 * @param $model
	 * @param $attribute
	 * @param $array
	 *
	 * @return input checkbox
	 */

	public function checkBox($model,$attribute,$array=array())
	{
		if (!property_exists($model,$attribute) && !isset($model->$attribute)) {
			echo '<html><body><h5>Not attribute '.$attribute.'</h5></body></html>';
			exit;
		}

		$form=array(
			"type"=>"checkbox",
			"id"=>get_class ($model)."_".$attribute,
			"value"=>true,
		);

		foreach($array as $key=>$value)
			$form[$key]=$value;

		$STR='<input ';
		foreach ($form as $key=>$value) {
			if($key!="class")
				$STR.=' '.$key.'="'.$value.'" ';
			else{
				$STR.=' class="';
				foreach($value as $key2=>$value2)
					$STR.=$value2.' ';

				$STR.='"';
			}
		}

		$STR.='name="'.get_class ($model).'['.$attribute.']" '.(true==$model->$attribute ? 'checked="checked"' : '').'  />';

		return $STR;
	}
	
	/**
	 * @param $value
	 * @param $array
	 *
	 * @return input submit
	 */

	public function submit($val="",$array=array())
	{
		$form=array(
			"type"=>"submit",
		);
		$STR='<input ';
		foreach($array as $key=>$value)
			$form[$key]=$value;
		foreach($form as $key=>$value)
			$STR.=' '.$key.'="'.$value.'" ';

		$STR.=' value="'.$val.'" />';

		return $STR;
	}
	
	/**
	 * @param $model
	 * @param $attribute
	 *
	 * @return errorMessage
	 */

	public function error($model,$attribute)
	{
		$model=new $model();

		if (!property_exists($model,$attribute) && !isset($model->$attribute)) {
			echo '<html><body><h5>Not attribute '.$attribute.'</h5></body></html>';
			exit;
			
		}
		
		if(isset(SmForm::$errorData[$attribute])){
			$attributeLabels=$model->attributeLabels();
			$attributeLabel=$attributeLabels[$attribute];
			$replace=str_replace($attribute,$attributeLabel,SmForm::$errorData[$attribute]);
			return '<div class="errorMessage">'.($attributeLabel!=""?$replace:SmForm::$errorData[$attribute]).'</div>';
			
		}
	}

	/**
	 *
	 * @return errorSummary
	 */
	 
	public function errorSummary($model)
	{
		
		if (count(SmForm::$errorData)>0) {
			
			$attributeLabels=$model->attributeLabels();
			
			$STR='<div class="errorSummary">
				<p>Lütfen veri giriş hatalarını düzeltin:</p>
				<ul>';
				foreach (SmForm::$errorData as $key=>$value) {
					$attributeLabel=$attributeLabels[$key];
					$replace=str_replace($key,$attributeLabel,$value);
					$STR.='<li>'.($attributeLabel!=""?$replace:$value).'</li>';
				}
				$STR.='</ul></div>';

			echo $STR;
		}
	}

}
