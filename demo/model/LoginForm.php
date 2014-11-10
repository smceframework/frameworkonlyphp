<?php

/**
 * LoginForm class.
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */

class LoginForm extends \SmLib\SMFormModel
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
