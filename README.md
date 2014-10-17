version 1.0.0.0

controller
--------------------------
<?php

class SiteController extends Smcontroller
{
	
	public $layout='//layouts/column1';

	public function actionIndex(){
	
		 $this->render("view",array(
		 	"model"=>"Site controllerden gelen bi yazıdır",
		 	"grup"=>"PHP-TR grubu",
			"grup_site"=>"https://www.facebook.com/groups/tr.developers/",
		 ));
	}
	
	
	public function actionDeneme(){
	
		 $this->render("deneme",array(
		 	"model"=>"deneme yazısıdır",
		 ));
	}
}

view
--------------------------
<b>Proje BaseUrl</b>: <?PHP echo Smce::baseUrl()?><br />
<b>Proje BasePath</b>: <?PHP echo Smce::basePath()?><br />
<b>Layout/MasterPage</b>: <?PHP echo $this->layout?><br />
<br />
<br />
<br />
<b>Controller</b>: <?PHP echo BASE_CONTROLLER?><br />
<b>View</b>: <?PHP echo BASE_VIEW?>
<br />
<br />
<br />

<b>SiteController gelen veri</b>: <?PHP echo $model?><br /><br />
<b>Grup</b>: <?PHP echo $grup?>	<br /><br />
<b>Grup-Site</b>: <?PHP echo $grup_site?>	<br />




config
--------------
	
	$debug = false;
	
	if($debug){
		ini_set('display_errors', 1);
		error_reporting(E_ALL ^ E_NOTICE);
	}
	
	//db setting
	define("DB_USER","root");
	define("DB_PASSWORD","");
	define("DB_NAME","");
	define("DB_HOST","localhost");
	
	
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
	
	
