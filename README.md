version 1.0.0.5

PHP-TR gurubu https://www.facebook.com/groups/tr.developers/
Samed Ceylan

controller
--------------------------
<?php

class SiteController extends Smcontroller
{
	
	public $layout='//layouts/column1';


	public function actionIndex(){
		if(Smce::app()->getState("name")==""){
			 
			 $this->render("index",array(
				"model"=>"Site controllerden gelen bi yazıdır",
				"grup"=>"PHP-TR grubu",
				"grup_site"=>"https://www.facebook.com/groups/tr.developers/",
			 ));
			 
		}else{
			$this->redirect("panel/index");
		}
	}
	
	
	public function actionAbout(){
	
		 $this->render("pages/about");
	}
	
	public function actionLogin(){
		$model=new LoginForm;
		
		if(isset($_POST["LoginForm"])){
			$post=(object)$_POST["LoginForm"];
			
			
			$model->username	=	$post->username;
			$model->password	=	$post->password;
			$model->rememberMe	=	@$post->rememberMe;
			
			if($model->validate() && $model->login()){
				
				//redirect url
				$this->redirect("panel/index");
				
			}
		}
		
		$this->render("login",array(
		 	"model"=>$model,
		 ));
		
	}
	
	public function actionLogout(){
		Smce::app()->stateClear();
		$this->redirect("site/index");
	}
	
	
	public function error($err){
		 
		 $this->render("error",array(
		 	"code"=>$err,
		 ));
	}
}

view
--------------------------
<b>Proje BaseUrl</b>: <?PHP echo Smce::app()->baseUrl?> <br />
<b>Proje BasePath</b>: <?PHP echo Smce::app()->basePath?><br />
<b>Layout/MasterPage</b>: <?PHP echo $this->layout?>
<br />
<br />
<br />
<b>Controller</b>: <?PHP echo BASE_CONTROLLER?><br />
<b>View</b>: <?PHP echo BASE_VIEW?>
<br />
<br />
<br />

<b>İp Adres</b>: <?PHP echo Smce::app()->ip?><br />
<br />
<br />

<b>SiteController gelen veri</b>: <?PHP echo $model?><br />
<b>Grup</b>: <?PHP echo $grup?>	<br />
<b>Grup-Site</b>: <?PHP echo $grup_site?>	<br />




config
--------------
	
<?php
	
  
return array(
	'name'=>'SmceFramework',
	
	// autoloading model and component classes
	'import'=>array(
		'models',
		'components',
	),
	
	'debug'=>false,
	
	'components'=>array(
		'db'=>array(
			'user'=>"root",
			'password'=>"",
			'name'=>"",
			'host'=>"localhost",
		),
	),
);


?>
	
	
model
---------------
	
	
class UsersModel{ 

	public function __construct(){
		DB::$error_handler = false;
		DB::$throw_exception_on_error = true;
	}
	
	public function create($array){
		
	    //meekro DB  http://www.meekro.com/
		  $query=DB::insert('users',$array);
		  //$query=DB::update('users',$array);
	    // $query=DB::query("SELECT * FROM users");
		
	}
	
	
