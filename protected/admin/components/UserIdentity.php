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
	  const ERROR_OPERATE=10;
	  const ERROR_STATUS=11;
    const ERROR_USER_TYPE=12;
    public function authenticate(){
    	  $user=new User('AdminLogin');
        $user_data=$user->find("(user_email=:user_email OR user_login=:user_email)",array(':user_email'=>$this->username));
        $user_salt=Util::createSalt($user_data->user_salt);
        if($user_data===null){
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }else if($user_data->user_password!=Util::hc($this->password,$user_salt)){ 		
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        }else{
        	if($user_data->admin_status!='2'){
        		$this->errorCode=self::ERROR_OPERATE;
        	}else{
        		if($user_data->company_id!='0'){
        			  $this->errorCode=self::ERROR_USERNAME_INVALID;
        		}else{
        				$this->_id=$user_data->id;
             		$this->errorCode=self::ERROR_NONE;
            }
          }
        }
        return !$this->errorCode;
    }
    public function getId()
    {
        return $this->_id;
    }

}