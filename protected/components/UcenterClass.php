<?php
require_once('config.inc.php');
require_once('uc_client/client.php');
class UcenterClass{
 private static $static_class=null;
 public static function get()
 {
   if (self::$static_class == null){
      self::$static_class =  new UcenterClass();
   }
    return self::$static_class;
  }
  public  function __construct()
  {
    
  }
  
  public function register_ucenter_user($user_login,$user_password){
  	  list($uid, $username, $password, $email) = uc_user_login($user_login,$user_password);
  	  
  	  if($uid>0){
	     $user_registe=new User("UcenterRegiste");
	     $user_datas=$user_registe->find(array('select'=>'id,user_salt','condition'=>'user_login=:user_login','params'=>array(':user_login'=>$user_login)));
	     if(!empty($user_datas)){
	     	  $user_id=$user_datas->id;
	     	  $update_datas['user_email']=$email;
	     	  $update_datas['user_login']=$username;
	     	  $user_salt=Util::createSalt($user_datas->user_salt);
	     	  $update_datas['user_password']=Util::hc($password,$user_salt);
	     	  $user_registe->update_table_datas($user_id,$update_datas);
	     }else{
	     	   
	     	   $user_registe->id=$uid;
	     	   $user_registe->user_login=$username;
	     	   $salt=Util::randStr(6);
  		     $user_registe->user_salt=$salt;
  		     $user_salt=Util::createSalt($salt);
  	       $user_registe->user_password=Util::hc($user_password,$user_salt);
	     	   $user_registe->user_email=$email;
	     	   if($user_registe->validate()){
			        $user_registe->insert_datas();
			     }
	     }
	   }
	   return $uid;
  }  
}
?>
