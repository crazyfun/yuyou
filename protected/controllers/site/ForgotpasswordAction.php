<?php
class ForgotpasswordAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_main_page();
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
   }
   protected function do_action(){
   	$cssPath=$this->controller->get_css_path();
    $jsPath=$this->controller->get_js_path();
  	$model=new User("ForgotPassword");
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->findByPk($_POST[$model_name]['id']):$model;
  		$model->setScenario("ForgotPassword");
      $model->attributes=$_POST[$model_name];
			if($model->validate()){
				$model=$model->find("user_login=:user_login",array(':user_login'=>$model->user_login));
				$send_mail=new SendMail();
				$forgot_href=Yii::app()->homeUrl."/site/validatepassword/id/".$model->id."/code/".Util::createSalt($model->user_salt);
			  $send_mail->send_mail(12,$model->user_email,array('user_login'=>$model->user_login,'forgot_href'=>$forgot_href),array());
			  $this->display("send_forgot_password",array('model'=>$model,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
		  }else{
			  $this->controller->f(CV::FAIL);
			  $this->display("forgot_password",array('model'=>$model,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
		  }
		}else{
	    $this->display("forgot_password",array('model'=>$model,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
	  }
  }

}
?>