<?php
class LogoutAction extends BaseAction{
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
     Yii::app()->user->logout();
     $ucsynlogout = uc_user_synlogout();
     $this->display('loginoutsuccess',array('ucsynlogout'=>$ucsynlogout,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
   }
}
?>