<?php
class EditAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	require_once('config.inc.php');
  	require_once('uc_client/client.php');
  	$model=new User("AdminRegiste");
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
  		$user_email=$model->user_email;
  		$model->setScenario("AdminRegiste");
  		$config = Yii::app()->getParams();
  		$password=$config['default_password'];
  		if(empty($_POST[$model_name]['id'])){
  			//设置用户的密钥和默认密码
  			$salt=Util::randStr(6);
  			$user_salt=Util::createSalt($salt);
  			$model->user_salt=$salt;
  			$model->user_password=Util::hc($password,$user_salt);
  		}
      $model->attributes=$_POST[$model_name];
			if($model->validate()){
				if($user_email!=$model->user_email){
					$ucresult = uc_user_edit($model->user_login,"","",$model->user_email,'1');
				}
			  $model->insert_datas();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}else{
			$id=$_REQUEST['id'];
			$model=!empty($id)?$model->get_table_datas($id,array()):$model;
		}
		$this->display('add',array('model'=>$model));
  } 
}
?>
