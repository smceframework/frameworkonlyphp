<?php
//ActiveRecord example

use Smce\Core\SmActiveRecord;

class ListModel extends SmActiveRecord
{
	
	public static $table_name="list";
	
	public static $connection="db";
	
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
