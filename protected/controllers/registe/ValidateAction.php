<?php
class ValidateAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_main_page();
        return true;
    }
   protected function do_action(){
			if(Yii::app()->request->isAjaxRequest){
			Util::reset_vars();
			$action=$_REQUEST['action'];
			$value=$_REQUEST['value'];
			$user=User::model();
			switch($action){
				case 'userlogin':
				    if(empty($value)){
				    	echo Util::combo_ajax_message("f",array(),"用户名不能为空");
				    }else{
				    $user->user_login=$value;
				    $user->exist_user_login();
				    $user_login_error=$user->getError("user_login");
				    if($user_login_error){
				    	echo Util::combo_ajax_message("f",array(),$user->getError("user_login"));
				    }else{
				    	echo Util::combo_ajax_message("s",array(),"用户名正确");
				    }
				  }
						break;
				case 'useremial':
				    if(empty($value)){
				    	echo Util::combo_ajax_message("f",array(),"邮箱不能为空");
				    }else{
				    if(!Util::ie($value)){
				    	echo Util::combo_ajax_message("f",array(),"邮箱格式错误");
				    }else{
				    $user->user_email=$value;
				    $user->exist_user_email();
				    $user_email_error=$user->getError("user_email");
				    if($user_email_error){
				    	echo Util::combo_ajax_message("f",array(),$user->getError("user_email"));
				    }else{
				    	echo Util::combo_ajax_message("s",array(),"用户邮箱正确");
				    }
				   }
				  }
						break;
				default:
						break;
			}
			return true;
		}else{
			return false;
		}
   }

}
?>