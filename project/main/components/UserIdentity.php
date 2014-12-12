<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
 
use Smce\Core\SmUserIdentity;
 
class UserIdentity extends SmUserIdentity
{

    public function authenticate()
    {
		
        /*

			ERROR_NONE=0;
			ERROR_USERNAME_INVALID=1;
			ERROR_PASSWORD_INVALID=2;
			ERROR_UNKNOWN_IDENTITY=100;

		*/

        $array=array(
            "admin"=>"admin",
            "demo"=>"demo",
        );
        if(isset($array[$this->username])!=$this->username)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        elseif(isset($array[$this->password])!=$this->password)
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else{

            Smce::app()->setState("name",$this->username);

            // echo Smce::app()->getState("name");

            $this->errorCode=self::ERROR_NONE;
        }
		
        return $this->errorCode;
    }

}
