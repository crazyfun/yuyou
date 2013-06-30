<?php
class ValidatepasswordAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_main_page();
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	$cssPath=$this->controller->get_css_path();
    $jsPath=$this->controller->get_js_path();
   	require_once('config.inc.php');
  	require_once('uc_client/client.php');
  	$user_id=$_REQUEST['id'];
  	$code=$_REQUEST['code'];
  	$model=new User("ValidatePassword");
  	$model=$model->findByPK($user_id);
  	$user_salt=$model->user_salt;
  	$validate_flag=false;
  	if($code!=Util::createSalt($user_salt)){
  		$this->controller->redirect($this->controller->createUrl("error/error404"));
  	}
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model->setScenario("ValidatePassword");
      $model->attributes=$_POST[$model_name];
			if($model->validate()){
				 //设置用户的密钥和默认密码
  		  $user_salt=Util::createSalt($model->user_salt);
  	    $model->user_password=Util::hc($model->new_password,$user_salt);
			  $result=$model->insert_datas();
			  if($result){
					$ucresult = uc_user_edit($model->user_login,'',$model->new_password,'','1');
					$validate_flag=true;
			  	$this->controller->f(CV::SUCCESS);
			  }
		  }else{
		  	
			  $this->controller->f(CV::FAIL);
		  }
		}
		$this->display('validate_password',array('model'=>$model,'validate_flag'=>$validate_flag,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }

}
?>