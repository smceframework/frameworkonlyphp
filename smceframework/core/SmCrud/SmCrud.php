<?php

namespace Smce\Core;

use Smce\Base\SmBase;
use ActiveRecord;
use Smce;

class SmCrud
{
	public static $conn;
	
	public function __construct($conn)
	{
		
		if(!isset(SmBase::$config["components"]["activerecord"][$conn]["connectionString"]))
			throw new SmException("Connection String not be empty");
		
		self::$conn=$conn;
			
	}
	
	public function newModel($table="")
	{
		if(empty($table))
			throw new SmException("Table Name not be empty");
		
		$migration=new SmMigration(self::$conn);
		
		if(!$migration->getTable($table))
			throw new SmException("Table can not be found.");
		
		$attributes=$migration->getAttributes($table);
		
		$modelName=ucfirst($table)."Model";
		
		$model_1=file_get_contents(dirname(__FILE__)."/model/model");
		
		$model_1=str_replace("[model]",$modelName,$model_1);
		
		$model_1=str_replace("[tablename]",$table,$model_1);
		
		$model_1=str_replace("[connection]",self::$conn,$model_1);
		
		$rules2="";
		$label="";
		$int=array();
		$varchar=array();
		
		$requiredBol=false;
		
		foreach($attributes as $key=>$value){
			
			$value=(object)$value;
			
			if($value->null=="NO" && $value->extra!="auto_increment"){
				if($requiredBol==false){
					$rules2="array('";
					$requiredBol=true;
				}
				$rules2.=strtolower($value->field).", ";
			}
			
			if(substr($value->type,0,7)=="varchar"  && $value->extra!="auto_increment"){
				preg_match("/\((.*?)\)/",$value->type,$match);
				$varchar[$match[1]][]=strtolower($value->field);
			}
			
			if(substr($value->type,0,3)=="int"  && $value->extra!="auto_increment"){
				$int[][]=strtolower($value->field);
			}
			
			$label[]=sprintf("'%s' =>\t'%s',",strtolower($value->field),strtolower($value->field));
		}
		if(!empty($rules2)){
			$rules2=substr($rules2,0,strlen($rules2)-2);
			$rules2.="', 'required')";
		}
		
		$max_len=array();
		foreach($varchar as $key=>$value){
			$max_len[]="array('".implode(", ",$value)."', 'max_len,".$key."')";
		}
		
		
		$integer="";
		foreach($int as $key=>$value){
			$integer="array('".implode(", ",$value)."', 'integer')";
		}
		
		$rules="public function rules()
	{
		
		return array(
		
			[array]
			[max_len]
			[integer]
			
		);
		
	}";
	
		if(!empty($rules2))
			$rules=str_replace("[array]",$rules2.",",$rules);
		else
			$rules=str_replace("[array]","",$rules);
		
		if(!empty($max_len))
			$rules=str_replace("[max_len]",implode(",",$max_len).",",$rules);
		else
			$rules=str_replace("[max_len]","",$rules);
		
		
		$rules=str_replace("[integer]",$integer,$rules);
		
			
		$model_1=str_replace("[rules]",$rules,$model_1);
		
		
		$labels="public function attributeLabels()
	{
		return array(
		
			[label]
		);
	}";
		
		
		$labels=str_replace("[label]",implode("\n\t\t\t",$label),$labels);
		
		
		$model_1=str_replace("[labels]",$labels,$model_1);
		
		
		echo "Is Let's create a new model ?(yes-no)# ";
		while ($c = fread(STDIN, 3)) {
			if(trim(strtolower($c))=="yes" || trim(strtolower($c))=="y")
				break;
			else
				exit;
		}
	
		$fileName=Smce::app()->basePath."/main/model/".$modelName.".php";
		if(file_put_contents($fileName,$model_1))
			echo "Add ".$modelName." 	".$fileName;
		else
			echo "Failed to Create ".$modelName."	".$fileName;	
	}
}