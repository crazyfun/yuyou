<?php
class EditpasswordAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_user_page();
        $this->controller->user_tag="editpassword";
        WebConfig::set_seo_content(array(),array(),array());
        WebConfig::set_breadcrumbs();
        return true;
    }
   protected function do_action(){
   	$cssPath=$this->controller->get_css_path();
    $jsPath=$this->controller->get_js_path();
   	require_once('config.inc.php');
  	require_once('uc_client/client.php');
  	$user_id=Yii::app()->user->id;
  	$model=new User("EditPassword");
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->findByPk($_POST[$model_name]['id']):$model;
  		$model->setScenario("EditPassword");
      $model->attributes=$_POST[$model_name];
			if($model->validate()){
				
				 //设置用户的密钥和默认密码
  		  $user_salt=Util::createSalt($model->user_salt);
  	    $model->user_password=Util::hc($model->new_password,$user_salt);
  	    $old_password=$model->check_password;
  	    $model->check_password=$model->new_password;
			  $result=$model->insert_datas();
			  if($result){
					$ucresult = uc_user_edit($model->user_login,$old_password,$model->new_password,'','0');
			  	$this->controller->f(CV::SUCCESS);
			  }
		  }else{
		  	
			  $this->controller->f(CV::FAIL);
		  }
		}else{
			$model=empty($user_id)?$model:$model->findByPk($user_id);
		}
		$this->display('edit_password',array('model'=>$model,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
  }

}
?>