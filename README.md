version 1.1.7
﻿
composer: https://packagist.org/packages/smce/framework

PHP-TR gurubu https://www.facebook.com/groups/tr.developers/

Php-ist grubu https://www.facebook.com/groups/istanbul.developers/

Samed Ceylan

controller
--------------------------

``` php
<?php

class SiteController extends \SmceFramework\Sm_Controller
{

    public $layout='//layouts/column1';

    public function actionIndex()
    {
        if (Smce::app()->getState("name")=="") {

             $this->render("index",array(
                "model"=>"Site controllerden gelen bi yazıdır",
                "grup"=>"PHP-TR grubu",
                "grup_site"=>"https://www.facebook.com/groups/tr.developers/",
             ));

        } else {
            $this->redirect("panel/index");
        }
    }
	

    public function actionAbout()
    {
         $this->render("pages/about");
    }

    public function actionLogin()
    {
        $model=new LoginForm();

        if (isset($_POST["LoginForm"])) {
            $post=(object) $_POST["LoginForm"];

            $model->username    =    $post->username;
            $model->password    =    $post->password;
            $model->rememberMe    =    isset($post->rememberMe);

            if ($model->validate() && $model->login()) {

                //redirect url
                $this->redirect("panel/index");

            }
        }

        $this->render("login",array(
            "model"=>$model,
         ));

    }

    public function actionLogout()
    {
        Smce::app()->stateClear();
        $this->redirect("site/index");
    }

    public function error($err)
    {
         $this->render("error",array(
            "code"=>$err,
         ));
    }
}


```

view
--------------------------

``` php

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

```


config
--------------

``` php
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
```
	
model
---------------

``` php
<?php

/**
 * LoginForm class.
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */

class LoginForm extends \SmLib\SM_Form_Model
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
            array('username, password', 'required'),
			// rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
			// password needs to be authenticated
            array('password', "after", 'authenticate'),//array('password', false, 'authenticate'),
			
        );
		
		/*
			
			-----RULES-----
			
				required
				valid_email
				max_len,1
				min_len,4
				exact_len,10
				alpha
				alpha_numeric
				numeric
				integer
				boolean
				float
				valid_url
				url_exists
				valid_ip
				valid_ipv4
				valid_ipv6
				valid_name
				contains,free pro basic
				
			-----RULES-----
			
		*/
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Beni Hatırla',
			'username'=>'E-mail',
			'password'=>'Parola',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$value)
	{

		$this->_identity=new UserIdentity($this->username,$this->password);

		if($this->_identity->authenticate() && !$this->error)
			$this->addError('password','Kullanıcı ve/veya Parola hatalı.');

	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if ($this->_identity===null) {
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if ($this->_identity->errorCode===UserIdentity::ERROR_NONE) {
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
            Smce::app()->login($this->_identity,$duration);
			return true;
		} else
			return false;
	}
}

```

model 2
---------------------------------------

``` php
<?php

class UsersModel{ 


	public function __construct(){
		DB::$error_handler = false;
		DB::$throw_exception_on_error = true;
	}
	
	public function create($array){
		  //insert
		  $query=DB::insert('users',$array);
		 
	}
	
	public function update($array){
		
	     //update
		  $query=DB::update('users', $array, "userID=%s", $array["userID"]);
		
	}
	
	
	public function admin(){
		 //select
		 $query=DB::query("SELECT * FROM agencies");
		  
	}

}

```
