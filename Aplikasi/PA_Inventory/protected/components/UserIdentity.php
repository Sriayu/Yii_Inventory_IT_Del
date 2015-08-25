<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
        private $_id;
        public function getId(){
            return ($this->_id);
            
        }

        public function authenticate()
	{
		$pengguna = Account::model()->findByAttributes(array('username'=>$this->username));
		
		$username='';
		$pass='';
		if(isset($pengguna->username))
		{
			$username=$pengguna->username;
			$pass=$pengguna->password;
                        $this->_id = $pengguna->id;
		}

		$users=array(
			// username => password
			$username=>$pass,
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
}