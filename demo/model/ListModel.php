<?php
//ActiveRecord example

use Smce\Core\SmFormModel;

class ListModel extends SmFormModel
{
	
	public static $table_name="list";
	
	public function rules()
	{
		return array(
			// name, password and email are required
            array('name, email', 'required'),
			
		);
	}

	public function attributeLabels()
	{
		return array(
			'name'=>'Ad Soyad',
			'email'=>'E-mail',
		);
	}
	
	
}
