<?php
class IndexAction extends BaseAction{
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
		$model=new User("WebRegiste");
		$model_name=ucfirst(get_class($model));
		if($_POST[$model_name]){
      $model->attributes=$_POST[$model_name];
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
		    		/*
		    		$invite_code=Yii::app()->session->get("invite_code");
		    		if(!empty($invite_code)){
		    			$invite=Invite::model();
		    			$remote_ip=Util::getIp();
		    			$invite_user_data=$model->find(array('select'=>'t.id','condition'=>'invite_code=:invite_code','params'=>array(':invite_code'=>$invite_code)));
		    			$i_user_id=$invite_user_data->id;
		    			if(!empty($i_user_id)){
		    			  $invite_data=$invite->find(array('select'=>'t.invite_id','condition'=>'user_id=:user_id AND invite_ip=:invite_ip','params'=>array(':user_id'=>$i_user_id,'invite_ip'=>$remote_ip)));
		    			  if(empty($invite_data)){
		    			  	$invite->setIsNewRecord(true);
		    			  	$invite->user_id=$invite_user_data->id;
		    			  	$invite->invite_id=$model->id;
		    			  	$invite->invite_ip=$remote_ip;
		    			  	$invite->validate();
		    			  	$invite_result=$invite->insert_datas();
		    			  	if($invite_result){
		    			  		$sys_config=SysConfig::model();
		    			  		$all_sys_config=$sys_config->get_all_syscfg();
		    			  		$sfc_invite_coupon=$all_sys_config['sfc_invite_coupon'];
		    			  		$consume_temp=new ConsumeTemp();
		    			  		$consume_temp->consume(2,$i_user_id,'1',$sfc_invite_coupon,array('user_login'=>$model->user_login,'value'=>$sfc_invite_coupon));
		    			  	}
		    			  }
		    			}
		    		}
		    		*/
		    		if($uid > 0) {
				          $ucsynlogin = uc_user_synlogin($uid);
				     }
				    $model->user_password=$_POST[$model_name]['user_password'];
				    $model->login();
				   
		    		$uc_avatarflash = uc_avatar($model->id);
		    		$this->display("registe2",array('model'=>$model,'uc_avatarflash'=>$uc_avatarflash,'ucsynlogin'=>$ucsynlogin,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
		    		exit();
		    	}
		    }
		  }else{
			  //$this->f(CV::FAIL);
		  }
		}else{
        //$invite_code=$_REQUEST['invite_code'];
        //Yii::app()->session->add('invite_code',$invite_code);
		}
		$this->display('registe',array('model'=>$model,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
   }
}
?>