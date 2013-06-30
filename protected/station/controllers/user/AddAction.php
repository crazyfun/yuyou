<?php
class AddAction extends BaseAction{
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
  		$model->setScenario("AdminRegiste");
  		$config = Yii::app()->getParams();
  		$password=$config['default_password'];
  		if(empty($_POST[$model_name]['id'])){
  			//设置用户的密钥和默认密码
  			$salt=Util::randStr(6);
  			$user_salt=Util::createSalt($salt);
  			$model->user_salt=$salt;
  			$model->user_password=Util::hc($password,$user_salt);
  			$model->pay_password=$model->user_password;
  		}
      $model->attributes=$_POST[$model_name];
      $model->company_id=$this->controller->company_id;
			if($model->validate()){
				//注册ucenter
				$uid = uc_user_register($model->user_login,$password,$model->user_email);
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
		    	}
			    $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		    } 
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
