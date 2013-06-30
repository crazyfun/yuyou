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
		    $ts = time();
	      $model=new User('Login');
	      $model_name=ucfirst(get_class($model));
	      $model_errors="";
        if(isset($_POST[$model_name])){
        	
            $model->attributes=$_POST[$model_name];
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
				        $this->display('loginsuccess',array('ucsynlogin'=>$ucsynlogin));
				        exit();
            }else{
            }
        }
  	    $this->display("index",array('model'=>$model,'ts'=>$ts,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
   }
}
?>