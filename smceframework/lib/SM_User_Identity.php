<?php


abstract class SM_User_Identity extends \SMLib\SM_Cli implements \SMImplements\SM_User_Identity_Imp
{
	const ERROR_NONE=0;
    const ERROR_USERNAME_INVALID=1;
    const ERROR_PASSWORD_INVALID=2;
    const ERROR_UNKNOWN_IDENTITY=100;

	public $errorCode=self::ERROR_UNKNOWN_IDENTITY;
	public $username;
	public $password;

	public function __construct($username,$password)
	{
		$this->username=$username;
		$this->password=$password;
	}

}
