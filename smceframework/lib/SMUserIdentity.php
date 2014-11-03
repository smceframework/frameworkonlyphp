<?PHP


abstract class SMUserIdentity extends \SMLib\SMCli implements \SMImplements\SMUserIdentity_
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
