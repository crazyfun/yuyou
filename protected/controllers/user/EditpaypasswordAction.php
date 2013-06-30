<?php
class EditpaypasswordAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->user_tag="editpaypassword";
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	$cssPath=$this->controller->get_css_path();
    $jsPath=$this->controller->get_js_path();
  	$user_id=Yii::app()->user->id;
  	$model=new User("EditPayPassword");
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->findByPk($_POST[$model_name]['id']):$model;
  		$model->setScenario("EditPayPassword");
      $model->attributes=$_POST[$model_name];
			if($model->validate()){
				//设置用户的密钥和默认密码
  		  $user_salt=Util::createSalt($model->user_salt);
				if(Util::hc($model->check_password,$user_salt)!=$model->pay_password){
					$model->addError('check_password',"旧密码不正确");
					$result=false;
				}else{
  	      $model->pay_password=Util::hc($model->new_password,$user_salt);
  	      $result=$model->insert_datas();
  	   }

			  if($result){
					
			  	$this->controller->f(CV::SUCCESS);
			  }
		  }else{
		  	
			  $this->controller->f(CV::FAIL);
		  }
		}else{
			$model=empty($user_id)?$model:$model->findByPk($user_id);
		}
		$this->display('edit_paypassword',array('model'=>$model,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }

}
?>