<?PHP


namespace SMLib;


class SMForm  extends \SMLib\SMCli{
	
	public static $errorData=array();
	
	
	
	public function beginWidget($array=array()){
		$form=array(
			"method"=>"post",
		);
		
		
		foreach($array as $key=>$value)
			$form[$key]=$value;
		
		$STR='<form';
		foreach($form as $key=>$value)
			$STR.=' '.$key.'="'.$value.'" ';
		
		$STR.='/>';
		
		echo $STR;
	
		return new SMFormField;
	}
	
	
	public function endWidget(){
		$STR='</form>';
		echo $STR;
	}
	
	
	public function getError(){
		if(count(SMForm::$errorData)>0)
			return true;
	}
	
	
	public function getErrorData(){
			return SMForm::$errorData;
	}
}

