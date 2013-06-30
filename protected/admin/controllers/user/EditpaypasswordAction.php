<?php
class EditpaypasswordAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new User("EditAdminPayPassword");
  	$model_name=get_class($model);
  	if(isset($_POST[$model_name])){
  		$model=!empty($_POST[$model_name]['id'])?$model->get_table_datas($_POST[$model_name]['id']):$model;
  		$model->setScenario("EditAdminPayPassword");
      $model->attributes=$_POST[$model_name];
			if($model->validate()){
				//设置用户的密钥和默认密码
  			$salt=$model->user_salt;
  			$user_salt=Util::createSalt($salt);
  			$model->pay_password=Util::hc($model->new_password,$user_salt);
  			
			  $model->insert_datas();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}else{
			$id=$_REQUEST['id'];
			$model=!empty($id)?$model->get_table_datas($id,array()):$model;
		}
		$this->display('editpaypassword',array('model'=>$model));
  } 
}
?>
