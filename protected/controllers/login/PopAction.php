<?php
class PopAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_page();
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
  }
   protected function do_action(){
   			$cssPath=$this->controller->get_css_path();
    		$jsPath=$this->controller->get_js_path();
		    require_once('config.inc.php');
  	    require_once('uc_client/client.php');
  	    $action=$_REQUEST['action'];
		    $ts = time();
	      $model=new User();
	      $model_name=ucfirst(get_class($model));
	      $action=$_REQUEST['action'];
	      if($action=="login"){
        if(isset($_POST[$model_name])){
            $model->attributes=$_POST[$model_name];
            $model->imagecode=$_POST[$model_name]['imagecode'];
            $model->setScenario("Login");
            $ucenter_class=UcenterClass::get();
            $uc_result=$ucenter_class->register_ucenter_user($_POST[$model_name]['user_login'],$_POST[$model_name]['user_password']);
            if($uc_result<=0){
						  if($uc_result == -1) {
							   $model->addError('user_login','用户名不存在');
              } elseif($uc_result == -2) {
	               $model->addError('user_password','密码不正确');
              } else {
	               $model->addError('user_login','登录错误');
              }
					  }
					 $get_errors=$model->getErrors();
           if(empty($get_errors)&&$model->validate()&&$model->login()){
					      if($uc_result > 0) {
				          $ucsynlogin = uc_user_synlogin($uc_result);
				        }
				        $this->display('poploginsuccess',array('ucsynlogin'=>$ucsynlogin));
				        exit();
            }else{
            }
        }
      }
      
      if($action=="registe"){
     if($_POST[$model_name]){
      $model->attributes=$_POST[$model_name];
      $model->var_user_password=$_POST[$model_name]['var_user_password'];
      $model->agreement='1';
      $model->setScenario("WebRegiste");
      $model->id=null;
		  $model->setIsNewRecord(true);
			if($model->validate()){
				//注册ucenter
				$uid = uc_user_register($_POST[$model_name]['user_login'], $_POST[$model_name]['user_password'], $_POST[$model_name]['user_email']);
		    if($uid <= 0) {
			      if($uid == -1) {
			          	$model->addError('user_login','用户名不合法');
			      } elseif($uid == -2) {
			          	$model->addError('user_login','包含要允许注册的词语');
			      } elseif($uid == -3) {
			          	$model->addError('user_login','用户名已存在');
			      } elseif($uid == -4) {
			          	$model->addError('user_email','用户邮箱格式有误');
			      } elseif($uid == -5) {
			          	$model->addError('user_email','用户邮箱不允许注册');
			      } elseif($uid == -6) {
			          	$model->addError('user_email','用户邮箱已存在');
			      } 
		    }
		    $get_errors=$model->getErrors();
		    if(empty($get_errors)){
		    	$salt=Util::randStr(6);
  		    $model->user_salt=$salt;
  		    $user_salt=Util::createSalt($salt);
  		    $model->id=$uid;
  	      $model->user_password=Util::hc($model->user_password,$user_salt);
  	      $model->var_user_password=$model->user_password;   
  	      $model->pay_password=$model->user_password;
  	      $invite_code=Util::randStr(6);
  	      $invite_code=Util::createSalt($invite_code);
  	      $model->invite_code=$invite_code;
		    	$result=$model->insert_datas();
		    	if($result){
		    		$user_type=UserType::model();
		    		$user_type->id=null;
		    		$user_type->setIsNewRecord(true);
		    		$user_type->user_id=$model->id;
		    		$user_type->type='1';
		    		$user_type->insert_datas();
		    		if($uid > 0) {
				          $ucsynlogin = uc_user_synlogin($uid);
				     }
				    $model->user_password=$_POST[$model_name]['user_password'];
				    $model->login();
		    		$uc_avatarflash = uc_avatar($model->id);
		    		$this->display("popregistesuccess",array('model'=>$model,'ucsynlogin'=>$ucsynlogin,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
		    		exit();
		    	}
		    }
		  }
		}
   }
        $ts = time();
  	    $this->display("pop",array('model'=>$model,'ts'=>$ts,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
   }
}
?>