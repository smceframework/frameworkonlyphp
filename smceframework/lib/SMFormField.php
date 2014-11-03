<?PHP


namespace SMLib;

class SMFormField extends \SMLib\SMCli
{
	public function labelEx($model,$attribute)
	{
		$model=new $model();

		if ( property_exists($model,$attribute)) {
			$label=$model->attributeLabels();
			return '<label>'.(isset($label[$attribute]) ? $label[$attribute] : '').'</label>';
		} else {
			echo '<html><body><h5>Not attribute '.$attribute.'</h5></body></html>';
			exit;
		}

	}

	public function textField($model,$attribute,$array=array())
	{
		if (!property_exists($model,$attribute)) {
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

		$STR.='name="'.get_class ($model).'['.$attribute.']" value="'.$model->$attribute.'" />';

		return $STR;
	}

	public function passwordField($model,$attribute,$array=array())
	{
		if (!property_exists($model,$attribute)) {
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

		$STR.='name="'.get_class ($model).'['.$attribute.']" value="'.$model->$attribute.'" />';

		return $STR;
	}

	public function textArea($model,$attribute,$array=array())
	{
		if (!property_exists($model,$attribute)) {
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

		$STR.='name="'.get_class ($model).'['.$attribute.']">'.$model->$attribute .'</textarea>';

		return $STR;
	}

	public function dropDownList($model,$attribute,$item=array(),$array=array())
	{
		if (!property_exists($model,$attribute)) {
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

		$STR.='name="'.get_class ($model).'['.$attribute.']">';

		foreach($item as $key=>$value)
			$STR.='<option value="'.$key.'" '.($key==$model->$attribute ? 'selected="selected"' : '').'>'.$value.'</option>';

		$STR.='</select>';

		return $STR;
	}

	public function checkBox($model,$attribute,$array=array())
	{
		if (!property_exists($model,$attribute)) {
			echo '<html><body><h5>Not attribute '.$attribute.'</h5></body></html>';
			exit;
		}

		$form=array(
			"type"=>"checkbox",
			"id"=>get_class ($model)."_".$attribute,
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

	public function submit($val,$array=array())
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

	public function error($model,$attribute)
	{
		$model=new $model();

		if ( property_exists($model,$attribute)) {
			if(isset(SMForm::$errorData[$attribute]))
				return '<div class="errorMessage">'.SMForm::$errorData[$attribute].'</div>';
		} else {
			echo '<html><body><h5>Not attribute '.$attribute.'</h5></body></html>';
			exit;
		}
	}

	public function errorSummary()
	{
		if (count(SMForm::$errorData)>0) {
			$STR='<div class="errorSummary">
				<p>Lütfen veri giriş hatalarını düzeltin:</p>
				<ul>';
				foreach (SMForm::$errorData as $key=>$value) {
					$STR.='<li>'.$value.'</li>';
				}
				$STR.='</ul></div>';

			echo $STR;
		}
	}

}
